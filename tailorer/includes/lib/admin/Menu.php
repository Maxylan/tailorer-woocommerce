<?php

namespace Tailorer\Library\Admin;

use Tailorer\Core;
use Tailorer\Library\Taxonomies;

/**
 * Defines the callbacks and functionality for the admin menu.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Admin
 */
final class Menu
{
    /** Disallow creating instances */
    private function __construct()
    {
    }

    /**
     * Adds the top-level wp-admin area menu page for the product-parts taxonomy.
     * @hook: admin_menu
     * @return  void
     */
    public static function add_product_parts_toplevel_menu(): void
    {
        \add_menu_page(
            Taxonomies\ProductPart::get_taxonomy_name_plural(), 
            Taxonomies\ProductPart::get_name_plural(), 
            Taxonomies\ProductPart::$capabilities['manage_terms'], 
            'edit.php?page='.Taxonomies\ProductPart::get_taxonomy_name_plural(),
            [Menu::class, 'product_parts_toplevel_menu_callback'],
            'dashicons-image-filter', 56
        );
    }

    /**
     * Adds a submenu for editing the terms of the product-part taxonomy under
     * the "Products" top-level page of the wp-admin area.
     * @hook: admin_menu
     * @return  void
     */
    public static function manage_product_part_terms_submenu(): void 
    {
        \add_submenu_page(
            'edit.php?post_type=product',
            Taxonomies\ProductPart::get_name_plural(),
            Taxonomies\ProductPart::get_name_plural(),
            Taxonomies\ProductPart::$capabilities['manage_terms'],
            Taxonomies\ProductPart::get_taxonomy_name(), 
            [EditProductParts::class, 'init'], 1
        );
    }
}