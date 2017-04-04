@extends('layouts.base')


@section('content')

  @if (is_product_category())
    @php
      // global $wp_query;
      // $cat = $wp_query->get_queried_object();
      // $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
      // $image = wp_get_attachment_url( $thumbnail_id, 'large' );
      // $title = $cat->name;
    @endphp
  @endif

  <div class="container container-wide">
    <div class="row">
      <div class="col">
        @php
          woocommerce_breadcrumb();
        
        @endphp
        <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
      </div>

    </div>
    <div class="row">
      <aside class="sidebar col-12 col-lg-3 col-xl-3">
        @include('partials.sidebar')
      </aside>
      <main class="main col-12 col-lg-9 col-xl-9">
          <?php woocommerce_content(); ?>
      </main>
    </div>
  </div>
  <div class="missing-anything vheight-all text-center">
    <div class="container container-wide">
      {{the_field('missing_anything', 'option')}}
    </div>
  </div>
@endsection
