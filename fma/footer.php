<?php
$t = explode ("/",get_page_template());
$template = end($t);
?>
<?php if($template!='template-home.php') {  ?>
    <p class="back_to_top"><span>Back to Top</span></p>
<?php } ?>
  </div><!-- #content_right -->
  <div class="clear"></div>
<?php if(is_front_page()) { ?>
  <div id="mobile_toolbar">
    <ul>
      <li class="email"><a href="mailto:info@fradkinmcalpin.com"><span>Email</span></a></li>
      <li class="phone"><a href="tel:2125295740"><span>Phone</span></a></li>
      <li class="map"><a href="https://www.google.com/maps/place/920+Broadway,+New+York,+NY+10010/@40.7395115,-73.9894268,17z/data=!3m1!4b1!4m2!3m1!1s0x89c259a3db01f895:0xb9cec749a1d596c8" target="_blank"><span>Directions</span></a></li>
    </ul>
  </div>
<?php } ?>
  <footer>
  <div id="wrapper_footer">
    <div id="container_footer">
      <div class="line"><a href="tel:2125295740">(212) 529-5740</a> • <a href="mailto:">Email</a> • <a href="https://www.instagram.com/fradkinmcalpin/">Instagram</a></div>
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