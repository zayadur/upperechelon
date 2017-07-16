<?php /* Template Name: Match Page */ ?>

<?php
	$matches = pixiehuge_matches();

	// Get slug
	$matchid = (int)esc_attr(get_query_var('matchid'));
    if(empty($matchid)) {
        wp_redirect('/');
    }

	// Get match
	$match = pixiehuge_matches($matchid);
    if(empty($match)) {
        wp_redirect('/');
    }
    $match = $match[0];
	$details = json_decode($match['details'],1);

	// Get stream
    $stream = [];
    if($match['stream'] != 0) {
	    $stream = pixiehuge_streams($match['stream']);
    }
	if(!empty($stream)) {
		$stream = $stream[0];
	}

	$title = $match['team_a_name'] . ' vs ' . $match['team_b_name'];

	$playersA = pixiehuge_players($match['team_a_id']);
	$playersB = pixiehuge_players($match['team_b_id']);

	// Get maps
    $maps = pixiehuge_maps();
    $matchMaps = [];

    if(!empty($details['maps'])) {
	    $matchMaps = json_decode($details['maps'], 1);
    }

    $matchesA = pixiehuge_matches_byTeamID($match['team_a_id'], 5, $matchid);
    $matchesB = pixiehuge_matches_byTeamID($match['team_b_id'], 5, $matchid);

    $teamA = pixiehuge_teams(false, $match['team_a_id'])[0];
    $teamB = pixiehuge_teams(false, $match['team_b_id'])[0];
?>

