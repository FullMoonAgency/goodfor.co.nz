<section class="newsletter-banner vheight-all text-center">
  <div class="container">
    <div class="row">
        @php
           $text = get_sub_field('text');
           $form = get_sub_field('form');
         @endphp
         <div class="col-12">
           <p class="h3">{{$text}}</p>
         </div>
         <div class="col-12">
          @php
            print  $form;
          @endphp
         </div>
    </div>
  </div>
</section>
