<?php
/**
 * Plugin Name.
 *
 * @package   Wp_Mcs_Admin
 * @author    Aaron Lee <aaron.lee@buooy.com>
 * @license   GPL-2.0+
 * @link      http://buooy.com
 * @copyright 2013 Buooy
 */

/**
 *
 * @package Wp_Mcs_Admin
 * @author    Aaron Lee <aaron.lee@buooy.com>
 */
include_once( 'views/admin.php' );

class Wp_Mcs_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	public function __construct() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		/*
		 * Call $plugin_slug from public plugin class.
		 *
		 * @TODO:
		 *
		 * - Rename "Wp_Mcs" to the name of your initial plugin class
		 *
		 */
		$plugin = Wp_Mcs::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		// Add action ajax for admin page
		add_action( 'wp_ajax_wp_mcs',  array($this,'wp_mcs_ajax_callback') );

	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @TODO:
	 *
	 * - Rename "Wp_Mcs" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), time() );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @TODO:
	 *
	 * - Rename "Wp_Mcs" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Wp_Mcs::VERSION );
			
			wp_register_style( 'wp_mcs_datepicker_style', plugins_url( 'assets/css/smoothness/jquery-ui-1.10.4.custom.min.css"', __FILE__ ), false, false );
			wp_enqueue_style( 'wp_mcs_datepicker_style' );
			wp_enqueue_script( 'jquery-ui-datepicker' );

			wp_register_style( 'wp_mcs_bootstrap_style', plugins_url( 'assets/css/bootstrap.min.css"', __FILE__ ), false, false );
			wp_enqueue_style( 'wp_mcs_bootstrap_style' );

			wp_register_script( 'wp_mcs_bootstrap_script', plugins_url( 'assets/js/bootstrap.min.js"', __FILE__ ), false, false );
			wp_enqueue_script( 'wp_mcs_bootstrap_script' );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * @TODO:
		 *
		 * - Change 'Page Title' to the title of your plugin admin page
		 * - Change 'Menu Text' to the text for menu item for the plugin settings page
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */
		$admin_view = new Wp_Mcs_Admin_View;
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Maintenance & Coming Soon', $this->plugin_slug ),
			__( 'Maintenance & Coming Soon', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $admin_view, 'display_page' )
		);

	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	 * Add Ajax Callbacks
	 *
	 *	wp-mcs-type: deactivated, maintenance, comingsoon
	 *
	 *
	 */
	public function wp_mcs_ajax_callback(){

		// Option names
		$wp_mcs_options = array(
							'wp_mcs_mode' 	=> 	'wp-mcs-type',
							'wp_mcs_theme' 	=>	'wp-mcs-theme',
							'wp_mcs_redirect' 	=>	'wp-mcs-redirect',
							'wp_mcs_deadline'	=>	'wp-mcs-deadline',
							'wp_mcs_access_code'	=>	'wp-mcs-access-code',
						);

		$wp_mcs_types = array('deactivated','maintenance','comingsoon','redirect');
		$return = 	array(
						'status'	=>	'error',
						'msg'		=>	'Oops. An error has occurred.',
					);

		// Verify WP NONCE
		if( wp_verify_nonce( $_POST['_wpnonce'], 'update-wp-mcs' ) ){

			if( !in_array( $_POST['wp-mcs-type'], $wp_mcs_types )  ){
				$return['msg'] .= 'You did not insert a correct mode.';
			}
			else{

				foreach( $wp_mcs_options as $key=>$value ){
					update_option($key, $_POST[$value]);
					$return['status'] = 'success';
					$return['msg'] = 'The settings have been updated';
				}

			}

		}
		else{
			$return['msg'] = '\r\nVerification has failed.';
		}
		
		echo json_encode($return);
		die();
	}
	

}
