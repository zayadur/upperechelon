<?php

use PixieHuge\Controller;

class pixiehugesponsorsController extends Controller
{

    public function index($tables) {

        // Create menu
        $data['menu'] = [
            ['id' => 'home', 'name' => 'General Settings'],
            ['id' => 'sponsors', 'name' => 'Sponsors'],
            ['id' => 'add', 'name' => 'Add sponsor'],
        ];

        // Save Information
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'add') {
                $saveInfo = $this->save($tables, true);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Get Sponsors
        $q = "SELECT * FROM `{$tables['sponsors']}`";
        $data['sponsors'] = $this->query($q);

        $this->view('sponsor/index', $data);

    }

    private function save($tables, $insert = true) {
        global $wpdb;

        $data = [
            'logo'              => ( !empty($_REQUEST['logo']) ? stripslashes_deep($_REQUEST['logo']) : null ),
            'name'              => ( !empty($_REQUEST['name']) ? stripslashes_deep($_REQUEST['name']) : null ),
            'url'               => ( !empty($_REQUEST['url']) ? stripslashes_deep($_REQUEST['url']) : null ),
            'social'            => ( !empty($_REQUEST['social']) ? json_encode(stripslashes_deep($_REQUEST['social'])) : null ),
            'about'             => ( !empty($_REQUEST['about']) ? stripslashes_deep($_REQUEST['about']) : null ),
            'sponsor_category'  => ( !empty($_REQUEST['sponsor_category']) ? stripslashes_deep($_REQUEST['sponsor_category']) : null ),
            'sponsor_type'      => ( !empty($_REQUEST['sponsor_type']) ? (int)$_REQUEST['sponsor_type'] : null ),
            'created_at'        => date('Y-m-d H:i:s', time()),
        ];

        if(empty($_REQUEST['sponsor_type']) || ($_REQUEST['sponsor_type'] > 3 && $_REQUEST['sponsor_type'] < 1)) {
            $data['sponsor_type'] = 1;
        }
        $error = false;
        if(empty($data['name'])){
            $error = true;
        }

        if(empty($data['url']) || $data['url'] == '#') {
            $data['url'] = 'no';
        }


        if(!$error) {

            if($insert) {
                // Insert
                $wpdb->insert( $tables['sponsors'], $data);
                return esc_html__('Sponsor added!', 'pixiehugepanel');
            } else {
                // Update
                unset($data['created_at']);
                
                $id = esc_attr($_REQUEST['id']);
                $wpdb->update( $tables['sponsors'], $data, ['id' => $id]);
                return esc_html__('Sponsor updated!', 'pixiehugepanel');
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
            'name'  => 'Edit sponsor', // NAME
        ];

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        if(empty($_REQUEST['id'])) {
            $this->redirect('pixiesponsors', 'error', esc_html__('Sponsor not found', 'pixiehugepanel'));
            return false;
        }
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['sponsors']}` WHERE `id`='{$id}'";
        $data['sponsor'] = $this->query($q);
        
        if(empty($data['sponsor'])) {
            $this->redirect('pixiesponsors', 'error', esc_html__('Sponsor not found', 'pixiehugepanel'));
        }

        return $this->view('sponsor/edit',$data);
    }

    public function delete($tables) {
        global $wpdb;

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixiesponsors');
            return false;
        }

        // Remove action
        $id = esc_sql($_REQUEST['id']);
        $wpdb->delete( $tables['sponsors'], ['id' => $id]);

        $this->redirect('pixiesponsors', 'success', esc_html__('You have successfully deleted this sponsor!', 'pixiehugepanel'));
        return false;

    }

}