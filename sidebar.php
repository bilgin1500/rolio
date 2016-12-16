<?php
/**
 * The sidebar containing the aside widget area.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package rolio
 */

if ( ! is_active_sidebar( 'sidebar-post-right' ) ) {
	return;
}

// If we get this far, we have widgets. Let's do this.
?>
<aside class="site-content-widget-area widget-area" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-post-right' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-post-right' ); ?>
	<?php endif; ?>

</aside>