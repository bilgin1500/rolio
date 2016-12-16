<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package rolio
 */
?>
	</main>

	<footer id="footer" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer-top' ); ?>
		<?php rolio_nav_menu( 'footer' ); ?>
		<?php do_action( 'rolio_footer' ); ?>
	</footer>

</div>
<?php wp_footer(); ?>

</body>
</html>
