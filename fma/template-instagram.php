<?php
/* Template Name: Instagram Feed (Don't Use) */
get_header();

include('inc/news-header.php');

the_post();	

$instagram = array();	
if(function_exists("instagram_access_fetch"))
{
	$count = get_field("instagram_count");	
	$instagram = instagram_access_fetch($count);
}
$instagramIndex = 0;

while($instagramIndex < sizeof($instagram))
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
?>
    </section>
<?php get_footer(); ?>