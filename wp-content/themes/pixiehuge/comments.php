<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<article class="comments">

	<?php if ( have_comments() ) : ?>
    
	<h3>
		<?php
			esc_html_e('Comment(s)', 'pixiehuge');
		?>
	</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'pixiehuge' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'pixiehuge' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'pixiehuge' ) ); ?></div>
	</nav><!-- #comment-nav-above -->
	<?php endif; // Check for comment navigation. ?>

	<ul class="comment-list">
		<?php
			wp_list_comments('type=comment&callback=pixiehuge_custom_comments');
		?>
	</ul><!-- .comment-list -->
	<div class="clearfix"></div>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'pixiehuge' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'pixiehuge' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'pixiehuge' ) ); ?></div>
	</nav><!-- #comment-nav-below -->
	<?php endif; // Check for comment navigation. ?>

	<?php if ( ! comments_open() ) : ?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pixiehuge' ); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php 
		$fields =  array(
			'author' => '<input id="author" type="text" name="author" placeholder="' . esc_html__('Name', 'pixiehuge') . '*">',
			'email' => '<input id="email" type="email" name="email" placeholder="' . esc_html__('Email', 'pixiehuge') . '*">',
            'url'	=> '<input id="url" name="url" type="text" placeholder="' . esc_html__('Website', 'pixiehuge') . '">',
		);

		$args = array(
		  'id_form'           => 'commentform',
		  'class_form'      => 'comment-form',
		  'id_submit'         => 'submit',
		  'class_submit'      => 'submit',
		  'name_submit'       => 'submit',
		  'title_reply'       => '<h3>' . esc_html__( 'Add comment', 'pixiehuge' ) . '</h3>',
		  'title_reply_to'    => '<p>' . esc_html__( 'Leave a Reply to %s', 'pixiehuge' ) . '</p>',
		  'cancel_reply_link' => esc_html__( 'Cancel Reply', 'pixiehuge' ),
		  'label_submit'      => esc_html__( 'Post Comment', 'pixiehuge' ),
		  'format'            => 'xhtml',

		  'comment_field' =>  '<textarea name="comment" id="comment" placeholder="' . esc_html__('Write your comment', 'pixiehuge') . '"></textarea>',

		  'must_log_in' => '<p class="must-log-in">' .
		    sprintf(
		      esc_html__( 'You must be <a href="%s">logged in</a> to post a comment.', 'pixiehuge' ),
		      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		    ) . '</p>',

		  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
		);
		comment_form($args); 
	?>

</article><!-- #comments -->
