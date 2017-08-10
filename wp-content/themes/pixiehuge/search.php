<?php get_header(); ?>


	<div class="container split-flex">

		<section id="news" class="news-page nobg">
			<div class="content">
				<?php if($wp_query->found_posts > 0): ?>
				<div class="section-header">
					<article class="topbar">
						<h3>
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
							<?php echo esc_html__('Search Results for: ', 'pixiehuge'); echo esc_attr(get_search_query()); ?>
						</h3>
					</article>
					<!-- /TOP-BAR -->

				</div>
				<!-- /SECTION-HEADER -->
				<?php else: ?>
				<div class="search-page">
					<h1 class="archive-sub"><?php echo esc_html__('No Search Results for: ', 'pixiehuge'); echo esc_attr(get_search_query()); ?></h1>
					<h2><?php esc_html_e('Nothing Found', 'pixiehuge') ?></h2>

					<p>
						<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'pixiehuge') ?>
					</p>

					<?php get_search_form() ?>
					<!-- Tab panes -->
				</div>
				<?php endif; ?>

				<?php
				// Get posts
				$postnum = 0;
				while ( have_posts() && $postnum < 6) : the_post(); // while if have news posts
					$postnum ++; ?>
					<?php if($postnum < 2): ?>
						<article <?php post_class( 'news-box large', get_the_ID() ); ?> style="background-image: url('<?php the_post_thumbnail_url( get_the_ID(), 'pixiehuge-large-thumbnail'); ?>');">
							<?php
							$categories = get_the_category();
							if(!empty($categories)):
								$link = get_category_link($categories[0]->cat_ID);
								?>
								<a href="<?php echo esc_url($link); ?>" class="category">
									<?php
									// Show category
									if ( ! empty( $categories ) ) {
										echo esc_attr( $categories[0]->name );
									}
									?>
								</a>
							<?php endif; ?>

							<div class="details">
								<a href="<?php the_permalink(); ?>">
									<?php
									echo esc_attr(pixiehuge_short_title( 64, get_the_title() ));
									?>
								</a>

								<span class="date">
                                <?php echo esc_attr(get_the_date()); ?>
                                <?php
                                if(is_sticky(get_the_ID())) {
	                                echo '<span class="sticky_post"> | <i class="fa fa-thumb-tack" aria-hidden="true"></i>' . esc_html__('Sticky', 'pixiehuge') . '</span>';
                                }
                                ?>
                            </span>
							</div>
							<!-- /DETAILS -->
						</article>
					<?php else: ?>
						<article <?php post_class( 'news-box', get_the_ID() ); ?> style="background-image: url('<?php the_post_thumbnail_url( get_the_ID(), 'pixiehuge-small-thumbnail'); ?>');">


							<div class="details">
								<?php
								$categories = get_the_category();
								if(!empty($categories)):
									$link = get_category_link($categories[0]->cat_ID);
									?>
									<a href="<?php echo esc_url($link); ?>" class="category">
										<?php
										// Show category
										if ( ! empty( $categories ) ) {
											echo esc_attr( $categories[0]->name );
										}
										?>
									</a>
								<?php endif; ?>

								<a href="<?php the_permalink(); ?>">
									<?php
									echo esc_attr(pixiehuge_short_title( 64, get_the_title() ));
									?>
									<?php
									if(is_sticky(get_the_ID())) {
										echo '<span class="sticky_post"> <i class="fa fa-thumb-tack" aria-hidden="true"></i>' . esc_html__('Sticky', 'pixiehuge') . '</span>';
									}
									?>
								</a>

								<span class="date">
                                <?php echo esc_attr(get_the_date()); ?>
                                <?php
                                if(is_sticky(get_the_ID())) {
	                                echo '<span class="sticky_post"> | <i class="fa fa-thumb-tack" aria-hidden="true"></i>' . esc_html__('Sticky', 'pixiehuge') . '</span>';
                                }
                                ?>
                            </span>
							</div>
							<!-- /DETAILS -->
						</article>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
			<!-- /NEWS -->

		</section>
		<!-- /NEWS -->

		<?php get_sidebar(); ?>
	</div>
	<!-- /CONTAINER -->

<?php get_footer(); ?>