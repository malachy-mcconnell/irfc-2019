<?php
/**
* Plugin Name: WP Club Manager - Players Gallery
* Version: 1.0
* Plugin URI: https://wpclubmanager.com/extensions/players-gallery/
* Description: Adds a shortcode button to the TinyMCE editor which displays a Player or Staff Gallery anywhere on your site
* Author: Clubpress
* Author URI: http://wpclubmanager.com
*/


class WPCM_Players_Gallery {

	private static $instance;

	/**
	 * Get active object instance
	 *
	 * @since 1.0
	 *
	 * @access public
	 * @static
	 * @return object
	 */
	public static function get_instance() {

		if ( ! self::$instance )
			self::$instance = new WPCM_Players_Gallery();

		return self::$instance;
	}

	/**
	 * Class constructor.  Includes constants, includes and init method.
	 *
	 * @since 1.0
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		if( ! class_exists( 'WPClubManager' ) ) {
			return;
		}

		$this->constants();
		$this->includes();

	}

	/**
	 * Register generally helpful constants.
	 *
	 * @since 1.0
	 *
	 * @access private
	 * @return void
	 */
	private function constants() {

		define( 'WPCM_PG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define( 'WPCM_PG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		define( 'WPCM_PG_PLUGIN_FILE', __FILE__ );
		define( 'WPCM_PG_VERSION', '1.0' );

	} 

	/**
	 * Include files.
	 *
	 * @since 1.0
	 *
	 * @access private
	 * @return void
	 */
	private function includes() {

		include_once( WPCM_PG_PLUGIN_DIR . 'includes/license-handler.php' );
		include_once( WPCM_PG_PLUGIN_DIR . 'includes/players-gallery.php' );

	}
}

function wpcm_pg_load() {
	$GLOBALS['wpcm_pg'] = new WPCM_Players_Gallery();
}
add_action( 'plugins_loaded', 'wpcm_pg_load' );