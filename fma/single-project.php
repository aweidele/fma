<?php 
$thisID = $post->ID;
$projectIndex = array();
/*** DETERMINE NEXT PROJECT ***/
$all = new WP_Query(array(
  'post_type'=>'project',
  'meta_key'=>'listing_type',
  'meta_value'=>'grid'
));
if($all->have_posts()) : while($all->have_posts()) : $all->the_post();
  $projectIndex[] = get_the_id();
endwhile;
endif;
wp_reset_query();
$nextProject = array_search($thisID,$projectIndex) + 1;
if($nextProject > sizeof($projectIndex)-1) { $nextProject = 0; }
 ?>
<?php get_header();
if(have_posts()) : while(have_posts()) : the_post();
$gallery = get_field('gallery');
$related_projects = get_field('related_projects');

// sidebar fields
$press = get_field('press');
$tags = get_the_tags();
?>
  <section id="single_project_top">
    <div id="single_project_title">
      <h2><?php echo get_the_title(); ?></h2>
      <div class="slideshow_controls">
        <ul class="backnext">
          <li><a href="<?php echo get_permalink(19); ?>">Back to Projects</a></li>
          <li><a href="<?php echo get_permalink($projectIndex[$nextProject]) ?>">Next Project</a></li>
        </ul>
      </div>
    </div>
    <div class="fma_slideshow" id="single_project_slideshow">
    <input type="hidden" name="studioSlideshowSpeed" value="0" />
<?php 
$active = " active"; 
foreach($gallery as $image) { 
?>
    <div class="slide<?php echo $active; ?>">
      <p class="image"><img src="<?php echo $image['sizes']['Project Single']; ?>" /></p>
    </div>
<?php 
$active = "";
} ?>

    <ul class="project_slideshow_prevnext">
      <li><span>Previous Slide</span></li>
      <li><span>Next Slide</span></li>
    </ul>

    </div><!-- #single_project_slideshow -->
    <div id="single_project_mobile_title"><h2><?php echo get_the_title(); ?></h2></div>
  </section><!-- #single_project_top -->
  <div id="single_project_content">

    <section id="single_project_main">
      <h2><?php echo get_field('caption'); ?></h2>
<?php echo wpautop(get_the_content()); ?>
      <h3>Related Projects</h3>
      <ul class="related_projects">
<?php foreach($related_projects as $rProject) { ?>
        <li><a href="<?php echo get_permalink($rProject->ID); ?>"><?php echo $rProject->post_title; ?></a></li>
<?php } ?>
      </ul>
    </section><!-- #single_project_main -->

    <section id="single_project_right">
<?php 
if(get_field('location') != "") { ?>
      <h3>Location</h3>
      <p><?php echo get_field('location'); ?></p>
<?php }
if(get_field('area') != "") { ?>
      <h3>Area</h3>
      <p><?php echo get_field('area'); ?></p>
<?php }
if(get_field('awards') != "") { ?>
      <h3>Awards</h3>
      <?php echo wpautop(get_field('awards')); ?>
<?php }
if(is_array($press)) { ?>
      <h3>Related News</h3>
      <ul>
<?php foreach(get_field('press') as $press) { ?>
        <li><a href="<?php echo get_permalink($press->ID); ?>"><?php echo $press->post_title; ?></a></li>
<?php } ?>
      </ul>
<?php }
if(get_field('credits') != "") { ?>
      <h3>Credits</h3>
      <?php echo wpautop(get_field('credits')); ?>
<?php }
if(is_array($tags)) { ?>
      <h3>Tags</h3>
      <ul class="tags">
<?php foreach($tags as $tag) { ?>
        <li><a href="<?php echo get_term_link($tag->term_id,$tag->taxonomy); ?>"><?php echo $tag->name; ?></a></li>
<?php } ?>
      </ul>
<?php } ?>
<?php /*
      <h3 class="share">Share Project</h3>
      <ul class="sharers">
        <li class="facebook"><a href=""><span>Facebook<span></a></li>
        <li class="twitter"><a href=""><span>Twitter</span></a></li>
        <li class="pinterest"><a href=""><span>Pinterest</span></a></li>
        <li class="gplus"><a href=""><span>Google+</span></a></li>
      </ul>
*/ ?>
    </section><!-- #single_project_right -->
    
    <div class="clear"></div>
  </div><!-- #single_project_content -->
  
<?php
endwhile;
endif;
wp_reset_query();
get_footer(); ?>