<?php 
    $pdata = get_query_var('pixiehuge_data');
    $matches = $pdata['matches'];
    $streams = $pdata['streams'];
    $teams = $pdata['teams'];
    $maps = $pdata['maps'];
?>
<section id="home" class="admin-section">
    <form method="POST" class="match-options-form" action="options.php">
        <?php
            settings_fields( "match-settings");
            do_settings_sections("pixiehuge-match-page");
            submit_button( esc_html__("Save changes", "pixiehuge"), 'primary', 'btnSubmit');
        ?>
    </form>
</section>

<!-- LIST_OF_MATCHES -->
<section id="matches" class="admin-section">

    <h2><?php esc_html_e('List of Matches', 'pixiehugepanel') ?></h2>
    <p class="section-description">
        <?php esc_html_e('In the list below you can see your matches added, if the list is blank, you need to click \'ADD MATCH\' in the sidebar to the left. You have filters show 10/25/50/100 entries & ability to search for a match.', 'pixiehugepanel') ?>
    </p>

    <table id="datatable" class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Tournament name', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Team home', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Team Away', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Results', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Start date', 'pixiehugepanel') ?></th>
                <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($matches)): ?>
            <?php foreach($matches as $item): ?>
                <?php
		        $details = json_decode($item['details'], 1);
                ?>
                <tr>
                    <td>
                        <?php echo esc_attr($item['id']) ?>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_attr($details['tournament_name']) ?>">
                        <?php echo (strlen($details['tournament_name']) > 18) ? esc_attr(trim(substr($details['tournament_name'], 0, 15))) . '...' : $details['tournament_name'] ?>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_attr($item['team_a_name']) ?>">
                        <?php echo (strlen($item['team_a_name']) > 18) ? esc_attr(trim(substr($item['team_a_name'], 0, 15))) . '...' : $item['team_a_name'] ?>
                    </td>
                    <td rel="tipsy" title="<?php echo esc_attr($item['team_b_name']) ?>">
                        <?php echo (strlen($item['team_b_name']) > 18) ? esc_attr(trim(substr($item['team_b_name'], 0, 15))) . '...' : $item['team_b_name'] ?>
                    </td>
                    <td>    
                        <?php if(!empty($item['score_a'])): ?>
                        <?php echo esc_attr($item['score_a']) ?>:<?php echo esc_attr($item['score_b']) ?>
                        <?php else: ?>
                            <label class="btn pixieBtn">
                                <?php esc_html_e('Upcoming match', 'pixiehugepanel') ?>
                            </label>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo esc_attr(date('Y.m.d H:i', strtotime($item['startdate']))) ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugematches', false). '&action=edit&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to edit this match', 'pixiehugepanel') ?>"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugematches', false). '&action=delete&id='.$item['id']) ?>" rel="tipsy" title="<?php esc_html_e('Click here to delete this match', 'pixiehugepanel') ?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</section>
<!-- /LIST_OF_MATCHES -->

