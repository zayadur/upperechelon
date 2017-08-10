<?php

use PixieHuge\Controller;

class pixiehugepanelController extends Controller
{

    public function index($tables) {

        // Create menu
        $data['menu'] = [
            ['id' => 'home', 'name' => 'Social settings'],
            ['id' => 'header-settings', 'name' => 'Header settings'],
            ['id' => 'twitter-settings', 'name' => 'Twitter settings'],
	        ['id' => 'homepage-settings', 'name' => 'Section order'],
            ['id' => 'footer-settings', 'name' => 'Footer settings'],
	        ['id' => 'import-settings', 'name' => 'Demo content'],
        ];

      // Save Information
        $saveInfo = false;
        if(!empty($_REQUEST['type'])) {
            if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'importContent') {
                // $saveInfo = $this->export();
                $saveInfo = $this->importContent($tables, true);
            }
        }
        $data['saveInfo'] = $saveInfo;

        // Get sections
        $q = "SELECT * FROM `{$tables['sections']}` ORDER BY `orderNum` ASC";
	    $data['sections'] = $this->query($q);

        $this->view('home', $data);

    }

    private function importContent($tables, $insert = true) {
        global $wpdb;

        $data = [
            'demo'  => ( !empty($_REQUEST['demo_content']) ? stripslashes_deep($_REQUEST['demo_content']) : null ),
        ];

        $this->importSql($tables);
        if($data['demo'] == 1) {
            $this->importData('orange-elite');
        } elseif($data['demo'] == 2) {
            $this->importData('pink-prime');
        } elseif($data['demo'] == 3) {
            $this->importData('relentless-green');
        } elseif($data['demo'] == 4) {
            $this->importData('purple-haste');
        } elseif($data['demo'] == 5) {
            $this->importData('yellow-grenade');
        }
  
        return esc_html__('Imported!', 'pixiehugepanel');
    }

    private function importSql($tables) {
        global $wpdb;
        $base = dirname(__FILE__);

        $table_prefix = $wpdb->prefix;
        //drop, create and insert data for commentmeta

        $siteurl = home_url();
        $upload_dir = wp_upload_dir();
        $uploaddir = $upload_dir['baseurl'];

        include_once($base . '/../sql/import_teams.php');
        include_once($base . '/../sql/import_achievements.php');
        include_once($base . '/../sql/import_players.php');
        include_once($base . '/../sql/import_streams.php');
        include_once($base . '/../sql/import_sponsors.php');
        include_once($base . '/../sql/import_boardmembers.php');
        include_once($base . '/../sql/import_maps.php');
        include_once($base . '/../sql/import_matches.php');
    }

    private function export() {
        header("Cache-Control: public, must-revalidate");
        header("Pragma: hack");
        header("Content-Type: text/plain");
        header('Content-Disposition: attachment; filename="theme-options-' . date("y-m-d") . '.dat"');
        echo serialize($this->_get_options());
        
        die();
    }

    private function importData($file) {
        $base = dirname(__FILE__);

        $link = $base . '/../sql/'. $file .'.dat';
        $options = unserialize(file_get_contents($link));
        if ($options) {
            foreach ($options as $option) {
                
                $val = $option->option_value;
                if(@unserialize($option->option_value)) {
                    $val = unserialize($option->option_value);
                }

                update_option($option->option_name, $val);
            }
        }
    }

    private function _get_options() {
        global $wpdb;
        $query = "SELECT option_name, option_value FROM {$wpdb->options} WHERE `option_name` LIKE 'pixiehuge-%'";
        
        return $wpdb->get_results($query);
    }
}