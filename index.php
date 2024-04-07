<?php
/**
 * Plugin Name: Pop up 
 * Author: Rupom
 * Desciption: Plugin description
 * Version: 1.0
 */
require_once plugin_dir_path( __FILE__ ).'/popup_metabox.php';

function callback_enqueue_scripts(){
	wp_enqueue_script('jquery');
    wp_enqueue_style( 'popup_css',plugin_dir_url( __FILE__ ).'/assets/css/style.css' );
    wp_enqueue_script( 'popup_js', plugin_dir_url( __FILE__ ).'/assets/js/jquery.plainmodal.min.js', null, '1.0', true);
    wp_enqueue_script( 'popup_main-js', plugin_dir_url( __FILE__ ).'/assets/js/main.js', array('jquery','popup_js'), time(),true);
}
add_action( 'wp_enqueue_scripts','callback_enqueue_scripts');
add_action( 'wp_footer', 'showing_popup');
function showing_popup(){
    ?>
    <div id="modal" class="open_modal"> hello popup
        <div>
          <button id="close-button"> close</button>
        </div>
    </div>
    <?php
}
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