<?php
/**
 * The template for displaying comments
 * @package rolio
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h3 class="comments-title"><?php printf( __( 'Thoughts on %1$s', 'rolio' ), get_the_title() ); ?></h3>

		<div class="comment-list">
			<?php wp_list_comments( 'callback=rolio_tag_comment' ); ?>
		</div>

		<?php rolio_nav_comments(); ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<div class="warning">
			<p><?php _e( 'Comments are closed.', 'rolio' ); ?></p>
		</div>
	<?php endif; ?>

	<?php
		comment_form( array(
			'cancel_reply_link' => '<i class="lnr lnr-cross"></i>' . __( 'Cancel reply', 'rolio' )
		) );
	?>

</div>
