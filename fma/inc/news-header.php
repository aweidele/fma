<?php
$ppp = get_option( 'page_for_posts' );
$media = get_field("media_inquiries_email", $ppp);

?>
    <section id="news_top">
      <div id="news_container">
        <h2>
			<div class="media_inquiry"><ul><li><a href="mailto:<?=$media?>" target="_blank">Media Inquires</a></li></ul></div>
        	<?php echo get_the_title($ppp); ?>
        </h2>
      </div>
    </section>
    <section id="news_posts">
<?php
