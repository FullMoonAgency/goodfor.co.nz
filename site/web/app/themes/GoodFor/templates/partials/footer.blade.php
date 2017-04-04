<footer id="main-footer" class="content-info">
  <div class="footer-menu-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-12">
          @php(dynamic_sidebar('sidebar-footer'))
        </div>
        <div class="col-12 col-lg-2 social_icons">
          <div class="row">
            @if(have_rows('footer_social_icons', 'option'))

                @while(have_rows('footer_social_icons', 'option')) @php(the_row())
                  @php
                    $icon = get_sub_field('icon', 'option');
                    $link = get_sub_field('link', 'option');
                  @endphp
                    <div class="social_icon col">
                      <a href="{{$link}}">
                        <img src="{{$icon['url']}}" alt="{{$icon['alt']}}">
                      </a>
                    </div>
                @endwhile
            @endif
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="sub-footer ">
    <div class="container">
      <div class="row ">
        <div class="col">
          <span class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</span>
          <span class="fullmoon-link">Powered by <a href="http://fullmoon.co.nz" target="_blank" rel="nofollow"> Full Moon</a></span>
        </div>
      </div>
    </div>
  </div>

</footer>
