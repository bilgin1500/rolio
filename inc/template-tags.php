<?php
/**
 * Rolio custom template tags for this theme.
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package rolio
 *
 * TOC
 * rolio_meta_posted_on
 * rolio_meta_updated_on
 * rolio_meta_posted_by
 * rolio_meta_cats
 * rolio_meta_tags
 * rolio_meta_edit_url
 * rolio_meta_paged
 * rolio_meta_sticky
 * rolio_meta_comments_link
 * rolio_meta_custom_fields
 * rolio_nav_menu
 * rolio_nav_page
 * rolio_nav_posts
 * rolio_nav_comments
 * rolio_nav_paged_posts
 * rolio_nav_back_to_cat
 * rolio_nav_category_children_menu
 * rolio_nav_backtotop_button
 * rolio_tag_custom_logo
 * rolio_tag_custom_header
 * rolio_tag_site_title
 * rolio_tag_site_desc
 * rolio_tag_wp_link
 * rolio_tag_designer_link
 * rolio_tag_copy_text
 * rolio_tag_copy_notice
 * rolio_tag_comment
 * rolio_tag_page_header
 */



if ( ! function_exists( 'rolio_meta_posted_on' ) ) {
/**
 * Current post's publish date
 * @return void
 */
function rolio_meta_posted_on() {
	$time_string = sprintf( '<span class="screen-reader-text" aria-hidden="true">' . __('Posted on','rolio') . '</span><time class="entry-date published" datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'd.m.Y' ) )
	);
	echo '<div class="entry-meta-publish-date"><i class="lnr lnr-clock"></i>' . $time_string . '</div>';
}}



if ( ! function_exists( 'rolio_meta_updated_on' ) ) {
/**
 * Current post's update date
 * @return void
 */
function rolio_meta_updated_on() {
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<span class="screen-reader-text" aria-hidden="true">' . __('Updated on','rolio') . '</span><time class="entry-date updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date( 'd.m.Y' ) )
		);
		echo '<div class="entry-meta-update-date"><i class="lnr lnr-history"></i>' . $time_string . '</div>';
	}
}}



if ( ! function_exists( 'rolio_meta_posted_by' ) ) {
/**
 * Current post's author with author url
 * @return void
 */
function rolio_meta_posted_by() {
	echo '<div class="entry-meta-posted-by"><span class="screen-reader-text" aria-hidden="true">' . __('Posted by','rolio') . '</span><a class="entry-author url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="lnr lnr-user"></i>' . esc_html( get_the_author() ) . '</a></div>';
}}



if ( ! function_exists( 'rolio_meta_cats' ) ) {
/**
 * Current post's categories
 * @return void
 */
function rolio_meta_cats() {
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( esc_html__( ', ', 'rolio' ) );
		if ( $categories_list && rolio_blog_has_category() ) {
			echo '<div class="entry-meta-categories"><span class="entry-categories"><span class="screen-reader-text" aria-hidden="true">' . __('Categorized in','rolio') . '</span><i class="lnr lnr-layers"></i>' . $categories_list. '</span></div>';
		}
	}
}}



if ( ! function_exists( 'rolio_meta_tags' ) ) {
/**
 * Current post's tags
 * @return void
 */
function rolio_meta_tags() {
	if ( 'post' === get_post_type() ) {
		$tags_list = get_the_tag_list( '<i class="lnr lnr-tag"></i>',esc_html__( ', ', 'rolio' ) );
		if ( $tags_list ) {
			echo '<div class="entry-meta-tags"><span class="entry-tags"><span class="screen-reader-text" aria-hidden="true">' . __('Tagged by','rolio') . '</span>' . $tags_list . '</span></div>';
		}
	}
}}



if ( ! function_exists( 'rolio_meta_edit_url' ) ) {
/**
 * Current post's edit url
 * @return void
 */
function rolio_meta_edit_url() {
	edit_post_link( sprintf( __( '%1$s Edit this page', 'rolio' ), '<i class="lnr lnr-pencil"></i>' ) );
}}



if ( ! function_exists( 'rolio_meta_paged' ) ) {
/**
 * Paged entry meta
 * @return void
 */
function rolio_meta_paged() {
	global $numpages;
	if ( $numpages > 1 ) {
		echo '<div class="entry-meta-paged"><i class="lnr lnr-book"></i><span>' . sprintf( __('%1$s part story.','rolio'), $numpages ) . '</span></div>';
	}
}}



