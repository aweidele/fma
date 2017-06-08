<?php
  $resultArray = array(
    "Projects" => array(),
    "News" => array()
  );
  if(have_posts()) : while(have_posts()) : the_post();
    $display = array(
      "title"=> get_the_title(),
      "permalink"=>get_permalink(),
      "thumbnail"=>get_the_post_thumbnail()
    );
    $resultArray['News'][] = $display;
  endwhile;
  endif;
  wp_reset_query();
  
  $term_id = get_query_var('tag_id');
  $args = array('post_type' => 'project' , 'tag_id' => $term_id);
  $project_query = new WP_Query($args);
  if($project_query->have_posts()) : while ( $project_query->have_posts() ) : $project_query->the_post();

    $display = array(
      "title"=> get_the_title(),
      "permalink"=>get_permalink(),
      "thumbnail"=>get_the_post_thumbnail()
    );
    $resultArray['Projects'][] = $display;

  endwhile;
  endif;
?>
<?php get_header(); ?>
  <section id="search">
    <h2>Posts tagged with “<?php single_tag_title(); ?>”</h2>
<?php foreach($resultArray as $key => $result) { ?>
    <div class="search_container">
<?php if(sizeof($result)) { ?>
    <h3><?php echo $key; ?></h3>
<?php foreach($result as $r) { ?>
    <a href="<?php echo $r['permalink']; ?>">
    <div class="post">
       <?php echo $r['thumbnail']; ?>     
       <h4><?php echo $r['title']; ?></h4>
       <div class="clear"></div>
    </div>
    </a>
<?php } } ?>
    </div>
<?php } ?>
  </section>
<?php get_footer(); ?>