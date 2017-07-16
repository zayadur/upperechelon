<?php
use PixieHuge\Controller;

class pixiehugeaboutController extends Controller
{

    public function index($tables) {

        // Create menu
        $data['menu'] = [
            ['id' => 'home', 'name' => 'General Settings'],
            ['id' => 'members', 'name' => 'Board members'],
            ['id' => 'add', 'name' => 'Add member'],
        ];

        // Save Information
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'add') {
                $saveInfo = $this->save($tables, true);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Get Streams
        $q = "SELECT * FROM `{$tables['boardmembers']}`";
        $data['boardmembers'] = $this->query($q);

        $this->view('about/index', $data);

    }

    private function save($tables, $insert = true) {
        global $wpdb;

        $data = [
            'fullname'              => stripslashes_deep($_REQUEST['fullname']),
            'role'                  => stripslashes_deep($_REQUEST['role']),
            'category'              => stripslashes_deep($_REQUEST['category']),
            'avatar'                => stripslashes_deep($_REQUEST['avatar']),
            'social'                => json_encode(stripslashes_deep($_REQUEST['social'])),
            'created_at'            => esc_attr(date('Y-m-d H:i:s', time())),
        ];
        $error = false;
        if(empty($data['fullname']) || empty($data['role'])){
            $error = true;
        }

        if(!$error) {
            if($insert) {
                // Insert
                $wpdb->insert( $tables['boardmembers'], $data);
                return esc_html__('Board member added!', 'pixiehugepanel');
            } else {
                // Update
                unset($data['created_at']);
                
                $id = stripslashes_deep($_REQUEST['id']);
                $wpdb->update( $tables['boardmembers'], $data, ['id' => $id]);
                return esc_html__('Board member updated!', 'pixiehugepanel');
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
            'name'  => 'Edit board member', // NAME
        ];

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieabout', 'error', esc_html__('Board member not found', 'pixiehugepanel'));
            return false;
        }
        $id = esc_sql($_REQUEST['id']);
        $q = "SELECT * FROM `{$tables['boardmembers']}` WHERE `id`='{$id}'";
        $data['boardmember'] = $this->query($q);
        
        if(empty($data['boardmember'])) {
            $this->redirect('pixieabout', 'error', esc_html__('Board member not found', 'pixiehugepanel'));
        }

        return $this->view('about/edit',$data);
    }

    public function delete($tables) {
        global $wpdb;

        $_REQUEST['id'] = esc_sql($_REQUEST['id']);

        // Chek params
        if(empty($_REQUEST['id'])) {
            $this->redirect('pixieabout');
            return false;
        }

        // Remove action
        $id = esc_sql($_REQUEST['id']);
        $wpdb->delete( $tables['boardmembers'], ['id' => $id]);

        $this->redirect('pixieabout', 'success', esc_html__('You have successfully deleted this board member!', 'pixiehugepanel'));
        return false;

    }

}