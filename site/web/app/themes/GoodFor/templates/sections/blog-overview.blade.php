
@php
  //Protect against arbitrary paged values
  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

  $args = array(
    'post_type' => 'post',
    'order_by' => 'date',
    'posts_per_page' => 12,
    'paged' => $paged
  );
  $loop = new WP_Query( $args );
@endphp
@if($loop->have_posts())
  <section class="container blog-overview vheight">
    <div class="row">
      @while($loop->have_posts()) @php($loop->the_post())
        @php
          $image = get_the_post_thumbnail_url();
          $link = get_permalink();
          $name = get_the_title();
        @endphp
        <div class="col-12 col-md-4  p-2">
            <a href="{{ $link }}">
              <div class="image-hover-overlay text-center">
                @if ($image)
                  <img class="img-fluid" src="{{$image}}" alt="{{$name}}">
                @else
                  <img style="max-width:100%;" src="@asset('images/lentils.jpg')">
                @endif


                <div class="caption">
                  <div class="d-table w-100 h-100">
                    <h4>{{$name}}</h4>
                  </div>
                </div>
              </div>
            </a>
        </div>

      @endwhile

      @php


      $max_num_pages = $loop->max_num_pages;

      $html= '<div class="paginate woocommerce"><nav class="woocommerce-pagination">';

      $big = 999999999; // need an unlikely integer

      $html.= paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $max_num_pages,
        'prev_text'    => '&larr;',
  			'next_text'    => '&rarr;',
  			'type'         => 'list'
        ) );


      $html.= '</nav></div >';
      echo $html;
      @endphp


      @php(wp_reset_postdata())
    </div>
  </section>
@endif
