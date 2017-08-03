<?php
$t = explode ("/",get_page_template());
$template = end($t);

$email = get_field("footer_email", "options");
$phoneLink = get_field("footer_phone_link", "options");
$phoneDisplay = get_field("footer_phone_display", "options");
$maps = get_field("footer_google_maps_url", "options");
?>
<?php if($template!='template-home.php') {  ?>
    <p class="back_to_top"><span>Back to Top</span></p>
<?php } ?>
  </div><!-- #content_right -->
  <div class="clear"></div>
<?php if(is_front_page()) { ?>
  <div id="mobile_toolbar">
    <ul>
      <li class="email"><a href="mailto:<?= $email ?>"><span>Email</span></a></li>
      <li class="phone"><a href="tel:<?= $phoneLink ?>"><span>Phone</span></a></li>
      <li class="map"><a href="<?= $maps ?>" target="_blank"><span>Directions</span></a></li>
    </ul>
  </div>
<?php } ?>
  <footer>
  <div id="wrapper_footer">
    <div id="container_footer">
      <div class="line"><a href="tel:<?= $phoneLink ?>"><?= $phoneDisplay ?></a> • <a href="mailto:<?= $email ?>">Email</a> • <a href="https://www.instagram.com/fradkinmcalpin/" target="_blank">Instagram</a></div>
      <div class="line search"><div class="search_container"><?php get_search_form(); ?></div></div>
    </div>
  </div>
  </footer>
</div>
<?php wp_footer(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55123771-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>