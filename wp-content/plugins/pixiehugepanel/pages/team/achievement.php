<?php 
    // Get team
    $pdata = get_query_var('pixiehuge_data');
    $achievement = $pdata['achievement'][0];

?>
<section id="home" class="admin-section">
    <a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=edit&id='.$achievement['team_id']) ?>"><?php esc_html_e('Back to team', 'pixiehugepanel') ?></a>
    <h2><?php esc_html_e('Edit achievement', 'pixiehugepanel') ?></h2>
    <div class="clearfix"></div>
    <hr>
    <form action="" method="POST">
        <input type="hidden" name="type" value="update_achievement">
        <input type="hidden" name="team_id" value="<?php echo esc_attr($achievement['team_id']) ?>">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('Here you need to enter the achievements name, description and select the achievement place. Select something from 1st, 2nd, 3rd & 4th. It will be displayed on the team profile page.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Achievement name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="name" size="50" value="<?php echo esc_attr($achievement['name']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Achievement description', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="description" size="50" value="<?php echo esc_attr($achievement['description']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Achievement place', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <select type="text" class="pixie-input" name="place" required>
                                            <option value="1st place"<?php echo ($achievement['place'] == '1st place') ? ' selected' : '' ?>>1st place</option>
                                            <option value="2nd place"<?php echo ($achievement['place'] == '2nd place') ? ' selected' : '' ?>>2nd place</option>
                                            <option value="3rd place"<?php echo ($achievement['place'] == '3rd place') ? ' selected' : '' ?>>3rd place</option>
                                            <option value="4th place"<?php echo ($achievement['place'] == '4th place') ? ' selected' : '' ?>>4th place</option>
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
            <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="<?php esc_html_e('Save changes', 'pixiehugepanel') ?>">
        </p>
    </form>                                     
</section>