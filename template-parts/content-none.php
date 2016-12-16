<?php
/**
 * Template part for displaying a message where there is no post.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package rolio
 */
?>

<section class="no-results">
	<div class="entry-content">
	<?php if ( is_archive() ) : ?>
		<p class="warning"><?php esc_html_e( 'Sorry, this archive is empty.', 'rolio' ); ?></p>
	<?php endif; ?>
	<?php if ( is_search() ) : ?>
		<p class="warning"><?php esc_html_e( 'Sorry, no result found.', 'rolio' ); ?></p>
	<?php endif; ?>
	</div>
</section>
