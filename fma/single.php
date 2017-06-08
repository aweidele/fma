<?php
$thisID = $post->ID;
$postIndex = array();

//$custom_fields = get_post_custom($post->ID);
//print_r($custom_fields['read_more']);
/*** DETERMINE NEXT POST ***/
$all = new WP_Query(array(
  'post_type'=>'post',
  'meta_key'=>'read_more',
  'meta_value'=>'a:1:{i:0;s:3:"yes";}'
));
if($all->have_posts()) : while($all->have_posts()) : $all->the_post();
  $postIndex[] = get_the_id();
endwhile;
endif;
wp_reset_query();
$nextPost = array_search($thisID,$postIndex) + 1;
if($nextPost > sizeof($postIndex)-1) { $nextPost = 0; }
?>
<?php get_header();
if(have_posts()): while(have_posts()): the_post(); 
$next = get_next_post();

$post_cats = wp_get_post_categories(get_the_ID());
$cats=array();
foreach($post_cats as $c) {
  $cat = get_category($c);
  $cats[] = '<a href="'.get_category_link($c).'" class="cat_link">'.$cat->name.'</a>';
}

$post_tags = wp_get_post_tags(get_the_ID());
$tags = array();
foreach($post_tags as $tag) {
  $tags[] = '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
}
?>

    <section id="news_top" class="single_post">
      <div id="news_container">
        <ul class="newsPrevnext">
          <li><a href="<?php echo get_permalink(get_option( 'page_for_posts' )); ?>">Back to All News</a></li>
          <li><a href="<?php echo get_permalink($postIndex[$nextPost]); ?>">Next News Item</a></li>
        </ul>
        <div class="clear"></div>
        
        <h2><?php echo get_the_title(); ?></h2>
      </div>
    </section>
    <section id="news_post">
      <div id="mobile_title"><h2><?php echo get_the_title(); ?></h2></div>
      <div class="news_column">
        <p class="info"><?php echo implode(', ',$cats); ?> | <?php echo get_the_date(); ?><?php
        if(get_field('link') != '') { echo ' | <a href="'.get_field('link').'" target="_blank">Link to Article</a>'; }
        ?></p>
        <?php echo wpautop(get_the_content()); ?>
<?php if(sizeof($tags)) { ?>
        <h3>Tags</h3>
        <p><?php echo implode(" | ",$tags); ?></p>
<?php } ?>
<?php /*
        <h3 class="share">Share News</h3>
        <ul class="sharers">
          <li class="facebook"><a href=""><span>Facebook<span></a></li>
          <li class="twitter"><a href=""><span>Twitter</span></a></li>
          <li class="pinterest"><a href=""><span>Pinterest</span></a></li>
          <li class="gplus"><a href=""><span>Google+</span></a></li>
        </ul>
*/ ?>
      </div>
      <div class="news_gallery">
<?php foreach(get_field('gallery') as $gallery) { ?>
        <img src="<?php echo $gallery['sizes']['News Right']; ?>" />
<?php } ?>
      </div>
      <div class="clear"></div>
    </section>

<?php
endwhile;
endif;
get_footer(); ?>