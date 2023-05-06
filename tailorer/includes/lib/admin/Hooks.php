<?php

namespace Tailorer\Library\Admin;

/**
 * Defines all action/filter hooks to be added for the admin-area.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Admin
 */
final class Hooks
{
    /** Disallow creating instances */
    private function __construct()
    {
    }

    /**
     * Registers/Adds all action/filter hooks associated with the admin-area.
     * @return  void
     */
    public static function register_hooks(): void
    {
        // Adds the top-level page for the three custom post types.
        add_action('admin_menu', [Menu::class, 'add_product_parts_toplevel_menu'], 10, 2);

        // Add Product Part terms to the WooCommerce "Products" menu tab as a submenu
        add_action('admin_menu', [Menu::class, 'manage_product_part_terms_submenu'], 10, 3);
        
    }
}