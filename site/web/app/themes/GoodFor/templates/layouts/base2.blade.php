<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="content">
      @while(have_posts()) @php(the_post())
          @if (App\display_page_banner())
              @yield('header')
          @endif
          @if (App\display_sidebar())
            <div class="container">
              <div class="row">
                <aside class="sidebar col-12 col-md-3">
                  @include('partials.sidebar')
                </aside>
                <main class="main col-12 col-md-9">
                    @yield('content')
                </main>
              </div>
            </div>
          @else
            <main class="main">
                @yield('content')
            </main>
          @endif
      @endwhile
    </div>
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
  </body>
</html>
