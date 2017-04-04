<!doctype html>
<?php //echo App\Template('woocommerce/single-product'); ?>
<html <?php language_attributes() ?>>
  <?php echo App\Template('partials/head'); ?>
  <body <?php body_class() ?>>

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
      <div class="container">
        <div class="row">
          <aside class="sidebar col-12 col-md-3">
            <?php echo App\Template('partials/sidebar'); ?>
            @include('partials.sidebar')
          </aside>
          <main class="main col-12 col-md-9">
            <?php
            while (have_posts()) : the_post();
              wc_get_template_part( 'content', 'single-product' );
            endwhile;
             ?>
          </main>
        </div>
      </div>
      <?php do_action('get_footer') ?>
      <?php echo App\Template('partials/footer'); ?>
      <?php wp_footer() ?>
    </div>
  </body>
</html>
