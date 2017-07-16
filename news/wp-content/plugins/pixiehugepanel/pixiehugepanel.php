<?php

/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       PixieHuge - Panel
 * Plugin URI:        http://www.pixiesquad.com
 * Description:       This plugin is intended to help customers with the Website administration and customization.
 * Version:           1.0.2
 * Author:            PixieSquad
 * Author URI:        http://www.pixiesquad.com/
 * Text Domain:       pixiehugepanel
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Constants
define('PIXIEHUGE_LOC_URL', plugin_dir_url( __FILE__ ));
define('PIXIEHUGE_LOC_DIR', plugin_dir_path( __FILE__ ));

function activate_pixiehugepanel() {
	require_once plugin_dir_path( __FILE__ ) . 'app/includes/pixiehugepanel-activator.php';
	PixieHugePanel_Activator::activate();
}

function deactivate_pixiehugepanel() {
	require_once plugin_dir_path( __FILE__ ) . 'app/includes/pixiehugepanel-deactivator.php';
    PixieHugePanel_Deactivator::deactivate();
}

// Ajax proccess
require plugin_dir_path( __FILE__ ) . 'app/core/Ajax.php';

register_activation_hook( __FILE__, 'activate_pixiehugepanel' );
register_deactivation_hook( __FILE__, 'deactivate_pixiehugepanel' );

// Autoload
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
require plugin_dir_path( __FILE__ ) . 'app/core/App.php';
require plugin_dir_path( __FILE__ ) . 'app/core/Controller.php';
require plugin_dir_path( __FILE__ ) . 'app/core/Stream.php';
require plugin_dir_path( __FILE__ ) . 'app/includes/pixiehugepanel-vars.php';

function run_pixiehugepanel() {
	$app = new PixieHuge\App();
}
run_pixiehugepanel();