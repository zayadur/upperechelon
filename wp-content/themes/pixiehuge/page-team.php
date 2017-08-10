<?php /* Template Name: Team Page */ ?>

<?php
    // Get slug
	$teamSlug = esc_attr(get_query_var('teamname'));

	// Get Team data
	$teamData = pixiehuge_teams($teamSlug);

	if(empty($teamData)) {
        wp_redirect('/');
    }
    // Set data
    $team = $teamData[0];

    $country = false;
	if(!empty($team['country'])) {
	    $country = explode(':', $team['country']);
    }
    $stats = json_decode($team['stats'], 1);
    $coverbg = $team['cover'];

    // Get achievements
    $achievements = pixiehuge_achievements($team['id']);

    // Get players
    $players = pixiehuge_players($team['id']);
?>
<?php get_header(); ?>
<div class="cover-bg" style="background-image: url('<?php echo !empty($coverbg) ? esc_url($coverbg) : get_stylesheet_directory_uri() . '/images/team-cover.jpg'; ?>');"></div>
<section id="team-profile">

    <div class="container">
        <article class="team-info">
            <div class="game" style="background-image: url('<?php echo esc_url($team['game_logo']) ?>');"></div>
            <div class="profile-details">
                <figure>
                    <img src="<?php echo esc_url($team['team_logo']) ?>">
                </figure>
                <div class="name">
                    <h4><?php echo esc_attr($team['name']) ?></h4>
                    <?php if(!empty($team['subtitle'])): ?>
                    <span class="subtitle"><?php echo esc_attr($team['subtitle']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /PROFILE-DETAILS -->
        </article>
        <!-- /TEAM-INFO -->

        <article class="stats">

            <ul class="left">
                <li class="first">
                    <span class="title"><?php esc_html_e('Our team\'s', 'pixiehuge') ?></span>
                    <h5>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px"><path fill-rule="evenodd" d="M19.014,10.937 L18.021,10.937 C17.592,14.674 14.636,17.635 10.910,18.065 L10.910,19.062 C10.910,19.580 10.491,20.000 9.974,20.000 C9.458,20.000 9.039,19.580 9.039,19.062 L9.039,18.065 C5.313,17.635 2.357,14.674 1.928,10.937 L0.935,10.937 C0.419,10.937 -0.000,10.518 -0.000,10.000 C-0.000,9.482 0.419,9.062 0.935,9.062 L1.930,9.062 C2.359,5.326 5.312,2.363 9.039,1.933 L9.039,0.937 C9.039,0.420 9.458,-0.000 9.974,-0.000 C10.491,-0.000 10.910,0.420 10.910,0.937 L10.910,1.935 C14.636,2.365 17.592,5.326 18.021,9.062 L19.014,9.062 C19.531,9.062 19.949,9.482 19.949,10.000 C19.949,10.518 19.531,10.937 19.014,10.937 ZM14.338,9.062 L16.131,9.062 C15.725,6.363 13.601,4.233 10.910,3.826 L10.910,5.625 C10.910,6.142 10.491,6.562 9.974,6.562 C9.458,6.562 9.039,6.142 9.039,5.625 L9.039,3.828 C6.347,4.235 4.223,6.364 3.816,9.062 L5.611,9.062 C6.127,9.062 6.546,9.482 6.546,10.000 C6.546,10.518 6.127,10.937 5.611,10.937 L3.818,10.937 C4.224,13.637 6.348,15.766 9.039,16.174 L9.039,14.375 C9.039,13.857 9.458,13.437 9.974,13.437 C10.491,13.437 10.910,13.857 10.910,14.375 L10.910,16.174 C13.601,15.766 15.725,13.637 16.131,10.937 L14.338,10.937 C13.822,10.937 13.403,10.518 13.403,10.000 C13.403,9.482 13.822,9.062 14.338,9.062 ZM9.974,10.937 C9.458,10.937 9.039,10.518 9.039,10.000 C9.039,9.482 9.458,9.062 9.974,9.062 C10.491,9.062 10.910,9.482 10.910,10.000 C10.910,10.518 10.491,10.937 9.974,10.937 Z"/></svg>
                        <?php esc_html_e('Stats', 'pixiehuge') ?>
                    </h5>
                </li>
                <li class="numeric">
                    <span class="mTitle"><?php esc_html_e('Wins', 'pixiehuge') ?></span>
                    <span class="number"><?php echo !empty($stats['wins']) ? esc_attr($stats['wins']) : 0 ?></span>
                </li>
                <li class="numeric">
                    <span class="mTitle"><?php esc_html_e('Losses', 'pixiehuge') ?></span>
                    <span class="number"><?php echo !empty($stats['losses']) ? esc_attr($stats['losses']) : 0 ?></span>
                </li>
                <li class="numeric">
                    <span class="mTitle"><?php esc_html_e('Ties', 'pixiehuge') ?></span>
                    <span class="number"><?php echo !empty($stats['ties']) ? esc_attr($stats['ties']) : 0 ?></span>
                </li>
            </ul>
            <!-- /LEFT -->

            <ul class="right">
                <?php if(!empty($country[0])): ?>
                <li>
                    <span class="title"><?php esc_html_e('Country', 'pixiehuge') ?></span>
                    <span class="subtitle"><i class="flag-icon flag-icon-<?php echo esc_attr(strtolower($country[0])) ?>"></i><?php echo !empty($country[1]) ? esc_attr($country[1]) : '' ?></span>
                </li>
                <?php endif; ?>

                <?php if(!empty($team['year_founded'])): ?>
                <li>
                    <span class="title"><?php esc_html_e('Year founded', 'pixiehuge') ?></span>
                    <span class="subtitle"><i class="fa fa-clock-o"></i> <?php echo esc_attr($team['year_founded']) ?></span>
                </li>
                <?php endif; ?>
            </ul>
            <!-- /RIGHT -->

        </article>
        <!-- /STATS -->

        <article class="about">
           <?php echo htmlspecialchars_decode($team['about']); ?>
        </article>

        <ul class="achievements">

            <?php if(!empty($achievements)): ?>
                <?php foreach($achievements as $achievement): ?>
                <li>
                    <span class="title"><?php echo esc_attr($achievement['name']) ?></span>
                    <p>
                        <span class="place <?php echo ($achievement['place'] == '1st place') ? 'first' : ($achievement['place'] == '2nd place' ? 'second' : 'third'); ?>"><?php echo esc_attr($achievement['place']) ?></span>
                        <span class="date"><?php echo esc_attr($achievement['description']) ?></span>
                    </p>
                </li>
                <!-- /ACHIEVEMENT -->
                <?php endforeach; ?>
           <?php endif; ?>

        </ul>
    </div>

</section>
<!-- /Team-Profile -->


<?php if(!empty($players)): ?>
<section id="matchRoster" class="noNav">

    <div class="container">

        <div class="section-header">
            <article class="topbar">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg> Our players
                </h3>
            </article>
            <!-- /TOP-BAR -->

        </div>
        <!-- /SECTION-HEADER -->

        <div class="tab-content content">
            <ul class="roster active">

                <?php foreach($players as $player): ?>
                <li style="background-image: url('<?php echo esc_url($player['avatar']) ?>');">
                    <div class="details">
                        <h4>
                            <?php echo esc_attr($player['nick']) ?>
                        </h4>
                        <span class="role">
                            <?php echo esc_attr($player['role']) ?>
                        </span>
                    </div>
                    <div class="overlay">
                        <ul>
                            <li class="firstname">
                                <?php echo esc_attr($player['firstname']) ?>
                            </li>
                            <li class="lastname">
                                <?php echo esc_attr($player['lastname']) ?>
                            </li>
                            <li class="nickname">
                                <?php echo esc_attr($player['nick']) ?>
                            </li>
                            <li class="role">
                                <?php echo esc_attr($player['role']) ?>
                            </li>
                        </ul>

                        <?php
                            $stats = json_decode($player['social'], 1);
                        ?>

                        <?php if(!empty($stats)): ?>
                            <?php foreach($stats as $id => $item): ?>
                                <a href="<?php echo esc_url($item) ?>" target="_blank"><i class="fa fa-<?php echo esc_attr(strtolower($id)) ?>"></i></a>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <a href="<?php echo get_home_url(null, 'player/' . esc_attr($player['slug']))?>" class="player-cta">
                            <?php esc_html_e('SEE PROFILE', 'pixiehuge') ?> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(0, 0, 0)" d="M4.700,0.183 C4.449,0.444 4.449,0.867 4.700,1.128 L6.817,3.327 L0.654,3.327 C0.298,3.327 0.011,3.626 0.011,3.995 C0.011,4.363 0.298,4.662 0.654,4.662 L6.817,4.662 L4.700,6.862 C4.449,7.123 4.449,7.545 4.700,7.806 C4.951,8.067 5.358,8.067 5.609,7.806 L8.824,4.467 C8.940,4.346 9.013,4.179 9.013,3.995 C9.013,3.810 8.940,3.643 8.824,3.522 L5.609,0.183 C5.358,-0.077 4.951,-0.077 4.700,0.183 Z"/></svg>
                        </a>
                    </div>
                </li>
                <!-- /PLAYER -->
                <?php endforeach; ?>
            </ul>
            <!-- /TEAM -->
        </div>
        <!-- /CONTENT -->

    </div>
    <!-- /CONTAINER -->
</section>
<!-- /ROSTER -->
<?php endif; ?>

<?php
$Posts = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page'    => 5,
    'order'             => 'DESC',
    'orderby'           => 'date',
    'tag'               => $team['slug']
) );

