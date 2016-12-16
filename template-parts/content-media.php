<?php
/**
 * Template part for displaying media posts.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package rolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( !is_single() ) : ?>
		<div class="entry-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
		</div>
	<?php else: ?>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	<?php endif; ?>

	<div class="entry-header">
		<?php if ( is_single() ) : ?>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<?php else: ?>
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<?php endif; ?>
	</div>
	
	<div class="entry-meta">
		<?php rolio_meta_tags(); ?>
		<?php rolio_meta_custom_fields(); ?>
		<?php if ( is_single() ) : ?><?php rolio_meta_edit_url(); ?><?php endif; ?>
	</div>

</article>