<?php get_header(); ?>
	<section id="match-details">

		<div class="container bg" style="background-image: url('<?php echo !empty($details['match_bg']) ? esc_url($details['match_bg']) : get_stylesheet_directory_uri() . '/images/match-bg.jpg'; ?>');">

			<article class="head">
				<div class="line"></div>
				<div class="content">
					<span class="info"><?php echo ($match['status'] == 1) ? 'Online' : 'Lan' ?></span>
					<h3 class="title"><?php echo esc_attr($details['tournament_name']) ?></h3>
					<span class="subtitle"><?php echo esc_attr($details['tournament_description']) ?></span>
				</div>
				<div class="line"></div>
			</article>

			<article class="middle">
				<div class="team home">
					<div class="name">
						<h5><?php echo esc_attr($match['team_a_name']) ?></h5>
						<h6><?php echo esc_attr($teamA['subtitle']) ?></h6>
					</div>
					<!-- /NAME -->
					<figure>
						<img src="<?php echo esc_attr($match['team_a_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
					</figure>
				</div>
				<!-- /TEAM-HOME -->

				<div class="details">
					<h5><?php echo (!empty($match['game'])) ? esc_attr($match['game']) : '' ?></h5>
					<span class="date"><?php echo date('F d, l H:i e') ?></span>

					<?php if(!empty($details['best_of']) && $details['best_of'] != 0): ?>
					<span class="type"><?php esc_html_e('Best out of ', 'pixiehuge') ?><?php echo esc_attr($details['best_of']) ?></span>
					<?php endif; ?>

                    <?php if(!empty($stream)): // Show stream ?>
					<a href="<?php echo esc_url($stream['link']) ?>" class="stream <?php echo esc_attr(strtolower($stream['category'])) ?>"><?php echo esc_attr($stream['category']) ?></a>
                    <?php endif; ?>
				</div>
				<!-- /DETAILS -->

				<div class="team away">
					<figure>
						<img src="<?php echo esc_attr($match['team_b_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
					</figure>
					<div class="name">
						<h5><?php echo esc_attr($match['team_b_name']) ?></h5>
						<h6><?php echo esc_attr($teamB['subtitle']) ?></h6>
					</div>
					<!-- /NAME -->
				</div>
				<!-- /TEAM-AWAY -->
			</article>

			<article class="footer">
				<div class="middle">
					<?php if($match['score_a'] != 0 || $match['score_b'] != 0): ?>
					<span class="final"><?php esc_html_e('Final Result', 'pixiehuge') ?></span>
					<span class="score">
						<?php echo esc_attr($match['score_a']) ?> - <?php echo esc_attr($match['score_b']) ?>
					</span>
					<?php else: ?>
					<span class="score">
						<?php esc_html_e('Upcoming', 'pixiehuge') ?>
					</span>
					<?php endif; ?>
					<a href="<?php echo esc_url(pixiehuge_share_links( 'facebook', '', esc_html__('Match page - ', 'pixiehuge') . $title )); ?>" class="facebook" target="_blank">
						<i class="fa fa-facebook"></i> <?php esc_html_e('Share', 'pixiehuge') ?>
					</a>
					<a href="<?php echo esc_url(pixiehuge_share_links( 'twitter', '', esc_html__('Match page - ', 'pixiehuge') . $title )); ?>" class="twitter" target="_blank">
						<i class="fa fa-twitter"></i> <?php esc_html_e('Tweet', 'pixiehuge') ?>
					</a>
				</div>
				<!-- /MIDDLE -->

				<?php if(!empty($details['read_article'])): ?>
				<a href="<?php echo esc_url($details['read_article']) ?>" class="btn btn-transparent">
					<?php esc_html_e('Read article', 'pixiehuge') ?>
				</a>
				<?php endif; ?>
			</article>
		</div>
		<!-- /CONTAINER -->

	</section>
	<section id="matchRoster">

		<div class="container">

			<div class="section-header">
				<article class="topbar">
					<h3>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
						<?php esc_html_e('Team roster', 'pixiehuge'); ?>
					</h3>
				</article>
				<!-- /TOP-BAR -->

				<article class="bottombar">
					<ul>
						<li class="active">
							<a href="#<?php echo esc_attr(sanitize_title($match['team_a_name'])); ?>" data-toggle="tab"><?php echo esc_attr($match['team_a_name']); ?><?php esc_html_e('\'s roster', 'pixiehuge') ?></a>
						</li>
						<li>
							<a href="#<?php echo esc_attr(sanitize_title($match['team_b_name'])); ?>" data-toggle="tab"><?php echo esc_attr($match['team_b_name']); ?><?php esc_html_e('\'s roster', 'pixiehuge') ?></a>
						</li>
					</ul>
				</article>
				<!-- /BOTTOM-BAR -->
			</div>
			<!-- /SECTION-HEADER -->

			<div class="tab-content content">
				<ul id="<?php echo esc_attr(sanitize_title($match['team_a_name'])); ?>" class="roster active">
					<?php if(!empty($playersA)): ?>
						<?php foreach($playersA as $player): ?>
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
					<?php endif; ?>
				</ul>
				<ul id="<?php echo esc_attr(sanitize_title($match['team_b_name'])); ?>" class="roster">
					<?php if(!empty($playersB)): ?>
						<?php foreach($playersB as $player): ?>
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
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</section>

    <?php if(!empty($maps) && !empty($matchMaps)): ?>
	<section id="mapsPlayed">

		<div class="container">

			<div class="section-header">
				<article class="topbar">
					<h3>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
                        <?php esc_html_e('Our matches', 'pixiehuge') ?>
					</h3>
				</article>
				<!-- /TOP-BAR -->
			</div>
			<!-- /SECTION-HEADER -->

			<ul>

	            <?php foreach($maps as $map):
                    if(empty($matchMaps[strtolower($map['name'])])) {
                        continue; // Skip
                    }
                    $cMap = $matchMaps[strtolower($map['name'])];
		            $win = $cMap['team_a'] > $cMap['team_b'] ? $teamA : $teamB;
		            if(empty($win)) {
		                continue; // If team doesn't exists
                    }
                ?>
				<li style="background-image: url('<?php echo esc_url($map['image']); ?>');">

					<article class="details">

						<div class="left">
							<h5><?php echo esc_attr($map['name']) ?></h5>
							<span class="won"><?php echo esc_attr($win['name']) ?> <?php esc_html_e('won the round', 'pixiehuge') ?></span>
						</div>
						<!-- /LEFT -->

						<div class="right">
							<img src="<?php echo esc_url($win['team_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
						</div>
						<!-- /RIGHT -->

					</article>
					<!-- /DETAILS -->
				</li>
				<!-- /MAP -->
                <?php endforeach; ?>
			</ul>
			<!-- /MAPS -->

		</div>
	</section>
	<!-- /MAPS-PLAYED -->
    <?php endif; ?>