<!-- ADD_MATCH -->
<section id="add" class="admin-section">

    <h2><?php esc_html_e('Add match', 'pixiehugepanel') ?></h2>
    <p class="demolink"><span class="spliter">|</span><a target="_blank" href="<?php echo PIXIEHUGE_LOC_URL . 'assets/images/04_1_2.jpg' ?>">Click here&gt;</a> <?php esc_html_e('to see which element you are changing', 'pixiehugepanel') ?></p>
    <p class="section-description"></p>

    <form action="" method="POST">
        <input type="hidden" name="type" value="add">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('In the fields below you need to input information in every field and select an item from each dropdown field. If you skip a field, that exact field won\'t be displayed on the certain match. If you do not enter the match result, the match will be displayed in the upcoming tab section.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewTeamCover"></div>
                                        <input type="hidden" class="button button-secondary" id="previewTeamCover" name="details[match_bg]" value="">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadTeamCover" value="<?php esc_html_e('Choose a background', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Game', 'pixiehugepanel') ?>
                                    </td>
                                    <td class="td-align-left">
                                        <input type="text" name="game" size="35" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Tournament name', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="details[tournament_name]" size="35" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Tournament description', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="details[tournament_description]" size="35" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Team Home', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <?php
                                        if(!empty($teams)):
                                        ?>
                                        <select class="pixie-input" name="team_a">
                                            <?php foreach($teams as $team): ?>
                                                <option value="<?php echo esc_attr($team['id']) ?>"><?php echo esc_attr($team['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php
                                        else: // If not empty
                                            echo 'No team';
                                        endif; // If not empty
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Team Away', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
	                                    <?php
	                                    if(!empty($teams)):
	                                    ?>
                                        <select class="pixie-input" name="team_b">
	                                        <?php foreach($teams as $team): ?>
                                                <option value="<?php echo esc_attr($team['id']) ?>"><?php echo esc_attr($team['name']) ?></option>
	                                        <?php endforeach; ?>
                                        </select>
                                        <?php
	                                    else: // If not empty
		                                    echo 'No team';
	                                    endif; // If not empty
	                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Status', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <select class="pixie-input" name="status" required>
                                            <option value="1"><?php esc_html_e('Online', 'pixiehugepanel') ?></option>
                                            <option value="2"><?php esc_html_e('Lan', 'pixiehugepanel') ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Best of', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <select class="pixie-input" name="details[best_of]" required>
                                            <option value="0"><?php esc_html_e('None', 'pixiehugepanel') ?></option>
                                            <option value="1">1</option>
                                            <option value="3">3</option>
                                            <option value="5">5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Result Home', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="score_a" size="35" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Result Away', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="score_b" size="35" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Start date', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input datepicker" name="startdate" size="35" value="">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Article link', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="details[read_article]" size="35" value="">
                                    </td>
                                </tr>
                                <?php if(!empty($maps)): ?>
	                                <?php foreach($maps as $map): ?>
                                        <tr>
                                            <td>
				                                <?php echo esc_attr($map['name']) ?> <?php esc_html_e('Score', 'pixiehugepanel') ?>
                                            </td>
                                            <td>
                                                <input type="text" class="pixie-input" name="maps[<?php echo esc_attr(strtolower($map['name'])) ?>][team_a]" size="25" value="<?php echo (!empty($matchMap[strtolower($map['name'])])) ? $matchMap[strtolower($map['name'])]['team_a'] : '' ?>" placeholder="<?php esc_html_e('Result Home', 'pixiehugepanel') ?>">
                                                <input type="text" class="pixie-input" name="maps[<?php echo esc_attr(strtolower($map['name']))?>][team_b]" size="25" value="<?php echo (!empty($matchMap[strtolower($map['name'])])) ? $matchMap[strtolower($map['name'])]['team_b'] : '' ?>" placeholder="<?php esc_html_e('Result Away', 'pixiehugepanel') ?>">
                                            </td>
                                        </tr>
	                                <?php endforeach; ?>
                                <?php endif; ?>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Stream', 'pixiehugepanel') ?>
                                    </td>
                                    <td class="td-align-left">
                                        <select class="pixie-input" name="stream" required>
                                            <option value="0"><?php esc_html_e('No stream', 'pixiehugepanel') ?></option>
                                            <?php
                                            if(!empty($streams)):
                                                foreach($streams as $stream):
                                            ?>
                                            <option value="<?php echo esc_attr($stream['id']) ?>"><?php echo esc_attr($stream['author']) ?></option>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
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
<!-- /ADD_MATCH -->

<section id="map" class="admin-section">
    <h2><?php esc_html_e('Maps', 'pixiehugepanel') ?></h2>

    <table id="mapDatatable" class="widefat fixed" cellspacing="0">
        <thead>
        <tr>
            <th><?php esc_html_e('ID', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Name', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Image', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Created at', 'pixiehugepanel') ?></th>
            <th><?php esc_html_e('Actions', 'pixiehugepanel') ?></th>
        </tr>
        </thead>
        <tbody>
		<?php if(!empty($maps)): ?>
			<?php foreach($maps as $item): ?>
                <tr>
                    <td>
						<?php echo esc_attr($item['id']) ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugeteams', false). '&action=map&id='.$item['id']) ?>">
							<?php echo esc_attr($item['name']) ?>
                        </a>
                    </td>
                    <td>
                        <img src="<?php echo esc_url($item['image']) ?>" alt="<?php esc_html_e('Image', 'pixiehugepanel') ?>" style="max-width:35px">
                    </td>
                    <td>
						<?php echo esc_attr(date('Y.m.d H:i', strtotime($item['created_at']))); ?>
                    </td>
                    <td>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugematches', false). '&action=map&id='.$item['id']) ?>"><?php esc_html_e('Edit', 'pixiehugepanel') ?></a>
                        <a href="<?php echo esc_url(menu_page_url('pixiehugematches', false). '&action=mapdelete&id='.$item['id']) ?>"><?php esc_html_e('Delete', 'pixiehugepanel') ?></a>
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

    <h2 class="top20"><?php esc_html_e('Add map', 'pixiehugepanel') ?></h2>
    <form action="" method="POST">
        <input type="hidden" name="type" value="add_map">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('In the field on the right enter the name for the map and upload the image of the map, that will be displayed on the single match page. Recommended image size: 390x200px.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Map name', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="name" size="50" value="" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewmapImage"></div>
                                        <input type="hidden" class="button button-secondary" id="previewmapImage" name="image" value="">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadmapImage" value="<?php esc_html_e('Choose a image', 'pixiehugepanel') ?>">
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