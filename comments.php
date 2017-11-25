<?php
require_once get_template_directory() . '/inc/class/ft-walker-comment.php';

if ( post_password_required() || (!comments_open() && get_comments_number()==0) ) {
	return;
}
?>

<div id="comments" class="comments-area hidden slidein">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 == $comments_number ) {
					printf(
						__('One thought on &ldquo;%s&rdquo;', 'ft-theme'),
						get_the_title()
					);
				} else {
					printf(
						__('%1$s thoughts on &ldquo;%2$s&rdquo;', 'ft-theme'),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		<?php // the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'walker' => new Ft_Walker_Comment,
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php echo __( 'Comments are closed.' ); ?></p>
	<?php endif; ?>

	<?php
		// comment_form();
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'comment_field'      => '<p class="comment-form-comment">' .
				'<textarea id="comment" name="comment" cols="50" rows="8" aria-required="true" placeholder="' . _x( 'Comment', 'noun' ) .
				'"></textarea></p>',
			'fields' => array(
				'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name' ) . '</label>' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="50"' . $aria_req . ' placeholder="' . __( 'Name' ) . '" />' .
					'</p>',
				'email' =>
					'<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label>' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="50"' . $aria_req . ' placeholder="' . __( 'Email' ) . '"/>' .
					'</p>',
				'url' =>
					'<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
					'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="50" placeholder="' . __( 'Website' ) . '"/></p>',
			),
		) );
	?>

</div><!-- /#comments -->
