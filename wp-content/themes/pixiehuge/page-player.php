<?php /* Template Name: Player Page */ ?>

<?php
    // Get slug
	$playerSlug = esc_attr(get_query_var('playername'));

	// Get Player data
	$playerData = pixiehuge_player($playerSlug);

	if(empty($playerData)) {
        wp_redirect('/');
    }
    // Set data
    $player = $playerData[0];

    $country = false;
	if(!empty($player['country'])) {
	    $country = explode(':', $player['country']);
    }
    $stats = json_decode($player['stats'], 1);
    $equipments = json_decode($player['equipment'], 1);
    $social = json_decode($player['social'], 1);

    // Get players
    $team = pixiehuge_team($player['team_id'])[0];
    $coverbg = $player['cover'];
?>
<?php get_header(); ?>
<div class="cover-bg" style="background-image: url('<?php echo !empty($coverbg) ? esc_url($coverbg) : get_stylesheet_directory_uri() . '/images/team-cover.jpg'; ?>');"></div>
<section id="player-profile">

    <div class="container">
        <article class="player-info">
            <div class="avatar" style="background-image: url('<?php echo esc_url($player['avatar']) ?>');"></div>
            <div class="right-panel">
                <ul class="profile-details">
                    <li>
                        <figure>
                            <img src="<?php echo esc_url($team['team_logo']) ?>" alt="<?php echo esc_attr($player['nick']) ?>">
                        </figure>
                        <div class="name">
                            <span class="nickname"><?php echo esc_attr($player['nick']) ?></span>
                            <h4><?php echo esc_attr($player['firstname']) . ' ' . esc_attr($player['lastname']) ?></h4>
                        </div>
                    </li>
                    <li class="social">
                        <?php $stream = false; ?>
                        <?php if(!empty($social['twitch'])): ?>
                            <?php $stream = true; ?>
                            <a href="<?php echo esc_url($social['twitch']) ?>" class="stream twitch"><?php esc_html_e('Twitch.tv', 'pixiehuge') ?></a>
                        <?php endif; ?>
                        <div class="links">
                            <?php
                                unset($social['twitch']);
                                if(!empty($social)): // check if exists
                                    $i = 0;
                                    foreach($social as $id => $item):
                            ?>
                            <a href="<?php echo esc_url($item) ?>"<?php echo ($i == 0 && $stream) ? ' class="first"' : '' ?> target="_blank"><i class="fa fa-<?php echo esc_attr(strtolower($id)) ?>"></i></a>
                            <?php
                                    $i ++;
                                endforeach; // end loop
                            endif; // end if
                            ?>
                        </div>
                    </li>
                </ul>
                <!-- /PROFILE-DETAILS -->

                <ul class="info-section">
                    <li>
                        <span class="title"><?php esc_html_e('Currently team', 'pixiehuge') ?></span>
                        <a href="<?php echo get_home_url(null, 'team/' . $team['slug']) ?>"><?php echo esc_attr($team['name']) ?> <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.182 C4.437,0.442 4.437,0.865 4.688,1.126 L6.805,3.325 L0.643,3.325 C0.287,3.325 -0.000,3.625 -0.000,3.993 C-0.000,4.362 0.287,4.661 0.643,4.661 L6.805,4.661 L4.688,6.861 C4.437,7.122 4.437,7.544 4.688,7.805 C4.939,8.066 5.346,8.066 5.597,7.805 L8.811,4.466 C8.928,4.345 9.000,4.178 9.000,3.993 C9.000,3.809 8.928,3.642 8.811,3.521 L5.597,0.182 C5.346,-0.079 4.939,-0.079 4.688,0.182 Z"/></svg></a>
                    </li>
                    <?php if(!empty($player['age'])): ?>
                    <li>
                        <span class="title"><?php esc_html_e('Player age', 'pixiehuge') ?></span>
                        <span class="desc"><?php echo esc_attr($player['age']) ?></span>
                    </li>
                    <?php endif; ?>
                    <?php if(!empty($country[0])): ?>
                        <li>
                            <span class="title"><?php esc_html_e('Country', 'pixiehuge') ?></span>
                            <span class="desc"><i class="flag-icon flag-icon-<?php echo esc_attr(strtolower($country[0])) ?>"></i><?php echo !empty($country[1]) ? esc_attr($country[1]) : '' ?></span>
                        </li>
                    <?php endif; ?>

                    <?php if(!empty($player['age'])): ?>
                    <li>
                        <span class="title"><?php esc_html_e('Ingame Role', 'pixiehuge') ?></span>
                        <span class="desc"><i class="icon" style="background-image: url('<?php echo esc_url($player['role_icon']) ?>');"></i> <?php echo esc_attr($player['role']) ?></span>
                    </li>
                    <?php endif; ?>
                </ul>

                <div class="about">
                    <span class="title"><?php esc_html_e('Player', 'pixiehuge') ?></span>
                    <h4>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13px" height="14px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M12.071,-0.000 L0.928,-0.000 C0.415,-0.000 -0.000,0.391 -0.000,0.875 L-0.000,7.000 C-0.000,10.867 5.822,13.778 6.070,13.900 C6.205,13.966 6.352,13.999 6.500,13.999 C6.648,13.999 6.795,13.966 6.929,13.900 C7.178,13.778 13.000,10.867 13.000,7.000 L13.000,0.875 C13.000,0.391 12.584,-0.000 12.071,-0.000 ZM11.143,1.750 L11.143,3.500 L1.857,3.500 L1.857,1.750 L11.143,1.750 ZM6.499,12.124 C4.890,11.238 1.857,9.129 1.857,7.000 L1.857,5.250 L11.143,5.250 L11.143,7.000 C11.143,9.122 8.108,11.235 6.499,12.124 Z"/></svg>Quick Bio
                    </h4>

                    <p>
                        <?php echo htmlspecialchars_decode($player['about']) ?>
                    </p>
                </div>
            </div>
            <!-- /RIGHT-PANEL -->

        </article>
        <!-- /TEAM-INFO -->
    </div>

