<?php
/**
 * Rolio theme functions and definitions.
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package rolio
 *
 * TOC
 * rolio_action_setup
 * rolio_action_content_width
 * rolio_action_init_widgets
 * rolio_action_enqueue_scripts
 * rolio_filter_body_classes
 * rolio_filter_post_classes
 * rolio_filter_widget_tag_cloud_args
 * rolio_filter_get_the_archive_title
 * rolio_is_image_index
 * rolio_get_post_format_group
 * rolio_list_social_media_sites
 * rolio_hook_social_media_links
 * rolio_blog_has_category
 * rolio_blog_has_category_transient_flusher
 * rolio_filter_admin_add_styleselect
 * rolio_filter_admin_add_style_formats
 * rolio_filter_admin_add_editor_styles
 * /inc/template-tags.php
 * /inc/customizer.php
 */



if ( ! function_exists( 'rolio_action_setup' ) ) {
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as
 * indicating support for post thumbnails.
 * @return void
 */
function rolio_action_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on rolio, use a find and replace
	 * to change 'rolio' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'rolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'header' => __( 'Header Menu', 'rolio' ),
		'footer' => __( 'Footer Menu', 'rolio' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video',
		'audio'
	) );

	// Set up the WordPress core custom logo feature.
	add_theme_support( 'custom-logo', array(
		'width'			=> 600,
		'height'		=> 125,
		'flex-width'	=> true
	) );

	// Set up custom background color and image feature
	add_theme_support( 'custom-background' );

	// Set up custom header feature
	add_theme_support( 'custom-header', array(
		'width'			=> 880,
		'height'		=> 300,
		'flex-height'	=> true,
		'header-text' 	=> false
	) );

}
add_action( 'after_setup_theme', 'rolio_action_setup' );}



if ( ! function_exists( 'rolio_action_content_width' ) ) {
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 * @return void
 */
function rolio_action_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'rolio_content_width', 880 );
}
add_action( 'after_setup_theme', 'rolio_action_content_width', 0 );}



