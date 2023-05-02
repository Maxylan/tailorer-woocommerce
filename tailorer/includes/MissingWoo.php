<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/classes
 */

namespace Tailorer;

use Tailorer\Core;

/**
 * The core plugin class in the absence of WooCommerce.
 *
 * Here you can define what happens in the absence of the plugin
 * WooCommerce that this is dependent on.
 *
 * @since      1.0-alpha
 * @package    Tailorer
 * @author     Maxylan (Max Olsson)
 */
final class MissingWoo
{
    /** Prevent instances of this from being created. */
    private function __construct()
    {
    }

    /**
     * Starts execution of the plugin!
     * 
     * @return  void
     */
    public static function run(): void
    {
        Core::log(__('WooCommerce is not active! Please install and activate WooCommerce (7+) to use this plugin.', 'tailorer'));

        // WooCommerce disabled
        self::register_hooks();
    }

    /**
     * Registers all action/filter hooks.
     * 
     * @return  void
     */
    public static function register_hooks(): void
    {
        // Registrators\Hooks::register_hooks();
    }
}