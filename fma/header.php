<?php
//include (get_template_directory().'/inc/custom_walker.php');
?><!DOCTYPE HTML>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<title><?php 
  if (is_front_page()) { 
    echo get_bloginfo('name');
    if (get_bloginfo('description')!="") { echo " | ".get_bloginfo('description'); }
  } else {
    wp_title ( ' | ', true,'right' );
    echo get_bloginfo('name');
  } ?></title>

<?php wp_head(); ?>

</head>
<body>
<?php  $template = end (explode('/',get_page_template()) ); ?>
<div id="feedback">feedback</div>
<div id="wrapper"<?php if (current_user_can('manage_options')) { echo ' style="margin-top: -32px;"'; } ?>>
  <div id="content_left">
    <div id="content_left_container">
    <header>
      <h1><a href="<?php echo get_option('home'); ?>" title="<?php echo get_bloginfo('name'); ?>"><?php echo get_bloginfo('name'); ?></a></h1>
    </header>
    <nav>
      <ul class="browser">
<?php
$locations = get_nav_menu_locations();
$items = wp_get_nav_menu_items($locations['primary-menu']);
//print_r($items);
foreach($items as $item) { ?>
        <li><a href="<?php echo $item->url; ?>"><?php 
          if($item->post_title != "") {
            echo $item->post_title;
          } else {
            echo get_the_title($item->object_id); } ?></a></li>
<?php } ?>
      </ul>
      <ul class="mobile">
<?php
$locations = get_nav_menu_locations();
$items = wp_get_nav_menu_items($locations['primary-menu']);
//print_r($items);
foreach($items as $item) { ?>
        <li><a href="<?php echo $item->url; ?>"><?php 
          if($item->post_title != "") {
            echo $item->post_title;
          } else {
            echo get_the_title($item->object_id); } ?></a></li>
<?php } ?>
        <li class="email"><a href="mailto:info@fradkinmcalpin.com"><span>Email</span></a></li>
        <li class="phone"><a href="tel:2125295740"><span>Phone</span></a></li>
        <li class="map"><a href="https://www.google.com/maps/place/39+W+37th+St,+New+York,+NY+10018/@40.7514055,-73.9852373,17z/data=!3m1!4b1!4m2!3m1!1s0x89c259aa39e5366d:0x10f3457a652a3f1d" target="_blank"><span>Map</span></a></li>
        <li class="copyright">©2014 Fradkin & McAlpin Architects, LLP</li>
      </ul>
    </nav>
    <div class="mobile_clear"></div>
    </div>
  </div><!-- content_left -->
  
  <div id="content_right"<?php 
    if(
      $template == 'template-studio.php' ||
      $template == 'template-contact.php') {
      echo ' class="sidebar"'; 
    }
    if(is_front_page()) { echo ' class="homepage"'; }
  ?>>