if ( ! function_exists( 'rolio_action_init_widgets' ) ) {
/**
 * Registers the widget areas.
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 * @return void
 */
function rolio_action_init_widgets() {

	register_sidebar( array(
		'name'          => __( 'Right sidebar of blog posts', 'rolio' ),
		'id'            => 'sidebar-post-right',
		'description'   => __( 'Appears at right sidebar on post pages.', 'rolio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Header bottom sidebar', 'rolio' ),
		'id'            => 'sidebar-header-bottom',
		'description'   => __( 'Appears at bottom of the header, on every page.', 'rolio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer top sidebar', 'rolio' ),
		'id'            => 'sidebar-footer-top',
		'description'   => __( 'Appears at top of the footer, on every page.', 'rolio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'rolio_action_init_widgets' );}



if ( ! function_exists( 'rolio_action_enqueue_scripts' ) ) {
/**
 * Enqueue scripts and styles.
 * @return void
 */
function rolio_action_enqueue_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'font-lato', get_template_directory_uri() . '/fonts/Lato/font.css', array(), '20160607' );
	wp_enqueue_style( 'font-libre', get_template_directory_uri() . '/fonts/Libre-Baskerville/font.css', array(), '20160607' );

	// Add icon fonts (https://linearicons.com/free)
	wp_enqueue_style( 'linearicons', get_template_directory_uri() . '/fonts/Linearicons/font.css', array(), '1.0.0' );
	wp_enqueue_style( 'fontawesome-sm-icons', get_template_directory_uri() . '/fonts/Fontawesome-Social-Media-Icons/style.css', array(), '1.0.0' );

	// Add main theme stylesheet
	wp_enqueue_style( 'rolio-style', get_stylesheet_uri(), array(), '1.0.1' );

	// Add front-end js files
	wp_enqueue_script( 'rolio-plugins-js', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20160507', true );
	wp_enqueue_script( 'rolio-main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'rolio-plugins-js', 'masonry' ), '20160507', true );

	// Localize main.js
	wp_localize_script( 'rolio-main-js', 'i18n', array(
		'expand'   => __( 'expand child menu', 'rolio' ),
		'collapse' => __( 'collapse child menu', 'rolio' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'rolio_action_enqueue_scripts' );}



if ( ! function_exists( 'rolio_filter_body_classes' ) ) {
/**
 * Adds custom classes to the array of body classes.
 * @param array $classes Classes for the body element.
 * @return array Filtered body classes.
 */
function rolio_filter_body_classes( $classes ) {

	// Adds a class of has-sidebar-right-post to posts with active main sidebar.
	if ( is_active_sidebar( 'sidebar-post-right' ) ) {
		$classes[] = 'has-sidebar-post-right';
	}

	// Adds a class of has-footer-sidebar to pages with active footer sidebar.
	if ( is_active_sidebar( 'sidebar-footer-top' ) ) {
		$classes[] = 'has-footer-sidebar';
	}

	// Adds a class of has-header-sidebar to pages with active header sidebar.
	if ( is_active_sidebar( 'sidebar-header-bottom' ) ) {
		$classes[] = 'has-header-sidebar';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// If there is a post format selected, adds a group class for this format type
	if ( is_singular() && get_post_format() ) {
		$classes[] = 'single-format-group-' . rolio_get_post_format_group();
	}

	// Adds layout customization classes to the body
	$classes[] = get_theme_mod( 'rolio_theme_layout', 'theme-classic' );
	$classes[] = get_theme_mod( 'rolio_theme_color', 'theme-light' );

	// Adds image index view class
	if ( rolio_is_image_index() ) {
		$classes[] = 'theme-image-index';
		$classes[] = get_theme_mod( 'rolio_theme_image_index' ) === 'theme-standard' ? '' : get_theme_mod( 'rolio_theme_image_index' );
	}

	return $classes;
}
add_filter( 'body_class', 'rolio_filter_body_classes' );}



if ( ! function_exists( 'rolio_filter_post_classes' ) ) {
/**
 * Adds custom classes to the array of post classes.
 * @param array $classes Classes for the post element.
 * @return array Filtered post classes.
 */
function rolio_filter_post_classes( $classes ) {

	// If there is a post format selected, adds a group class for this format type
	if ( get_post_format() ) {
		$classes[] = 'format-group-' . rolio_get_post_format_group();
	}

	return $classes;
}
add_filter( 'post_class', 'rolio_filter_post_classes' );}



if ( ! function_exists( 'rolio_filter_widget_tag_cloud_args' ) ) {
/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font
 * size.
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function rolio_filter_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'rolio_filter_widget_tag_cloud_args' );}



if ( ! function_exists( 'rolio_filter_get_the_archive_title' ) ) {
/**
 * Modifies archive titles and removes prefix like "Category:".
 * @link http://wordpress.stackexchange.com/a/179590
 * @param string $title Archive title
 * @return string A new modified title.
 */
function rolio_filter_get_the_archive_title( $title ) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
};
add_filter( 'get_the_archive_title', 'rolio_filter_get_the_archive_title' );}



if ( ! function_exists( 'rolio_is_image_index' ) ) {
/**
 * Check if the taxonomy query contains only image, video or gallery post formats
 * @return boolean Return true if the query contains only image and gallery post
 * formats.
 */
function rolio_is_image_index(){
	$is_image_index = false;
	if ( is_category() || is_tag() ) {
		$is_image_index = true;
		global $wp_query;
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				$format = get_post_format();
				if ( ( $format != 'image' ) && 
					( $format != 'gallery' ) &&
					( $format != 'video' ) ) {
					$is_image_index = false;
				}
			endwhile;
		else :
			$is_image_index = false;
		endif;
	}
	return $is_image_index;
}}



if ( ! function_exists( 'rolio_get_post_format_group' ) ) {
/**
 * This function groups the post formats and returns the new group name
 * @return string Group name
 */
function rolio_get_post_format_group() {
	$format = get_post_format() ? get_post_format() : 'standard';
	$formatGroup = '';
	switch ($format) {
		case 'image':
		case 'gallery':
		case 'video':
		case 'audio':
			$formatGroup = 'media';
			break;
	}
	return $formatGroup;
}}



if ( ! function_exists( 'rolio_list_social_media_sites' ) ) {
/**
 * Store social media site names in an array
 * @link
 * https://www.competethemes.com/blog/social-icons-wordpress-menu-theme-customizer/
 * @return array All available social media sites
 */
function rolio_list_social_media_sites() {

	$social_sites = array(
		'Behance',
		'Dribbble',
		'Facebook', 
		'Flickr', 
		'Github',
		'Google Plus', 
		'Instagram',
		'LinkedIn', 
		'Pinterest',
		'Reddit',
		'Snapchat',
		'Soundcloud',
		'Tumblr', 
		'Twitter', 
		'Vimeo',
		'Vine',
		'Wordpress',
		'Youtube'
	);

	return $social_sites;
}}



if ( ! function_exists( 'rolio_hook_social_media_links' ) ) {
/**
 * Takes user input from the customizer and outputs linked social media icons
 * @link
 * https://www.competethemes.com/blog/social-icons-wordpress-menu-theme-customizer/
 * @return string HTML list
 */
function rolio_hook_social_media_links() {

	/**
	 * Builds the social media menu
	 * @return [string] Menu markup
	 */
	function rolio_build_social_media_links( $addUlWrapper=true ) {

	    $social_sites = rolio_list_social_media_sites();
	    $social_menu = '';

	    // any inputs that aren't empty are stored in $active_sites array
	    foreach($social_sites as $social_site) {
	        if( strlen( get_theme_mod( sanitize_title( $social_site ) ) ) > 0 ) {
	            $active_sites[] = $social_site;
	        }
	    }

	    // for each active social site, add it as a list item
	    if ( ! empty( $active_sites ) ) {
	        if ( $addUlWrapper ) {
	        	$social_menu .= '<ul class="social-media-links">';
	        }
	        foreach ( $active_sites as $active_site ) {
                $social_menu .= '<li>';
                $social_menu .= '<a';
                $social_menu .= ' target="target_' . sanitize_title( $active_site ) . '"';
                $social_menu .= ' href="' . esc_url( get_theme_mod( sanitize_title( $active_site )) ) . '">';
                $social_menu .= '<i class="icon-sm-' . esc_attr( sanitize_title( $active_site ) ) . '"';
                $social_menu .= ' title="' . sprintf( __('%s icon', 'rolio'), $active_site ) . '">';
                $social_menu .= '</i>';
                $social_menu .= '<span class="screen-reader-text">' . $active_site .'</span>';
                $social_menu .= '</a>';
                $social_menu .= '</li>';
	        }
	        if ( $addUlWrapper ) {
	        	$social_menu .= '</ul>';
	        }
	    }

	    return $social_menu;
    }

    // sm links' position
    switch (get_theme_mod( 'rolio_theme_sm_icon_pos' )) {
    	
    	case 'sm-pos-header-menu':

    		function rolio_nav_add_sm_links_to_header_menu ( $items, $args ) {
			    if ( $args->theme_location == 'header' ) {
			        $items .= rolio_build_social_media_links( false );
			    }
			    return $items;
			}
	    	add_filter( 'wp_nav_menu_items', 'rolio_nav_add_sm_links_to_header_menu', 10, 2 );
	    	break;
	    
	    case 'sm-pos-header':

	    	function rolio_header_sm_links() { echo rolio_build_social_media_links( true ); }
	        add_action( 'rolio_header', 'rolio_header_sm_links', 10, 1 );
	        break;

	    case 'sm-pos-footer-menu':

    		function rolio_nav_add_sm_links_to_footer_menu ( $items, $args ) {
			    if ( $args->theme_location == 'footer' ) {
			        $items .= rolio_build_social_media_links( false );
			    }
			    return $items;
			}
	    	add_filter( 'wp_nav_menu_items', 'rolio_nav_add_sm_links_to_footer_menu', 10, 2 );
	    	break;
	    
	    case 'sm-pos-footer':

	    	function rolio_footer_sm_links() { echo rolio_build_social_media_links( true ); }
	        add_action( 'rolio_footer', 'rolio_footer_sm_links', 10, 1 );
	        break;
	    
	    case 'sm-pos-none':
	    	return;
	}

}
rolio_hook_social_media_links();}



if ( ! function_exists( 'rolio_blog_has_category' ) ) {
/**
 * Returns true if a blog has more than 1 category.
 * @return boolean
 */
function rolio_blog_has_category() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rolio_categories' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'rolio_categories', $all_the_cool_cats );
	}
	if ( $all_the_cool_cats > 1 ) {
		return true;
	} else {
		return false;
	}
}}



if ( ! function_exists( 'rolio_blog_has_category_transient_flusher' ) ) {
/**
 * Flush out the transients used in rolio_blog_has_category
 * @return void
 */
function rolio_blog_has_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'rolio_categories' );
}
add_action( 'edit_category', 'rolio_blog_has_category_transient_flusher' );
add_action( 'save_post',     'rolio_blog_has_category_transient_flusher' );
}



if ( ! function_exists( 'rolio_filter_admin_add_styleselect' ) ) {
/**
 * Callback function to filter the MCE settings
 * @return array
 */
function rolio_filter_admin_add_styleselect( $buttons ) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'rolio_filter_admin_add_styleselect');}



if ( ! function_exists( 'rolio_filter_admin_add_style_formats' ) ) {
/**
 * Callback function to filter the MCE settings
 * @link
 * http://www.wpbeginner.com/wp-tutorials/how-to-add-custom-styles-to-wordpress-visual-editor/
 * @return array
 */
function rolio_filter_admin_add_style_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => __( 'Caption','rolio' ),  
			'block' => 'div',  
			'classes' => 'caption',
			'wrapper' => true
		),
		array(  
			'title' => __( 'Warning','rolio' ),  
			'block' => 'div',  
			'classes' => 'warning',
			'wrapper' => true
		)
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	return $init_array;  
} 
add_filter( 'tiny_mce_before_init', 'rolio_filter_admin_add_style_formats' );}



if ( ! function_exists( 'rolio_filter_admin_add_editor_styles' ) ) {
/**
 * Callback function to filter the MCE settings
 * @return void
 */
function rolio_filter_admin_add_editor_styles() {

    add_editor_style( 'css/editor.css' );

}
add_action( 'init', 'rolio_filter_admin_add_editor_styles' );}



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
