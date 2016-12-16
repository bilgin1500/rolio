<?php
/**
 * The sidebar containing the footer top widget area.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package rolio
 */

if ( ! is_active_sidebar( 'sidebar-footer-top' ) ) {
	return;
}

// If we get this far, we have widgets. Let's do this.
?>
<div class="site-footer-widget-area widget-area" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-footer-top' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-footer-top' ); ?>
	<?php endif; ?>

</div>