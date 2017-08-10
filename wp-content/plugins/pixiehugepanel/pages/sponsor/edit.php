<?php 
    // Get team
    $pdata = get_query_var('pixiehuge_data');
    $sponsor = $pdata['sponsor'][0];

    $social = json_decode($sponsor['social'], 1);
?>
<section id="home" class="admin-section">
    <a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugesponsors', false)) ?>"><?php esc_html_e('Back', 'pixiehugepanel') ?></a>
    <h2><?php esc_html_e('Edit sponsor', 'pixiehugepanel') ?></h2>
    <div class="clearfix"></div>
    <form action="" method="POST">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="id" value="<?php echo esc_attr($sponsor['id']) ?>">
        <table class="form-table custom-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('You can change, remove the information on the right. If you remove information from a field, that part of the element will not be displayed.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                            <tr>
                                <td colspan="2">
                                    <div class="image-preview-holder previewLogo">
                                        <?php if(!empty($sponsor['logo'])): ?>
                                            <img class="width-max320" src="<?php echo esc_url($sponsor['logo']) ?>" alt="<?php echo esc_attr($sponsor['name']) ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="clearfix"></div>
                                    <input type="hidden" class="button button-secondary" id="previewLogo" name="logo" value="<?php echo esc_url($sponsor['logo']) ?>">
                                    <input type="button" class="button button-secondary" id="uploadLogo" value="<?php esc_html_e('Choose a sponsor logo', 'pixiehugepanel') ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Name', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="name" size="50" value="<?php echo esc_attr($sponsor['name']) ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Category', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="sponsor_category" size="50" value="<?php echo esc_attr($sponsor['sponsor_category']) ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Type', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <select class="pixie-input" name="sponsor_type" required>
                                        <option value="1"<?php echo ($sponsor['sponsor_type'] == 1) ? ' selected="selected"' : ''?>>Promoter</option>
                                        <option value="2"<?php echo ($sponsor['sponsor_type'] == 2) ? ' selected="selected"' : ''?>>Sponsor</option>
                                        <option value="3"<?php echo ($sponsor['sponsor_type'] == 3) ? ' selected="selected"' : ''?>>Head sponsor</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('About', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <textarea type="text" class="pixie-input" name="about" size="50"><?php echo esc_attr($sponsor['about']) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Facebook', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="social[facebook]" size="50" value="<?php echo (!empty($social['facebook'])) ? esc_url($social['facebook']) : '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Twitter', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="social[twitter]" size="50" value="<?php echo (!empty($social['twitter'])) ? esc_url($social['twitter']) : '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Instagram', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="social[instagram]" size="50" value="<?php echo (!empty($social['instagram'])) ? esc_url($social['instagram']) : '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Twitch', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="social[youtube]" size="50" value="<?php echo (!empty($social['youtube'])) ? esc_url($social['youtube']) : '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Steam', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="social[steam]" size="50" value="<?php echo (!empty($social['steam'])) ? esc_url($social['steam']) : '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Linkedin', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="social[linkedin]" size="50" value="<?php echo (!empty($social['linkedin'])) ? esc_url($social['linkedin']) : '' ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Website', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="url" size="50" value="<?php echo ($sponsor['url'] != 'no') ? esc_url($sponsor['url']) : '#' ?>">
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