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
define( 'TAILORER_DIR', wp_normalize_path( __DIR__.'/' ) );

/**
 * Plugin Directory URL
 */
define( 'TAILORER_URL', plugin_dir_url(__FILE__) );

/**
 * Plugin Directory relative to the Wordpress root.
 */
define( 'TAILORER_DIR_RELATIVE', 'wp-content/plugins/'.TAILORER_NAME.'/' );
