<?php
/**
 * Defines constants used throughout the plugin.
 *
 * @author            Maxylan (Max Olsson)
 * @link              https://github.com/Maxylan
 */

// If this file is called directly, abort.
if ( ! defined( 'TAILORER_VERSION' ) ) {
	die;
}

/**
 * Plugin name/identifier.
 */
define( 'TAILORER_NAME', 'tailorer' );

/**
 * Debug/Development flag.
 */
define( 'TAILORER_DEBUG', true );

/**
 * Plugin Directory
 */
define( 'TAILORER_DIR', trailingslashit( wp_normalize_path( __DIR__ ) ) );

/**
 * Plugin Directory URL
 */
define( 'TAILORER_URL', plugin_dir_url(__FILE__) );

/**
 * Plugin Directory relative to the Wordpress root.
 */
define( 'TAILORER_DIR_RELATIVE', 'wp-content/plugins/'.TAILORER_NAME.'/' );

/**
 * Check if WooCommerce exists and is activated.
 * My recommendation is that you put WC in the folder "mu-plugins" so that
 * it will always be active, this plugin will not run without it.
 */
if ( !defined('WC_ACTIVE') ) 
{
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	define( 'WC_ACTIVE', is_plugin_active( 'woocommerce/woocommerce.php' ) );
}