<?php
/*
Template Name: Studio (Top-Level)
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
<?php while(have_posts()) : the_post();
  $thisID = get_the_id();
  $childPages = getChildPages($thisID); ?>
    
<!-- SUBNAV -->
      <div id="subnav">
        <div id="subnav_container">
<?php //childPageMenu($childPages); ?>
        <div id="quote_wrapper">
          <div id="quote_container" class="fma_slideshowwww">
          <input type="hidden" name="quote_speed" value="<?php echo get_field('quotes_speed'); ?>" />
<?php
$args = array(
  "post_type"=>'testimonials',
  "posts_per_page"=>-1
);
$testimonials = new WP_Query($args);
$active = " active";
if($testimonials->have_posts()): while($testimonials->have_posts()): $testimonials->the_post();
?>
            <div class="slide<?php echo $active; ?>">
              <p><?php echo get_the_content(); ?></p>
              <p class="attribution">— <?php echo get_the_title(); ?></p>
            </div>
<?php
$active = "";
endwhile;
endif;
wp_reset_query();
?>
          </div>
        </div>
        </div>
      </div><!-- #subnav -->
      
<!-- CONTENT -->
      <div id="studio_content" class="sectionedContent">
        <section id="studio_home">
      
<?php
$slider = get_field('slider');
?>

<!-- TOP SLIDESHOW -->
        <div class="fma_slideshow" id="studio_slideshow">
          <input type="hidden" name="studioSlideshowSpeed" value="<?php echo get_field('slideshow_pause'); ?>" />
<?php 
$active = ' active';
foreach($slider as $slide) { ?>
          <div class="slide<?php echo $active; ?>">
            <p class="image">
            <img src="<?php echo $slide['image']['sizes']['Studio Slideshow']; ?>" />
            <input type='hidden' value='<?php echo $slide['image']['sizes']['Retina Studio Slideshow']; ?>' name='retina' /></p>
            <div class="slide_text">
              <div class="padding">
<?php echo wpautop($slide['caption']); ?>
              </div>
            </div>
          </div><!-- .slide -->
<?php 
$active = "";
} ?>
<!--
          <ul class="prevnext">
            <li><svg class="icon icon-arrow-left" viewBox="0 0 32 32"><use xlink:href="#icon-arrow-left"></use></svg></li>
            <li><svg class="icon icon-arrow-right" viewBox="0 0 32 32"><use xlink:href="#icon-arrow-right"></use></svg></li>
          </ul>
-->
        </div><!-- #studio_slideshow -->

        </section>
      <!-- SECONDARY PAGE CONTENT -->
<?php showChildPageContent($childPages); ?>

<!-- pre><?php print_r($childPages); ?></pre -->
      </div><!-- #studio_content -->
      <div class="clear"></div>
<?php
endwhile;
endif;
?>

<?php get_footer(); ?>