<?php 
    // Get team
    $pdata = get_query_var('pixiehuge_data');
    $stream = $pdata['stream'][0];
?>
<section id="home" class="admin-section">
    <a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugestreams', false)) ?>"><?php esc_html_e('Back', 'pixiehugepanel') ?></a>
    <h2><?php esc_html_e('Edit stream', 'pixiehugepanel') ?></h2>
    <hr>
    <form action="" method="POST">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="url" value="<?php echo esc_attr($stream['link']) ?>">
        <input type="hidden" name="category" value="<?php echo esc_attr($stream['category']) ?>">
        <input type="hidden" name="id" value="<?php echo esc_attr($stream['id']) ?>">
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
                            <td colspan="2">
                                <div class="image-preview-holder previewIcon">
			                        <?php if(!empty($stream['thumbnail'])): ?>
                                        <img src="<?php echo esc_url($stream['thumbnail']); ?>" alt="<?php echo esc_attr($stream['title']) ?>" width="250px">
			                        <?php endif; ?>
                                </div>
                                <input type="hidden" class="button button-secondary" id="previewIcon" name="stream_thumbnail" value="<?php echo esc_url($stream['thumbnail']); ?>">
                                <div class="clearfix"></div>
                                <input type="button" class="button button-secondary" id="uploadIcon" value="<?php esc_html_e('Choose stream thumbnail', 'pixiehugepanel') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="pixie-input" name="title" placeholder="<?php esc_html_e('Title', 'pixiehugepanel') ?>" size="35" value="<?php echo esc_attr($stream['title']) ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="pixie-input" name="url" placeholder="<?php esc_html_e('Stream url', 'pixiehugepanel') ?>" size="35" value="<?php echo esc_attr($stream['link']) ?>" required>
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
            <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="<?php esc_html_e('Save changes', 'pixiehugepanel') ?>">
        </p>
    </form>
</section>