if ( ! function_exists( 'rolio_meta_sticky' ) ) {
/**
 * Sticky post meta
 * @return void
 */
function rolio_meta_sticky() {
	if ( is_sticky() ) {
		echo '<div class="entry-meta-sticky"><i class="lnr lnr-bookmark"></i><span>' . __('Sticky post.','rolio') . '</span></div>';
	}
}}



if ( ! function_exists( 'rolio_meta_comments_link' ) ) {
/**
 * Current post's comments link
 * @return void
 */
function rolio_meta_comments_link() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<div class="entry-meta-comments-link"><span class="comments-link"><i class="lnr lnr-bubble"></i>';
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text" aria-hidden="true"> on %s</span>', 'rolio' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span></div>';
	}
}}



if ( ! function_exists( 'rolio_meta_custom_fields' ) ) {
/**
 * Current post's custom fields
 * @see the_meta()
 * @return void 
 */
function rolio_meta_custom_fields() {
	if ( $keys = get_post_custom_keys() ) {
		$allKeyValues = '';
		$count = 0;
		foreach ( (array) $keys as $key ) {
			$keyt = trim($key);
			if ( is_protected_meta( $keyt, 'post' ) )
				continue;
			$values = array_map( 'trim', get_post_custom_values($key) );
			$value = implode( $values,', ' );
			$count++;
			$allKeyValues .= apply_filters( 'the_meta_key', "<li><span class='post-meta-key'>$key:</span> $value</li>\n", $key, $value );
		}
		if ($count > 0) {
			echo '<div class="entry-meta-custom-fields"><ul class="post-meta">' . $allKeyValues . '</ul></div>';
		}
	}
}}


if ( ! function_exists( 'rolio_nav_menu' ) ) {
/**
 * Uses wp_nav_menu()
 * @return void
 */
function rolio_nav_menu( $theme_location ) {

	$menu = wp_nav_menu( array( 
		'theme_location' 	=> $theme_location, 
		'menu_id' 			=> $theme_location.'-menu' ,
		'container_class' 	=> 'menu-container',
		'echo'				=> false
	) );
	
	if ( has_nav_menu( $theme_location ) && substr_count($menu,'class="menu-item ') > 0 ) {
		$menuStr = '<nav id="site-navigation-'.$theme_location.'" class="main-navigation" role="navigation">';
			$menuStr .= '<a class="menu-toggle" aria-controls="'.$theme_location.'-menu" aria-expanded="false">';
				$menuStr .= '<i class="lnr lnr-menu"></i>';
				$menuStr .= '<span class="screen-reader-text" aria-hidden="true">';
				$menuStr .= sprintf( __( 'Toggle %1$s menu', 'rolio' ), $theme_location );
				$menuStr .= '</span>';
			$menuStr .= '</a>';
			$menuStr .= $menu;
		$menuStr .= '</nav>';
		echo $menuStr;
	}
}}



if ( ! function_exists( 'rolio_nav_page' ) ) {
/**
 * On archive and index pages previous and next page links on the bottom
 * @return void
 */
function rolio_nav_page() {
	the_posts_navigation( array(
		'prev_text' => sprintf( '<i class="lnr lnr-chevron-left"></i><span>%1$s</span>', __('Previous Page','rolio') ),
		'next_text'  => sprintf( '<i class="lnr lnr-chevron-right"></i><span>%1$s</span>', __('Next Page','rolio') ),
	) );
}}



if ( ! function_exists( 'rolio_nav_posts' ) ) {
/**
 * On single post pages previous and next post links on the bottom
 * @return void
 */
function rolio_nav_posts() {
	if ( is_singular( 'attachment' ) ) {
		// Parent post navigation.
		the_post_navigation( array(
			'prev_text' => sprintf( '<i class="lnr lnr-chevron-up"></i><span>%1$s</span>', __('Published in %title','rolio') )
		) );
	} elseif ( is_singular( 'post' ) ) {
		// Previous/next post navigation.
		the_post_navigation( array(
			'prev_text' => sprintf( '<i class="lnr lnr-chevron-left"></i><span>%1$s: %2$s</span>', __('Previous','rolio'), '%title' ),
			'next_text'  => sprintf( '<i class="lnr lnr-chevron-right"></i><span>%1$s: %2$s</span>', __('Next','rolio'), '%title' )
		) );
	}
}}



