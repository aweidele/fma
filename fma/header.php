<?php
//include (get_template_directory().'/inc/custom_walker.php');
?><!DOCTYPE HTML>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<script src="https://use.typekit.net/tnc5esc.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<title><?php 
  if (is_front_page()) { 
    echo get_bloginfo('name');
    if (get_bloginfo('description')!="") { echo " | ".get_bloginfo('description'); }
  } else {
    wp_title ( ' | ', true,'right' );
    echo get_bloginfo('name');
  } ?></title>

<?php 
wp_head(); 
?>

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
// Home is the posts page, not the front page.
$ppp = -1;
if(is_home()||is_category()||is_page_template("template-instagram.php")) {
	$ppp = get_option( 'page_for_posts' );
}
foreach($items as $item) {
	$check_children = is_page($item->object_id); 
	$is_home = $ppp == $item->object_id;
	$is_portfolio = in_array('project-archive', $item->classes) && (is_page_template("template-project.php") || is_tax("theme") || is_tax("type"));
?>
        <li class="<?= ($check_children || $is_home || $is_portfolio) ? 'current-menu-item' : '' ?>"><a href="<?php echo $item->url; ?>"><?php 
          if($item->post_title != "") {
            echo $item->post_title;
          } else {
            echo get_the_title($item->object_id); } ?></a>
<?php
	if( $is_portfolio ) {
		$themes = get_terms( 'theme' );

		echo '<ul class="nested">';

		foreach($themes as $t) { ?>
            <li class="<?= is_tax("theme", $t->slug) ? 'current-menu-item' : '' ?>"><a href="<?php echo get_term_link($t, 'theme'); ?>"><?php echo $t->name; ?></a></li>
<?php } ?>          
	    	<li class="<?= is_page_template("template-project.php") ? 'current-menu-item' : '' ?>"><a href="<?php echo get_permalink(19); ?>">View All</a></li>
	   	</ul>
	   	<?php
	} else if($check_children) {
  		require_once('subpages.php');
		$childPages = getChildPages($item->object_id);
		childPageMenu($childPages);
	} else if( $is_home ) {
		$categories = get_categories();
		if(is_category()) {
		  $thisCat = get_category( get_query_var( 'cat' ) );
		}
		echo '<ul class="nested">';
		foreach($categories as $cat) { ?>
			
          <li<?php if(is_object($thisCat) && $thisCat->slug == $cat->slug) { echo ' class="current-menu-item"'; } ?>><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></li>
	<?php 	} 
	
		$instagramPage = get_field("instagram_page", $ppp);
		
		if($instagramPage) {
		?>
		  <li<?php if(is_page_template("template-instagram.php")) { echo ' class="current-menu-item"'; } ?>><a href="<?php echo $instagramPage; ?>">Instagram</a></li>
		<?php } ?>
          <li<?php if(!is_object($thisCat)&&!is_page_template("template-instagram.php")) { echo ' class="current-menu-item"'; } ?>><a href="<?php echo get_permalink($ppp); ?>">View All</a></li>
        </ul>
	<?php
	}
	echo "</li>"; 
} 
?>

      </ul>
      <ul class="mobile">
<?php
foreach($items as $item) { ?>
        <li><a href="<?php echo $item->url; ?>"><?php 
          if($item->post_title != "") {
            echo $item->post_title;
          } else {
            echo get_the_title($item->object_id); } ?></a></li>
<?php } 

$email = get_field("footer_email", "options");
$phoneLink = get_field("footer_phone_link", "options");
$maps = get_field("footer_google_maps_url", "options");
?>
        <li class="email"><a href="mailto:<?= $email ?>"><span>Email</span></a></li>
        <li class="phone"><a href="tel:<?= $phoneLink ?>"><span>Phone</span></a></li>
        <li class="map"><a href="<?= $maps ?>" target="_blank"><span>Map</span></a></li>
        <li class="copyright">©<?= date("Y") ?> Fradkin & McAlpin Architects, LLP</li>
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