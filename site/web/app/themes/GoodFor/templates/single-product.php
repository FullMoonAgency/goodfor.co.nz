<!doctype html>
<?php //echo App\Template('woocommerce/single-product'); ?>
<html <?php language_attributes() ?>>
  <?php echo App\Template('partials/head'); ?>
  <body <?php body_class('fullmoon_theme') ?>>

    <?php do_action('get_header') ?>
    <?php echo App\Template('partials/header'); ?>
    <div class="content">
      <?php
      if (is_shop()) {
        $image = get_the_post_thumbnail_url(get_option('woocommerce_shop_page_id') );
        $title = get_the_title(get_option('woocommerce_shop_page_id') );
        echo App\Template('partials/page-header-banner', array('title' => $title, 'image_url' => $image));
      }
      ?>
      <div class="container container-wide">
        <?php woocommerce_breadcrumb(); ?>
        <div class="row">
          <aside class="sidebar col-12 col-lg-3">
            <?php echo App\Template('partials/sidebar'); ?>

          </aside>
          <main class="main col-12 col-lg-9">
            <?php
            while (have_posts()) : the_post();
              wc_get_template_part( 'content', 'single-product' );
            endwhile;
            // App\print_filters_for( 'woocommerce_before_add_to_cart_form' );
            // App\print_filters_for( 'woocommerce_single_variation' );
             ?>
          </main>
        </div>
      </div>
      <div class="missing-anything vheight-all text-center">
        <div class="container container-wide">
          <?php echo the_field('missing_anything', 'option'); ?>
        </div>
      </div>
      <?php do_action('get_footer') ?>
      <?php echo App\Template('partials/footer'); ?>
      <?php wp_footer() ?>
    </div>
  </body>
</html>
