@extends('layouts.base')


@section('content')

  @if (is_shop())
    @php
      $image = get_the_post_thumbnail_url(get_option('woocommerce_shop_page_id') );
      $title = get_the_title(get_option('woocommerce_shop_page_id') );
    @endphp
    @include('partials.page-header-banner', ['title' => $title, 'image_url' => $image])
  @endif

  <div class="container">
    <div class="row">
      <aside class="sidebar col-12 col-md-3">
        @include('partials.sidebar')
      </aside>
      <main class="main col-12 col-md-9">
        @while ( have_posts() ) @php(the_post())
          @php
            wc_get_template_part( 'content', 'single-product' );
          @endphp
        @endwhile
      </main>
    </div>
  </div>
  <div class="missing-anything vheight text-center">
    <div class="container container-wide">
      {{the_field('missing_anything', 'option')}}
    </div>
  </div>
@endsection
