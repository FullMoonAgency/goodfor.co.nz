<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    // Add class if sidebar is active
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    return $classes;
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
array_map(function ($type) {
    add_filter("{$type}_template_hierarchy", function ($templates) {
        return call_user_func_array('array_merge', array_map(function ($template) {
            $transforms = [
                '%^/?(templates)?/?%' => config('sage.disable_option_hack') ? 'templates/' : '',
                '%(\.blade)?(\.php)?$%' => ''
            ];
            $normalizedTemplate = preg_replace(array_keys($transforms), array_values($transforms), $template);
            return ["{$normalizedTemplate}.blade.php", "{$normalizedTemplate}.php"];
        }, $templates));
    });
}, [
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
]);

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = array_reduce(get_body_class(), function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    echo template($template, $data);

    // Return a blank file to make WordPress happy
    return get_theme_file_path('index.php');
}, PHP_INT_MAX);

/**
 * Tell WordPress how to find the compiled path of comments.blade.php
 */
add_filter('comments_template', 'App\\template_path');

add_filter('sage/display_sidebar', function ($display) {
    static $display;

    isset($display) || $display = in_array(true, [
      // The sidebar will be displayed if any of the following return true
    //  is_page('woocommerce-category.blade.php'),
      is_tax()
    ]);

    return $display;
});

add_filter('sage/display_page_banner', function ($display) {
    static $display;

    isset($display) || $display = in_array(true, [
      // The sidebar will be displayed if any of the following return true
    //  is_page('woocommerce-category.blade.php'),
      is_tax(),
      is_front_page(),
      is_page()
    ]);

    return $display;
});


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page('Theme Settings');

}


//remove reviews
add_filter('woocommerce_product_tabs', function ($tabs) {
  unset($tabs['reviews']);
  unset($tabs['description']);
  unset( $tabs['additional_information'] );
  return $tabs;
}, 98);


//remove max price so default price is 100g
add_filter( 'woocommerce_variable_sale_price_html', function ( $price, $_product ) {
    $min_price_regular = $_product->get_variation_regular_price( 'min', true );
    $min_price_sale    = $_product->get_variation_sale_price( 'min', true );
    return ( $min_price_sale == $min_price_regular ) ?
        wc_price( $min_price_regular ) :
        '<del>' . wc_price( $min_price_regular ) . '</del>' . '<ins>' . wc_price( $min_price_sale ) . '</ins>';
}, PHP_INT_MAX, 2 );
add_filter( 'woocommerce_variable_price_html',      function ( $price, $_product ) {
    $min_price_regular = $_product->get_variation_regular_price( 'min', true );
    $min_price_sale    = $_product->get_variation_sale_price( 'min', true );
    return ( $min_price_sale == $min_price_regular ) ?
        wc_price( $min_price_regular ) :
        '<del>' . wc_price( $min_price_regular ) . '</del>' . '<ins>' . wc_price( $min_price_sale ) . '</ins>';
}, PHP_INT_MAX, 2 );

//inc products per archive page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );


//remove sort by options

add_filter( "woocommerce_catalog_orderby", function ( $orderby ) {
    unset($orderby["rating"]);
    //menu_order, popularity, rating, date, price, price-desc.
    return $orderby;
}, 20 );

add_filter('woocommerce_shop_loop_item_title', function() {
  echo '<div class="product-info-size">';
}, 1);
add_filter('woocommerce_after_shop_loop_item_title', function() {
  echo '</div>';
}, 11);


  add_filter( 'woocommerce_show_page_title' , function() { return false; } );



// add_filter( 'woocommerce_product_tabs', __NAMESPACE__ . '\\woo_new_product_tab' );
// function woo_new_product_tab( $tabs ) {
//
// 	// Adds the new tab
//
// 	$tabs['test_tab'] = array(
// 		'title' 	=> __( 'Delivery', 'woocommerce' ),
// 		'priority' 	=> 50,
// 		'callback' 	=> 'App\woo_new_product_tab_content'
// 	);
//
// 	return $tabs;
//
// }
// function woo_new_product_tab_content() {
//
// 	// The new tab content
//
// 	echo '<h2>Delivery Info</h2>';
// 	echo '<p>Flate fee of $5 nation wide</p>';
//
// }



//add_filter('woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_add_to_cart', 15);




//rearange single product
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
add_filter('woocommerce_before_add_to_cart_button', 'woocommerce_single_variation', 1);

function print_filters_for( $hook = '' ) {
    global $wp_filter;
    if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
        return;

    print '<pre>';
    print_r( $wp_filter[$hook] );
    print '</pre>';
}


//add_filter('woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 1);
add_filter('woocommerce_single_product_summary', function() {
  the_content();
}, 6);


// //add devilery details using ACF
// add_filter('woocommerce_single_product_summary', function() {
//   the_field('delivery_details', 'option');
// },39 );

// src/filters.php

add_filter('wc_get_template_part', function ($template, $slug, $name) {

    $bladeTemplate = false;

    // Look in yourtheme/slug-name.blade.php and yourtheme/woocommerce/slug-name.blade.php
    if ( $name && ! WC_TEMPLATE_DEBUG_MODE ) {
        $bladeTemplate = locate_template( array( "{$slug}-{$name}.blade.php", WC()->template_path() . "{$slug}-{$name}.blade.php" ) );
    }

    // If template file doesn't exist, look in yourtheme/slug.blade.php and yourtheme/woocommerce/slug.blade.php
    if ( ! $template && ! WC_TEMPLATE_DEBUG_MODE ) {
        $bladeTemplate = locate_template( array( "{$slug}.blade.php", WC()->template_path() . "{$slug}.blade.php" ) );
    }

    if ($bladeTemplate) {
        echo template($bladeTemplate);

        // Return a blank file to make WooCommerce happy
        return get_theme_file_path('index.php');
    }

    return $template;
}, PHP_INT_MAX, 3);


add_filter('wc_get_template', function($located, $template_name, $args, $template_path, $default_path) {

    $bladeTemplateName = str_replace('.php', '.blade.php', $template_name);
    $bladeTemplate = locate_template( array($bladeTemplateName, WC()->template_path() . $bladeTemplateName ) );

    if ($bladeTemplate) {
        return template_path($bladeTemplate, $args);
    }

    return $located;
}, PHP_INT_MAX, 5);


add_action( 'wp_enqueue_scripts', function () {
    wp_dequeue_style( 'wcqi-css' );
} );



/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
add_filter( 'woocommerce_add_to_cart_fragments', function ( $fragments ) {

    ob_start();
    $count = WC()->cart->cart_contents_count;

    echo '<div class="cart-contents"  title="' . _e( 'View your shopping cart' ) . '">';
    echo '<span class="cart-contents-count">';
    if ( $count >= 0 ) {
       echo esc_html( $count );
    }
    echo '</span></div>';

    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
} );
