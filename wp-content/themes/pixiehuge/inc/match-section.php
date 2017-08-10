<?php
$heading = get_option('pixiehuge-match-heading', 'Our matches');
$matchsection = get_option('pixiehuge-match-section-enable');

global $sectionNum;
?>

<?php if($matchsection): ?>
	<section id="matches"<?php echo (!empty($sectionNum) && $sectionNum == 1) ? ' class="firstWithBg"' : '' ?>>

		<div class="container">

			<div class="section-header">
				<article class="topbar">
					<h3>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
						<?php echo esc_attr($heading); ?>
					</h3>
				</article>
				<!-- /TOP-BAR -->

				<article class="bottombar">
					<ul>
						<li class="active">
							<a href="#UpcomingMatches" data-toggle="tab"><?php esc_html_e('Upcoming Matches', 'pixiehuge') ?></a>
						</li>
						<li>
							<a href="#LatestResults" data-toggle="tab"><?php esc_html_e('Latest Results', 'pixiehuge') ?></a>
						</li>
					</ul>
				</article>
				<!-- /BOTTOM-BAR -->
			</div>
			<!-- /SECTION-HEADER -->

			<div class="tab-content content">

				<ul id="UpcomingMatches" class="active">

					<?php
					$upcomingMatches = 0;

					$matches = pixiehuge_matches(false, 5, 1);
					if(!empty($matches)):
						foreach ($matches as $match):

							$upcomingMatches ++;

							$details = json_decode($match['details'], 1);

							$stream = false;
							if($match['stream'] != 0) {
								$stream = pixiehuge_streams($match['stream'])[0];
							}
							?>
							<li class="matchBox">
								<div class="teams">
									<a href="<?php echo get_home_url(null, 'team/' . sanitize_title($match['team_a_name'])) ?>">
										<img src="<?php echo esc_attr($match['team_a_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
										<span><?php echo esc_attr($match['team_a_name']) ?></span>
									</a>
									<span class="vs"><?php esc_html_e('VS', 'pixiehuge') ?></span>
									<a href="<?php echo get_home_url(null, 'team/' . sanitize_title($match['team_b_name'])) ?>">
										<img src="<?php echo esc_attr($match['team_b_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
										<span><?php echo esc_attr($match['team_b_name']) ?></span>
									</a>
								</div>
								<!-- /TEAMS -->

								<div class="rightBox">
									<div class="match-info">
										<span class="league"><?php echo esc_attr($details['tournament_name']) ?></span>
										<div class="status">
											<span><?php echo ($match['status'] == 1) ? 'Online' : 'Lan' ?></span> <?php echo (!empty($match['game'])) ? esc_attr($match['game']) : '' ?>
										</div>
										<span class="date"><?php echo date('d F', strtotime($match['startdate'])) ?> <?php esc_html_e('at', 'pixiehuge') ?> <?php echo date('h:i A', strtotime($match['startdate'])) ?></span>
									</div>
									<!-- /MATCH INFO -->

									<?php if(!empty($stream)): ?>
										<div class="stream">
											<a href="<?php echo esc_url($stream['link']) ?>" target="_blank"><?php esc_html_e('Watch this match live', 'pixiehuge') ?></a>
											<span class="<?php echo esc_attr(strtolower($stream['category'])) ?>"><?php echo esc_attr($stream['category']) ?></span>
										</div>
									<?php endif; ?>
								</div>
								<a href="<?php echo get_home_url(null, 'match/' . $match['slug']) ?>" class="cta-btn">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.182 C4.437,0.442 4.437,0.865 4.688,1.126 L6.805,3.326 L0.643,3.326 C0.288,3.326 -0.000,3.625 -0.000,3.993 C-0.000,4.362 0.288,4.661 0.643,4.661 L6.805,4.661 L4.688,6.861 C4.437,7.122 4.437,7.544 4.688,7.805 C4.939,8.066 5.346,8.066 5.597,7.805 L8.811,4.466 C8.928,4.345 9.000,4.178 9.000,3.993 C9.000,3.809 8.928,3.642 8.811,3.521 L5.597,0.182 C5.346,-0.079 4.939,-0.079 4.688,0.182 Z"/>
									</svg>
								</a>
							</li>
							<!-- /MATCH-BOX -->
							<?php
						endforeach;
					endif;
					?>

				</ul>
				<!-- /UPCOMING-MATCHES -->

				<ul id="LatestResults">

					<?php
					$LatestResults = 0;
					$matches = pixiehuge_matches(false, 5, 2);
					if(!empty($matches)):
						foreach ($matches as $match):
							if($match['score_a'] == 0 && $match['score_b'] == 0)
								continue;

							$LatestResults ++;

							$details = json_decode($match['details'], 1);

							$stream = false;
							if($match['stream'] != 0) {
								$stream = pixiehuge_streams($match['stream'])[0];
							}
							?>
							<li class="matchBox">
								<div class="teams">
									<a href="<?php echo get_home_url(null, 'team/' . sanitize_title($match['team_a_name'])) ?>">
										<img src="<?php echo esc_attr($match['team_a_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
										<span><?php echo esc_attr($match['team_a_name']) ?></span>
									</a>
									<span class="score"><?php echo esc_attr($match['score_a']) . ' - ' . esc_attr($match['score_b']) ?></span>
									<a href="<?php echo get_home_url(null, 'team/' . sanitize_title($match['team_b_name'])) ?>">
										<img src="<?php echo esc_attr($match['team_b_logo']) ?>" alt="<?php esc_html_e('Team\'s logo', 'pixiehuge') ?>">
										<span><?php echo esc_attr($match['team_b_name']) ?></span>
									</a>
								</div>
								<!-- /TEAMS -->

								<div class="rightBox">
									<div class="match-info">
										<span class="league"><?php echo esc_attr($details['tournament_name']) ?></span>
										<div class="status">
											<span><?php echo ($match['status'] == 1) ? 'Online' : 'Lan' ?></span> <?php echo (!empty($match['game'])) ? esc_attr($match['game']) : '' ?>
										</div>
										<span class="date"><?php echo date('d F', strtotime($match['startdate'])) ?> <?php esc_html_e('at', 'pixiehuge') ?> <?php echo date('h:i A', strtotime($match['startdate'])) ?></span>
									</div>
									<!-- /MATCH INFO -->

									<?php if(!empty($stream)): ?>
										<div class="stream">
											<a href="<?php echo esc_url($stream['link']) ?>" target="_blank"><?php esc_html_e('Watch this match live', 'pixiehuge') ?></a>
											<span class="<?php echo esc_attr(strtolower($stream['category'])) ?>"><?php echo esc_attr($stream['category']) ?></span>
										</div>
									<?php endif; ?>
								</div>
								<a href="<?php echo get_home_url(null, 'match/' . $match['slug']) ?>" class="cta-btn">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M4.688,0.182 C4.437,0.442 4.437,0.865 4.688,1.126 L6.805,3.326 L0.643,3.326 C0.288,3.326 -0.000,3.625 -0.000,3.993 C-0.000,4.362 0.288,4.661 0.643,4.661 L6.805,4.661 L4.688,6.861 C4.437,7.122 4.437,7.544 4.688,7.805 C4.939,8.066 5.346,8.066 5.597,7.805 L8.811,4.466 C8.928,4.345 9.000,4.178 9.000,3.993 C9.000,3.809 8.928,3.642 8.811,3.521 L5.597,0.182 C5.346,-0.079 4.939,-0.079 4.688,0.182 Z"/>
									</svg>
								</a>
							</li>
							<!-- /MATCH-BOX -->
							<?php
						endforeach;
					endif;
					?>

				</ul>
				<!-- /LATEST-RESULTS -->

			</div>
			<!-- /CONTENT -->
		</div>
		<!-- /CONTAINER -->

	</section>
	<!-- /MATCHES -->
<?php endif; // Match section ?>