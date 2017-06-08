<?
/* Template Name: Projects */
get_header();
$themes = get_terms( 'theme' );
$types = get_terms( 'type' );

$currentURL =  explode("?",$_SERVER["REQUEST_URI"]);
$thisPage = $currentURL[0];

function sortlink($sort) {
  $sortlink = '?view=list&sort='.$sort;
  
  if( isset($_GET['sort']) && $_GET['sort'] == $sort && !isset($_GET['order']) ) {
    $sortlink .= '&order=DESC';
  }
  
  return $sortlink;
}

function sortclass($sort) {
  if( isset($_GET['sort']) && $_GET['sort'] == $sort ) {
    if(isset($_GET['order'])) {
      $class = " up";
    } else {
      $class = " down";
    }
  } else {
    $class = "";
  }
  
  return $class;
}
?>
    <section id="project_top">
      <div id="project_container">
        <div class="project_top_left">
          <h2><?php echo $post->post_title; ?></h2>
          <ul class="categories">
<?php foreach($themes as $t) { ?>
            <li><a href="<?php echo get_term_link($t->name, 'theme'); ?>"><?php echo $t->name; ?></a></li>
<?php } ?>
            <li class="featured">By Type
              <ul>
<?php foreach($types as $t) { ?>
            <li><a href="<?php echo get_term_link($t->name, 'type'); ?>"><?php echo $t->name; ?></a></li>
<?php } ?>          
              </ul>
            </li>
            <li class="catActive"><a href="<?php echo get_permalink(19); ?>">View All</a></li>  
          </ul><!-- categories menu -->
        </div>
        <ul class="project_view">
          <li class="grid"><a href="<?php echo $thisPage; ?>">Grid View</a></li>
          <li class="list"><a href="<?php echo $thisPage; ?>?view=list">List View</a></li>
        </ul>
        <div class="clear"></div>
      </div>
    </section><!-- #project_top -->
<?php
$args = array('post_type'=>'project');
$projects = new WP_Query($args);
if($projects->have_posts()) :

/***** LIST VIEW *****/
if(isset($_GET['view']) && $_GET['view'] == 'list') { ?>
    <section id="project_list">
      <div class="project_list_wrapper">

        <div class="project_list_row project_list_head">
          <div class="project_list_column project_title"><div class="project_list_content<?php echo sortclass('project'); ?>"><a href="<?php echo sortlink('project'); ?>">Project</a></div></div>
          <div class="project_list_column"><div class="project_list_content<?php echo sortclass('location'); ?>"><a href="<?php echo sortlink('location'); ?>">Location</a></div></div>
          <div class="project_list_column"><div class="project_list_content<?php echo sortclass('type'); ?>"><a href="<?php echo sortlink('type'); ?>">Type</a></div></div>
          <div class="project_list_column"><div class="project_list_content<?php echo sortclass('theme'); ?>"><a href="<?php echo sortlink('theme'); ?>">Theme</a></div></div>
          <div class="clear"></div>
        </div><!-- .project_list_row -->

<?php 
$projectIndex = array();
$sortField = array();
while($projects->have_posts()) : $projects->the_post();
  $postID = get_the_ID();
  $type = array();
  $theme = array();

  $t = wp_get_post_terms($postID,'type');
  foreach($t as $term) { $type[] = $term->name; }

  $t = wp_get_post_terms($postID,'theme');
  foreach($t as $term) { $theme[] = $term->name; }
  
  if( get_field('listing_type') == 'expanded' ) {
    $content = get_the_content();
    $gallery = get_field('gallery');
  } else {
    $content = '';
    $gallery = null;
  }
  
  $projectIndex[] = array(
    'postID'=>get_the_id(),
    'title'=>get_the_title(),
    'permalink'=>get_permalink(),
    'listing_type'=>get_field('listing_type'),
    'location'=>get_field('location'),
    'type'=>implode(", ",$type),
    'theme'=>implode(", ",$theme),
    'content'=>$content,
    'gallery'=>$gallery
  );
  
  if(isset($_GET['sort']) && $_GET['sort'] != '') {
    switch($_GET['sort']) {
      case 'project':
        $sortField[] = get_the_title();
        break;
      case 'location':
        $sortField[] = get_field('location');
        break;
      case 'type':
        $sortField[] = implode(", ",$type);
        break;
      case 'theme':
        $sortField[] = implode(", ",$theme);
        break;
    }
  }
  
endwhile;

if(isset($_GET['sort']) && $_GET['sort'] != '') {
  
  if(isset($_GET['order']) && $_GET['order'] == 'DESC') {
    $order = SORT_DESC;
  } else {
    $order = SORT_ASC;
  }
  
  array_multisort($sortField,$order,$projectIndex);
}

foreach($projectIndex as $project) {
 ?>
        <div class="project_list_row">
<?php 

          switch($project['listing_type']) {
            case "grid": ?>
          <div class="project_list_column project_title"><div class="project_list_content"><a href="<?php echo $project['permalink']; ?>"><?php echo $project['title']; ?></a></div></div>
<?php
              break;
            case "expanded": ?>
          <div class="project_list_column project_title expanded_list"><div class="project_list_content"><a href="<?php echo $project['permalink']; ?>"><?php echo $project['title']; ?></a></div></div>
<?php
              break;
            default: ?>
          <div class="project_list_column project_title"><div class="project_list_content"><?php echo $project['title']; ?></div></div>
<?php
              break;
      }
          
          ?>
          <div class="project_list_column"><div class="project_list_content"><?php echo $project['location']; ?></div></div>
          <div class="project_list_column"><div class="project_list_content"><?php echo $project['type']; ?></div></div>
          <div class="project_list_column"><div class="project_list_content"><?php echo $project['theme']; ?></div></div>
          <div class="clear"></div>
<?php if ($project['listing_type']=='expanded') { ?>

          <div class="project_expanded">
            <div class="project_expanded_text">
              <?php echo wpautop($project['content']); ?>
            </div>
            <div class="project_expanded_slides">
              <ul>
<?php
foreach($project['gallery'] as $image) {
?>
                <li><img src="<?php echo $image['sizes']['Project Expanded']; ?>" /></li>
<?php } ?>
              </ul>
            </div>
            <div class="clear"></div>
          </div>

<?php } ?>
        </div><!-- .project_list_row -->
<?php } ?>
      </div><!-- .project_list_wrapper -->
    </section>
<?php 
/***** GRID VIEW *****/
} else { ?>

    <section id="project_posts">
<?php 
while($projects->have_posts()) : $projects->the_post();
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