<?php

add_theme_support('html5', array('search-form'));

/**********************************************************************/
/******** ENQUEUE STYLES AND SCRIPTS **********************************/
/**********************************************************************/
function theme_name_scripts() {
    //wp_enqueue_style( 'fonts', '//cloud.webtype.com/css/1b7cfdf0-9828-4ed8-b99b-ccab8b975185.css');
	wp_enqueue_style( 'fonts', '//fast.fonts.net/cssapi/e64835e4-ce1a-486d-8414-bc9d3ec7ae11.css');
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/script.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'touchswipe', get_template_directory_uri() . '/inc/jquery.touchSwipe.min.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

/**********************************************************************/
/******** ADD SUPPORT FOR CUSTOM MENUS ********************************/
/**********************************************************************/
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
  set_post_thumbnail_size(80, 80,true);
	add_image_size('Studio Slideshow',1200,613,true);
	add_image_size('Team Portrait',220,260,true);
	add_image_size('Team Group',1200,999999);
	add_image_size('News Featured',370,999999);
	add_image_size('News Right',1120,999999);
	add_image_size('Project Index',560,400,true);
	add_image_size('Project Expanded',80,80,true);
	add_image_size('Project Single',1130,640,true);
	add_image_size('Homepage',1600,999999);
	add_image_size('Homepage Mobile',480,253,true);
	
	/* RETINA */
	add_image_size('Retina Studio Slideshow',2400,1226,true);
	add_image_size('Retina Team Portrait',440,520,true);
	add_image_size('Retina Team Group',2048,999999);
	add_image_size('Retina News Featured',470,999999);
	add_image_size('Retina News Right',2048,999999);
	add_image_size('Retina Project Index',1120,800,true);
	add_image_size('Retina Project Expanded',160,160,true);
	add_image_size('Retina Project Single',1260,1280,true);
	add_image_size('Retina Homepage',2048,999999);
}

/**********************************************************************/
/******** ADD CUSTOM STYLES TO WYSIWYG EDITOR *************************/
/**********************************************************************/
add_filter('tiny_mce_before_init', 'add_custom_classes');
function add_custom_classes($arr_options) {
	$arr_options['theme_advanced_styles'] = "Intro Text=intro";
	$arr_options['theme_advanced_buttons2_add_before'] = "styleselect";
	return $arr_options;
}


/**********************************************************************/
/******** POST THUMBNAILS AND IMAGE SIZES *****************************/
/**********************************************************************/
add_theme_support('post-thumbnails');

/**********************************************************************/
/******** REORDER ADMIN MENUS *****************************************/
/**********************************************************************/
    function custom_menu_order($menu_ord) {  
        if (!$menu_ord) return true;  
          
        return array(  
            'index.php', // Dashboard  
            'separator1', // First separator  
            'edit.php?post_type=page', // Pages
            'edit.php?post_type=team', // Team
            'edit.php?post_type=testimonials', // Testimonials
            'edit.php?post_type=project', // Projects
            'edit.php', // Posts
            'separator2', // First separator  
            'upload.php', // Media    
            'edit-comments.php', // Comments  
            'link-manager.php', // Links  
            'separator-last', // Last separator  
            'themes.php', // Appearance  
            'plugins.php', // Plugins  
            'users.php', // Users  
            'tools.php', // Tools  
            //'options-general.php', // Settings  
        );  
    }  
    add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order  
    add_filter('menu_order', 'custom_menu_order');

    function edit_admin_menus() {  
        global $menu; 
        $menu[5][0] = 'News'; // Change Posts to The Ladder   
    }  
    add_action( 'admin_menu', 'edit_admin_menus' );  

