<?php 
    $pdata = get_query_var('pixiehuge_data');
    $boardmembers = $pdata['boardmembers'];
?>
<section id="home" class="admin-section">
    <form method="POST" class="about-options-form" action="options.php" enctype="multipart/form-data">
        <?php
            settings_fields( "about-settings");
            do_settings_sections("pixie-about-page");
            submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
        ?>
    </form>
</section>
<!-- LIST_OF_MEMBERS -->
<section id="members" class="admin-section">

    <h2><?php esc_html_e('The list of board members', 'pixiehugepanel') ?></h2>
    <p class="demolink"><span class="spliter">|</span> <a href="<?php echo PIXIEHUGE_LOC_URL . 'assets/images/06_1_2.jpg' ?>" target="_blank"><?php esc_html_e('Click here', 'pixiehugepanel') ?></a> <?php esc_html_e('to see which element you are changing', 'pixiehugepanel') ?></p>
    <p class="section-description">
		<?php esc_html_e('Down below you will be able to see list of board members. To edit a board member click on the "pencil" icon, to delete the board member click on "x" icon.', 'pixiehugepanel') ?>
    </p>

    <table id="datatable" class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Full name', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Title', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Category', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Created at', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($boardmembers)): ?>
            <?php foreach($boardmembers as $item): ?>
                <tr>
                    <td>
                        <?php echo esc_attr($item['id']) ?>
                    </td>
                    <td>    
                        <a href="<?php echo esc_url(menu_page_url('pixieabout', false). '&action=edit&id='.$item['id']) ?>">
                            <?php echo esc_attr($item['fullname']) ?>
                        </a>
                    </td>
                    <td>    
                        <?php echo esc_attr($item['role']) ?>
                    </td>
                    <td>
                        <?php echo esc_attr($item['category']) ?>
                    </td>
                    <td>
                        <?php echo esc_attr(date('Y.m.d H:i', strtotime($item['created_at']))); ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeabout', false). '&action=edit&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to edit this member', 'pixiehugepanel') ?>"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeabout', false). '&action=delete&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to delete this member', 'pixiehugepanel') ?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<!-- /LIST_OF_MEMBERS -->

<!-- ADD_MEMBER -->
<section id="add" class="admin-section">
    <form action="" method="POST" class="general-options-form">
        <input type="hidden" name="type" value="add">
        <h2><?php esc_html_e('Add board member', 'pixiehugepanel') ?></h2>
        <p class="demolink"><span class="spliter">|</span> <a href="<?php echo PIXIEHUGE_LOC_URL . 'assets/images/06_1_3.jpg' ?>" target="_blank"><?php esc_html_e('Click here', 'pixiehugepanel') ?></a> <?php esc_html_e('to see which element you are changing', 'pixiehugepanel') ?></p>
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
                                        <div class="image-preview-holder previewLogo"></div>
                                        <input type="hidden" class="button button-secondary" id="previewLogo" name="avatar" value=""/>
                                        <input type="button" class="button button-secondary" id="uploadLogo" value="<?php esc_html_e('Choose an avatar', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Full name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" size="50" class="pixie-input" name="fullname" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Role', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" size="50" class="pixie-input" name="role" required>
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
                                                <option value="<?php echo esc_attr($categories[$id]) ?>"><?php echo esc_attr($categories[$id]) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Twitter', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input class="pixie-input" size="50" name="social[twitter]" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Facebook', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input class="pixie-input" size="50" name="social[facebook]" type="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Linkedin', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input class="pixie-input" size="50" name="social[linkedin]" type="text">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit"><input class="button button-primary" id="btnSubmit" name="btnSubmit" type="submit" value="<?php esc_html_e('Add', 'pixiehugepanel') ?>"></p>
    </form>
</section>
<!-- /ADD_MEMBER -->