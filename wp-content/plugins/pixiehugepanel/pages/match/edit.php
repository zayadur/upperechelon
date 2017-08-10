<?php 
    // Get team
    $pdata = get_query_var('pixiehuge_data');
    $match = $pdata['match'][0];
    $streams = $pdata['streams'];
    $teams = $pdata['teams'];

    // Get details
    $details = json_decode($match['details'], 1);

    $matchMap = json_decode($details['maps'], 1);

    // Get maps
    $maps = $pdata['maps'];
?>
<section id="home" class="admin-section">
    <a class="backBtn button button-secondary" href="<?php echo esc_url(menu_page_url('pixiehugematches', false)) ?>"><?php esc_html_e('Back', 'pixiehugepanel') ?></a>
    <h2><?php esc_html_e('Edit match', 'pixiehugepanel') ?></h2>
    <hr>
    <form action="" method="POST">
        <input type="hidden" name="type" value="update">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <p class="description">
                            <?php esc_html_e('In the fields below you need to input information in every field and select an item from each dropdown field. If you skip a field, that exact field won\'t be displayed on the certain match.', 'pixiehugepanel') ?>
                        </p>
                    </th>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="image-preview-holder previewTeamCover">
                                            <?php if(!empty($details['match_bg'])): ?>
                                                <img src="<?php echo esc_url($details['match_bg']) ?>" alt="<?php esc_html_e('Background', 'pixiehugepanel') ?>" width="150px">
                                            <?php endif; ?>
                                        </div>
                                        <input type="hidden" class="button button-secondary" id="previewTeamCover" name="details[match_bg]" value="<?php echo (!empty($details['match_bg'])) ? esc_url($details['match_bg']) : ''?>">
                                        <div class="clearfix"></div>
                                        <input type="button" class="button button-secondary" id="uploadTeamCover" value="<?php esc_html_e('Choose a background', 'pixiehugepanel') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php esc_html_e('Game', 'pixiehugepanel') ?>
                                    </td>
                                    <td class="td-align-left">
                                        <input type="text" name="game" size="35" value="<?php echo esc_attr($match['game']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Tournament name', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="details[tournament_name]" size="35" value="<?php echo esc_attr($details['tournament_name']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Tournament description', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="details[tournament_description]" size="35" value="<?php echo esc_attr($details['tournament_description']) ?>">
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
                                                    <option value="<?php echo esc_attr($team['id']) ?>"<?php echo ($team['id'] == $match['team_a_id']) ? ' selected="selected"' : '' ?>><?php echo esc_attr($team['name']) ?></option>
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
                                                    <option value="<?php echo esc_attr($team['id']) ?>"<?php echo ($team['id'] == $match['team_b_id']) ? ' selected="selected"' : '' ?>><?php echo esc_attr($team['name']) ?></option>
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
                                            <option value="1"<?php echo ($match['status'] == 1) ? ' selected="selected"' : '' ?>><?php esc_html_e('Online', 'pixiehugepanel') ?></option>
                                            <option value="2"<?php echo ($match['status'] == 2) ? ' selected="selected"' : '' ?>><?php esc_html_e('Lan', 'pixiehugepanel') ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label><?php esc_html_e('Best of', 'pixiehugepanel') ?></label>
                                    </td>
                                    <td>
                                        <select class="pixie-input" name="details[best_of]" required>
                                            <option value="0"<?php echo (!empty($details['best_of']) && $details['best_of'] == 0) ? ' selected="selected"' : '' ?>><?php esc_html_e('None', 'pixiehugepanel') ?></option>
                                            <option value="1"<?php echo (!empty($details['best_of']) && $details['best_of'] == 1) ? ' selected="selected"' : '' ?>>1</option>
                                            <option value="3"<?php echo (!empty($details['best_of']) && $details['best_of'] == 3) ? ' selected="selected"' : '' ?>>3</option>
                                            <option value="5"<?php echo (!empty($details['best_of']) && $details['best_of'] == 5) ? ' selected="selected"' : '' ?>>5</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Result Home', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="score_a" size="35" value="<?php echo !empty($match['score_a']) ? esc_attr($match['score_a']) : 0 ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Result Away', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="score_b" size="35" value="<?php echo !empty($match['score_b']) ? esc_attr($match['score_b']) : 0 ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Start date', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input datepicker" name="startdate" size="35" value="<?php echo esc_attr($match['startdate']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
		                                <?php esc_html_e('Article link', 'pixiehugepanel') ?>
                                    </td>
                                    <td>
                                        <input type="text" class="pixie-input" name="details[read_article]" size="35" value="<?php echo !empty($details['read_article']) ? esc_url($details['read_article']) : '' ?>">
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
                                                <option value="<?php echo esc_attr($stream['id']) ?>"<?php ($stream['id'] == $match['stream']) ? ' selected="selected"' : '' ?>><?php echo esc_attr($stream['author']) ?></option>
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
        <input type="submit" name="btnSubmit" id="btnSubmit" class="button button-primary" value="<?php esc_html_e('Save changes', 'pixiehugepanel') ?>">
    </p>
</section>