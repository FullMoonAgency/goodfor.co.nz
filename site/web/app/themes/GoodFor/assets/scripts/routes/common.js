export default {
  init() {
    // JavaScript to be fired on all pages
    var isMobile = false;
    var isMob = window.matchMedia("only screen and (max-width: 768px)");
    if (isMob.matches) {
      isMobile = true;
    }

    //mobile header search
    if(isMobile) {
      $('.widget-search .search-btn').click(function(){
        $('.widget-search .product-search').toggleClass('active');
        $('.widget-search').toggleClass('active');
        $('input.product-search-field').focus();
      });
//
    }


    // $('input.product-search-field').focusout(function(){
    //     $('.widget-search .search-btn').click();
    // });



    $('.product.pa_size-100g span.ivpa_term[data-term="100g"]').click();
      $('.widget_shopping_cart').hide();

    //$('#mega-menu-wrap-primary_navigation #mega-menu-primary_navigation > li.mega-menu-megamenu > ul.mega-sub-menu').wrapInner( "<div class='wrapper'></div>");
if(isMobile) {
  $('.cart-header').click(function(){
    window.location.href =  "/cart";
  });
} else {

  $('.cart-header').click(function(){
    $('.widget_shopping_cart').fadeToggle(200);
  });

  $('.widget_shopping_cart').mouseleave(function(){
    $('.widget_shopping_cart').fadeToggle(200);
  });
}

/***********************animation**********************************************/
var currentScroll = jQuery(window).scrollTop();
var didScroll = true;
var st;
var middleScreen;

/***************************FADE in sections**********************************/

        var fadeSections = ".page-header-banner .center-box, .full-width-banner .center-box, .featured-text p, .image-hover-overlay, .media-logo, .newsletter-banner .row, .missing-anything .container";
        var $fadeSections = $(fadeSections);
        var $fadeSectionsSlow = $(".feature-box");
        $fadeSections.addClass("active-scroll");
        $fadeSectionsSlow.addClass("active-scroll-slow");

        function checkScroll() {
          currentScroll = jQuery(window).scrollTop();
          jQuery(window).trigger('fooscroll');
        }
        if(!isMobile){
        /** Update Scroll Position **/
        setInterval(function() {
            if ( didScroll ) {
            didScroll = false;
            checkScroll();
            }
        }, 250);
        //var lastScrollTop = 0;
        $(window).on('scroll', function() {
            didScroll = true;
        });
        //onscroll
        $(window).on('fooscroll', function() {
          scrollFade();
        });
      }
        function scrollFade() {
              //section fade in
              var fadeDelay = 0;
              $(".active-scroll").each(function(index, element) {

                st = $(this).offset().top;
                middleScreen = currentScroll + $(window).height()*0.95;
                if (st <= middleScreen) {
                  setTimeout(function(){
                    $(element).addClass("show-item");

                  }, fadeDelay*150);
                  setTimeout(function(){
                    $(element).removeClass("active-scroll");
                  }, fadeDelay*150+150);
                  //max consecqutive items fading In: 5
                  if (fadeDelay < 5) {
                    fadeDelay++;
                  }

                }
              });

              var fadeDelay2 = -1;
              //slow scroll in
              $(".active-scroll-slow").each(function(index, element) {

                st = $(this).offset().top;
                middleScreen = currentScroll + $(window).height();
                if (st <= middleScreen) {
                    $(element).removeClass("active-scroll");
                  setTimeout(function(){
                    $(element).addClass("show-item");

                  }, fadeDelay2*400);
                  //max consecqutive items fading In: 5
                  if (fadeDelay2 < 5) {
                    fadeDelay2++;
                  }

                }
              });
      }
  /*********************************************************************************/
if(!isMobile) {


    $(".home .full-width-banner").addClass("parallax");

  /*********Parallax***********/
      var speedP = 0.5;
      $(window).on('scroll', function() {
      $(".parallax").each(function() {
        if($(window).width() <= 800) {
          $(this).addClass("cover-image");
          $(this).removeClass("parallax");
          return false;
        }
        if($(this).hasClass("fast-speed")){
          speedP = 0.7;
        } else if ($(this).hasClass("slow-speed")) {
          speedP = 0.2;
        } else {
          speedP = 0.5;
        }
        var amountOff = window.pageYOffset - $(this).offset().top;
        var elBackgrounPos = "50% " + (amountOff * -speedP) + "px";
        $(this).css({
          backgroundPosition: elBackgrounPos,
        });

    });

    });
  }
  /*********************************end parallax*************************************************/

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
