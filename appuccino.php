<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://appuccino.xyz/
 * @since             1.0.0
 * @package           Appuccino
 *
 * @wordpress-plugin
 * Plugin Name:       Appuccino
 * Plugin URI:        https://appuccino.xyz/wordpress
 * Description:       Build an app in the time it takes to make a coffee.
 * Version:           1.0.0
 * Author:            Appuccino
 * Author URI:        https://appuccino.xyz/about
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       appuccino
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'APPUCCINO_VERSION', '1.0.0' );



function register_appuccino_menu_item() {
    add_menu_page('Appuccino', 'Appuccino', 'add_users', 'appuccino', 'appuccino_menu_item', null, 6);
}
add_action('admin_menu', 'register_appuccino_menu_item');

function appuccino_menu_item() {
   require 'admin/partials/appuccino-admin-display.php';
}


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-appuccino-activator.php
 */
function activate_appuccino() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-appuccino-activator.php';
	Appuccino_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-appuccino-deactivator.php
 */
function deactivate_appuccino() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-appuccino-deactivator.php';
	Appuccino_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_appuccino' );
register_deactivation_hook( __FILE__, 'deactivate_appuccino' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-appuccino.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_appuccino() {

	$plugin = new Appuccino();
	$plugin->run();

}
run_appuccino();
