<?php
/**
 * Plugin Name: Pop up 
 * Author: Rupom
 * Desciption: Plugin description
 * Version: 1.0
 */
require_once plugin_dir_path( __FILE__ ).'/popup_metabox.php';
function register_popup_callback() {
	$labels = [
		"name" => "popups", 
		"singular_name" => "popup", 
		"add_new" => "Add New popup", 
		"add_new_item" => "Add New popup", 
        "featured_image" => "Popup image",
        "set_featured_image" => "Set popup image",
	];

	$args = [
		"label" => "popups", 
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"capability_type" => "post",
		"hierarchical" => true,
		"menu_position" => 12,
		"menu_icon" => "dashicons-media-interactive",
		"supports" => [ "title", "thumbnail",],
	];

	register_post_type( "popup", $args );
}
add_action( 'init', 'register_popup_callback' );

?>