<?php 
    $pdata = get_query_var('pixiehuge_data');
    $sponsors = $pdata['sponsors'];
?>
<section id="home" class="admin-section">
    <form method="POST" class="sponsor-options-form" action="options.php">
        <?php
            settings_fields( "sponsor-settings");
            do_settings_sections("pixiehuge-sponsor-page");
            submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
        ?>
    </form>
</section>

<!-- LIST_OF_SPONSORS -->
<section id="sponsors" class="admin-section">

    <h2><?php esc_html_e('List of Sponsors', 'pixiehugepanel') ?></h2>
    <p class="section-description">
        <?php esc_html_e('Down below you will be abale to see list of sponsors/partners, as well as displayed position for each of them. To edit a sponsor/partner click on the "pencil" icon, to delete the sponsor/partner click on "x" icon. ', 'pixiehugepanel') ?>
    </p>

    <table id="datatable" class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Category', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('URL', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Sponsor - Display', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Sponsor logo', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($sponsors)): ?>
            <?php foreach($sponsors as $item): ?>
                <tr>
                    <td>
                        <?php echo esc_attr($item['id']) ?>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_attr($item['name']) ?>">
                        <a href="<?php echo esc_url(menu_page_url('pixiesponsors', false). '&action=edit&id='.$item['id']) ?>">
                            <?php echo (strlen($item['name']) > 18) ? esc_attr(trim(substr($item['name'], 0, 15))) . '...' : esc_attr($item['name']) ?>
                        </a>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_url($item['url']) ?>">
                        <?php echo (strlen($item['url']) > 18) ? esc_url(trim(substr($item['url'], 0, 15))) . '...' : esc_url($item['url']) ?>
                    </td>
                    <td>    
                        <a class="btn btn-warning hfbtn"><?php echo esc_attr($item['sponsor_category']) ?></a>
                    </td>
                    <td>
                        <div class="bg_img_holder gray" style="background-image: url('<?php echo esc_url($item['logo']) ?>');"></div>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugesponsors', false). '&action=edit&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to edit this sponsor', 'pixiehugepanel') ?>"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugesponsors', false). '&action=delete&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to edit this sponsor', 'pixiehugepanel') ?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<!-- /LIST_OF_SPONSORS -->

<!-- ADD_SPONSOR -->
<section id="add" class="admin-section">

    <h2><?php esc_html_e('Add Sponsor', 'pixiehugepanel') ?></h2>
    <p class="demolink"><span class="spliter">|</span><a target="_blank" href="<?php echo PIXIEHUGE_LOC_URL . 'assets/images/05_1_2.jpg' ?>"><?php esc_html_e('Click here', 'pixiehugepanel') ?></a> <?php esc_html_e('to see which element you are changing', 'pixiehugepanel') ?></p>
    <form action="" method="POST">
        <input type="hidden" name="type" value="add">
        <table class="form-table custom-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('To add a sponsor/partner is to fill up the fields on the right. Sponsors are displayed on the sponsor page.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewLogo width-max320-img"></div>
                                        <input type="hidden" class="button button-secondary" id="previewLogo" name="logo" value="">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadLogo" value="<?php esc_html_e('Choose a sponsor logo', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="name" size="50" value="" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Category', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="sponsor_category" size="50" value="" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Type', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <select class="pixie-input" name="sponsor_type" required>
                                            <option value="1">Promoter</option>
                                            <option value="2">Sponsor</option>
                                            <option value="3">Head sponsor</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('About', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <textarea type="text" class="pixie-input" name="about" size="50"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Facebook', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[facebook]" size="50" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Twitter', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[twitter]" size="50" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Instagram', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[instagram]" size="50" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Twitch', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[youtube]" size="50" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Steam', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[steam]" size="50" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Linkedin', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[linkedin]" size="50" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Website', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="url" size="50" value="" required="required">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="<?php esc_html_e('Add', 'pixiehugepanel') ?>">
        </p>
    </form>
</section>
<!-- /ADD_SPONSOR -->