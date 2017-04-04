@if (is_tax() || is_shop() || is_product() || is_cart())
  @php(dynamic_sidebar('sidebar-category'))
@else
  @php(dynamic_sidebar('sidebar-primary'))
@endif
