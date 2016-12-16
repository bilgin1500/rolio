<?php
/**
 * The main template file.
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package rolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="site-main" class="site-main" role="main">

		<?php rolio_tag_page_header() ?>

		<?php if ( have_posts() ) : ?>

			<div class="page-content">

				<?php if ( rolio_is_image_index() && get_theme_mod( 'rolio_theme_image_index' ) === 'theme-masonry' ) : ?>
					<div class="post-sizer"></div>
					<div class="gutter-sizer"></div>
				<?php endif; ?>

				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', rolio_get_post_format_group() );
				endwhile;
				?>

			</div>

			<?php rolio_nav_page(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</div>
	</div>

<?php
get_footer();
