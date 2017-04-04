<header class="banner">
  <div class="container container-wide">

    <nav class="row primary_navigation">

     <a id="logo-menu" class="fixed-left" href="{{ home_url('/') }}">
       @php
         $image = get_field('site_logo', 'option');
       @endphp
       <img class="img-fluid" src="{{$image['url']}}" alt="{{$image['alt']}}">
     </a>
      @if (has_nav_menu('primary_navigation'))
        <div class="w-100 col" id="navbarSupportedContent">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
        </div>
      @endif
      <div class=" header-widgets">
        <div class="widget-search">
          @php(dynamic_sidebar('widget-search'))
          <div class="search-btn"></div>
        </div>
        <div class="widget-cart">
            @php
              $count = WC()->cart->cart_contents_count;
            @endphp
            <div class="cart-header">
              {{-- href="{{WC()->cart->get_cart_url()}}" --}}
              <div class="cart-contents"  title="<?php _e( 'View your shopping cart' ); ?>">
                @if ( $count >= 0)
                  <span class="cart-contents-count"> {{esc_html( $count )}}</span>
                @endif
              </div>
              @php(dynamic_sidebar('widget-cart'))
            </div>
        </div>
      </div>


    </nav>
  </div>
</header>
<div class="header-buffer">

</div>
