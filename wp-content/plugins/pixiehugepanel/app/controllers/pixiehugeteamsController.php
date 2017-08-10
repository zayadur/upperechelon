<?php

use PixieHuge\Controller;

class pixiehugeteamsController extends Controller
{
    public function index($tables) {

        $saveInfo = false;
        if(!empty($_REQUEST) && !empty($_REQUEST['type'])) {
            $saveInfo = $this->save($tables);
        }
        $data = [];

        // Create menu
        $data['menu'] = [
            ['id' => 'home', 'name' => 'General Settings'],
            ['id' => 'teams', 'name' => 'Teams & Players'],
            ['id' => 'add', 'name' => 'Add Team'],
        ];

        // Get team
        $q = "SELECT * FROM `{$tables['teams']}`";
        $data['teams'] = $this->query($q);

        // Player table name
        $data['playertable'] = $tables['players'];
        // Save Information
        $data['saveInfo'] = $saveInfo;

        $this->view('team/index', $data);
    }

    public function edit($tables) {

        $data = [];

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieteams', 'error', esc_html__('Team not found!', 'pixiehugepanel'));
            return false;
        }

        // Save Information
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if($_REQUEST['type'] == 'add_achievement') {
                $saveInfo = $this->save_achievement($tables);
            } else if($_REQUEST['type'] == 'team') {
                $saveInfo = $this->save($tables, false);
            } else {
                $saveInfo = $this->save_player($tables, true);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Get team
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['teams']}` WHERE `id`='{$id}'";
        $data['team'] = $this->query($q);

        if(empty($data['team'])) {
            $this->redirect('pixieteams', 'error', esc_html__('Team not found!', 'pixiehugepanel'));
            return false;
        }

        // Get Players
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['players']}` WHERE `team_id`='{$id}' ORDER BY `orderNum` ASC";
        $data['players'] = $this->query($q);


        // Get achievements
        $q = "SELECT * FROM `{$tables['achievements']}` WHERE `team_id`='{$id}' ";
        $data['achievements'] = $this->query($q);


        // Menu
        $data['menu'] = [
            ['id'    => 'home', 'name'  => 'Edit team'],
            ['id'    => 'players', 'name'  => 'Players'],
            ['id'    => 'addplayer', 'name'  => 'Add player'],
            ['id' => 'achievements', 'name' => 'Achievements'],
        ];

