<?php
namespace PixieHuge;

class App
{

    private $page = false;
    private $action = 'index';
    protected $controller = 'home';

	public $tables = array(
		'sponsors'          => 'pixiehuge_sponsor',
		'teams'             => 'pixiehuge_team',
		'players'           => 'pixiehuge_player',
		'streams'           => 'pixiehuge_stream',
		'matches'           => 'pixiehuge_match',
		'boardmembers'      => 'pixiehuge_boardmember',
		'achievements'      => 'pixiehuge_achievement',
		'maps'              => 'pixiehuge_maps',
		'sections'          => 'pixiehuge_section',
	);

    // constructor
    function __construct(){
        global $wpdb;
        global $wp_query;
        // prefixes for tables
        $prefix = $wpdb->prefix;

        foreach ($this->tables as $key => $table ) {
            $this->tables[$key] =  $prefix . $table;
        }

        $data = [];
        // initialize tables
        add_action('init', array($this, 'load_db'));

        // initialize pages
        $this->page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page'] != 'pixie-panel') ? $_REQUEST['page'] : 'home';

        add_action('admin_menu', array($this, 'loadPages'));
        add_action('init', array($this, 'global_vars'));
        // Other
        $this->loadOptions();
        $this->load_dependencies();
    }

    function global_vars(){
        global $wp_query;

        set_query_var('tables', $this->tables);
    }

    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/pixiehugepanel-widget.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/pixiehugepanel-i18n.php';

    }

    // load all tables
    public function load_db(){
        global $wpdb;

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        require_once plugin_dir_path( dirname( __FILE__ ) ) . '../database/scheme.php';

        $orderNum = $wpdb->get_row("SHOW COLUMNS FROM `{$this->tables['players']}` LIKE 'orderNum'");
        //Add column if not present.
        if(empty($orderNum)){
            $wpdb->query("ALTER TABLE `{$this->tables['players']}` ADD `orderNum` INT NULL DEFAULT NULL AFTER `hitbox`");
        }

    }

    // load all options
    private function loadOptions() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'core/Options.php';
        add_action('admin_init', 'pixiehuge_add_options');

    }

    // Make pages
    public function loadPages(){

        // Add main page
        add_menu_page(esc_html__('PixiePanel', 'pixiehugepanel'), esc_html__('PixiePanel', 'pixiehugepanel'), 'manage_options', 'pixiehugepanel', array($this, 'router'), plugin_dir_url(__FILE__ ) . '../../assets/admin/icon_star.svg');

        // Adding submenu pages
        add_submenu_page('pixiehugepanel', esc_html__('Teams', 'pixiehugepanel'), esc_html__('Teams', 'pixiehugepanel'), 'manage_options', 'pixiehugeteams', array($this, 'router'));
        add_submenu_page('pixiehugepanel', esc_html__('Streams', 'pixiehugepanel'), esc_html__('Streams', 'pixiehugepanel'), 'manage_options', 'pixiehugestreams', array($this, 'router'));
        add_submenu_page('pixiehugepanel', esc_html__('Matches', 'pixiehugepanel'), esc_html__('Matches', 'pixiehugepanel'), 'manage_options', 'pixiehugematches', array($this, 'router'));
        add_submenu_page('pixiehugepanel', esc_html__('Sponsors', 'pixiehugepanel'), esc_html__('Sponsors', 'pixiehugepanel'), 'manage_options', 'pixiehugesponsors', array($this, 'router'));
        add_submenu_page('pixiehugepanel', esc_html__('About', 'pixiehugepanel'), esc_html__('About', 'pixiehugepanel'), 'manage_options', 'pixiehugeabout', array($this, 'router'));
    }

    public function router() {

        // check if exists
        if(file_exists(plugin_dir_path( dirname( __FILE__ ) ) . 'controllers/' . $this->page . 'Controller.php')) {
            $this->controller = $this->page . 'Controller';
        }

        // initialize controller
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'controllers/' . $this->controller .'.php';

        $this->controller = new $this->controller;
        $this->action = (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) ? $_REQUEST['action'] : 'index';

        // Method exists
        if(method_exists($this->controller, $this->action)) {
            call_user_func_array([$this->controller, $this->action], ['tables' => $this->tables]);
        } else {
            die('Not found');
        }
    }
}
