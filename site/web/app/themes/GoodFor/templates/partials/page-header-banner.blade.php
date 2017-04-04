<div class="page-header-banner background-image" style="background-image:url('{{$image_url}}')">
  <div class="overlay-black">
      <div class="container-fluid w-100 h-100  d-table">
        <div class="center-box">
          @if (is_front_page())
            @php
              $image = get_field('alternative_logo', 'option');
            @endphp
            <img class="img-fluid" src="{{$image['url']}}" alt="{{$image['alt']}}">
            <a class="btn-outline" href="shop">Shop Now</a>
          @else
            <h1>{{$title}}</h1>
            @if (is_single() && !is_single('11'))
                @include('partials/entry-meta')
            @endif
          @endif

        </div>
      </div>
  </div>
</div>
