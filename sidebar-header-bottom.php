<?php
/**
 * The sidebar containing the header bottom widget area.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package rolio
 */

if ( ! is_active_sidebar( 'sidebar-header-bottom' ) ) {
	return;
}

// If we get this far, we have widgets. Let's do this.
?>
<div class="site-header-widget-area widget-area" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-header-bottom' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-header-bottom' ); ?>
	<?php endif; ?>

</div>