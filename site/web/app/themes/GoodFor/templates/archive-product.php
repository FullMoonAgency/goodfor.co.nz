<?php
if (is_search()) {
  echo App\Template('woocommerce/taxonomy-product_cat');
} else {
  // resets woocommerce shop to normal page query
  $args = array(
    'post_type' => 'page',
    'p' => get_option('woocommerce_shop_page_id')
  );
  query_posts( $args );
  echo App\Template('page');
}
?>
