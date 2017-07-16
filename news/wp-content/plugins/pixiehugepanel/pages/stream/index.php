<?php 
    $pdata = get_query_var('pixiehuge_data');
    $streams = $pdata['streams'];
?>
<!-- SETTINGS -->
<section id="home" class="admin-section">
    <form method="POST" class="twitch-options-form" action="options.php">
        <?php
            settings_fields( "stream-settings");
            do_settings_sections("pixiehuge-stream-page");
            submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
        ?>
    </form>
</section>
<!-- /SETTINGS -->

<!-- LIST_OF_STREAMS -->
<section id="streams" class="admin-section">

    <h2><?php esc_html_e('List of Streams', 'pixiehugepanel') ?></h2>
    <p class="demolink"></p>
    <p class="section-description">
        <?php esc_html_e('In the list below you can see the streams added. Streams are displayed on the homepage in the section "Streams".', 'pixiehugepanel') ?>
    </p>


    <table id="datatable" class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Stream name', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Platform', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('URL', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($streams)): ?>
            <?php foreach($streams as $item): ?>
                <tr>
                    <td>
                        <?php echo esc_attr($item['id']) ?>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_attr($item['title']) ?>">
                        <a href="<?php echo esc_url(menu_page_url('pixiehugestreams', false). '&action=edit&id='.$item['id']) ?>">
                            <?php echo (strlen($item['title']) > 18) ? esc_attr(trim(substr($item['title'], 0, 15))) . '...' : esc_attr($item['title']) ?>
                        </a>
                    </td>
                    <td>    
                        <label class="btn <?php echo esc_attr($item['category']) ?>">
                            <?php echo esc_attr($item['category']) ?>
                        </label>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_url($item['link']) ?>">
                        <?php echo (strlen($item['link']) > 18) ? esc_url(trim(substr($item['link'], 0, 15))) . '...' : esc_url($item['link']) ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugestreams', false). '&action=edit&id='.$item['id']) ?>"><i class="fa fa-pencil" rel="tipsy" title="<?php esc_html_e('Click here to edit this stream', 'pixiehugepanel') ?>"></i></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugestreams', false). '&action=delete&id='.$item['id']) ?>"><i class="fa fa-times" rel="tipsy" title="<?php esc_html_e('Click here to delete this stream', 'pixiehugepanel') ?>"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<!-- /LIST_OF_STREAMS -->

<!-- ADD_STREAM -->
<section id="add" class="admin-section">

    <h2><?php esc_html_e('Add stream', 'pixiehugepanel') ?></h2>

    <form action="" method="POST">
        <input type="hidden" name="type" value="add">
        <table class="form-table custom-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('In the fields on the right you need to upload the thumbnail image ( 800x450px ), write down the title, select the platform and enter the stream URL. The stream will be displayed in the stream section on the home page.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewIcon"></div>
                                        <input type="hidden" class="button button-secondary" id="previewIcon" name="stream_thumbnail" value="">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadIcon" value="<?php esc_html_e('Choose stream thumbnail', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="pixie-input" name="title" placeholder="<?php esc_html_e('Title', 'pixiehugepanel') ?>" size="35" value="" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="pixie-input" name="category" required>
                                            <?php if(get_option('pixiehuge-twitch-clientid')): ?>
                                            <option value="twitch"><?php esc_html_e('Twitch', 'pixiehugepanel') ?></option>
                                            <?php endif; ?>
	                                        <?php if(get_option('pixiehuge-twitch-clientid')): ?>
                                            <option value="youtube"><?php esc_html_e('Youtube', 'pixiehugepanel') ?></option>
	                                        <?php endif; ?>
                                            <option value="mixer"><?php esc_html_e('Mixer', 'pixiehugepanel') ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" class="pixie-input" name="url" placeholder="<?php esc_html_e('Stream url', 'pixiehugepanel') ?>" size="35" value="" required>
                                        <p><?php esc_html_e('Example: https://www.twitch.tv/pixiesquad', 'pixiehugepanel') ?></p>
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
<!-- /ADD_STREAM -->

<!-- TWITCH -->
<section id="streamintegration" class="admin-section">
    <form method="POST" class="twitch-options-form" action="options.php">
        <?php
            settings_fields( "socialstream-settings");
            do_settings_sections("pixiehuge-streamkey-page");
            submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
        ?>
    </form>
</section>
<!-- /TWITCH -->