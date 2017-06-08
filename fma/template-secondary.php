<?php
/*
Template Name: Secondary Pages
*/
?>
<?php get_header(); ?>
<svg display="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="32" viewBox="0 0 80 32">
<defs>
<g id="icon-arrow-left">
	<path class="path1" d="M21.5 23.5l-13-7.5 13-7.5z"></path>
</g>
<g id="icon-arrow-right">
	<path class="path1" d="M10.5 8.5l13 7.5-13 7.5z"></path>
</g>
</defs></svg>
<?php if(have_posts()): ?>
<?php 
while(have_posts()) : the_post();
  $my_wp_query = new WP_Query();
  $all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order'));
  $childPages = get_page_children(get_the_ID(),$all_wp_pages);
?>
  <div id="content_right" class="sidebar">
    
<!-- SUBNAV -->
      <div id="subnav">
        <ul>
<?php foreach($childPages as $childPage) { ?>
          <li><a href="#<?php echo $childPage->post_name; ?>"><?php echo $childPage->post_title; ?></a></li>
<?php } ?>
        </ul>
        <div id="quote_wrapper">
          <div id="quote_container">
            QUote goes here.
          </div>
        </div>
      </div><!-- #subnav -->
      
<!-- CONTENT -->
      <div id="studio_content">
        <section id="studio_home">
      
<?php
$slider = get_field('slider');
?>
        <div class="fma_slideshow" id="studio_slideshow">
          <input type="hidden" name="studioSlideshowSpeed" value="<?php echo get_field('slideshow_pause'); ?>" />
<?php 
$active = ' active';
foreach($slider as $slide) { ?>
          <div class="slide<?php echo $active; ?>">
            <p class="image"><img src="<?php echo $slide['image']['sizes']['Studio Slideshow']; ?>" /></p>
            <div class="slide_text">
              <div class="padding">
<?php echo wpautop($slide['caption']); ?>
              </div>
            </div>
          </div><!-- .slide -->
<?php 
$active = "";
} ?>
          <ul class="prevnext">
            <li><svg class="icon icon-arrow-left" viewBox="0 0 32 32"><use xlink:href="#icon-arrow-left"></use></svg></li>
            <li><svg class="icon icon-arrow-right" viewBox="0 0 32 32"><use xlink:href="#icon-arrow-right"></use></svg></li>
          </ul>
        </div><!-- #studio_slideshow -->
        </section>
      </div><!-- #studio_content -->
    
  </div><!-- #content_right -->
<?php
endwhile;
endif;
?>

<?php get_footer(); ?>