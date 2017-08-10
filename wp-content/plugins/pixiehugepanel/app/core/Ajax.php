<?php

add_action( 'wp_ajax_pixiehugepanel_save_player_order', 'pixiehugepanel_save_player_order' );
function pixiehugepanel_save_player_order() {

	global $wpdb;

	$items = $_REQUEST['items'];
	foreach($items as $key => $item) {
		$wpdb->update( $wpdb->prefix . 'pixiehuge_player', ['orderNum' => $key], ['id' => $item]);
	}
	wp_die();
}

add_action( 'wp_ajax_pixiehugepanel_save_section_order', 'pixiehugepanel_save_section_order' );
function pixiehugepanel_save_section_order() {

	global $wpdb;

	$items = $_REQUEST['items'];
	foreach($items as $key => $item) {
		$wpdb->update( $wpdb->prefix . 'pixiehuge_section', ['orderNum' => $key], ['id' => $item]);
	}
	wp_die();
}