<?php

/**
 * @since             1.0.0
 * @package           Kfr_addons
 *
 * @wordpress-plugin
 * Plugin Name:       Kfr Elementor Addons
 * Description:       Kfr-Addons is an addon of Elementor Page Builder.
 * Version:           1.0.0
 * Author:            Rampus
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kfr-addons
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 */
define( 'KFR_ADDONS_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kfr-addons.php';

/**
 * Begins execution of the plugin. *
 * @since    1.0.0
 */
function run_kfr_addons() {

    $plugin = new Kfr_Addons();
    $plugin->run();

}
add_action( 'plugins_loaded', 'run_kfr_addons' );