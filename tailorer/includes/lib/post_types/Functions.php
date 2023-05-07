<?php

namespace Tailorer\Library\PostTypes;

use Tailorer\Core;
use Tailorer\Library\Taxonomies;

/**
 * Defines functionality surrounding Tailorer's custom post types.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/PostTypes
 */
final class Functions
{
    /** Disallow creating instances */
    private function __construct()
    {
    }

    /**
     * Convert a post-type name to its corresponding class name.
     * Defaults to \WP_Post if no match is found.
     * 
     * @return string
     */
    public static function get_class_of_post_type($post_type): string {
        return match($post_type) {
            Type::get_post_type_name() => Type::class,
            Fabric::get_post_type_name() => Fabric::class,
            Pattern::get_post_type_name() => Pattern::class,
            default => \WP_Post::class
        };
    }

    /**
     * Automatically assign a "product_part" term to our three Custom Post Types 
     * upon their creation.
     * 
     * @return void
     */
    public static function assign_product_part_term($post_id, $post, $update): void
    {
        $class = self::get_class_of_post_type($post->post_type);

        if (!$update && in_array($class, [Type::class, Fabric::class, Pattern::class])) {
            \wp_set_object_terms($post_id, $class::get_part_term(), Taxonomies\ProductPart::get_taxonomy_name());
        }
    }
}