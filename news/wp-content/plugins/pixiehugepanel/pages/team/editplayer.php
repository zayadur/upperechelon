<?php 
    // Get team
    $pdata = get_query_var('pixiehuge_data');
    $player = $pdata['player'][0];


    $social = json_decode($player['social'], 1);
    $stats = json_decode($player['stats'], 1);
    $equip = json_decode($player['equipment'], 1);
    $countries = json_decode(ALL_COUNTRIES, 1);

    // Textarea settings
    $settings = array(
        'textarea_name' => 'about',
        'media_buttons' => false,
        'teeny' => true,
        'quicktags' => array(
            'buttons' => 'strong,em,del,ul,ol,li,close'
        )
    );
?>
<section id="home" class="admin-section">
    <a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=edit&id='.$player['team_id']) ?>"><?php esc_html_e('Back to team', 'pixiehugepanel') ?></a>
    <h2><?php esc_html_e('Edit player', 'pixiehugepanel') ?></h2>
    <div class="clearfix"></div>
    <hr>
    <form action="" method="POST">
        <input type="hidden" name="type" value="player">
        <input type="hidden" name="id" value="<?php echo esc_attr($player['id']) ?>">
        <input type="hidden" name="team_id" value="<?php echo esc_attr($player['team_id']) ?>">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('Use the tags on the news article in order for the news to be displayed as a related topic on the player\'s profile.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                
                                <tr>
                                    <td>
                                        <input type="type" value="<?php echo esc_attr($player['slug']) ?>" disabled="displayed">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="form-table">
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
                                        <div class="image-preview-holder previewAvatar team">
                                        <?php if(!empty($player['avatar'])): ?>
                                            <img src="<?php echo esc_url($player['avatar']) ?>" alt="<?php echo esc_attr($player['nick']) ?>">
                                        <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="previewAvatar" name="avatar" value="<?php echo esc_url($player['avatar']) ?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadAvatar" value="<?php esc_html_e('Choose an avatar', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder playerCover team">
                                        <?php if(!empty($player['cover'])): ?>
                                            <img src="<?php echo esc_url($player['cover']) ?>" alt="<?php echo esc_attr($player['nick']) ?>">
                                        <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="playerCover" name="cover" value="<?php echo esc_url($player['cover']) ?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadplayerCover" value="<?php esc_html_e('Choose a cover', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder roleBg team">
                                        <?php if(!empty($player['role_icon'])): ?>
                                            <img src="<?php echo esc_url($player['role_icon']) ?>" alt="<?php echo esc_attr($player['role']) ?>">
                                        <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="roleBg" name="role_icon" value="<?php echo esc_url($player['role_icon']) ?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadroleBg" value="<?php esc_html_e('Choose a role icon', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('First name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="firstname" size="50" value="<?php echo esc_attr($player['firstname']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Last name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="lastname" size="50" value="<?php echo esc_attr($player['lastname']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Nick name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="nick" size="50" value="<?php echo esc_attr($player['nick']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Role', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="role" size="50" value="<?php echo esc_attr($player['role']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Age', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="age" size="50" value="<?php echo esc_attr($player['age']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Country', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <select class="pixie-input" name="country" value="" required>
                                            <?php if(!empty($countries)): ?>
                                                <?php foreach($countries as $id => $country): ?>
                                                    <option value="<?php echo esc_attr($id) . ':' . esc_attr($country); ?>"<?php echo (($id . ':' . $country) == $player['country']) ? ' selected="selected"' : '' ?>><?php echo esc_attr($country); ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Facebook', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[facebook]" size="50" value="<?php echo (!empty($social['facebook'])) ? esc_attr($social['facebook']) : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Twitter', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[twitter]" size="50" value="<?php echo (!empty($social['twitter'])) ? esc_attr($social['twitter']) : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Instagram', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[instagram]" size="50" value="<?php echo (!empty($social['instagram'])) ? esc_attr($social['instagram']) : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Twitch', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[twitch]" size="50" value="<?php echo (!empty($social['twitch'])) ? esc_attr($social['twitch']) : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Steam', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="social[steam]" size="50" value="<?php echo (!empty($social['steam'])) ? esc_attr($social['steam']) : '' ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Total kills', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="stats[kills]" size="50" value="<?php echo esc_attr($stats['kills']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Headshots', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="stats[headshots]" size="50" value="<?php echo esc_attr($stats['headshots']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Total deaths', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="stats[deaths]" size="50" value="<?php echo esc_attr($stats['deaths']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Player Rating', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="stats[rating]" size="50" value="<?php echo esc_attr($stats['rating']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Equipment text', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <textarea class="pixie-input" name="equip[text]" size="50">
                                            <?php echo !empty($equip['text']) ? esc_attr($equip['text']) : '' ?>
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Mouse', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="equip[mouse][name]" size="25" value="<?php echo esc_attr($equip['mouse']['name']) ?>" placeholder="<?php esc_html_e('Name') ?>">
                                        <input type="text" class="pixie-input" name="equip[mouse][link]" size="25" value="<?php echo esc_url($equip['mouse']['link']) ?>" placeholder="<?php esc_html_e('Link') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Mouse Pad ', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="equip[mousepad][name]" size="25" value="<?php echo esc_attr($equip['mousepad']['name']) ?>" placeholder="<?php esc_html_e('Name') ?>">
                                        <input type="text" class="pixie-input" name="equip[mousepad][link]" size="25" value="<?php echo esc_url($equip['mousepad']['link']) ?>" placeholder="<?php esc_html_e('Link') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Keyboard', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="equip[keyboard][name]" size="25" value="<?php echo esc_attr($equip['keyboard']['name']) ?>" placeholder="<?php esc_html_e('Name') ?>">
                                        <input type="text" class="pixie-input" name="equip[keyboard][link]" size="25" value="<?php echo esc_url($equip['keyboard']['name']) ?>" placeholder="<?php esc_html_e('Link') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Headset', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="equip[headset][name]" size="25" value="<?php echo esc_attr($equip['headset']['name']) ?>" placeholder="<?php esc_html_e('Name') ?>">
                                        <input type="text" class="pixie-input" name="equip[headset][link]" size="25" value="<?php echo esc_url($equip['headset']['name']) ?>" placeholder="<?php esc_html_e('Link') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('CPU', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="equip[cpu][name]" size="25" value="<?php echo esc_attr($equip['cpu']['name']) ?>" placeholder="<?php esc_html_e('Name') ?>">
                                        <input type="text" class="pixie-input" name="equip[cpu][link]" size="25" value="<?php echo esc_url($equip['cpu']['name']) ?>" placeholder="<?php esc_html_e('Link') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Graphic Card', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="equip[graphiccard][name]" size="25" value="<?php echo esc_attr($equip['graphiccard']['name']) ?>" placeholder="<?php esc_html_e('Name') ?>">
                                        <input type="text" class="pixie-input" name="equip[graphiccard][link]" size="25" value="<?php echo esc_url($equip['graphiccard']['name']) ?>" placeholder="<?php esc_html_e('Link') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('About', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <?php wp_editor( $player['about'] , 'about', $settings); ?>
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