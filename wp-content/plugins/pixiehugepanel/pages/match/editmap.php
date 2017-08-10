<?php
// Get team
$pdata = get_query_var('pixiehuge_data');
$map = $pdata['map'][0];
?>
<section id="home" class="admin-section">
	<a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugematches', false)) ?>"><?php esc_html_e('Back', 'pixiehugepanel') ?></a>
	<h2><?php esc_html_e('Edit map', 'pixiehugepanel') ?></h2>
	<hr>
	<form action="" method="POST">
		<input type="hidden" name="type" value="update">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row">
					<p class="description">
						<?php esc_html_e('In the field on the right enter the name for the map and upload the image of the map, that will be displayed on the single match page. Recommended image size: 390x200px.', 'pixiehugepanel') ?>
					</p>
				</th>
				<td>
					<table>
						<tbody>
							<tr>
								<td>
									<?php esc_html_e('Map name', 'pixiehugepanel') ?>
								</td>
								<td>
									<input type="text" class="pixie-input" name="name" size="50" value="<?php echo esc_attr($map['name']) ?>" required>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="image-preview-holder previewmapImage">
										<?php if(!empty($map['image'])): ?>
											<figure>
												<img src="<?php echo esc_url($map['image']) ?>" alt="<?php esc_html_e('Image', 'pixiehugepanel') ?>" style="max-width:350px;">
											</figure>
										<?php endif; ?>
									</div>
									<input type="hidden" class="button button-secondary" id="previewmapImage" name="image" value="<?php echo esc_attr($map['image']) ?>">
									<div class="clearfix"></div>
									<input type="button" class="button button-secondary" id="uploadmapImage" value="<?php esc_html_e('Choose a image', 'pixiehugepanel') ?>">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="<?php esc_html_e('Save changes', 'pixiehugepanel') ?>">
		</p>
</section>