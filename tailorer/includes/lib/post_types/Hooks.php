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
        // Assigns each custom post type its respective class
        add_filter( 'register_post_type_args', function ( $args, $post_type ) {
            switch($post_type) {
                case Type::get_post_type_name(): 
                    $args['class'] = Type::class;
                    break;
                case Fabric::get_post_type_name(): 
                    $args['class'] = Fabric::class;
                    break;
                case Pattern::get_post_type_name(): 
                    $args['class'] = Pattern::class;
                    break;
            };
            return $args;
        }, 10, 2 );

        // Set what editor will be used for different post types. true = Gutenberg, false = Classic Wysiwyg.
        add_filter( 'use_block_editor_for_post_type', function ( $use_block_editor, $post_type ) 
        {
            return match($post_type) {
                Type::get_post_type_name() => false,
                Fabric::get_post_type_name() => false,
                Pattern::get_post_type_name() => false,
                default => $use_block_editor
            };
        }, 12, 2 );

        // Automatically assign a "product_part" term to our three Custom Post Types that are related to Product Parts upon creation.
        add_action('wp_insert_post', [Functions::class, 'assign_product_part_term'], 10, 3);

        // Automatically draft all WooCommerce products that has a relation to the Custom Post Type that was deleted.
        add_action('before_delete_post', [Products\Functions::class, 'draft_attached_products'], 10, 1); // TODO!
    }
}