$postnum = 0;
if( $Posts->have_posts()): // if there is posts
?>
<section id="news" class="nobg">

    <div class="container">

        <div class="section-header">
            <article class="topbar">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
                    <?php esc_html_e('Related News', 'pixiehuge') ?>
                </h3>
            </article>
            <!-- /TOP-BAR -->

        </div>
        <!-- /SECTION-HEADER -->

        <div class="content">
	        <?php
	        // Get posts
	        while( $Posts->have_posts() && $postnum < 2 ) : $Posts->the_post(); // posts loop
		        $postnum ++; ?>
		        <?php if($postnum < 3): ?>
                    <article <?php post_class( 'news-box large', get_the_ID() ); ?> style="background-image: url('<?php the_post_thumbnail_url( get_the_ID(), 'pixiehuge-large-thumbnail'); ?>');" onclick="window.location = '<?php the_permalink(); ?>'">
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
                    <article <?php post_class( 'news-box', get_the_ID() ); ?> style="background-image: url('<?php the_post_thumbnail_url( get_the_ID(), 'pixiehuge-small-thumbnail'); ?>');" onclick="window.location = '<?php the_permalink(); ?>'">


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
    </div>

</section>
<!-- /NEWS -->
<?php endif; ?>


<?php get_footer(); ?>

