<?php
get_header();

if( have_posts() ): 
	the_post(); // get post
    $postID = array( get_the_ID() ); // id in array for excluding post

    if(pixiehuge_is_woocommerce_page() || pixiehuge_is_bbpress()):
        get_template_part('inc/empty-page');
    else:
        get_template_part('inc/default-page');
    endif;

endif; // end if post exists
?>

<?php get_footer(); ?>
<?php get_header(); ?>