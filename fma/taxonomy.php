<?
/* Template Name: Projects */
get_header();
$themes = get_terms( 'theme' );
$types = get_terms( 'type' );

$q = get_queried_object();

$currentURL =  explode("?",$_SERVER["REQUEST_URI"]);
$thisPage = $currentURL[0];
?>
    <section id="project_top">
      <div id="project_container">
        <div class="project_top_left">
          <h2><?php echo $q->name; ?></h2>
          <ul class="categories">
            <li><a href="<?php echo get_permalink(19); ?>">All</a></li>
<?php foreach($themes as $t) { ?>
            <li><a href="<?php echo get_term_link($t->name, 'theme'); ?>"><?php if($q->term_id == $t->term_id) { echo '<strong>'.$t->name.'</strong>'; } else { echo $t->name; } ?></a></li>
<?php } ?>
            <li class="featured">Featured
              <ul>
<?php foreach($types as $t) { ?>
            <li><a href="<?php echo get_term_link($t->name, 'type'); ?>"><?php if($q->term_id == $t->term_id) { echo '<strong>'.$t->name.'</strong>'; } else { echo $t->name; } ?></a></li>
<?php } ?>            
              </ul>
            </li>
          </ul><!-- categories menu -->
        </div>
        <ul class="project_view">
          <li class="grid"><a href="<?php echo $thisPage; ?>">Grid View</a></li>
          <li class="list"><a href="<?php echo $thisPage; ?>?view=list">List View</a></li>
        </ul>
        <div class="clear"></div>
      </div>
    </section><!-- #project_top -->
    <section id="project_posts">
<?php

if(have_posts()) : while(have_posts()) : the_post();
$gallery = get_field('gallery');
?>
<?php /* <pre><?php print_r($gallery); ?></pre> */ ?>

      <div class="project">
        <div class="project_container">
          <div class="thumbnails"><!-- <a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(),'Project Index'); ?></a> -->

            <ul class="slideshow">
<?php 
$active = ' class="active"';
foreach($gallery as $thumb) { ?>
              <li<?php echo $active; ?>><img src="<?php echo $thumb['sizes']['Project Index']; ?>" width="<?php echo $thumb['sizes']['Project Index-width']; ?>" height="<?php echo $thumb['sizes']['Project Index-height']; ?>" /></li>
<?php 
$active = '';
} ?>
            </ul>
<?php if(sizeof($gallery) > 1) { ?>
            <ul class="nextprev">
              <li><span>Previous</span></li>
              <li><span>Next</span></li>
            </ul>
<?php } ?>

            <a href="<?php echo get_permalink(); ?>">Read More</a>

          </div><!-- thumbnails -->
          <h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
          <p><?php echo get_field('location'); ?></p>
        </div>
      </div>

<?php
endwhile;
endif;
?>
      <div class="clear"></div>
    </section><!-- #project_posts -->

<?php get_footer(); ?>