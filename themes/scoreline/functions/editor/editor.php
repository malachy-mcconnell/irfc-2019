<?php

add_action( 'admin_init', 'add_shortcode_button' );
add_filter( 'tiny_mce_version', 'refresh_mce' );


function add_shortcode_button() {

	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) return;

	if ( get_user_option('rich_editing') == 'true' ) :
		add_filter( 'mce_external_plugins', 'add_shortcode_tinymce_plugin' );
		add_filter( 'mce_buttons_3', 'register_shortcode_button' );
	endif;
}

function register_shortcode_button($buttons) {

	array_push( $buttons, "cp_players" );

	return $buttons;
}

function add_shortcode_tinymce_plugin($plugin_array) {

	$plugin_array['cp_players']   = get_template_directory_uri() . '/functions/editor/editor-plugin.js';

	return $plugin_array;
}

function refresh_mce( $ver ) {
	
	$ver += 3;
	return $ver;
}