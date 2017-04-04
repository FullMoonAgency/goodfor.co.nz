
  <article @php(post_class())>
    <header>
      @php
        $image_url = get_the_post_thumbnail_url();
        $title = get_the_title();
      @endphp
      @include('partials.page-header-banner', ['title' => $title, 'image_url' => $image_url])

    </header>
    <div class="container max-900 vheight">
      <div class="row">
        <div class="entry-content col-12">
          @php(the_content())
          <footer>
            {!! wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
          </footer>
          @php(comments_template('/templates/partials/comments.blade.php'))

        </div>
        {{-- <aside class="col-12 col-md-3">
          @include('partials.sidebar')
        </aside> --}}
        <div class="single-navigation-prev col-6 vheight-top">
          @php(previous_post_link())
        </div>
        <div class="single-navigation-next col-6 vheight-top text-right">
          @php(next_post_link())
        </div>
      </div>
    </div>


  </article>
