<?php /* Template Name: Blank Page */ ?>

<?php
get_header(); 

if( have_posts() ):
	the_post(); // get post
	$postID = array( get_the_ID() ); // id in array for excluding post
?>
	<div class="container blankpage">
		<?php the_content(); ?>
	</div>

<?php endif; ?>
<?php get_footer(); ?>