<?php
/**
 * The template for displaying all single posts.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package rolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="site-main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			rolio_nav_back_to_cat();

			get_template_part( 'template-parts/content', rolio_get_post_format_group() );

			rolio_nav_posts();

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</div>
	</div>

<?php
get_sidebar( 'post-right' );
get_footer();
