<?php
/**
 * Plugin Name: Ewebdevs Post Popup
 * Description: This plugin working for any kind of post popup quick view.
 * Plugin URI:  https://ewebdevs.com
 * Version:     1.0.0
 * Author:      ewebdevs
 * Author URI:  https://ewebdevs.com/popup
 * Text Domain: ewebdevs-popup
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main langona Companion Class
 *
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */


final class ewebdevspopup {

	/**
	 * Plugin Version
	 *
	 * @since 1.2.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.2.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'plugins_loaded', array( $this, 'widget_fronted_scripts' ) );
		add_action( 'plugins_loaded', array( $this, 'widget_styles' ) );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'ewebdevs-popup', plugins_url() . '/languages' );
	}


	function widget_fronted_scripts(){
		wp_enqueue_script("bootstrap-js",plugins_url("/assets/js/bootstrap.min.js",__FILE__),array('jquery'),'5.0.0',true);
		wp_enqueue_script("script-js",plugins_url("/assets/js/script.js",__FILE__),array('jquery'),'1.0',true);
	}

	function widget_styles(){
		wp_enqueue_style("animate-css-css", plugins_url("/assets/css/style.css", __FILE__));
		wp_enqueue_style("botstrap-css-css", plugins_url("/assets/css/bootstrap.css", __FILE__));
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ewebdevs-popup' ),
			'<strong>' . esc_html__( 'Elements Popup', 'ewebdevs-popup' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ewebdevs-popup' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ewebdevs-popup' ),
			'<strong>' . esc_html__( 'Elements Popup', 'ewebdevs-popup' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ewebdevs-popup' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */

	public function init() {
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		require_once( 'plugin.php' );
		require_once( 'popup.php' );
	}

}

new ewebdevspopup();
