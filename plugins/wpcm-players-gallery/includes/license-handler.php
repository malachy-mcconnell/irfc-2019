<?php
define( 'WPCM_PG_PRODUCT_NAME', 'Players Gallery' );
define( 'WPCM_PG_STORE_URL', 'http://wpclubmanager.com' );

if( !class_exists( 'WPCM_PG_Updater' ) ) {
	// load our custom updater
	include( dirname( __FILE__ ) . '/WPCM_PG_Updater.php' );
	//include( plugins_url() . '/wp-club-manager/includes/WPCM_SL_Plugin_Updater.php';
}

function wpcm_pg_updater() {

	$license_key = trim( get_option( 'wpcm_pg_license_key' ) );

	// setup the updater
	$wpcm_pg_updater = new WPCM_PG_Updater( WPCM_PG_STORE_URL, __FILE__, array( 
			'version' 	=> '1.0',
			'license' 	=> $license_key,
			'item_name' => WPCM_PG_PRODUCT_NAME,
			'author' 	=> 'Clubpress'
		)
	);

}
add_action( 'admin_init', 'wpcm_pg_updater' );

function wpcm_pg_license_page( $settings ) {
	
	$settings[] = array( 
		'title' => WPCM_PG_PRODUCT_NAME,
		'type' => 'title',
		'desc' => '',
		'id' => 'extension_licenses'
	);

	$settings[] = array(
		'title' 	=> __( 'License key', 'wpcm_pg' ),
		'desc' 		=> '',
		'id' 		=> 'wpcm_pg_license_key',
		'css' 		=> 'width:320px;',
		'default'	=> '',
		'type' 		=> 'license_key'
	);
	$settings[] = array(
		'title' 	=> '',
		'desc' 		=> '',
		'id' 		=> 'wpcm_pg',
		'type' 		=> 'license_activate'
	);

	$settings[] = array( 'type' => 'sectionend', 'id' => 'extension_licenses');

	return $settings;
}
add_filter( 'wpclubmanager_license_settings' , 'wpcm_pg_license_page' );

function wpcm_pg_register_option() {
	register_setting('wpcm_pg_license', 'wpcm_pg_license_key', 'wpcm_pg_sanitize_license' );
}
add_action('admin_init', 'wpcm_pg_register_option');

function wpcm_pg_sanitize_license( $new ) {
	$old = get_option( 'wpcm_pg_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'wpcm_pg_license_status' );
	}
	return $new;
}

function wpcm_pg_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['wpcm_pg_license_activate'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'wpcm_pg_nonce', 'wpcm_pg_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'wpcm_pg_license_key' ) );
			

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'activate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( WPCM_PG_PRODUCT_NAME ) // the name of our product in EDD
		);
		
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, WPCM_PG_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'wpcm_pg_license_status', $license_data->license );

	}
}
add_action('admin_init', 'wpcm_pg_activate_license');

function wpcm_pg_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['wpcm_pg_license_deactivate'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'wpcm_pg_nonce', 'wpcm_pg_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'wpcm_pg_license_key' ) );
			

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'deactivate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( WPCM_PG_PRODUCT_NAME ) // the name of our product in EDD
		);
		
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, WPCM_PG_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'wpcm_pg_license_status' );

	}
}
add_action('admin_init', 'wpcm_pg_deactivate_license');