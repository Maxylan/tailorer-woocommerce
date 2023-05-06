<?php

namespace Tailorer\Library\Admin;

use Tailorer\Core;

// If called directly; Initialize, then render.
if (!defined('ABSPATH')) {
    /** WordPress Administration Bootstrap */
    require_once __DIR__ . '/admin.php';
    require_once ABSPATH . 'wp-admin/admin-header.php';
    EditProductParts::init();
    require_once ABSPATH . 'wp-admin/admin-footer.php';
}

/**
 * Handles the edit-tags page for the Product Parts term.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Admin
 */
final class EditProductParts
{

    public static function init(): void 
    {
        // Do stuff.
        
        EditProductParts::render();
    }

    /**
     * Renders the Product Parts edit-term page.
     * @return	void
     */
    public static function render(): void
    {
        Core::view('edit-product-parts');
    }
}