        $this->view('team/edit', $data);

    }

    public function delete($tables) {
        global $wpdb;

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieteams');
            return false;
        }

        // Remove action
        $id = esc_sql($_REQUEST['id']);
        $wpdb->delete( $tables['teams'], ['id' => $id]);

        $this->redirect('pixieteams', 'success', esc_html__('You have successfully deleted this team!', 'pixiehugepanel'));
        return false;

    }

    public function playerdelete($tables) {
        global $wpdb;

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);
        $_REQUEST['teamid'] = esc_sql($_REQUEST['teamid']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieteams');
            return false;
        }

        // Remove action
        $id = esc_sql($_REQUEST['id']);
        $teamid = (int)$_REQUEST['teamid'];
        $wpdb->delete( $tables['players'], ['id' => $id]);

        $this->redirect('pixiehugepanel', 'success', esc_html__('You have successfully deleted this player!', 'pixiehugepanel'), '&action=edit&id='.$teamid);
        return false;

    }

    public function achievementdelete($tables) {
        global $wpdb;

        // ID
        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieteams');
            return false;
        }

        // Remove action
        $id = esc_sql($_REQUEST['id']);
        $wpdb->delete( $tables['achievements'], ['id' => $id]);

        $this->redirect('pixiehugeteams', 'success', esc_html__('You have successfully deleted this achievement!', 'pixiehugepanel'), '&action=edit&id='.$teamid);
        return false;

    }

    private function save($tables, $insert = true) {
        global $wpdb;

        $data = [
            'name'              => stripslashes_deep($_REQUEST['name']),
            'slug'              => sanitize_title($_REQUEST['name']),
            'subtitle'          => stripslashes_deep($_REQUEST['subtitle']),
            'game_logo'         => stripslashes_deep($_REQUEST['game_logo']),
            'team_logo'         => stripslashes_deep($_REQUEST['team_logo']),
            'cover'             => stripslashes_deep($_REQUEST['cover']),
            'thumbnail'         => stripslashes_deep($_REQUEST['thumbnail']),
            'about'             => stripslashes_deep($_REQUEST['about']),
            'country'           => stripslashes_deep($_REQUEST['country']),
            'year_founded'      => stripslashes_deep($_REQUEST['year_founded']),
            'my_team'           => stripslashes_deep($_REQUEST['my_team']),
            'stats'             => json_encode(stripslashes_deep($_REQUEST['stats'])),
            'created_at'        => date('Y-m-d H:i:s', time()),
        ];

        $error = false;
        if(empty($data['name'])){
            $error = true;
        }

        $sql = '';
        if(!empty($_REQUEST['id'])) {
            $id = esc_sql($_REQUEST['id']);
            $sql = "`id`!='{$id}' AND ";
        }
        $q = "SELECT * FROM `{$tables['teams']}` WHERE {$sql}`name`='{$data['name']}'";
        $checkTeam = $wpdb->query($q);

        if($checkTeam) {
            return esc_html__('Team already exists', 'pixiehugepanel');
        }

        if(!$error) {

            if($insert) {
                // Insert
                $wpdb->insert( $tables['teams'], $data);
                return esc_html__('Team added!', 'pixiehugepanel');
            } else {
                // Update
                unset($data['created_at']);

                $id = esc_sql($_REQUEST['id']);
                $wpdb->update( $tables['teams'], $data, ['id' => $id]);
                return esc_html__('Team updated!', 'pixiehugepanel');
            }
        } else {
            return esc_html__('Please fill in required fields', 'pixiehugepanel');
        }
        
    }

    private function save_achievement($tables, $insert = true) {
        global $wpdb;

        $data = [
            'team_id'               => (int)$_REQUEST['team_id'],
            'name'                  => stripslashes_deep($_REQUEST['name']),
            'description'           => stripslashes_deep($_REQUEST['description']),
            'place'                 => stripslashes_deep($_REQUEST['place']),
            'created_at'            => date('Y-m-d H:i:s', time()),
        ];

        $error = false;
        if(empty($data['name'])){
            $error = true;
        }

        if(!$error) {

            if($insert) {
                // Insert
                $wpdb->insert( $tables['achievements'], $data);
                return esc_html__('Achievement added!', 'pixiehugepanel');
            } else {
                // Update
                unset($data['created_at']);

                $id = stripslashes_deep($_REQUEST['id']);
                $wpdb->update( $tables['achievements'], $data, ['id' => $id]);
                return esc_html__('Achievement updated!', 'pixiehugepanel');
            }
        } else {
            return esc_html__('Please fill in required fields', 'pixiehugepanel');
        }
        
    }
    
    public function playeredit($tables) {

        // Update Player

        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'player') {
                $saveInfo = $this->save_player($tables, false);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Other
        $data['menu'][] = [
            'id'    => 'home', // ID
            'name'  => 'Edit player', // NAME
        ];

        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieteams', 'error', esc_html__('Player not found', 'pixiehugepanel'));
            return false;
        }
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['players']}` WHERE `id`='{$id}'";
        $data['player'] = $this->query($q);
        
        if(empty($data['player'])) {
            $this->redirect('pixieteams', 'error', esc_html__('Player not found', 'pixiehugepanel'));
        }

        return $this->view('team/editplayer',$data);
    }
    
    public function achievement($tables) {

        // Update Player

        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'update_achievement') {
                $saveInfo = $this->save_achievement($tables, false);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Other
        $data['menu'][] = [
            'id'    => 'home', // ID
            'name'  => 'Edit achievement', // NAME
        ];

        $_REQUEST['id'] = stripslashes_deep($_REQUEST['id']);

        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieteams', 'error', esc_html__('Achievement not found', 'pixiehugepanel'));
            return false;
        }
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['achievements']}` WHERE `id`='{$id}'";
        $data['achievement'] = $this->query($q);
        
        if(empty($data['achievement'])) {
            $this->redirect('pixieteams', 'error', esc_html__('Achievement not found', 'pixiehugepanel'));
        }

        return $this->view('team/achievement',$data);
    }

    private function save_player($tables, $insert = true) {
        global $wpdb;

        $data = [
            'team_id'               => stripslashes_deep($_REQUEST['team_id']),
            'avatar'                => stripslashes_deep($_REQUEST['avatar']),
            'cover'                 => stripslashes_deep($_REQUEST['cover']),
            'role_icon'             => stripslashes_deep($_REQUEST['role_icon']),
            'firstname'             => stripslashes_deep($_REQUEST['firstname']),
            'lastname'              => stripslashes_deep($_REQUEST['lastname']),
            'nick'                  => stripslashes_deep($_REQUEST['nick']),
            'slug'                  => sanitize_title($_REQUEST['nick']),
            'about'                 => stripslashes_deep($_REQUEST['about']),
            'country'               => stripslashes_deep($_REQUEST['country']),
            'role'                  => stripslashes_deep($_REQUEST['role']),
            'age'                   => stripslashes_deep($_REQUEST['age']),
            'equipment'             => json_encode(stripslashes_deep($_REQUEST['equip'])),
            'stats'                 => json_encode(stripslashes_deep($_REQUEST['stats'])),
            'social'                => json_encode(stripslashes_deep($_REQUEST['social'])),
            'created_at'            => date('Y-m-d H:i:s', time()),
        ];

        $error = false;
        if(empty($data['firstname']) || empty($data['nick'])){
            $error = true;
        }

        // Check exists
        $sql = '';
        if(!empty($_REQUEST['id'])) {
            $id = esc_sql($_REQUEST['id']);
            $sql = "`id`!='{$id}' AND ";
        }
        $q = "SELECT * FROM `{$tables['players']}` WHERE {$sql}`nick`='{$data['nick']}'";
        $checkTeam = $wpdb->query($q);

        if($checkTeam) {
            return esc_html__('Player already exists', 'pixiehugepanel');
        }

        if(!$error) {

            if($insert) {

                // Get Players
                $id = esc_sql($_REQUEST['id']);
                $q = "SELECT `orderNum` FROM `{$tables['players']}` WHERE `team_id`='{$id}' ORDER BY `orderNum` ASC LIMIT 1";
                $orderNum = ($this->query($q)) ? $this->query($q)[0]['orderNum'] : 0;
                $data['orderNum'] = $orderNum + 1;

                // Insert
                $wpdb->insert( $tables['players'], $data);
                return esc_html__('Player added!', 'pixiehugepanel');
            } else {

                // Update
                $id = stripslashes_deep($_REQUEST['id']);
                unset($data['created_at']);
                unset($data['team_id']);

                $wpdb->update( $tables['players'], $data, ['id' => $id]);
                return esc_html__('Player updated!', 'pixiehugepanel');
            }
        } else {
            return esc_html__('Please fill in required fields', 'pixiehugepanel');
        }
        
    }

}