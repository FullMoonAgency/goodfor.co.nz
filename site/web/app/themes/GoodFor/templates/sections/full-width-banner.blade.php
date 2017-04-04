@php
  $background = get_sub_field('background');
  $title = get_sub_field('title');
  $body = get_sub_field('body');
  $overlay = $class = $background_image = "";
  if ($background == 'image') {
    $image = get_sub_field('image');
    $background_image .= "background-image: url('";
    $background_image .= $image['url'];
    $background_image .= "');";
    $class .= "background-image";
    $overlay .= "overlay-black";
  } else {
    $class .= $background;
  }
  $class .= "  banner-height text-center full-width-banner";
  $overlay .= " ";
@endphp
<section class="{{$class}}" style="{{$background_image}}">
  <div class="{{$overlay}}">
    <div class="container w-100 h-100  d-table">
      <div class="center-box">
          @if ($title)
            <h2>{{$title}}</h2>
          @endif
          @if ($body)
            <p>{!!$body!!}</p>
          @endif
          @if (have_rows('button'))
              @while(have_rows('button')) @php(the_row())
                <a class="btn-outline" href="{{the_sub_field('link')}}">{{the_sub_field('title')}}</a>
              @endwhile
          @endif
      </div>
    </div>
  </div>
</section>
