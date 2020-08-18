<?php
/**
 * Plugin Name: WooCommerce common thumbnail for variation attribute
 * Description: Set a thumbnail for a variation attribute which will be shown for all variations with this attribute
 * Author: Tom Broucke
 * Author URI: https://tombroucke.be
 * Version: 1.0.1
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wc-variation-general-thumbnail
 * Domain Path: languages
 */

namespace Otomaties\WC_Variation_General_Thumbnail;

defined( 'ABSPATH' ) || exit;

/**
 * Plugin initialization
 */
class WC_Variation_General_Thumbnail {

	/**
	 * The WC_Variation_General_Thumbnail object
	 *
	 * @var mixed
	 */
	private static $_instance = null;

	/**
	 * Get instance
	 *
	 * @return WC_Variation_General_Thumbnail Plugin instance.
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Plugin constructor
	 */
	private function __construct() {
		$this->load_textdomain();
		$this->includes();
		$this->init();
	}

	/**
	 * Allow for translation
	 *
	 * @return void
	 */
	private function load_textdomain() {
		load_plugin_textdomain( 'wc-variation-general-thumbnail', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Include all classes
	 *
	 * @return void
	 */
	private function includes() {
		include plugin_dir_path( __FILE__ ) . '/includes/class-admin.php';
		include plugin_dir_path( __FILE__ ) . '/includes/class-frontend.php';
	}

	/**
	 * Initialize classes
	 *
	 * @return void
	 */
	private function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Enqueue custom script
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		$version = '1.0.0';
		wp_enqueue_style( 'variation-general-thumbnail-css', plugins_url( 'css/wc-variation-general-thumbnail-admin.css', __FILE__ ), array(), $version );
		wp_enqueue_script( 'variation-general-thumbnail-js', plugins_url( 'js/wc-variation-general-thumbnail-admin.js', __FILE__ ), array( 'jquery' ), $version );
	}
}

add_action( 'plugins_loaded', 'Otomaties\\WC_Variation_General_Thumbnail\\WC_Variation_General_Thumbnail::instance' );