if ( ! function_exists( 'rolio_nav_comments' ) ) {
/**
 * Comments navigation
 * @return void
 */
function rolio_nav_comments() {
	the_comments_navigation( array(
		'prev_text' => sprintf( '<i class="lnr lnr-chevron-left"></i><span>%1$s</span>', __('Previous Comments','rolio') ),
		'next_text'  => sprintf( '<i class="lnr lnr-chevron-right"></i><span>%1$s</span>', __('Next Comments','rolio') ),
	) );
}}



if ( ! function_exists( 'rolio_nav_paged_posts' ) ) {
/**
 * Displays page-links for paginated posts (i.e. includes the <!--nextpage--> Quicktag one or more times)
 * @return void
 */
function rolio_nav_paged_posts() {
	global $page, $numpages;

	$pageLinksTitle = sprintf( '<div class="page-links-title">' . __('This is the part %1$s of a %2$s part story.','rolio') . '</div>', $page, $numpages );

	wp_link_pages( array(
		'before'      => '<div class="page-links">' . $pageLinksTitle,
		'after'       => '</div>',
		'pagelink'	  => __('Part %','rolio'),
		'link_before' => '<span>',
		'link_after'  => '</span>',
		'separator'	  => '&bull;'
	) );
}}



if ( ! function_exists( 'rolio_nav_category_children_menu' ) ) {
/**
 * Builds a submenu for categories
 * @return string Returns the menu markup
 */
function rolio_nav_category_children_menu() {
	if ( is_category() ) {
		global $wp_query;
		$currentCatId = $wp_query->get_queried_object_id();
		$parentCat = get_category($currentCatId);
		$parentCatId = $parentCat->parent;
		$catId = $parentCatId > 0 ? $parentCatId : $currentCatId;
		$catChildren = get_categories( array(
			'parent'		=> $catId,
			'hide_empty' 	=> 0
		) );
		$menu = '';
		if ( count($catChildren) > 1 ) {
			$menu .= '<nav class="navigation category-children-navigation" role="navigation">';
			$menu .= '<h2 class="screen-reader-text" aria-hidden="true">';
			$menu .=  sprintf( __( 'Subcategories navigation for %1$s', 'rolio' ), get_cat_name( $catId ) ) . '</h2>';
			$menu .= '<ul class="nav-links">';
			foreach ( $catChildren as $child ) {
				$isCurrent = $currentCatId === $child->term_id ? 'current' : '';
				$menu .= '<li class="' . $isCurrent . '"><a href="' . get_term_link( $child->term_id ) . '">' . $child->name . '</a></li>';
			}
			$menu .= '</ul></nav>';
		}
		return $menu;
	}
}}



if ( ! function_exists( 'rolio_nav_back_to_cat' ) ) {
/**
 * On post-format:image single post page we'll add an extra link to the parent category
 * @return void
 */
function rolio_nav_back_to_cat() {
    if ( is_single() && get_post_format() == 'image' ) {
    	$menu = '<nav class="navigation back-to-cat-navigation" role="navigation">';
		$menu .= '<h2 class="screen-reader-text" aria-hidden="true">' . __( 'Back to categories navigation', 'rolio' ) . '</h2>';
		$menu .= '<ul class="nav-links">';
		$menu .= '<li><a href="#"><i class="lnr lnr-chevron-up"></i>';
		$menu .= '<span class="screen-reader-text" aria-hidden="true">' . __( 'All categories', 'rolio' ) . '</span></a><div><ul>';
		$post = get_post();
		$categories = get_the_category( $post->ID );
		foreach( $categories as $category ) {
			$menu .= '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
		}
		$menu .= '</ul></div></li></ul></nav>';
		echo $menu;
    }
}}



if ( ! function_exists( 'rolio_nav_backtotop_button' ) ) {
/**
 * Shows to the top button
 * @return void
 */
function rolio_nav_backtotop_button() {
	echo '<a class="back-to-top" href="#hello" title="' . __( 'Back to Top', 'rolio' ) . '"><i class="lnr lnr-chevron-up"></i><span class="screen-reader-text" aria-hidden="true">'. __( 'Back to Top', 'rolio' ) . '</span></a>';
}
add_action( 'rolio_footer', 'rolio_nav_backtotop_button', 200 );}



