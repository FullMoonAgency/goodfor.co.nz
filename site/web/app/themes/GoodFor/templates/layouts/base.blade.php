<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class('fullmoon_theme'))>
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="content">
        @yield('content')
        @php(do_action('get_footer'))
        @include('partials.footer')
        @php(wp_footer())
    </div>
  </body>
</html>
