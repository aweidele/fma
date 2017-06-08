<?php
  $resultArray = array(
    "Projects" => array(),
    "News" => array()
  );
  if(have_posts()) : while(have_posts()) : the_post();
    $posttype = get_post_type($post);
    $display = array(
      "title"=> get_the_title(),
      "permalink"=>get_permalink(),
      "thumbnail"=>get_the_post_thumbnail()
    );
    switch($posttype) {
      case 'post':
        $resultArray['News'][] = $display;
        break;
      case 'project':
        $resultArray['Projects'][] = $display;
        break;
    }
  endwhile;
  endif;
?>
<?php get_header(); ?>
  <section id="search">
    <h2>Search Results: <?php echo get_search_query(); ?></h2>
<?php foreach($resultArray as $key => $result) { ?>
    <div class="search_container">
    <h3><?php echo $key; ?></h3>
<?php foreach($result as $r) { ?>
    <a href="<?php echo $r['permalink']; ?>">
    <div class="post">
       <?php echo $r['thumbnail']; ?>     
       <h4><?php echo $r['title']; ?></h4>
       <div class="clear"></div>
    </div>
    </a>
<?php } ?>
    </div>
<?php } ?>
  </section>
<?php get_footer(); ?>