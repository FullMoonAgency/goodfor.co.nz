<div class="container container-wide product-categories">
  <div class="row center-flex">
    <?php
    $taxonomyName = "product_cat";
    $categories = get_terms($taxonomyName, array('orderby' => 'slug', 'hide_empty' => false)); ?>
      @foreach ($categories as $cPost)
          <?php
          //get cat image
          $thumbnail_id = get_woocommerce_term_meta($cPost->term_id, 'thumbnail_id', true);
          $image = wp_get_attachment_image_src($thumbnail_id, 'thumbnail')[0];

          $name = $cPost->name;
          $link = get_term_link($name, $taxonomyName); ?>


          <div class="align-self-start col-6 col-md-4 col-lg-3  p-2">
              <a href="{{ $link }}">
                <div class="image-hover-overlay text-center">
                  @if ($image)
                    <img class="img-fluid" src="{{$image}}" alt="{{$name}}">
                  @else
                    <img style="max-width:100%;" src="@asset('images/lentils.jpg')">
                  @endif


                  <div class="caption">
                    <div class="d-table w-100 h-100">
                      @php
                        //$name = ucwords(strtolower($name));
                      @endphp
                      <h4>{{$name}}</h4>
                    </div>
                  </div>
                </div>
              </a>
          </div>
  	  @endforeach
    </div>
</div>
