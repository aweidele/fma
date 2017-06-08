<?php
$args = array(
  'post_type' => 'team',
  'meta_query' => array(
    array(
      'key' => 'partner', // name of custom field
      'value' => '"Yes"', // matches exaclty "red", not just red. This prevents a match for "acquired"
      'compare' => 'LIKE' )
    ),
    'posts_per_page' => -1
);

$leadership = new WP_Query($args);
if($leadership->have_posts()) : while($leadership->have_posts()): $leadership->the_post();
  $thumb = get_the_post_thumbnail(get_the_ID(),'Team Portrait');
  $retina = wp_get_attachment_image_src(get_post_thumbnail_id(),'Retina Team Portrait');
?>
          <div class="partner_bio">
            <div class="portrait"><?php echo $thumb; ?><input type='hidden' value='<?php echo $retina[0]; ?>' name='retina' />
            <input type='hidden' value='<?php 
              $retina = wp_get_attachment_image_src(get_post_thumbnail_id(),'Retina Team Portrait');
              echo $retina[0]; ?>' name='retina' /></div>
            <div class="bio">
              <h2><?php echo get_the_title(); ?><br />
              <span>Principal</span></h2>
              <?php the_content(); ?>
            </div>
            <div class="clear"></div>
          </div>
<?php
  endwhile;
  endif;
  wp_reset_query();
?>