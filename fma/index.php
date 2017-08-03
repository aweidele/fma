<?php get_header(); 

include('inc/news-header.php');

$instagram = array();	
if(function_exists("instagram_access_fetch")&&is_home())
{
	global $wp_query;
	
	$instagram = instagram_access_fetch($wp_query->post_count - 1);
}
$instagramIndex = 0;
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
	if($instagramIndex < sizeof($instagram))
	{
		$iPost = $instagram[$instagramIndex];
	?>
		<div class="post">
			<p class="thumbnail">
				<a href='<?= $iPost['link'] ?>' target='_blank'>
					<img src='<?= $iPost['images']['standard_resolution']['url'] ?>' />
				</a>
			</p>
			<div class="post_container">
				<a href='<?= $iPost['link'] ?>' target='_blank'>
					<b><?= $iPost['user']['username'] ?></b>
					<?= $iPost['caption']['text'] ?>
				</a>
				<div class="instagram">
					<span class="comments"><?= $iPost['comments']['count'] ?></span>
					<span class="likes"><?= $iPost['likes']['count'] ?></span>
				</div>
			</div>				
		</div>
	<?php
		$instagramIndex++;
	}

endwhile;
endif;
?>
    </section>
<?php get_footer(); ?>