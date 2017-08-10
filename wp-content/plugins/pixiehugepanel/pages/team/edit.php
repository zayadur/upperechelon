<?php 
    // Get team
    $pdata = get_query_var('pixiehuge_data');
    $team = $pdata['team'][0];

    // Get achievements
    $achievements = $pdata['achievements'];

    $players = $pdata['players'];
    $stats = json_decode($team['stats'], 1);
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

    // Textarea2 settings
    $settings2 = array(
        'textarea_name' => 'about',
        'media_buttons' => false,
        'teeny' => true,
        'quicktags' => array(
            'buttons' => 'strong,em,del,ul,ol,li,close'
        )
    );
?>
<section id="home" class="admin-section">
    <a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugeteams', false)) ?>"><?php esc_html_e('Back', 'pixiehugepanel') ?></a>
    <h2><?php esc_html_e('Edit team', 'pixiehugepanel') ?></h2>
    <hr>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo esc_attr($team['id']) ?>">
        <input type="hidden" name="type" value="team">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('Use the tags on the news article in order for the news to be displayed as a related topic on the team\'s profile.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                
                                <tr>
                                    <td>
                                        <input type="type" value="<?php echo esc_attr($team['slug']) ?>" disabled="displayed">
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
                            <?php esc_html_e('Choose option yes if you want this team to be displayed on the all teams page and have a team profile. This is important, because you need to add other teams in order to select them when creating a match.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Does this team belong to your organization or not?', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <select class="pixie-input" name="my_team" required>
                                            <option value="0"<?php echo ($team['my_team'] == 0) ? ' selected="selected"' : '' ?>><?php esc_html_e('No', 'pixiehugepanel') ?></option>
                                            <option value="1"<?php echo ($team['my_team'] == 1) ? ' selected="selected"' : '' ?>><?php esc_html_e('Yes', 'pixiehugepanel') ?></option>
                                        </select>
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
                                        <div class="image-preview-holder previewTeamCover">
                                            <?php if(!empty($team['cover'])): ?>
                                                <img src="<?php echo esc_url($team['cover']) ?>" alt="<?php esc_html_e('Cover image', 'pixiehugepanel') ?>" width="150px">
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="previewTeamCover" name="cover" value="<?php echo esc_url($team['cover']) ?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadTeamCover" value="<?php esc_html_e('Choose a cover', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewGameLogo">
                                            <?php if(!empty($team['game_logo'])): ?>
                                                <img src="<?php echo esc_url($team['game_logo']) ?>" alt="<?php esc_html_e('Game Logo', 'pixiehugepanel') ?>" width="150px">
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="previewGameLogo" name="game_logo" value="<?php echo esc_url($team['game_logo']) ?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadGameLogo" value="<?php esc_html_e('Choose a game logo', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder teamLogo">
                                            <?php if(!empty($team['team_logo'])): ?>
                                                <img src="<?php echo esc_url($team['team_logo']) ?>" alt="<?php esc_html_e('Team Logo', 'pixiehugepanel') ?>" width="150px">
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="teamLogo" name="team_logo" value="<?php echo esc_url($team['team_logo']) ?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadteamLogo" value="<?php esc_html_e('Choose a team logo', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder teamThumbnail">
                                            <?php if(!empty($team['thumbnail'])): ?>
                                                <img src="<?php echo esc_url($team['thumbnail']) ?>" alt="<?php esc_html_e('Thumbnail', 'pixiehugepanel') ?>" width="150px">
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="teamThumbnail" name="thumbnail" value="<?php echo esc_url($team['thumbnail']) ?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadteamThumbnail" value="<?php esc_html_e('Choose team banner', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Team name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="name" size="50" value="<?php echo esc_attr($team['name']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Subtitle', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="subtitle" size="50" value="<?php echo esc_attr($team['subtitle']) ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('About', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <?php wp_editor( $team['about'] , 'about', $settings); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Year founded', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="year_founded" size="50" value="<?php echo esc_attr($team['year_founded']) ?>" required>
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
                                                    <option value="<?php echo esc_attr($id) . ':' . esc_attr($country) ?>"<?php echo (($id . ':' . $country) == $team['country']) ? ' selected="selected"' : '' ?>><?php echo esc_attr($country); ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Wins', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="number" class="pixie-input" name="stats[wins]" size="50" value="<?php echo !empty($stats['wins']) ? esc_attr($stats['wins']) : 0 ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Losses', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="number" class="pixie-input" name="stats[losses]" size="50" value="<?php echo !empty($stats['losses']) ?  esc_attr($stats['losses']) : 0 ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Ties', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="number" class="pixie-input" name="stats[ties]" size="50" value="<?php echo !empty($stats['ties']) ?  esc_attr($stats['ties']) : 0 ?>" required>
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

<section id="players" class="admin-section">
    <h2><?php esc_html_e('Players', 'pixiehugepanel') ?></h2>
    <p class="section-description">
	    <?php esc_html_e('Here you can see a list of players that you have previously added. To reorder a player\'s position, simply drag it to the position you want and release. They will appear in the same exact order on the team profile page as they are here.', 'pixiehugepanel') ?>
    </p>
    <table class="playersTable widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Player name', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Nick name', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($players)): ?>
            <?php foreach($players as $item): ?>
                <tr id="<?php echo esc_attr($item['id']) ?>">
                    <td>
                        <?php echo esc_attr($item['id']) ?>
                    </td>

                    <td rel="tipsy" title="<?php echo esc_attr($item['firstname']) ?>">
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=playeredit&id='.$item['id']) ?>">
                            <?php echo (strlen($item['firstname']) > 18) ? esc_attr(trim(substr($item['firstname'], 0, 15))) . '...' : esc_attr($item['firstname']) ?>
                        </a>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_attr($item['nick']) ?>">
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=playeredit&id='.$item['id']) ?>">
                            <?php echo (strlen($item['nick']) > 18) ? esc_attr(trim(substr($item['nick'], 0, 15))) . '...' : esc_attr($item['nick']) ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=playeredit&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to edit this player', 'pixiehugepanel') ?>"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=playerdelete&id='.$item['id']).'' ?>" rel="tipsy" title="<?php esc_html_e('Click here to delete this player', 'pixiehugepanel') ?>"><i class="fa fa-close"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</section>

<section id="addplayer" class="admin-section">
    <h2><?php esc_html_e('Add player', 'pixiehugepanel') ?></h2>
    <p class="section-description"></p>

    <form action="" method="POST">
        <input type="hidden" name="type" value="player">
        <input type="hidden" name="team_id" value="<?php echo esc_attr($team['id']) ?>">
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
                                <div class="image-preview-holder previewAvatar"></div>
                                <input type="hidden" class="button button-secondary" id="previewAvatar" name="avatar" value="">
                                <div class="clearfix"></div>
                                <input type="button" class="button button-secondary" id="uploadAvatar" value="<?php esc_html_e('Choose an avatar', 'pixiehugepanel') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="image-preview-holder playerCover team"></div>
                                <input type="hidden" class="button button-secondary" id="playerCover" name="cover" value="">
                                <div class="clearfix"></div>
                                <input type="button" class="button button-secondary" id="uploadplayerCover" value="<?php esc_html_e('Choose a cover', 'pixiehugepanel') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="image-preview-holder roleBg team"></div>
                                <input type="hidden" class="button button-secondary" id="roleBg" name="role_icon" value="">
                                <div class="clearfix"></div>
                                <input type="button" class="button button-secondary" id="uploadroleBg" value="<?php esc_html_e('Choose a role icon', 'pixiehugepanel') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('First name', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="firstname" size="50" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Last name', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="lastname" size="50" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Nick name', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="nick" size="50" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Role', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="role" size="50" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Age', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="age" size="50" value="" required>
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
                                            <option value="<?php echo esc_attr($id) . ':' . esc_attr($country) ?>"><?php echo esc_attr($country); ?></option>
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
                                <input type="text" class="pixie-input" name="social[twitch]" size="50" value="">
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
								<?php esc_html_e('Total kills', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="stats[kills]" size="50" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Headshots', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="stats[headshots]" size="50" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Total deaths', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="stats[deaths]" size="50" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Player Rating', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="stats[rating]" size="50" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Equipment text', 'pixiehugepanel') ?>
                            </td>
                            <td>
                            <textarea class="pixie-input" name="equip[text]" size="50"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Mouse', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="equip[mouse][name]" size="25" value="" placeholder="<?php esc_html_e('Name') ?>">
                                <input type="text" class="pixie-input" name="equip[mouse][link]" size="25" value="" placeholder="<?php esc_html_e('Link') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Mouse Pad', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="equip[mousepad][name]" size="25" value="" placeholder="<?php esc_html_e('Name') ?>">
                                <input type="text" class="pixie-input" name="equip[mousepad][link]" size="25" value="" placeholder="<?php esc_html_e('Link') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Keyboard', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="equip[keyboard][name]" size="25" value="" placeholder="<?php esc_html_e('Name') ?>">
                                <input type="text" class="pixie-input" name="equip[keyboard][link]" size="25" value="" placeholder="<?php esc_html_e('Link') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Headset', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="equip[headset][name]" size="25" value="" placeholder="<?php esc_html_e('Name') ?>">
                                <input type="text" class="pixie-input" name="equip[headset][link]" size="25" value="" placeholder="<?php esc_html_e('Link') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('CPU', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="equip[cpu][name]" size="25" value="" placeholder="<?php esc_html_e('Name') ?>">
                                <input type="text" class="pixie-input" name="equip[cpu][link]" size="25" value="" placeholder="<?php esc_html_e('Link') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('Graphic Card', 'pixiehugepanel') ?>
                            </td>
                            <td>
                                <input type="text" class="pixie-input" name="equip[graphiccard][name]" size="25" value="" placeholder="<?php esc_html_e('Name') ?>">
                                <input type="text" class="pixie-input" name="equip[graphiccard][link]" size="25" value="" placeholder="<?php esc_html_e('Link') ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
								<?php esc_html_e('About', 'pixiehugepanel') ?>
                            </td>
                            <td>
								<?php wp_editor( '' , 'about_player', $settings2); ?>
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
<section id="achievements" class="admin-section">
    <h2><?php esc_html_e('List of Achievements', 'pixiehugepanel') ?></h2>
    <p class="demolink"><span class="spliter">|</span> <a target="_blank" href="<?php echo PIXIEHUGE_LOC_URL . 'assets/images/Achievements.jpg' ?>"><?php esc_html_e('Click here', 'pixiehugepanel') ?></a> <?php esc_html_e('to see which element you are changing', 'pixiehugepanel') ?></p>
    <p class="section-description"></p>

    <table id="datatable" class="widefat fixed" cellspacing="0">
        <thead>
        <tr>
            <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Achievement Name', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Achievement Description', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Achievement Place', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Created at', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($achievements)): ?>
            <?php foreach($achievements as $item): ?>
                <tr>
                    <td>
                        <?php echo esc_attr($item['id']) ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=achievement&id='.$item['id']) ?>">
                            <?php echo esc_attr($item['name']) ?>
                        </a>
                    </td>
                    <td>
                        <?php echo esc_attr($item['description']) ?>
                    </td>
                    <td>
                        <?php echo esc_attr($item['place']) ?>
                    </td>
                    <td>
                        <?php echo esc_attr(date('Y.m.d H:i', strtotime($item['created_at']))); ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=achievement&id='.$item['id']) ?>"><?php esc_html_e('Edit', 'pixiehugepanel') ?></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=achievementdelete&id='.$item['id']) ?>"><?php esc_html_e('Delete', 'pixiehugepanel') ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5"><?php esc_html_e('Empty', 'pixiehugepanel') ?></td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>

    <h2 class="top20"><?php esc_html_e('Add achievement', 'pixiehugepanel') ?></h2>
    <form action="" method="POST">
        <input type="hidden" value="<?php echo esc_attr($team['id']) ?>" name="team_id">
        <input type="hidden" name="type" value="add_achievement">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">
                    <p class="description">
                        <?php esc_html_e('Here you need to enter the achievements name, description and select the achievement place. Select something from 1st, 2nd, 3rd and 4th. It will be displayed on the team profile page.', 'pixiehugepanel') ?>
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
                                    <input type="text" class="pixie-input" name="name" size="50" value="" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Achievement description', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <input type="text" class="pixie-input" name="description" size="50" value="" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php esc_html_e('Achievement place', 'pixiehugepanel') ?>
                                </td>
                                <td>
                                    <select type="text" class="pixie-input" name="place" required>
                                        <option value="1st place">1st place</option>
                                        <option value="2nd place">2nd place</option>
                                        <option value="3rd place">3rd place</option>
                                        <option value="4th place">4th place</option>
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
            <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="<?php esc_html_e('Add', 'pixiehugepanel') ?>">
        </p>
    </form>
</section>