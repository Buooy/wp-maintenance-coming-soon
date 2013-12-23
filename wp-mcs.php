<?php
/**
 *
 * @package   Wp_Mcs
 * @author    Aaron Lee <aaron.lee@buooy.com>
 * @license   GPL-2.0+
 * @link      http://buooy.com
 * @copyright 2013 Buooy
 *
 * @wordpress-plugin
 * Plugin Name:       WP Maintenance and Coming Soon
 * Plugin URI:        http://buooy.com
 * Description:       WP Maintenance and Coming Soon is a custom plugin by Buooy
 * Version:           1.0.0
 * Author:            Aaron Lee
 * Author URI:        http://buooy.com

 * Text Domain:       wp-mcs-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/Buooy/wp-mcs
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-wp-mcs.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Wp_Mcs', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Wp_Mcs', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Wp_Mcs', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-admin.php` with the name of the plugin's admin file
 * - replace Wp_Mcs_Admin with the name of the class defined in
 *   `class-wp-mcs-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-wp-mcs-admin.php' );
	add_action( 'plugins_loaded', array( 'Wp_Mcs_Admin', 'get_instance' ) );

}
