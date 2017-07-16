<?php
$bg = get_option('pixiehuge-twitter-background');
$twitter = get_option('pixiehuge-twitter-enable');
$title = get_option('pixiehuge-twitter-title');
$subtitle = get_option('pixiehuge-twitter-subtitle');
$text = get_option('pixiehuge-twitter-text');
$url = get_option('pixiehuge-twitter-url');
$username = get_option('pixiehuge-twitter-username');

global $sectionNum;

if($twitter):
	?>
	<section id="twitter"<?php echo (!empty($sectionNum) && $sectionNum == 1) ? ' class="firstWithBg"' : '' ?>>
		<div class="container tw-bg"<?php echo (!empty($bg)) ? ' style="background-image: url(\''. esc_url($bg) . '\')"' : '' ?>>
			<article class="left">
				<?php if(!empty($title)): ?>
					<h4><?php echo esc_attr($title) ?></h4>
				<?php endif; ?>

				<?php if(!empty($subtitle)): ?>
					<h3><?php echo esc_attr($subtitle) ?></h3>
				<?php endif; ?>

				<?php if(!empty($text)): ?>
					<p><?php echo esc_attr($text) ?></p>
				<?php endif; ?>


				<?php if(!empty($url) && !empty($username)): ?>
				<a href="<?php echo esc_url($url) ?>" class="twitter">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="16px"> <path fill-rule="evenodd"  fill="rgb(255, 255, 255)" d="M12.923,0.000 C14.433,-0.027 15.237,0.544 16.004,1.270 C16.656,1.212 17.503,0.834 18.001,0.571 C18.163,0.479 18.325,0.388 18.486,0.295 C18.201,1.095 17.815,1.720 17.221,2.194 C17.090,2.300 16.959,2.442 16.794,2.509 C16.794,2.513 16.794,2.516 16.794,2.519 C17.640,2.510 18.337,2.114 19.000,1.899 C19.000,1.903 19.000,1.906 19.000,1.909 C18.652,2.483 18.181,3.066 17.678,3.483 C17.475,3.650 17.272,3.818 17.069,3.985 C17.081,4.914 17.056,5.801 16.889,6.582 C15.915,11.122 13.336,14.205 9.253,15.525 C7.786,15.999 5.417,16.195 3.737,15.761 C2.904,15.547 2.152,15.304 1.445,14.984 C1.053,14.806 0.690,14.614 0.342,14.394 C0.228,14.322 0.114,14.250 -0.000,14.177 C0.379,14.189 0.822,14.297 1.246,14.227 C1.629,14.162 2.005,14.179 2.358,14.099 C3.240,13.898 4.023,13.632 4.697,13.223 C5.024,13.024 5.521,12.791 5.753,12.505 C5.315,12.513 4.918,12.408 4.593,12.288 C3.332,11.826 2.598,10.977 2.120,9.701 C2.502,9.744 3.603,9.847 3.861,9.622 C3.380,9.595 2.917,9.306 2.586,9.091 C1.572,8.432 0.745,7.327 0.751,5.628 C0.884,5.693 1.017,5.759 1.151,5.825 C1.405,5.936 1.664,5.996 1.968,6.061 C2.097,6.088 2.353,6.167 2.501,6.110 C2.495,6.110 2.488,6.110 2.482,6.110 C2.285,5.873 1.966,5.715 1.769,5.461 C1.118,4.621 0.508,3.329 0.894,1.791 C0.992,1.401 1.147,1.056 1.312,0.738 C1.318,0.742 1.325,0.745 1.331,0.748 C1.407,0.913 1.576,1.034 1.683,1.171 C2.015,1.598 2.425,1.983 2.843,2.322 C4.267,3.477 5.549,4.187 7.607,4.713 C8.130,4.846 8.733,4.948 9.357,4.949 C9.182,4.420 9.238,3.563 9.376,3.050 C9.723,1.762 10.477,0.833 11.582,0.335 C11.847,0.216 12.140,0.129 12.448,0.059 C12.606,0.040 12.765,0.020 12.923,0.000 Z"/></svg>
					<span class="right">
                    <?php esc_html_e('Follow us', 'pixiehuge') ?>
						<span><?php echo esc_attr($username) ?></span>
                </span>
					<?php endif; ?>
				</a>
			</article>
			<!-- /LEFT -->

			<?php if(!empty($url) && !empty($username)): ?>
				<article class="right">
					<a class="twitter-timeline" data-width="496" data-height="275" href="https://twitter.com/<?php echo esc_attr($username) ?>"></a>
				</article>
			<?php endif; ?>
			<!-- /RIGHT -->
		</div>
	</section>
	<!-- /TWITTER-FEED -->
<?php endif; // Twitter section ?>