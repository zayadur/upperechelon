<?php 
    $pdata = get_query_var('pixiehuge_data');
    $teams = $pdata['teams'];
    $playertable = $pdata['playertable'];

    // Get countries
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
    <form method="POST" class="team-options-form" action="options.php">
        <?php
            settings_fields( "team-settings");
            do_settings_sections("pixiehuge-team-page");
            submit_button( __("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
        ?>
    </form>
</section>

<!-- LIST_OF_TEAMS -->
<section id="teams" class="admin-section">

    <h2><?php esc_html_e('List of teams', 'pixiehugepanel') ?></h2>
    <p class="section-description">
        <?php esc_html_e('In the list below you can see a list of teams with all needed information. To change or add a player, all you need to do is click the player icon.', 'pixiehugepanel') ?> <i class="fa fa-users"></i>.
        <br>
        <?php esc_html_e('If you want to change a team ( name, logo ), click on the edit icon.', 'pixiehugepanel') ?><i class="fa fa-pencil"></i>.
        <br>
        <?php esc_html_e('To delete a team and all the players with it, you need to click the X icon.', 'pixiehugepanel') ?><i class="fa fa-times"></i>.
    </p>

    <table id="datatable" class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Name', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Num. of players', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Logo', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($teams)): ?>
            <?php foreach($teams as $item): ?>
                <tr>
                    <td>
                        <?php echo esc_attr($item['id']) ?>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_attr($item['name']) ?>">
                        <a href="<?php echo esc_url(menu_page_url('pixieteams', false). '&action=edit&id='.$item['id']) ?>">
                            <?php echo (strlen($item['name']) > 18) ? esc_attr(trim(substr($item['name'], 0, 15))) . '...' : esc_attr($item['name']) ?>
                        </a>
                    </td>
                    <td>
                        <?php 
                            // Get Players
                            $id = esc_sql($item['id']);
                            $q = "SELECT * FROM `{$playertable}` WHERE `team_id`='{$id}'";
                            $players = ($this->query($q)) ? count($this->query($q)) : 0;
                            echo esc_attr($players);
                        ?>
                    </td>
                    <td>
                        <div class="bg_img_holder" style="background-image: url('<?php echo esc_url($item['team_logo']) ?>');background-size: 32px;"></div>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=edit&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to edit this team', 'pixiehugepanel') ?>"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=edit&id='.$item['id']).'#players' ?>" rel="tipsy" title="<?php esc_html_e('Click here to see player management (add new/edit current player)', 'pixiehugepanel') ?>"><i class="fa fa-users"></i></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=delete&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to delete this team. NOTE: This will delete all team players as well', 'pixiehugepanel') ?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<!-- /LIST_OF_TEAMS -->

<!-- ADD_TEAM -->
<section id="add" class="admin-section">

    <h2><?php esc_html_e('Add Team', 'pixiehugepanel') ?></h2>
    <p class="section-description"></p>
    <hr>
    <form action="" method="POST">
        <input type="hidden" name="type" value="addteam">
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
                                            <option value="0"><?php esc_html_e('No', 'pixiehugepanel') ?></option>
                                            <option value="1"><?php esc_html_e('Yes', 'pixiehugepanel') ?></option>
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
                            <?php esc_html_e('To add a team you need to fill the fields on the right. Game logo will be displayed in the team menu, whilst the team name is on the left, if it is active.') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewTeamCover"></div>
                                        <input type="hidden" class="button button-secondary" id="previewTeamCover" name="cover" value="">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadTeamCover" value="<?php esc_html_e('Choose a cover', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewGameLogo"></div>
                                        <input type="hidden" class="button button-secondary" id="previewGameLogo" name="game_logo" value=""/>
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadGameLogo" value="<?php esc_html_e('Choose a game logo', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder teamLogo"></div>
                                        <input type="hidden" class="button button-secondary" id="teamLogo" name="team_logo" value=""/>
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadteamLogo" value="<?php esc_html_e('Choose a team logo', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder teamThumbnail"></div>
                                        <input type="hidden" class="button button-secondary" id="teamThumbnail" name="thumbnail" value="">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadteamThumbnail" value="<?php esc_html_e('Choose a thumbnail', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Team name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="name" size="50" value="" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Subtitle', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="subtitle" size="50" value="" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('About', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <?php wp_editor( null , 'about', $settings); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Year founded', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="year_founded" size="50" value="" required>
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
                                        <?php esc_html_e('Wins', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="number" class="pixie-input" name="stats[wins]" size="50" value="0" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Losses', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="number" class="pixie-input" name="stats[losses]" size="50" value="0" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Ties', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="number" class="pixie-input" name="stats[ties]" size="50" value="0" required>
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
<!-- /ADD_TEAM -->