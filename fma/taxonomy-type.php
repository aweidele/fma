<?php
/* Template Name: Projects */
get_header();
$currentURL =  explode("?",$_SERVER["REQUEST_URI"]);
$thisPage = $currentURL[0];

$term =	$wp_query->queried_object;

?>
    <section id="project_top">
      <div id="project_container">
        <div class="project_top_left">
          <h2><?php echo get_the_title(19); ?>: <?php echo $term->name; ?></h2>
        </div>
        <ul class="project_view">
          <li class="grid"><a href="<?php echo $thisPage; ?>">Grid View</a></li>
          <li class="list"><a href="<?php echo $thisPage; ?>?view=list">List View</a></li>
        </ul>
        <div class="clear"></div>
      </div>
    </section><!-- #project_top -->
<?php

if(have_posts()) :

/***** LIST VIEW *****/
if(isset($_GET['view']) && $_GET['view'] == 'list') { ?>
    <section id="project_list">
      <div class="project_list_wrapper">

        <div class="project_list_row project_list_head">
          <div class="project_list_column project_title"><div class="project_list_content">Project</div></div>
          <div class="project_list_column"><div class="project_list_content">Location</div></div>
          <div class="project_list_column"><div class="project_list_content">Type</div></div>
          <div class="project_list_column"><div class="project_list_content">Theme</div></div>
          <div class="clear"></div>
        </div><!-- .project_list_row -->

<?php while(have_posts()) : the_post(); ?>
<?php
$postID = get_the_ID();
$type = array();
$theme = array();

$t = wp_get_post_terms($postID,'type');
foreach($t as $term) { $type[] = $term->name; }

$t = wp_get_post_terms($postID,'theme');
foreach($t as $term) { $theme[] = $term->name; }
?>

        <div class="project_list_row">
<?php 
          
          $g = get_field('listing_type');
          switch($g) {
            case "grid": ?>
          <div class="project_list_column project_title"><div class="project_list_content"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></div></div>
<?php
              break;
            case "expanded": ?>
          <div class="project_list_column project_title expanded_list"><div class="project_list_content"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></div></div>
<?php
              break;
            default: ?>
          <div class="project_list_column project_title"><div class="project_list_content"><?php echo get_the_title(); ?></div></div>
<?php
              break;
      }
          
          ?>
          <div class="project_list_column"><div class="project_list_content"><?php echo get_field('location'); ?></div></div>
          <div class="project_list_column"><div class="project_list_content"><?php echo implode(", ",$type); ?></div></div>
          <div class="project_list_column"><div class="project_list_content"><?php echo implode(", ",$theme); ?></div></div>
          <div class="clear"></div>
<?php if ($g=='expanded') { ?>

          <div class="project_expanded">
            <div class="project_expanded_text">
              <?php echo wpautop(get_the_content()); ?>
            </div>
            <div class="project_expanded_slides">
              <ul>
<?php
$g = get_field('gallery');
//print_r($g);
foreach($g as $image) {
?>
                <li><img src="<?php echo $image['sizes']['Project Expanded']; ?>" /></li>
<?php } ?>
              </ul>
            </div>
            <div class="clear"></div>
          </div>

<?php } ?>
        </div><!-- .project_list_row -->
<?php endwhile; ?>
      </div><!-- .project_list_wrapper -->
    </section>
<?php 
/***** GRID VIEW *****/
} else { ?>

    <section id="project_posts">
<?php 
while(have_posts()) : the_post();
if(get_field('listing_type') == 'grid') {
  $gallery = get_field('grid_slideshow');
?>
<?php /* <pre><?php print_r($gallery); ?></pre> */ ?>

      <div class="project">
        <div class="project_container">
          <div class="thumbnails"><!-- <a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(get_the_ID(),'Project Index'); ?> --></a>

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
<?php }
endwhile; ?>
      <div class="clear"></div>
    </section><!-- #project_posts -->
<?php 
}
endif; ?>

<?php get_footer(); ?>