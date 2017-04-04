@if (get_sub_field('normal_text_box'))
  <section class="text-only vheight-top">
@else
  <section class="featured-text vheight text-center">
@endif
    <div class="container">
      {{the_sub_field('text')}}
    </div>
  </section>
