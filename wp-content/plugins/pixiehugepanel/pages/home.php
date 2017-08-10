<?php
// Get team
$pdata = get_query_var('pixiehuge_data');
$sections = $pdata['sections'];
?>
<section id="home" class="admin-section">
	<form method="POST" class="general-options-form" action="options.php">
	    <?php
	        settings_fields( "main-settings");
	        do_settings_sections("pixie-main-page");
	        submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
	    ?>
	</form>
</section>

<section id="header-settings" class="admin-section">
	<form method="POST" class="header-options-form" action="options.php">
	    <?php
	        settings_fields( "header-settings");
	        do_settings_sections("pixie-header-page");
	        submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
	    ?>
	</form>
</section>

<section id="twitter-settings" class="admin-section">
	<form method="POST" class="twitter-options-form" action="options.php">
	    <?php
	        settings_fields( "twitter-settings");
	        do_settings_sections("pixiehuge-twitter-page");
	        submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
	    ?>
	</form>
</section>

<section id="homepage-settings" class="admin-section">
	<form method="POST" class="homepage-options-form clearfix" action="options.php">
        <h2 class="noFloat"><?php esc_html_e('Order', 'pixiehugepanel') ?></h2>
        <p class="gray-description"><?php esc_html_e('Here you can reorder sections as you wish of the home page. To do this simply drag one section on the place you want it to be displayed first.', 'pixiehugepanel'); ?></p>
        <ul class="sectionTable" >

	        <?php if(!empty($sections)): ?>
		        <?php foreach($sections as $item): ?>
                    <li id="<?php echo esc_attr($item['id']) ?>" class="sectionBox">
                        <?php echo esc_attr($item['name']) ?>
                    </li>
		        <?php endforeach; ?>
	        <?php endif; ?>
        </ul>
	</form>
</section>

<section id="footer-settings" class="admin-section">
	<form method="POST" class="footer-options-form" action="options.php">
	    <?php
	        settings_fields( "footer-settings");
	        do_settings_sections("pixie-footer-page");
	        submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
	    ?>
	</form>
</section>

<section id="import-settings" class="admin-section">
	<form action="" method="POST">
        <h2 class="noFloat"><?php esc_html_e('Order', 'pixiehugepanel') ?></h2>
        <input type="hidden" name="type" value="importContent">
		<table class="form-table custom-table">
	        <tbody>
		        <tr>
		            <th scope="row">
		                <p class="description">
						    <?php esc_html_e('In the fields on the right you need to upload the thumbnail image ( 800x450px ), write down the title and enter the stream URL. The stream will be displayed in the stream section on the home page.', 'pixiehugepanel') ?>
		                </p>
		            </th>
		            <td>
		                <table>
		                    <tbody>
			                    <tr>
			                        <td>
			                            <select type="text" class="pixie-input" name="demo_content" required>
			                            	<option value="1">Orange Elite</option>
			                            	<option value="2">Pink Prime</option>
			                            	<option value="3">Relentless Green</option>
			                            	<option value="4">Purple Haste</option>
			                            	<option value="5">Yellow Grenade</option>
			                            </select>
			                        </td>
			                    </tr>
		                    </tbody>
		                </table>
		            </td>
		        </tr>
	        </tbody>
	    </table>
	    <p class="submit">
	        <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="<?php esc_html_e('Import', 'pixiehugepanel') ?>">
	    </p>
	</form>
</section>