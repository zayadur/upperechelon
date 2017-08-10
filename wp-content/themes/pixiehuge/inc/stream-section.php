<?php
$streamHeading = get_option('pixiehuge-stream-heading', 'Our streams');
$streamsection = get_option('pixiehuge-stream-section-enable');

$streams = pixiehuge_streams();
global $sectionNum;
?>

<?php if($streamsection && !empty($streams)): ?>
	<section id="streams"<?php echo (!empty($sectionNum) && $sectionNum == 1) ? ' class="firstWithBg"' : '' ?>>
		<?php
		$sList = [
			'twitch' => pixiehuge_streams(false, 'twitch'),
			'youtube' => pixiehuge_streams(false, 'youtube'),
			'mixer' => pixiehuge_streams(false, 'mixer'),
		];
		$active = false;
		?>
		<div class="container">

			<div class="section-header">
				<article class="topbar">
					<h3>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd" fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"></path></svg>
						<?php echo esc_attr($streamHeading); ?>
					</h3>
				</article>
				<!-- /TOP-BAR -->

				<article class="bottombar">
					<ul>
						<?php foreach($sList as $id => $items): ?>
							<?php if(!empty($items)):?>
								<li<?php echo !$active ? ' class="active"' : '' ?>>
									<a href="#<?php echo esc_attr($id) ?>" data-toggle="tab"><?php echo esc_attr($id) ?></a>
								</li>
								<?php
								if(!$active) {
									$active = $id;
								}
							endif; // If not empty ?>
						<?php endforeach; // Get categories ?>
					</ul>
				</article>
				<!-- /BOTTOM-BAR -->
			</div>
			<!-- /SECTION-HEADER -->

			<div class="tab-content content">

				<?php foreach($sList as $id => $items): ?>
				<?php if(!empty($items)): $i = 1; ?>
				<div id="<?php echo esc_attr($id) ?>" class="list<?php echo ($active == $id) ? ' active' : '' ?>">
					<?php foreach($items as $item): ?>

				<?php if($i == 1): ?>
					<div class="left">
						<article class="streamBox large" style="background-image: url('<?php echo esc_url($item['thumbnail']) ?>');">
							<a href="<?php echo esc_url($item['link']) ?>" class="playBtn" target="_blank">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10px" height="12px"><path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M10.000,6.000 C10.000,6.412 9.789,6.773 9.473,6.968 L9.474,6.968 L1.629,11.835 C1.626,11.837 1.623,11.839 1.620,11.841 L1.616,11.843 L1.616,11.843 C1.457,11.942 1.270,12.000 1.071,12.000 C0.480,12.000 -0.000,11.496 -0.000,10.875 L-0.000,10.875 L-0.000,1.124 L-0.000,1.124 C-0.000,0.503 0.480,-0.000 1.071,-0.000 C1.270,-0.000 1.457,0.057 1.616,0.156 L1.616,0.156 L1.620,0.159 C1.623,0.160 1.626,0.162 1.629,0.164 L9.474,5.031 L9.473,5.031 C9.789,5.227 10.000,5.587 10.000,6.000 Z"></path></svg>
							</a>
							<div class="details">
								<span class="stream <?php echo esc_attr($id) ?>"><?php echo esc_attr($id) ?></span>
								<a href="<?php echo esc_url($item['link']) ?>" target="_blank"><?php echo esc_attr($item['title']) ?></a>
								<h6><?php echo esc_attr($item['author']) ?></h6>
							</div>
						</article>
					</div>
					<!-- /LEFT -->
				<?php else: // Large thumbnail ?>
				<?php if($i == 2): ?>
					<div class="right">
						<?php endif; ?>
						<?php if($i == 4): ?>
						<div class="small">
							<?php endif; ?>
							<article class="streamBox" style="background-image: url('<?php echo esc_url($item['thumbnail']) ?>');">
								<div class="details on-hover">
									<a href="<?php echo esc_url($item['link']) ?>"><?php echo esc_attr($item['title']) ?></a>

									<a href="<?php echo esc_url($item['link']) ?>" class="cta-btn" target="_blank">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M4.688,0.182 C4.437,0.442 4.437,0.865 4.688,1.126 L6.805,3.326 L0.643,3.326 C0.288,3.326 -0.000,3.625 -0.000,3.993 C-0.000,4.362 0.288,4.661 0.643,4.661 L6.805,4.661 L4.688,6.861 C4.437,7.122 4.437,7.544 4.688,7.805 C4.939,8.066 5.346,8.066 5.597,7.805 L8.811,4.466 C8.928,4.345 9.000,4.178 9.000,3.993 C9.000,3.809 8.928,3.642 8.811,3.521 L5.597,0.182 C5.346,-0.079 4.939,-0.079 4.688,0.182 Z"></path>
										</svg>
									</a>
								</div>
							</article>
							<?php if($i == count($items) || $i == 3): ?>
						</div>
					<?php endif; ?>
						<?php endif; ?>

						<?php $i++; endforeach; ?>

					</div>
					<?php endif; ?>
					<?php endforeach; ?>

				</div>
				<!-- /CONTENT -->
			</div>
			<!-- /CONTAINER -->
	</section>
<?php endif; ?>