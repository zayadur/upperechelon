<?php

use PixieHuge\Controller;

class pixiehugematchesController extends Controller
{
    
    public function index($tables) {

        // Create menu
        $data['menu'] = [
            ['id' => 'home', 'name' => 'General Settings'],
            ['id' => 'matches', 'name' => 'Matches'],
            ['id' => 'add', 'name' => 'Add match'],
            ['id' => 'map', 'name' => 'Maps'],
        ];

        // Save Information
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type'])) {
            	if($_REQUEST['type'] == 'add') {
		            $saveInfo = $this->save($tables, true);
	            } elseif($_REQUEST['type'] == 'add_map') {
		            $saveInfo = $this->saveMap($tables, true);
	            }
            }
        }

        $data['saveInfo'] = $saveInfo;

        // Get Matches
        $q = "SELECT * FROM `{$tables['matches']}`";
        $data['matches'] = $this->query($q);

        // Get Streams
        $q = "SELECT * FROM `{$tables['streams']}`";
        $data['streams'] = $this->query($q);

        // Get Teams
        $q = "SELECT * FROM `{$tables['teams']}`";
        $data['teams'] = $this->query($q);

        // Get Maps
        $q = "SELECT * FROM `{$tables['maps']}`";
        $data['maps'] = $this->query($q);


        $this->view('match/index', $data);

    }

    private function save($tables, $insert = true) {
        global $wpdb;

        $data = [
            'team_a_id'         => (int)$_REQUEST['team_a'],
            'team_b_id'         => (int)$_REQUEST['team_b'],
            'score_a'           => stripslashes_deep($_REQUEST['score_a']),
            'score_b'           => stripslashes_deep($_REQUEST['score_b']),
            'stream'            => (!empty($_REQUEST['stream']) ? stripslashes_deep($_REQUEST['stream']) : ''),
            'status'            => stripslashes_deep($_REQUEST['status']),
            'startdate'         => stripslashes_deep($_REQUEST['startdate']),
            'game'              => stripslashes_deep($_REQUEST['game']),
            'details'           => stripslashes_deep($_REQUEST['details']),
            'created_at'        => esc_attr(date('Y-m-d H:i:s', time())),
        ];

        $maps = json_encode(stripslashes_deep($_REQUEST['maps']));
	    $data['details']['maps'] = $maps;
	    $data['details'] = json_encode($data['details']);

        // Error
        $error = false;
        if( (empty($data['team_a_id']) || empty($data['team_b_id'])) || $data['team_a_id'] == $data['team_b_id']){
        	if($data['team_a_id'] == $data['team_b_id']) {
		        return esc_html__('Wrong team id', 'pixiehugepanel');
	        }
            $error = true;
        }

        if(!$error) {

        	// Get Team A
	        $q = "SELECT `name`,`team_logo` FROM `{$tables['teams']}` WHERE `id`='{$data['team_a_id']}'";
	        $teamA = $this->query($q);

        	// Get Team B
	        $q = "SELECT `name`,`team_logo` FROM `{$tables['teams']}` WHERE `id`='{$data['team_b_id']}'";
	        $teamB = $this->query($q);

	        // Check exists
	        if(empty($teamA) || empty($teamB)) {
		        return esc_html__('Wrong team id', 'pixiehugepanel');
	        }
	        $teamA = $teamA[0];
	        $teamB = $teamB[0];

	        // Set data
	        $data['team_a_name'] = $teamA['name'];
	        $data['team_a_logo'] = $teamA['team_logo'];
	        $data['team_b_name'] = $teamB['name'];
	        $data['team_b_logo'] = $teamB['team_logo'];

	        // Create slug
            $q = "SHOW TABLE STATUS LIKE '{$tables['matches']}'";
            $lastId = $this->query($q);
        
            if(!empty($lastId[0]['Auto_increment'])) {
                $lastId = $lastId[0]['Auto_increment'];
            } else {
                $lastId = 1;
            }

			$data['slug'] = $lastId . '-'. sanitize_title(strtolower($data['team_a_name'])) . '-' . sanitize_title(strtolower($data['team_b_name']));

			// Start date
            $data['startdate'] = date('Y-m-d H:i:s', strtotime($data['startdate']));
            if($insert) {
                
                // Insert
                $wpdb->insert( $tables['matches'], $data);
                return esc_html__('Match added!', 'pixiehugepanel');
            } else {
                // Update
                unset($data['created_at']);

                $id = esc_sql($_REQUEST['id']);
                $data['slug'] = $id . '-' . sanitize_title(strtolower($data['team_a_name'])) . '-' . sanitize_title(strtolower($data['team_b_name']));
                $wpdb->update( $tables['matches'], $data, ['id' => $id]);
                return esc_html__('Match updated!', 'pixiehugepanel');
            }
        } else {
            return esc_html__('Please fill in required fields', 'pixiehugepanel');
        }
        
    }

    private function saveMap($tables, $insert = true) {
        global $wpdb;

        $data = [
            'name'              => stripslashes_deep($_REQUEST['name']),
            'image'           => stripslashes_deep($_REQUEST['image']),
            'created_at'        => esc_attr(date('Y-m-d H:i:s', time())),
        ];

        // Error
        $error = false;
        if( (empty($data['name']) || empty($data['image']))){
            $error = true;
        }

        if(!$error) {
            if($insert) {
                // Insert
                $wpdb->insert( $tables['maps'], $data);

                return esc_html__('Map added!', 'pixiehugepanel');
            } else {
                // Update
                unset($data['created_at']);

                $id = esc_sql($_REQUEST['id']);
                $wpdb->update( $tables['maps'], $data, ['id' => $id]);
                return esc_html__('Map updated!', 'pixiehugepanel');
            }
        } else {
            return esc_html__('Please fill in required fields', 'pixiehugepanel');
        }

    }

    public function edit($tables) {

        // Save changes
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'update') {
                $saveInfo = $this->save($tables, false);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Other
        $data['menu'][] = [
            'id'    => 'home', // ID
            'name'  => 'Edit match', // NAME
        ];

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        if(empty($_REQUEST['id'])) {
            $this->redirect('pixiehugematches', 'error', esc_html__('Match not found', 'pixiehugepanel'));
            return false;
        }

        // Get Match
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['matches']}` WHERE `id`='{$id}'";
        $data['match'] = $this->query($q);

        if(empty($data['match'])) {
            $this->redirect('pixiehugematches', 'error', esc_html__('Match not found', 'pixiehugepanel'));
        }

        // Get Streams
        $q = "SELECT * FROM `{$tables['streams']}`";
        $data['streams'] = $this->query($q);

        // Get Teams
        $q = "SELECT * FROM `{$tables['teams']}`";
        $data['teams'] = $this->query($q);

        // Get Maps
        $q = "SELECT * FROM `{$tables['maps']}`";
        $data['maps'] = $this->query($q);

        return $this->view('match/edit',$data);
    }

    public function map($tables) {

        // Save changes
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'update') {
                $saveInfo = $this->saveMap($tables, false);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Other
        $data['menu'][] = [
            'id'    => 'home', // ID
            'name'  => 'Edit map', // NAME
        ];

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        if(empty($_REQUEST['id'])) {
            $this->redirect('pixiehugematches', 'error', esc_html__('Map not found', 'pixiehugepanel'));
            return false;
        }

        // Get Match
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['maps']}` WHERE `id`='{$id}'";
        $data['map'] = $this->query($q);

        if(empty($data['map'])) {
            $this->redirect('pixiehugematches', 'error', esc_html__('Map not found', 'pixiehugepanel'));
        }

        return $this->view('match/editmap',$data);
    }

    public function delete($tables) {
        global $wpdb;

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixiehugematches');
            return false;
        }

        // Remove action
        $id = esc_sql($_REQUEST['id']);
        $wpdb->delete( $tables['matches'], ['id' => $id]);

        $this->redirect('pixiehugematches', 'success', esc_html__('You have successfully deleted this match!', 'pixiehugepanel'));
        return false;

    }

}