<section class="image-links pt-3 vheight-bottom">
  <div class="container">
    @if (have_rows('image_links'))
      <div class="image_links row">
        @while(have_rows('image_links')) @php(the_row())
          <div class="col-md-4 col-12 p-2">
              @php
                $image = get_sub_field('image');
                $name = get_sub_field('caption');
                $link = get_sub_field('link');
              @endphp
              <a href="{{ $link }}">
                <div class="image-hover-overlay text-center">
                  <img class="img-fluid" src="{{$image['sizes']['thumbnail']}}" alt="{{$image['alt']}}">
                  <div class="caption">
                    <div class="d-table w-100 h-100">
                      <h4>{{$name}}</h4>
                    </div>
                  </div>
                </div>
              </a>
          </div>
        @endwhile
      </div>
    @endif
  </div>
</section>
