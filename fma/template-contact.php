<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
<?php 
if(have_posts()): while(have_posts()): the_post();
$thisID = get_the_id();
$childPages = getChildPages($thisID);
?>
     
      <!-- CONTENT -->
      <div id="contact_content" class="sectionedContent">

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_ihIJwce3FXPV63_Ic3dCbQAhBG1qOUc&v=3.exp&sensor=false"></script>
    <script>
var map;
var fma = new google.maps.LatLng(40.7514055,-73.9852373);

var MY_MAPTYPE_ID = 'custom_style';

function initialize() {

  //var featureOpts = [ { "featureType": "administrative.country", "stylers": [ { "visibility": "off" } ] },{ "featureType": "administrative.province", "stylers": [ { "visibility": "off" } ] },{ "featureType": "landscape.natural", "stylers": [ { "visibility": "on" }, { "color": "#d6d6d4" } ] },{ "featureType": "landscape.man_made", "elementType": "geometry", "stylers": [ { "color": "#e6e4e1" }, { "visibility": "off" } ] },{ "featureType": "poi", "stylers": [ { "visibility": "off" } ] },{ "featureType": "poi.park", "stylers": [ { "visibility": "on" }, { "color": "#9ca196" } ] },{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#999999" }, { "visibility": "on" } ] },{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "color": "#ffffff" } ] },{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "weight": 0.9 }, { "color": "#000000" } ] },{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "color": "#000000" }, { "visibility": "off" } ] },{ "featureType": "transit", "stylers": [ { "visibility": "off" } ] },{ "featureType": "administrative.neighborhood", "elementType": "labels.text.fill", "stylers": [ { "color": "#000000" } ] },{ "featureType": "administrative.neighborhood", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ffffff" } ] },{ "featureType": "landscape.man_made", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" }, { "color": "#bab8bb" } ] },{ "featureType": "road.local", "elementType": "geometry.fill" },{ "featureType": "road.local", "elementType": "geometry.stroke", "stylers": [ { "weight": 1.2 } ] },{ "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ] } ];
  var featureOpts = [
  {
    "featureType": "poi",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "landscape.man_made",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "landscape",
    "stylers": [
      { "color": "#f0f0f0" }
    ]
  },{
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [
      { "visibility": "on" },
      { "color": "#6A767A" }
    ]
  },{
    "featureType": "administrative",
    "elementType": "labels.text",
    "stylers": [
      { "visibility": "on" }
    ]
  },{
    "featureType": "transit.station",
    "elementType": "labels.text.fill",
    "stylers": [
      { "color": "#6A767A" }
    ]
  },{
    "elementType": "labels.icon"  }
];

  var mapOptions = {
    zoom: 16,
    center: fma,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
    },
    mapTypeId: MY_MAPTYPE_ID
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  
  var image = '<?php bloginfo('template_directory'); ?>/image/marker3.png';
  var fma_marker = new google.maps.LatLng(40.7514055,-73.9852373);
  var beachMarker = new google.maps.Marker({
      position: fma_marker,
      map: map
  });

  
  
  var styledMapOptions = {
    name: 'Custom Style'
  };

  var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

  map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <div id="map-canvas" style="height: 450px; "></div>

<?php echo get_the_content(); ?>
      <!-- SECONDARY PAGE CONTENT -->
<div><?php showChildPageContent($childPages); ?></div>
      </div><!-- contact_content -->

<?php
endwhile;
endif;
?>
<?php get_footer(); ?>