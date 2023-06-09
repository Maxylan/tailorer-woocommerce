<?php

namespace Tailorer\Library\Taxonomies;

use Tailorer\Library\Registrators;
use Tailorer\Library\PostTypes;
use Tailorer\Library\Admin;
use Tailorer\Core;

/**
 * Defines the ProductPart Taxonomy for Tailorer.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Taxonomies
 */
class ProductPart extends Registrators\Taxonomy
{
    /** Taxonomy Singular Taxonomy name @var string Use getter to access instead of this. */
    public static string $singular_taxname = 'product_part';

    /** Taxonomy Singular Nicename @var string Use getter to access instead of this. */
    public static string $singular_nicename = 'Product Part';

    /** Taxonomy Plural Taxonomy name @var string Use getter to access instead of this. */
    public static string $plural_taxname = 'product_parts';

    /** Taxonomy Plural Nicename @var string Use getter to access instead of this. */
    public static string $plural_nicename = 'Product Parts';

    /** Taxonomy query-var @var string Use getter to access instead of this. */
    public static string $query_var = 'parts';

    public static array $capabilities = [
        'manage_terms' => 'manage_product_parts',
        'edit_terms' => 'edit_product_parts',
        'delete_terms' => 'delete_product_parts',
        'assign_terms' => 'assign_product_parts',
    ];

    /**
     * Register the ProductPart Taxonomy
     * @return	void
     */
    public static function register(): void
    {
        parent::register_taxonomy([
            'public' => true,
            'query_var' => self::$query_var,
            'capabilities' => self::$capabilities,
            'show_in_menu' => false,
            'show_ui' => true,
            'labels' => [
                'name'         => static::get_name(),
                'search_items' => __('Find', 'tailorer') . ' ' . static::get_name(),
            ]
        ], ['product']);

        self::remove_quick_edit();
        self::remove_delete_option();

        // Filter the names of the three pre-defined terms of this taxonomy to be displayed
        // as singular instead of plural.
        \add_filter('post_column_taxonomy_links', function ($term_links, $taxonomy, $terms) {
            if ($taxonomy == self::get_taxonomy_name()) {
                $term_links = array_map(fn ($l) => preg_replace('/^.*>('.PostTypes\Type::get_name().'|'.PostTypes\Fabric::get_name().'|'.PostTypes\Pattern::get_name().').*$/', '$1', $l), $term_links);
            }
            return $term_links;
        }, 10, 3);
    }

    public static function get_associated_post_type(\WP_Term|string $part): string|false
    {
        $slug = is_object($part) ? $part->slug : $part;

        return match($slug) {
            PostTypes\Type::get_post_type_slug_plural() => PostTypes\Type::get_post_type_name(),
            PostTypes\Fabric::get_post_type_slug_plural() => PostTypes\Fabric::get_post_type_name(),
            PostTypes\Pattern::get_post_type_slug_plural() => PostTypes\Pattern::get_post_type_name(),
            default => false
        };
    }

    /**
     * Fires when the plugin is first activated.
     * Adds the three different types of ProductPart terms to the ProductPart taxonomy.
     * @return	void
     */
    public static function on_activation(): void 
    {
        global $wpdb;
        taxonomy_exists(self::get_taxonomy_name()) ?: self::register();

        /** Add three terms to the ProductPart taxonomy, one for each of the Product Parts. */

        if (!term_exists(PostTypes\Type::get_name_plural(), self::get_taxonomy_name())) {
            $term = wp_insert_term(PostTypes\Type::get_name_plural(), self::get_taxonomy_name(), [
                'description' => __('These are the different types of products that exist, e.g. "Shirt", "Pants", "Jacket", etc.', 'tailorer'),
                'slug' => PostTypes\Type::get_post_type_slug_plural()
            ]);
        }
        else {
            $term = get_term_by('name', PostTypes\Type::get_name_plural(), self::get_taxonomy_name(), ARRAY_A);
        }

        if (!empty($term) && !is_wp_error($term)) {
            \set_transient(self::get_taxonomy_name().'_'.PostTypes\Type::get_post_type_slug_plural().'_term_id', (int) $term['term_id']);
        }

        if (!term_exists(PostTypes\Fabric::get_name_plural(), self::get_taxonomy_name())) {
            $term = wp_insert_term(PostTypes\Fabric::get_name_plural(), self::get_taxonomy_name(), [
                'description' => __('These are the different types of fabric that can be used to construct the final product, e.g. "Cotton", "Polyester", "Wool", etc.', 'tailorer'),
                'slug' => PostTypes\Fabric::get_post_type_slug_plural()
            ]);
        }
        else {
            $term = get_term_by('name', PostTypes\Fabric::get_name_plural(), self::get_taxonomy_name(), ARRAY_A);
        }

        if (!empty($term) && !is_wp_error($term)) {
            \set_transient(self::get_taxonomy_name().'_'.PostTypes\Fabric::get_post_type_slug_plural().'_term_id', (int) $term['term_id']);
        }

        if (!term_exists(PostTypes\Pattern::get_name_plural(), self::get_taxonomy_name())) {
            $term = wp_insert_term(PostTypes\Pattern::get_name_plural(), self::get_taxonomy_name(), [
                'description' => __('These are the patterns that can be overlayed over the final product, e.g. "Plaid", "Stripes", "Polka Dots", etc.', 'tailorer'),
                'slug' => PostTypes\Pattern::get_post_type_slug_plural()
            ]);
        }
        else {
            $term = get_term_by('name', PostTypes\Pattern::get_name_plural(), self::get_taxonomy_name(), ARRAY_A);
        }

        if (!empty($term) && !is_wp_error($term)) {
            \set_transient(self::get_taxonomy_name().'_'.PostTypes\Pattern::get_post_type_slug_plural().'_term_id', (int) $term['term_id']);
        }
    }
}