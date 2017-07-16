<?php 
    $pdata = get_query_var('pixiehuge_data');
    $boardmember = $pdata['boardmember'][0];

    $social = json_decode($boardmember['social'], 1);
?>
<!-- EDIT_BOARDMEMBER -->
<section id="home" class="admin-section">
    <form action="" method="POST" class="general-options-form">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="id" value="<?php echo esc_attr($boardmember['id']) ?>">
        
        <a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugeabout', false)) ?>"><?php esc_html_e('Back', 'pixiehugepanel') ?></a>
        <h2><?php esc_html_e('Edit board member', 'pixiehugepanel') ?></h2>
        <p class="demolink"><span class="spliter">|</span> <a href="http://themes.pixiesquad.com/pixiehype/wp-content/themes/pixiehype/inc/images/main_settings_img.jpg" target="_blank"><?php esc_html_e('Click here', 'pixiehugepanel') ?></a> <?php esc_html_e('to see which element you are changing', 'pixiehugepanel') ?></p>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('In the fields on the right enter the required information that will be displayed on the board member section of the about us page. Upload the avatar image for the board member. Recommended image size: 165x132px', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewLogo">
                                            <?php if(!empty($boardmember['avatar'])): ?>
                                                <img src="<?php echo esc_url($boardmember['avatar']) ?>" class="width-max320" alt="<?php esc_html_e('Member\'s avatar', 'pixiehugepanel') ?>">
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="previewLogo" name="avatar" value="<?php echo esc_url($boardmember['avatar']) ?>">
                                        <input type="button" class="button button-secondary" id="uploadLogo" value="<?php esc_html_e('Choose an avatar', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Full name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" size="50" class="pixie-input" name="fullname" value="<?php echo esc_attr($boardmember['fullname']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Role', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" size="50" class="pixie-input" name="role" value="<?php echo esc_attr($boardmember['role']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Category', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <select class="pixie-input" name="category" required>
			                                <?php
			                                $params = array('cat_one' => 'Category one', 'cat_two' => 'Category two', 'cat_three' => 'Category three', 'cat_four' => 'Category four');
			                                $categories = get_option('pixiehuge-about-category');

			                                foreach($params as $id => $param):
				                                ?>
                                                <option value="<?php echo esc_attr($categories[$id]) ?>" <?php echo ($boardmember['category'] == $categories[$id]) ? 'selected="selected"' : '' ?>><?php echo esc_attr($categories[$id]) ?></option>
			                                <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Twitter', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input class="pixie-input" size="50" name="social[twitter]" value="<?php echo !empty($social['twitter']) ? esc_attr($social['twitter']) : '' ?>" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Facebook', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input class="pixie-input" size="50" name="social[facebook]" value="<?php echo !empty($social['facebook']) ? esc_attr($social['facebook']) : '' ?>" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Linkedin', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input class="pixie-input" size="50" name="social[linkedin]" value="<?php echo !empty($social['linkedin']) ? esc_attr($social['linkedin']) : '' ?>" type="text">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit"><input class="button button-primary" id="btnSubmit" name="btnSubmit" type="submit" value="<?php esc_html_e('Save changes', 'pixiehugepanel') ?>"></p>
    </form>
</section>
<!-- /EDIT_BOARDMEMBER -->