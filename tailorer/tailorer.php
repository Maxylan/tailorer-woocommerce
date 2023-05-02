<?php
/**
 * Tailorer bootstrap file
 *
 * @author            Maxylan (Max Olsson)
 * @link              https://github.com/Maxylan
 *
 * @wordpress-plugin
 * Plugin Name:       Tailorer
 * Plugin URI:        https://github.com/Maxylan/tailorer-woocommerce
 * Description:       Tailorer is a WooCommerce-extension for Wordpress 6.2+ (PHP 8+) for tailorers and fabric manufacturers who want to sell custom-made products.
 * Version:           1.0-alpha
 * Author:            Maxylan (Max Olsson)
 * Author URI:        https://github.com/Maxylan
 * License:           CC BY-SA 4.0
 * License URI:       https://creativecommons.org/licenses/by/4.0/legalcode
 * Text Domain:       tailorer
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'TAILORER_VERSION', '1.0-alpha' );

/**
 * For additional configuration.
 */
require_once 'constants.php';

/**
 * For autoloading of files.
 */
require_once 'vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 */
register_activation_hook( __FILE__, [\Tailorer\Core::class, 'activate'] );

/**
 * The code that runs during plugin deactivation.
 */
register_deactivation_hook( __FILE__, [\Tailorer\Core::class, 'deactivate'] );

// Register "tailorer" text-domain. (Needs to be done from a script in the plugin root)
add_action( 'plugins_loaded', function () { 
    if (!is_textdomain_loaded('tailorer') && 
        !load_plugin_textdomain( 'tailorer', false, '/'.TAILORER_NAME.'/lang' ) && (
            defined('TAILORER_DEBUG') && TAILORER_DEBUG 
        )) 
    {   // If loading domain is not successfull, log it if the plugin is in debug-mode.
        // error_log(ucfirst(TAILORER_NAME).' could not load custom text domain! Translations will be missing! Check if the path to /lang/ is correct, it needs to be relative to WP_PLUGIN_DIR ('.WP_PLUGIN_DIR.')');
    }
});


/**
 * Start Tailorer.
 */
\Tailorer\Core::run();