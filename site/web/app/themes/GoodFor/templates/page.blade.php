
@extends('layouts.base')


@section('content')
  @while(have_posts()) @php(the_post())

    {{-- header --}}
    @if (get_field('page_title_banner'))
      @php
        $image_url = get_the_post_thumbnail_url();
        if(get_field('alternative_title')) {
          $title = get_field('alternative_title_text');
        } else {
          $title = get_the_title();
        }

      @endphp
      @include('partials.page-header-banner', ['title' => $title, 'image_url' => $image_url])
    @elseif(! is_cart())
      @include('partials.page-header')
    @endif

    {{-- body --}}
    @if (have_rows('layouts') )
        @while( have_rows('layouts') ) @php( the_row())
          @if (get_row_layout() == 'featured_text')
            @include('sections.featured-text')
          @elseif (get_row_layout() == 'product_categories')
            @include('sections.product-categories')
          @elseif (get_row_layout() == 'media_logos')
            @include('sections.media-logos')
          @elseif (get_row_layout() == 'newsletter_banner')
            @include('sections.newsletter-banner')
          @elseif (get_row_layout() == 'image_links')
            @include('sections.image-links')
          @elseif (get_row_layout() == 'blog_overview')
            @include('sections.blog-overview')
          @elseif (get_row_layout() == 'full_width_banner')
            @include('sections.full-width-banner')
          @elseif (get_row_layout() == 'missing_anything')
            @include('sections.missing-anything')
          @endif
        @endwhile
    @elseif (is_cart())
      <div class="container container-wide" role="document">
        <h1>{!! App\title() !!}</h1>
        <div class="row">
          <aside class="sidebar col-12 col-lg-3">
            @include('partials.sidebar')
          </aside>
          <main class="main col-12 col-lg-9">

            @include('partials.content-page')
          </main>
        </div>
      </div>
    @else
      <div class="wrap container container-wide" role="document">
        @include('partials.content-page')
      </div>
    @endif



  @endwhile
@endsection
