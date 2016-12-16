<?php
/**
 * Template part for displaying page content in page.php.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package rolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php rolio_nav_paged_posts(); ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php rolio_meta_edit_url(); ?>
		</div>
	</footer>
</article>
