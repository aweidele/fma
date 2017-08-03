<?php 
function getChildPages($thisID) {
  $my_wp_query = new WP_Query();
  $all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order'));
  $childPages = get_page_children($thisID,$all_wp_pages);
  return $childPages;
}

function showChildPageContent($childPages) {
foreach($childPages as $childPage) {
  $childID = $childPage->ID;
  $template = get_page_template_slug($childID);
?>
        <section id="<?php echo $childPage->post_name; ?>"<?php if($template == "") { echo ' class="default"'; } ?>>
<?php switch($template) {

/***********************************************/
/*************** WHO WE ARE ********************/
  default:
    $right_content = get_field('right_content',$childID);
?>
          <div class="column_left">
<?php echo do_shortcode(wpautop($childPage->post_content)); ?>
          </div>
          <div class="column_right">
            <h3><?php echo get_field('right_content_header',$childID); ?></h3>
<?php echo do_shortcode(wpautop($right_content)); ?>
          </div>
          <div class="clear"></div>
<?php break;
/***********************************************/
/*************** LEADERSHIP ********************/
  case "subpage-leadership.php":
    include("subpage-content/content-leadership.php");
?>
<?php break;

/***********************************************/
/**************** OUR TEAM *********************/
  case "subpage-team.php":
?>
          <p class="team_group"><?php echo get_the_post_thumbnail($childID,'Team Group'); ?>
            <input type='hidden' value='<?php 
              $retina = wp_get_attachment_image_src(get_post_thumbnail_id($childID),'Retina Team Group');
              echo $retina[0];
              ?>' name='retina' /></p>
<?php include("subpage-content/content-team.php"); ?>

<?php break; } ?>
        </section><!-- <?php echo $childPage->post_name; ?> -->
<?php } // END CHILDPAGES LOOP
} // END showChildPageContent FUNCTION

function childPageMenu($childPages) { 
	if( count($childPages) == 0 ){ return; } 	
?>
        <ul class="nested child-pages">
<?php foreach($childPages as $childPage) { ?>
          <li><a href="#<?php echo $childPage->post_name; ?>"><?php echo $childPage->post_title; ?></a></li>
<?php } ?>
        </ul>
<?php } ?>