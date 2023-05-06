<?php

namespace Tailorer\Library\PostTypes;

use Tailorer\Library\Products;

/**
 * Defines all action/filter hooks to be added for the plugin's Custom Post Types.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/PostTypes
 */
final class Hooks
{
    /** Disallow creating instances */
    private function __construct()
    {
    }

    /**
     * Registers/Adds all action/filter hooks associated with the plugin's Custom Post Types.
     * @return  void
     */
    public static function register_hooks(): void
    {
        // Set what editor will be used for different post types. true = Gutenberg, false = Classic Wysiwyg.
        add_filter( 'use_block_editor_for_post_type', function ( $use_block_editor, $post_type ) 
        {
            return match($post_type) {
                Type::get_post_type_name() => false,
                Type::get_post_type_name() => false,
                Type::get_post_type_name() => false,
                default => $use_block_editor
            };
        }, 12, 2 );

        // Automatically draft all WooCommerce products that has a relation to the Custom Post Type that was deleted.
        add_action('before_delete_post', [Products\Functions::class, 'draft_attached_products'], 10, 1); // TODO!
    }
}