<?php

namespace Tailorer\Library\Admin;

use Tailorer\Core;
use Tailorer\Library\Taxonomies;
use Tailorer\Library\PostTypes;

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
    public static array $parts = [];
    public static array $posts = [];
    public static array $row_headers = [];
    public static array $row_actions = [];

    public static function init(): void 
    {
        // Do stuff.
        self::$parts = \get_terms([
            'taxonomy' => Taxonomies\ProductPart::get_taxonomy_name(),
            'hide_empty' => false,
        ]);

        // Get posts and group them by their product-part.
        foreach(self::$parts as $part) 
        {
            self::$posts[$part->term_id] = \get_posts([
                'post_type' => Taxonomies\ProductPart::get_associated_post_type($part) ?: [ 
                    // Should still work on default because our tax_query checks for inheriting term.
                    PostTypes\Type::get_post_type_name(),
                    PostTypes\Fabric::get_post_type_name(),
                    PostTypes\Pattern::get_post_type_name(),
                ],
                'tax_query' => [
                    [
                        'taxonomy' => Taxonomies\ProductPart::get_taxonomy_name(),
                        'field' => 'slug',
                        'terms' => $part->slug,
                    ]
                ],
                'hide_empty' => false,
            ]);
        }

        self::$row_headers = \apply_filters('tailorer_edit_product_parts_row_headers', [
            '<th scope="col" id="name" class="manage-column column-name column-primary"><span>Name</span></th>',
            '<th scope="col" id="description" class="manage-column column-description"><span>Description</span></th>',
            '<th scope="col" id="slug" class="manage-column column-slug"><span>Slug</span></th>',
            '<th scope="col" id="posts" class="manage-column column-posts num"><span>Count</span></th>'
        ], self::$parts, self::$posts);

        self::$row_actions = \apply_filters('tailorer_edit_product_parts_row_actions', [
            'edit', 'view_list', 'view_store'
        ]);

        self::render();
    }

    public static function render_product_part_row_headers(): void {
        foreach(self::$row_headers as $header) {
            echo $header;
        }
    }

    public static function render_product_part_row(\WP_Term $part): void {
    }

    /**
     * Renders the Product Parts edit-term page.
     * @return	void
     */
    public static function render(): void
    {
        if (empty(self::$parts)) {
            self::init();
        }

        include Core::view('edit-product-parts') ?: \get_theme_file_path('index.php');
    }
}