<?php if(!empty($matchesA) || !empty($matchesB)): ?>
    <section id="matches">

        <div class="container">

            <div class="section-header">
                <article class="topbar">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
						<?php esc_html_e('Our matches', 'pixiehuge') ?>
                    </h3>
                </article>
                <!-- /TOP-BAR -->

                <article class="bottombar">
                    <ul>
                        <li class="active">
                            <a href="#team_a" data-toggle="tab"><?php echo esc_attr($match['team_a_name']) ?></a>
                        </li>
                        <li>
                            <a href="#team_b" data-toggle="tab"><?php echo esc_attr($match['team_b_name']) ?></a>
                        </li>
                    </ul>
                </article>
                <!-- /BOTTOM-BAR -->

            </div>
            <!-- /SECTION-HEADER -->

            <div class="tab-content content">

                <?php if(!empty($matchesA)):?>
                <ul id="team_a" class="tab active">

					<?php
                    foreach ($matchesA as $item):
                        if($item['score_a'] != 0 || $item['score_b'] != 0)
                            continue;

                        $details = json_decode($item['details'], 1);

                        $stream = false;
                        if($item['stream'] != 0) {
                            $stream = pixiehuge_streams($item['stream'])[0];
                        }
                        ?>
                        <li class="matchBox">
                            <div class="teams">
                                <a href="<?php echo get_home_url(null, 'team/' . sanitize_title($item['team_a_name'])) ?>">
                                    <img src="<?php echo esc_attr($item['team_a_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
                                    <span><?php echo esc_attr($item['team_a_name']) ?></span>
                                </a>
                                <span class="vs"><?php esc_html_e('VS', 'pixiehuge') ?></span>
                                <a href="<?php echo get_home_url(null, 'team/' . sanitize_title($item['team_b_name'])) ?>">
                                    <img src="<?php echo esc_attr($item['team_b_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
                                    <span><?php echo esc_attr($item['team_b_name']) ?></span>
                                </a>
                            </div>
                            <!-- /TEAMS -->

                            <div class="rightBox">
                                <div class="match-info">
                                    <span class="league"><?php echo esc_attr($details['tournament_name']) ?></span>
                                    <div class="status">
                                        <span><?php echo ($item['status'] == 1) ? 'Online' : 'Lan' ?></span> <?php echo (!empty($item['game'])) ? esc_attr($item['game']) : '' ?>
                                    </div>
                                    <span class="date"><?php echo date('d F', strtotime($item['startdate'])) ?> <?php esc_html_e('at', 'pixiehuge') ?> <?php echo date('h:i A', strtotime($item['startdate'])) ?></span>
                                </div>
                                <!-- /MATCH INFO -->

                                <?php if(!empty($stream)): ?>
                                    <div class="stream">
                                        <a href="<?php echo esc_url($stream['link']) ?>" target="_blank"><?php esc_html_e('Watch this match live', 'pixiehuge') ?></a>
                                        <span class="<?php echo esc_attr(strtolower($stream['category'])) ?>"><?php echo esc_attr($stream['category']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo get_home_url(null, 'match/' . $item['slug']) ?>" class="cta-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.182 C4.437,0.442 4.437,0.865 4.688,1.126 L6.805,3.326 L0.643,3.326 C0.288,3.326 -0.000,3.625 -0.000,3.993 C-0.000,4.362 0.288,4.661 0.643,4.661 L6.805,4.661 L4.688,6.861 C4.437,7.122 4.437,7.544 4.688,7.805 C4.939,8.066 5.346,8.066 5.597,7.805 L8.811,4.466 C8.928,4.345 9.000,4.178 9.000,3.993 C9.000,3.809 8.928,3.642 8.811,3.521 L5.597,0.182 C5.346,-0.079 4.939,-0.079 4.688,0.182 Z"/>
                                </svg>
                            </a>
                        </li>
                        <!-- /MATCH-BOX -->
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if(!empty($matchesB)):?>
                <ul id="team_b" class="tab">

					<?php
                    foreach ($matchesB as $item):
                        if($item['score_a'] != 0 || $item['score_b'] != 0)
                            continue;

                        $details = json_decode($item['details'], 1);

                        $stream = false;
                        if($item['stream'] != 0) {
                            $stream = pixiehuge_streams($item['stream'])[0];
                        }
                        ?>
                        <li class="matchBox">
                            <div class="teams">
                                <a href="<?php echo get_home_url(null, 'team/' . sanitize_title($item['team_a_name'])) ?>">
                                    <img src="<?php echo esc_attr($item['team_a_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
                                    <span><?php echo esc_attr($item['team_a_name']) ?></span>
                                </a>
                                <span class="vs"><?php esc_html_e('VS', 'pixiehuge') ?></span>
                                <a href="<?php echo get_home_url(null, 'team/' . sanitize_title($item['team_b_name'])) ?>">
                                    <img src="<?php echo esc_attr($item['team_b_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
                                    <span><?php echo esc_attr($item['team_b_name']) ?></span>
                                </a>
                            </div>
                            <!-- /TEAMS -->

                            <div class="rightBox">
                                <div class="match-info">
                                    <span class="league"><?php echo esc_attr($details['tournament_name']) ?></span>
                                    <div class="status">
                                        <span><?php echo ($item['status'] == 1) ? 'Online' : 'Lan' ?></span> <?php echo (!empty($item['game'])) ? esc_attr($item['game']) : '' ?>
                                    </div>
                                    <span class="date"><?php echo date('d F', strtotime($item['startdate'])) ?> <?php esc_html_e('at', 'pixiehuge') ?> <?php echo date('h:i A', strtotime($item['startdate'])) ?></span>
                                </div>
                                <!-- /MATCH INFO -->

                                <?php if(!empty($stream)): ?>
                                    <div class="stream">
                                        <a href="<?php echo esc_url($stream['link']) ?>" target="_blank"><?php esc_html_e('Watch this match live', 'pixiehuge') ?></a>
                                        <span class="<?php echo esc_attr(strtolower($stream['category'])) ?>"><?php echo esc_attr($stream['category']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo get_home_url(null, 'match/' . $item['slug']) ?>" class="cta-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.182 C4.437,0.442 4.437,0.865 4.688,1.126 L6.805,3.326 L0.643,3.326 C0.288,3.326 -0.000,3.625 -0.000,3.993 C-0.000,4.362 0.288,4.661 0.643,4.661 L6.805,4.661 L4.688,6.861 C4.437,7.122 4.437,7.544 4.688,7.805 C4.939,8.066 5.346,8.066 5.597,7.805 L8.811,4.466 C8.928,4.345 9.000,4.178 9.000,3.993 C9.000,3.809 8.928,3.642 8.811,3.521 L5.597,0.182 C5.346,-0.079 4.939,-0.079 4.688,0.182 Z"/>
                                </svg>
                            </a>
                        </li>
                        <!-- /MATCH-BOX -->
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
            <!-- /CONTENT -->
        </div>
        <!-- /CONTAINER -->

    </section>
    <!-- /MATCHES -->
    <?php endif; ?>

<?php get_footer(); ?>