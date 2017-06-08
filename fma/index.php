<?php get_header(); 
$ppp = get_option( 'page_for_posts' );
$categories = get_categories();
if(is_category()) {
  $thisCat = get_category( get_query_var( 'cat' ) );
}
?>
    <section id="news_top">
      <div id="news_container">
        <h2><?php echo get_the_title($ppp); ?></h2>
        <ul class="categories">
<?php foreach($categories as $cat) { ?>
          <li<?php if(is_object($thisCat) && $thisCat->slug == $cat->slug) { echo ' class="catActive"'; } ?>><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->name; ?></a></li>
<?php } ?>
          <li<?php if(!is_object($thisCat)) { echo ' class="catActive"'; } ?>><a href="<?php echo get_permalink($ppp); ?>">View All</a></li>
        </ul>
      </div>
    </section>
    <section id="news_posts">
<?php
if(have_posts()): while(have_posts()): the_post(); 
$thumb = get_the_post_thumbnail(get_the_ID(),'News Featured');
$readmore = get_field('read_more');
$link = ($readmore[0]=='yes') ? get_permalink() : (get_field('link')!="" ? get_field('link') : false);
if(get_field('link') != "") { $ext=true; } else { $ext=false; }

$post_cats = wp_get_post_categories(get_the_ID());
$cats=array();
$catnames = array();
foreach($post_cats as $c) {
  $cat = get_category($c);
  $cats[] = '<a href="'.get_category_link($c).'">'.$cat->name.'</a>';
  $catnames[] = $cat->name;
}

?>

      <div class="post">
        <?php if($thumb != "") { ?>
        <p class="thumbnail"><?php 
          if($link) {
            echo '<a href="'.$link.'"';
            if($ext) { /* echo ' target="_blank"'; */ }
            echo '>'.$thumb.'</a>';
          } else {
            echo $thumb;
          }
        ?></p>
        <?php } ?>
        <div class="post_container">
          <h2><?php 
          if($link) {
            echo '<a href="'.$link.'"';
            if($ext) { /* echo ' target="_blank"'; */  }
            echo '>'.get_the_title().'</a>';
          } else {
            echo get_the_title();
          }
        ?></h2>
          <?php if($link) { ?><p class="readmore"><?php
            echo '<a href="'.$link.'"';
            if($ext) { echo ' class="ext"'; }
            echo '>read more</a>'; 
          ?></p><?php } ?>
        <?php if(in_array('Insight',$catnames)) { ?><p class="quote_attribution">—<?php echo get_field('quote_attribution'); ?></p><?php } ?>
          <p class="info"><?php echo get_the_date(); ?> | <?php echo implode(', ',$cats); ?></p>
        </div>
      </div>

<?php
endwhile;
endif;
?>
    </section>
<?php get_footer(); ?>