if ( ! function_exists( 'rolio_tag_custom_logo' ) ) {
/**
 * Displays the optional custom logo. Does nothing if the custom logo is not
 * available.
 * @return void
 */
function rolio_tag_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}}



if ( ! function_exists( 'rolio_tag_custom_header' ) ) {
/**
 * Displays the optional header image. Does nothing if the custom header is not
 * available.
 * @return void
 */
function rolio_tag_custom_header() {
	if ( get_header_image() ) {

		$custom_header_sizes = apply_filters( 'rolio_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );

		$headerImgStr = '<div class="site-header-image">';
			$headerImgStr .= '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
				$headerImgStr .= '<img src="' . get_header_image() . '" srcset="' . esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ) . '" sizes="' . esc_attr( $custom_header_sizes ) . '" width="' . esc_attr( get_custom_header()->width ) . '" height="' . esc_attr( get_custom_header()->height ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';
			$headerImgStr .= '</a>';
		$headerImgStr .= '</div>';

		echo $headerImgStr;
	}
}}



if ( ! function_exists( 'rolio_tag_site_title' ) ) {
/**
 * Displays the site title
 * @return void
 */
function rolio_tag_site_title() {
	$siteTitle = get_bloginfo( 'name' );
	if ( $siteTitle ) {
		$siteTitleStr = '<h1 class="site-title';
		if ( has_custom_logo() ) { 
			$siteTitleStr .= ' screen-reader-text'; 
		}
		$siteTitleStr .= '">';
		$siteTitleStr .= '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . $siteTitle . '</a>';
		$siteTitleStr .= '</h1>';
		echo $siteTitleStr;
	}
}}



if ( ! function_exists( 'rolio_tag_site_description' ) ) {
/**
 * Displays the site description
 * @return void
 */
function rolio_tag_site_description() {
	$description = get_bloginfo( 'description', 'display' );
	if ( $description ) {
		$siteDescStr = '<p class="site-description';
		if ( has_custom_logo() ) { 
			$siteDescStr .=  ' screen-reader-text'; 
		}
		$siteDescStr .= '">';
		$siteDescStr .= $description . '</p>';
		echo $siteDescStr;
	}
}}



if ( ! function_exists( 'rolio_tag_wp_link' ) ) {
/**
 * To display a link to WordPress.org
 * @return string The Wordpress.org link
 */
function rolio_tag_wp_link() {
   return '<a href="'.esc_url( 'http://www.wordpress.org' ).'" title="' . esc_attr__( 'WordPress', 'rolio' ) . '">' . __( 'WordPress', 'rolio' ) . '</a>';
}}



if ( ! function_exists( 'rolio_tag_designer_link' ) ) {
/**
 * To display a link to Rolakosta.com
 * @return string The designer website link
 */
function rolio_tag_designer_link() {
   return '<a href="'.esc_url( 'http://www.rolakosta.com' ).'" title="'.esc_attr__( 'Rolakosta.com', 'rolio' ).'" >'.__( 'Rolakosta', 'rolio') .'</a>';
}}



if ( ! function_exists( 'rolio_tag_copy_text' ) ) {
/**
 * To display a default copyright text
 * @return string Copyright text
 */
function rolio_tag_copy_text() {
	return sprintf( '&copy;%1$s %2$s', date( 'Y' ), __('Some rights reserved', 'rolio') );
}}



if ( ! function_exists( 'rolio_tag_copy_notice' ) ) {
/**
 * Function to build the copyright notice. These settings can be set in the
 * customizer panel.
 * @return void
 */
function rolio_tag_copy_notice() { 
    $notice = '<section class="copyright-notice">';
    $notice .= '<div class="copy-text">' . get_theme_mod( 'rolio_theme_copy_text', rolio_tag_copy_text() ) . '</div>';
    if ( get_theme_mod( 'rolio_theme_designed_by', 1 ) ) {
    	$notice .= '<div class="copy-designer">' . __( 'Designed by:', 'rolio' ) .' '.  rolio_tag_designer_link() . '</div>';
    }
    if ( get_theme_mod( 'rolio_theme_powered_by', 1 ) ) {
    	$notice .= '<div class="copy-powered">' . __( 'Powered by:', 'rolio' ) .' '. rolio_tag_wp_link() . '</div>';
	}
    $notice .= '</section>';    
    echo $notice;
}
add_action( 'rolio_footer', 'rolio_tag_copy_notice', 100 );}



if ( ! function_exists( 'rolio_tag_comment' ) ) {
/**
 * Function to build each comment on comments' list
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments#Comments_Only_With_A_Custom_Comment_Display
 * @return void
 */
function rolio_tag_comment($comment, $args, $depth) {

	// comment
    $commentStr = '<div ' . comment_class( empty( $args["has_children"] ) ? "" : "parent", null, null, false ) . ' id="comment-' . get_comment_ID() . '">';

    	// comment-avatar
    	if ( $args['avatar_size'] != 0 && get_option( 'show_avatars' ) && get_avatar( $comment ) ) {
	    	$commentStr .= '<div class="comment-avatar">';
				$commentStr .= get_avatar( $comment, $args['avatar_size'] );
			$commentStr .= '</div>';
		}

		// comment-body
    	$commentStr .= '<div class="comment-body">';

    		// comment-awaiting-moderation
	    	if ( $comment->comment_approved == '0' ) :
	        $commentStr .= '<div class="comment-awaiting-moderation warning"><p>' . __( 'Your comment is awaiting moderation.','rolio' ) . '</p></div>';
	        endif;
		    
		    // comment-text
		    $commentStr .= '<div class="comment-text">' . get_comment_text() . '</div>';

		    // comment-meta
		    $commentStr .= '<div class="comment-meta">';
		    	$commentStr .= '<span class="comment-date-and-author">';
				    $commentStr .= '<span class="comment-date" title="' . sprintf( __('%1$s at %2$s', 'rolio'), get_comment_date(),  get_comment_time() ) . '">';
					    $commentStr .= '<a href="' . esc_html( get_comment_link() ) . '">';
					    $commentStr .= human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago';	
					    $commentStr .= '</a>';
				    $commentStr .= '</span>';
				    $commentStr .= '<span class="comment-author vcard">';
		    		$commentStr .= sprintf( __( '<span class="by">by</span> <cite class="fn">%s</cite>', 'rolio' ), get_comment_author_link() );
		    		$commentStr .= '</span>';
		    	$commentStr .= '</span>';
			    $commentStr .= '<span class="comment-edit">';
		    	$commentStr .= '<a href="' . esc_html( get_edit_comment_link() ) . '"><i class="lnr lnr-pencil"></i>' . __( 'Edit', 'rolio' ) . '</a>';
		    	$commentStr .= '</span>';
		    	$commentStr .= get_comment_reply_link( array_merge( $args, array( 
		    		'depth' => $depth, 
		    		'max_depth' => $args['max_depth'],
		    		'before' => '<span class="comment-reply"><i class="lnr lnr-bubble"></i>',
		    		'after' => '</span>'
		    	) ) );
	    	$commentStr .= '</div>';

	    //	/comment-body
	    $commentStr .= '</div>';
	// /comment
    $commentStr .= '</div>';

    echo $commentStr;
}}



if ( ! function_exists( 'rolio_tag_page_header' ) ) {
/**
 * Page header for index pages
 * @return void
 */
function rolio_tag_page_header() {

	$pageTitleStr = '';

	if ( is_home() && ! is_front_page() && ! rolio_is_image_index() ) :
		$pageTitleStr .= '<header class="page-header">';
			$pageTitleStr .= '<h1 class="page-title">' . single_post_title(null,false) . '</h1>';
		$pageTitleStr .= '</header>';
	endif;

	if ( is_archive() ) :
		$pageTitleStr .= '<header class="page-header">';
			$pageTitleStr .= '<h1 class="page-title">' . get_the_archive_title() . '</h1>';
			$pageTitleStr .= '<div class="taxonomy-description">' . get_the_archive_description() . '</div>';
			$pageTitleStr .= rolio_nav_category_children_menu();
		$pageTitleStr .= '</header>';
	endif;

	if ( is_search() ) :
		$pageTitleStr .= '<header class="page-header">';
			$pageTitleStr .= '<h1 class="page-title">';
			$pageTitleStr .= sprintf( esc_html__( 'Search Results for: %s', 'rolio' ), '<span>' . get_search_query() . '</span>' );
			$pageTitleStr .= '</h1>';
		$pageTitleStr .= '</header>';
	endif;

	echo $pageTitleStr;
}}
