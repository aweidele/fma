<?php
$args = array(
  'post_type' => 'team',
  'meta_query' => array(
    array(
      'key' => 'partner', // name of custom field
      'value' => '"Yes"', // matches exaclty "red", not just red. This prevents a match for "acquired"
      'compare' => 'NOT LIKE' )
    ),
  'posts_per_page' => -1
);
$team = new WP_Query($args);
if($team->have_posts()) : while($team->have_posts()): $team->the_post();
/*  $projects = array();
  $related = get_field('related_projects');
  foreach($related as $r) {
    $projects[] = '<a href="'.get_permalink($r->ID).'">'.$r->post_title.'</a>';
  } */
?>
          <div class="bio">
            <div class="bio_portrait">
              <?php echo get_the_post_thumbnail(get_the_ID(),'Team Portrait'); ?>
            <input type='hidden' value='<?php 
              $retina = wp_get_attachment_image_src(get_post_thumbnail_id(),'Retina Team Portrait');
              echo $retina[0]; ?>' name='retina' />
            </div>
            <div class="bio_content">
              <h2><?php echo get_the_title(); ?></h2>
              <h3><?php echo get_field('title'); ?></h3>
              <p><?php echo get_the_content(); ?></p>
            </div>
            <div class="clear"></div>
          </div>
<?php
endwhile;
endif;
wp_reset_query();
?>