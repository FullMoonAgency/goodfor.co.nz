{{--
  Template Name: Contact Page
--}}


@extends('layouts.base')


@section('content')
  @while(have_posts()) @php(the_post())
  <section class="contact-page">
    <header>
      <div class="map-box">
        <div id="map" ></div>
      </div>
    </header>
    <section class="contact-body  container  ">
      <div class="contact-heading  text-center">
        @php
          if(get_field('alternative_title')) {
            $title = get_field('alternative_title_text');
          } else {
            $title = get_the_title();
          }
        @endphp
        <h1>{{$title}}</h1>
        {{the_field('heading_line')}}
      </div>
      <div class="row ">
        <div class="col-md-6 col-12 contact-details">
            <h2>{{the_field('contact_info_title')}}</h2>
            <p>
              Email {{the_field('email','option')}}<br>
              Phone {{the_field('phone_number','option')}}
            </p>
            <h2>{{the_field('location_title')}}</h2>
            {{the_field('location_body')}}
        </div>
        <div class=" col-md-6 col-12 contact-form">
          @php
          echo  do_shortcode('[gravityform id="1" title="false"]');
          @endphp
        </div>
      </div
    </section>

  </section>


  <script>
     function initMap() {

       // Create a new StyledMapType object, passing it an array of styles,
       // and the name to be displayed on the map type control.
       var styledMapType = new google.maps.StyledMapType(
         [
             {
                 "featureType": "administrative",
                 "elementType": "all",
                 "stylers": [
                     {
                         "saturation": "-100"
                     }
                 ]
             },
             {
                 "featureType": "administrative.province",
                 "elementType": "all",
                 "stylers": [
                     {
                         "visibility": "off"
                     }
                 ]
             },
             {
                 "featureType": "landscape",
                 "elementType": "all",
                 "stylers": [
                     {
                         "saturation": -100
                     },
                     {
                         "lightness": 65
                     },
                     {
                         "visibility": "on"
                     }
                 ]
             },
             {
                 "featureType": "poi",
                 "elementType": "all",
                 "stylers": [
                     {
                         "saturation": -100
                     },
                     {
                         "lightness": "50"
                     },
                     {
                         "visibility": "simplified"
                     }
                 ]
             },
             {
                 "featureType": "road",
                 "elementType": "all",
                 "stylers": [
                     {
                         "saturation": "-100"
                     }
                 ]
             },
             {
                 "featureType": "road.highway",
                 "elementType": "all",
                 "stylers": [
                     {
                         "visibility": "simplified"
                     }
                 ]
             },
             {
                 "featureType": "road.arterial",
                 "elementType": "all",
                 "stylers": [
                     {
                         "lightness": "30"
                     }
                 ]
             },
             {
                 "featureType": "road.local",
                 "elementType": "all",
                 "stylers": [
                     {
                         "lightness": "40"
                     }
                 ]
             },
             {
                 "featureType": "transit",
                 "elementType": "all",
                 "stylers": [
                     {
                         "saturation": -100
                     },
                     {
                         "visibility": "simplified"
                     }
                 ]
             },
             {
                 "featureType": "water",
                 "elementType": "geometry",
                 "stylers": [
                     {
                         "hue": "#ffff00"
                     },
                     {
                         "lightness": -25
                     },
                     {
                         "saturation": -97
                     }
                 ]
             },
             {
                 "featureType": "water",
                 "elementType": "geometry.fill",
                 "stylers": [
                     {
                         "saturation": "-10"
                     },
                     {
                         "color": "#dddcdc"
                     }
                 ]
             },
             {
                 "featureType": "water",
                 "elementType": "labels",
                 "stylers": [
                     {
                         "lightness": -25
                     },
                     {
                         "saturation": -100
                     }
                 ]
             }
          ],
           {name: 'Styled Map'});

       // Create a map object, and include the MapTypeId to add
       // to the map type control.
       var goodforshop = {lat: -36.8580849, lng: 174.7491599};
       var map = new google.maps.Map(document.getElementById('map'), {
         center: goodforshop,
         zoom: 13,
         scrollwheel: false,
         navigationControl: false,
          mapTypeControl: false,
          scaleControl: false,

         mapTypeControlOptions: {
           mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                   'styled_map']
         }
       });


       var marker = new google.maps.Marker({
         position: goodforshop,
         icon: "@asset('images/marker.png')",
         map: map
       });

       //Associate the styled map with the MapTypeId and set it to display.
       map.mapTypes.set('styled_map', styledMapType);
       map.setMapTypeId('styled_map');
     }
   </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCf6f87GtBm3uJ25gu90mnKvtApE1CQItQ&callback=initMap">
  </script>

  @endwhile
@endsection
