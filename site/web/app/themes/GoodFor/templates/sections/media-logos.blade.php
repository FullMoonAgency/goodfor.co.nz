
  @php
    $args = array( 'post_type' => 'media', 'order_by' => 'date', 'posts_per_page' => 999);
    $loop = new WP_Query( $args );
  @endphp
  @if($loop->have_posts())
    <section class="container vheight">
      <div class="media-logos row">
        @while($loop->have_posts()) @php($loop->the_post())
          @php
            $image = get_field('logo');
            $link = get_field('link');
          @endphp
          <div class="media-logo col-12 col-md-3">
            <a target="_blank" href="{{$link}}">
              <img class="img-fluid" src="{{$image['url']}}" alt="{{$image['alt']}}" >
            </a>
          </div>

        @endwhile
        @php(wp_reset_postdata())
      </div>
    </section>
  @endif
