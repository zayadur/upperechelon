<?php get_header(); ?>

<?php
    if( have_posts() ):
        the_post(); // get post
        $postID = array( get_the_ID() ); // id in array for excluding post
?>
 <div class="container split-flex">
    <section id="single-page">
        <?php if( has_post_thumbnail() ): ?>
            <figure class="thumbnail">
                <img src="<?php the_post_thumbnail_url( get_the_ID(), 'pixiehuge-large'); ?>" alt="<?php echo (get_the_title()) ? esc_html__('Post thumbnail', 'pixiehuge') : esc_attr(get_the_title()) ?>">
            </figure>
        <?php endif; // end empty link check  ?>
        <!-- /THUMBNAIL -->

        <article class="header">
            <div class="top-line">
                <?php
                $cat = get_the_category(); // Get categories
                $categories = ''; // Default = '';
                if(!empty($cat)) {
                    $i = 0;
                    foreach( $cat as $catItem ){
                        $i++;
                        echo '<a href="' . esc_url(get_category_link($catItem->term_id)) . '" class="category">' .esc_attr($catItem->name). '</a>';
                    }
                } // if is not empty
                ?>

                <?php 
                $socialAcitve = get_option('pixiehuge-news-social-share');

                if(!empty($socialAcitve) && socialAcitve):
                ?>
                <div class="social">
                    <a href="<?php echo esc_url(pixiehuge_share_links( 'facebook', get_the_permalink(), get_the_title() )); ?>" class="facebook" target="_blank">
                        <i class="fa fa-facebook"></i> <?php esc_html_e('Share', 'pixiehuge') ?>
                    </a>
                    <a href="<?php echo esc_url(pixiehuge_share_links( 'twitter', get_the_permalink(), get_the_title() )); ?>" class="twitter" target="_blank">
                        <i class="fa fa-twitter"></i> <?php esc_html_e('Tweet', 'pixiehuge') ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <h3><?php the_title(); ?></h3>
            <span class="date">
                 <?php esc_html_e('POSTED BY', 'pixiehuge') ?> <strong><?php (get_the_author()) ? the_author_link() : '/' ?></strong> <?php the_date() ?>
            </span>
        </article>
        <!-- /HEADER -->

        <article class="content">
            <?php the_content(); ?>

            <div class="clearfix"></div>
            <div class="post-tags">
                <?php
                if(get_the_tags()):
                    $posttags = get_the_tags();
                    if ($posttags) {
                        foreach($posttags as $tag) {
                            $tagUrl= get_tag_link($tag->term_id);
                            echo '<a href="' . esc_url($tagUrl) . '">' . esc_attr($tag->name) . '</a>';
                        }
                    }
                endif; // if is not empty
                ?>
            </div>
        </article>
        <!-- /CONTENT -->
        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
        ?>
    </section>
    <!-- /SINGLE-PAGE -->
     <?php get_sidebar(); ?>
</div>
<?php endif; ?>
<?php get_footer(); ?>