</section>
<!-- /Team-Profile -->

<section id="player-details">
    <div class="container">

        <div class="section-header">
            <article class="topbar">
                <h3>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
                    <?php esc_html_e('More details', 'pixiehuge') ?>
                </h3>
            </article>
            <!-- /TOP-BAR -->
        </div>
        <!-- /SECTION-HEADER -->


        <article class="content">
            <?php if(!empty($stats['kills']) || !empty($stats['headshots']) || !empty($stats['deaths']) || !empty($stats['rating'])): ?>
            <div class="stats" style="background-image: url('images/player-details-bg.jpg');">
                <ul>
                    <?php if(!empty($stats['kills'])): ?>
                    <li>
                        <h4><?php echo esc_attr($stats['kills']) ?></h4>
                        <div class="info">
                            <span class="title"><?php esc_html_e('Total kills', 'pixiehuge') ?></span>
                            <span class="desc"><?php esc_html_e('achieved so far', 'pixiehuge') ?></span>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if(!empty($stats['headshots'])): ?>
                    <li>
                        <h4><?php echo esc_attr($stats['headshots']) ?></h4>
                        <div class="info">
                            <span class="title"><?php esc_html_e('Headshots', 'pixiehuge') ?></span>
                            <span class="desc"><?php esc_html_e('made in games', 'pixiehuge') ?></span>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if(!empty($stats['deaths'])): ?>
                    <li>
                        <h4><?php echo esc_attr($stats['deaths']) ?></h4>
                        <div class="info">
                            <span class="title"><?php esc_html_e('Total deaths', 'pixiehuge') ?></span>
                            <span class="desc"><?php esc_html_e('by the player', 'pixiehuge') ?></span>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if(!empty($stats['rating'])): ?>
                    <li>
                        <h4><?php echo esc_attr($stats['rating']) ?></h4>
                        <div class="info last">
                            <span class="title"><?php esc_html_e('Player Rating', 'pixiehuge') ?></span>
                            <span class="desc"><?php esc_html_e('skill level', 'pixiehuge') ?></span>
                        </div>
                    </li>
                    <?php endif; ?>

                    <?php if(!empty($social['steam'])): ?>
                    <li class="steam">
                        <a href="<?php echo esc_url($social['steam']) ?>" class="btn btn-blue" target="_blank"><?php esc_html_e('View steam', 'pixiehuge') ?></a>
                    </li>
                    <?php endif; ?>
                </ul>

                <a href="<?php echo esc_url($social['steam']) ?>" class="btn btn-blue mobile" target="_blank"><?php esc_html_e('View steam', 'pixiehuge') ?></a>
            </div>
            <?php endif; // Check if exists ?>

            <div class="equip">

                <?php if(!empty($equipments)): ?>
                <ul class="desc">
                    <?php if(!empty($equipments['mouse']['name'])): ?>
                    <li>
                        <div class="details">
                            <span class="name"><?php esc_html_e('Mouse', 'pixiehuge') ?></span>
                            <span class="model"><?php echo esc_attr($equipments['mouse']['name']) ?></span>
                        </div>

                        <?php if(!empty($equipments['mouse']['link'])): ?>
                            <a href="<?php echo esc_url($equipments['mouse']['link']) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.187 C4.437,0.448 4.437,0.871 4.688,1.131 L6.805,3.331 L0.643,3.331 C0.288,3.331 -0.000,3.630 -0.000,3.999 C-0.000,4.368 0.288,4.667 0.643,4.667 L6.805,4.667 L4.688,6.867 C4.437,7.128 4.437,7.550 4.688,7.811 C4.939,8.072 5.346,8.072 5.597,7.811 L8.811,4.471 C8.928,4.350 9.000,4.184 9.000,3.999 C9.000,3.814 8.928,3.648 8.811,3.527 L5.597,0.187 C5.346,-0.074 4.939,-0.074 4.688,0.187 Z"/></svg>
                            </a>
                        <?php endif; // End if ?>
                    </li>
                    <?php endif; // End if ?>

                    <?php if(!empty($equipments['headset']['name'])): ?>
                    <li>
                        <div class="details">
                            <span class="name"><?php esc_html_e('Headset', 'pixiehuge') ?></span>
                            <span class="model"><?php echo esc_attr($equipments['headset']['name']) ?></span>
                        </div>

                        <?php if(!empty($equipments['headset']['link'])): ?>
                            <a href="<?php echo esc_url($equipments['headset']['link']) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.187 C4.437,0.448 4.437,0.871 4.688,1.131 L6.805,3.331 L0.643,3.331 C0.288,3.331 -0.000,3.630 -0.000,3.999 C-0.000,4.368 0.288,4.667 0.643,4.667 L6.805,4.667 L4.688,6.867 C4.437,7.128 4.437,7.550 4.688,7.811 C4.939,8.072 5.346,8.072 5.597,7.811 L8.811,4.471 C8.928,4.350 9.000,4.184 9.000,3.999 C9.000,3.814 8.928,3.648 8.811,3.527 L5.597,0.187 C5.346,-0.074 4.939,-0.074 4.688,0.187 Z"/></svg>
                            </a>
                        <?php endif; // End if ?>
                    </li>
                    <?php endif; // End if ?>

                    <?php if(!empty($equipments['cpu']['name'])): ?>
                    <li>
                        <div class="details">
                            <span class="name"><?php esc_html_e('CPU', 'pixiehuge') ?></span>
                            <span class="model"><?php echo esc_attr($equipments['cpu']['name']) ?></span>
                        </div>

                        <?php if(!empty($equipments['cpu']['link'])): ?>
                            <a href="<?php echo esc_url($equipments['cpu']['link']) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.187 C4.437,0.448 4.437,0.871 4.688,1.131 L6.805,3.331 L0.643,3.331 C0.288,3.331 -0.000,3.630 -0.000,3.999 C-0.000,4.368 0.288,4.667 0.643,4.667 L6.805,4.667 L4.688,6.867 C4.437,7.128 4.437,7.550 4.688,7.811 C4.939,8.072 5.346,8.072 5.597,7.811 L8.811,4.471 C8.928,4.350 9.000,4.184 9.000,3.999 C9.000,3.814 8.928,3.648 8.811,3.527 L5.597,0.187 C5.346,-0.074 4.939,-0.074 4.688,0.187 Z"/></svg>
                            </a>
                        <?php endif; // End if ?>
                    </li>
                    <?php endif; // End if ?>

                    <?php if(!empty($equipments['mousepad']['name'])): ?>
                    <li>
                        <div class="details">
                            <span class="name"><?php esc_html_e('Mouse Pad', 'pixiehuge') ?></span>
                            <span class="model"><?php echo esc_attr($equipments['mousepad']['name']) ?></span>
                        </div>

                        <?php if(!empty($equipments['mousepad']['link'])): ?>
                            <a href="<?php echo esc_url($equipments['mousepad']['link']) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.187 C4.437,0.448 4.437,0.871 4.688,1.131 L6.805,3.331 L0.643,3.331 C0.288,3.331 -0.000,3.630 -0.000,3.999 C-0.000,4.368 0.288,4.667 0.643,4.667 L6.805,4.667 L4.688,6.867 C4.437,7.128 4.437,7.550 4.688,7.811 C4.939,8.072 5.346,8.072 5.597,7.811 L8.811,4.471 C8.928,4.350 9.000,4.184 9.000,3.999 C9.000,3.814 8.928,3.648 8.811,3.527 L5.597,0.187 C5.346,-0.074 4.939,-0.074 4.688,0.187 Z"/></svg>
                            </a>
                        <?php endif; // End if ?>
                    </li>
                    <?php endif; // End if ?>

                    <?php if(!empty($equipments['keyboard']['name'])): ?>
                    <li>
                        <div class="details">
                            <span class="name"><?php esc_html_e('Keyboard', 'pixiehuge') ?></span>
                            <span class="model"><?php echo esc_attr($equipments['keyboard']['name']) ?></span>
                        </div>

                        <?php if(!empty($equipments['keyboard']['link'])): ?>
                            <a href="<?php echo esc_url($equipments['keyboard']['link']) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.187 C4.437,0.448 4.437,0.871 4.688,1.131 L6.805,3.331 L0.643,3.331 C0.288,3.331 -0.000,3.630 -0.000,3.999 C-0.000,4.368 0.288,4.667 0.643,4.667 L6.805,4.667 L4.688,6.867 C4.437,7.128 4.437,7.550 4.688,7.811 C4.939,8.072 5.346,8.072 5.597,7.811 L8.811,4.471 C8.928,4.350 9.000,4.184 9.000,3.999 C9.000,3.814 8.928,3.648 8.811,3.527 L5.597,0.187 C5.346,-0.074 4.939,-0.074 4.688,0.187 Z"/></svg>
                            </a>
                        <?php endif; // End if ?>
                    </li>
                    <?php endif; // End if ?>

                    <?php if(!empty($equipments['graphiccard']['name'])): ?>
                    <li>
                        <div class="details">
                            <span class="name"><?php esc_html_e('Graphics Card', 'pixiehuge') ?></span>
                            <span class="model"><?php echo esc_attr($equipments['graphiccard']['name']) ?></span>
                        </div>

                        <?php if(!empty($equipments['graphiccard']['link'])): ?>
                            <a href="<?php echo esc_url($equipments['graphiccard']['link']) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.187 C4.437,0.448 4.437,0.871 4.688,1.131 L6.805,3.331 L0.643,3.331 C0.288,3.331 -0.000,3.630 -0.000,3.999 C-0.000,4.368 0.288,4.667 0.643,4.667 L6.805,4.667 L4.688,6.867 C4.437,7.128 4.437,7.550 4.688,7.811 C4.939,8.072 5.346,8.072 5.597,7.811 L8.811,4.471 C8.928,4.350 9.000,4.184 9.000,3.999 C9.000,3.814 8.928,3.648 8.811,3.527 L5.597,0.187 C5.346,-0.074 4.939,-0.074 4.688,0.187 Z"/></svg>
                            </a>
                        <?php endif; // End if ?>
                    </li>
                    <?php endif; // End if ?>
                </ul>
                <?php endif; // Check if exists  ?>

                <?php if(!empty($equipments['text'])): ?>
                <p>
                    <?php echo esc_attr($equipments['text']) ?>
                </p>
                <?php endif; // End if ?>
            </div>
        </article>
    </div>
    <!-- /CONTAINER -->

</section>
<?php
$Posts = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page'    => 5,
    'order'             => 'DESC',
    'orderby'           => 'date',
    'tag'               => $player['slug']
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