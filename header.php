<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package rolio
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body id="hello" <?php body_class(); ?>>

<!--[if lt IE 9]>
    <a href="<?php echo esc_url( __('http://browsehappy.com/', 'rolio'));?>" class="please-do-upgrade"><?php _e( 'You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.', 'rolio' ); ?></a>
<![endif]-->

<div id="page" class="site">

	<header id="header" class="site-header" role="banner">

		<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'rolio' ); ?></a>

		<?php rolio_tag_custom_header(); ?>
		
		<div class="site-branding-nav-holder clear">
			<div class="site-branding">
				<?php rolio_tag_custom_logo(); ?>
				<?php rolio_tag_site_title(); ?>
				<?php rolio_tag_site_description(); ?>
			</div>
			<div class="site-header-nav">
				<?php do_action( 'rolio_header' ); ?>
				<?php rolio_nav_menu( 'header' ); ?>
			</div>
		</div>

		<?php get_sidebar( 'header-bottom' ); ?>
		
	</header>

	<main id="main" class="site-content">
