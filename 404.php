<?php
/**
 * The template for displaying 404 pages (not found).
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package rolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="site-main" class="site-main" role="main">

			<section class="error-404 not-found">
				
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rolio' ); ?></h1>
				</header>
				
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'rolio' ); ?></p>
					<?php get_search_form(); ?>
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
				</div>
			
			</section>

		</div>
	</div>

<?php
get_footer();