/**********************************************************************/
/******** CUSTOM POST TYPES *******************************************/
/**********************************************************************/
add_action('init', 'register_post_types');
function register_post_types() {
    
    /**** REGISTER PEOPLE POST TYPE ****/
	$labels = array(
		'name' => _x('Team', 'post type general name'),
		'singular_name' => _x('Team Member', 'post type singular name'),
		'add_new' => _x('Add New Team Member', 'portfolio item'),
		'add_new_item' => __('Add New Team Member'),
		'edit_item' => __('Edit Team Member'),
		'new_item' => __('New Team Member'),
		'view_item' => __('View Team Member'),
		'search_items' => __('Search Team Members'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_team.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		//"menu_position" => 21
	  ); 
 
	register_post_type( 'team' , $args );
	flush_rewrite_rules();
    
    /**** REGISTER TESTIMONIAL POST TYPE ****/
	$labels = array(
		'name' => _x('Testimonials', 'post type general name'),
		'singular_name' => _x('Testimonial', 'post type singular name'),
		'add_new' => _x('Add New Testimonial', 'portfolio item'),
		'add_new_item' => __('Add New Testimonial'),
		'edit_item' => __('Edit Testimonial'),
		'new_item' => __('New Testimonial'),
		'view_item' => __('View Testimonial'),
		'search_items' => __('Search Testimonials'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_testimonial.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','excerpt'),
		//"menu_position" => 21
	  ); 
 
	register_post_type( 'testimonials' , $args );
	//flush_rewrite_rules();



    /**** REGISTER PROJECT POST TYPE ****/
	$labels = array(
		'name' => _x('Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New Project', 'portfolio item'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/image/nav_projects.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','editor','tags'),
		//"taxonomies" => array('post_tags')
		//"menu_position" => 21
	  ); 
 
	register_post_type( 'project' , $args );
    register_taxonomy_for_object_type('post_tag', 'project');
	flush_rewrite_rules();

}

/**** REGISTER TAXONOMIES ****/
add_action( 'init', 'create_project_categories', 0 );
function create_project_categories() {
    // Add Project Type Taxonomy
    register_taxonomy(
        'type',
        'project',
        array(
            'labels' => array(
                'name'              => _x( 'Types' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Type' , 'taxonomy singular name'),
                'add_new_item' => 'Add Type',
                'new_item_name' => "New Type"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'support' => array('tags')
        )
    );
    register_taxonomy(
        'theme',
        'project',
        array(
            'labels' => array(
                'name'              => _x( 'Themes' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Theme' , 'taxonomy singular name'),
                'add_new_item' => 'Add Theme',
                'new_item_name' => "New Theme"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
            'support' => array('tags')
        )
    );
/*
    register_taxonomy(
        'type',
        'project',
        array(
            'labels' => array(
                'name'              => _x( 'Types' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Type' , 'taxonomy singular name'),
                'add_new_item' => 'Add Type',
                'new_item_name' => "New Type"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => false,
            'support' => array('tags'),
        )
    );
    // Add Project Theme Taxonomy
    register_taxonomy(
        'theme',
        'project',
        array(
            'labels' => array(
                'name'              => _x( 'Themes' , 'taxonomy general name' ),
                'singular_name'     => _x( 'Theme' , 'taxonomy singular name'),
                'add_new_item' => 'Add Theme',
                'new_item_name' => "New Theme"
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'show_tagcloud' => false,
            'hierarchical' => false,
        )
    );
*/
}

/*** CUSTOM COLUMNS FOR PROJECT EDIT SCREEN ***/
add_filter( 'manage_edit-project_columns', 'my_edit_project_columns' ) ;
add_action( 'manage_project_posts_custom_column', 'my_manage_project_columns', 10, 2 );

function my_edit_project_columns($columns) {
   $new_columns = array(
		//'cb' => '<input type="checkbox" />',
		'thumbnail' => __( 'Thumbnail' ),
		'gridview' => __( 'Listing Type' ),
		//'date' => __( 'Date' )
	);
	return array_merge($columns, $new_columns);
}

function my_manage_project_columns($column, $post_id) {
  global $post;
  switch( $column ) {
    case 'thumbnail' :
      $gallery = get_field('gallery');
      echo '<img src="'.$gallery[0]['sizes']['post-thumbnail'].'" />';
      break;
  }
  switch( $column ) {
    case 'gridview' :
      $g = get_field('listing_type');
      echo '<span style="font-size: 11px;">';
      switch($g) {
        case "grid":
          echo "Grid View";
          break;
        case "expanded":
          echo "Expanded List View";
          break;
        case "list":
          echo "List View Only";
          break;
        default:
          echo "Not defined";
          break;
      }
      echo '</span>';
      break;
  }
}

?>