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
 * The code that runs during plugin activation.
 */
register_activation_hook( __FILE__, [Tailorer\Core::class, 'activate'] );

/**
 * The code that runs during plugin deactivation.
 */
register_deactivation_hook( __FILE__, [Tailorer\Core::class, 'deactivate'] );


/**
 * Start Tailorer.
 */
Tailorer\Core::run();