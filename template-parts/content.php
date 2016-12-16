<?php
/**
 * Template part for displaying standard posts.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package rolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() && ! is_single() ) : ?>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'medium' ); ?></a>
	</div>

	<div class="entry-body">
	<?php endif; ?>

	<header class="entry-header">

		<h2 class="entry-title">
			<?php if ( ! is_single() ) : ?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php endif; ?>
			<?php the_title(); ?>	
			<?php if ( ! is_single() ) : ?></a><?php endif; ?>
		</h2>
		
		<div class="entry-meta">
			<?php rolio_meta_posted_on(); ?>
			<?php rolio_meta_cats(); ?>
			<?php if ( ! is_single() ) : ?>
				<?php rolio_meta_paged(); ?>
				<?php rolio_meta_sticky(); ?>
				<?php rolio_meta_comments_link(); ?>
			<?php endif; ?>
		</div>

		<?php if ( is_single() ) : ?><?php rolio_nav_paged_posts(); ?><?php endif; ?>
	
	</header>

	<div class="entry-content">
		<?php 
		if ( is_single() ) : 
			the_content();
		else :
			the_excerpt();
		endif;
		?>
	</div>

	<?php if ( is_single() ) : ?>
	<footer class="entry-footer">
        <div class="entry-meta">
            <?php rolio_meta_tags(); ?>
            <?php rolio_meta_custom_fields(); ?>
            <?php rolio_meta_posted_by(); ?>
            <?php rolio_meta_edit_url(); ?>
        </div>
    </footer>
    <?php endif; ?>

	<?php if ( has_post_thumbnail() && ! is_single() ) : ?>
	</div>
	<?php endif; ?>

</article>