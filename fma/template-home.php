<?php /* Template Name: Homepage Template */ ?>
<?php get_header(); ?>
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
  <div id="homepage_wrapper">
  
    <section id="homepage_slideshow" class="fma_slideshow">
      <input type="hidden" name="speed" value="<?php echo get_field('gallery_1_speed'); ?>" />
<?php
$slideshow = get_field('homepage_gallery');
$a = " ";
foreach($slideshow as $slide) {
  
  $permalink = get_permalink($slide['project']);
  $thumbnail = '<img src="'.$slide['project_image']['sizes']['Homepage'].'" class="homepage_browser" /><input type="hidden" value="'.$slide['project_image']['sizes']['Retina Homepage'].'" name="retina" />';
  $defaultMobile = $slide['project_image']['sizes']['Homepage Mobile'];
  $landscape = $slide['mobile_landscape'] ? $slide['mobile_landscape']['sizes']['Mobile Unlimited'] : $defaultMobile;
  $portrait = $slide['mobile_portrait'] ? $slide['mobile_portrait']['sizes']['Mobile Unlimited'] : $defaultMobile;
  $thumbnail_mobile = '<img src="'.$landscape.'" class="homepage_mobile landscape_mobile" /><img src="'.$portrait.'" class="homepage_mobile portrait_mobile" />';
?>
        <div class="slide no_transition <?php echo $c['scheme'].$a; ?>"><a href="<?php echo $permalink; ?>"><?php echo $thumbnail.$thumbnail_mobile; ?></a></div>
        <!-- div class="slide <?php echo $c['scheme'].$a; ?>"><?php echo $thumbnail.$thumbnail_mobile; ?></div -->
<?php 
  $a = "";
} ?>
    <ul class="prevnext">
      <li><span>Previous Slide</span></li>
      <li><span>Next Slide</span></li>
    </ul>
    </section>
<?php 
$content = get_field('homepage_content');
if( $content ) {
?>
    <section id="homepage_text">
      <input type="hidden" name="hpTextSpeed" value="<?php echo get_field('homepage_content_speed'); ?>" />
      <div id="homepage_text_container">
<?php
$a = ' active';
foreach($content as $c) {
//print_r($content);
$link_id = $c['link']->term_id;
?>
        <div class="slide<?php echo $a; ?>">
<?php if($c['type'] != 'blank') { ?>
          <div class="slide_content"><?php echo $c['content_area']; ?>
          <p><a href="<?php echo get_term_link( $link_id, 'theme' ); ?>"><?php echo $c['link_text']; ?></a></p>
          </div>
 <?php } ?>
        </div>
<?php
  $a = "";
} ?>
      </div>
    </section>
<?php } ?>
  </div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>