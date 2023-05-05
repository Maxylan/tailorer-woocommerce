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

    /** Taxonomy Plural Nicename @var string Use getter to access instead of this. */
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
        ], ['product']);

        self::remove_quick_edit();

        // Add this to the WooCommerce "Products" menu tab as a submenu
        add_action('admin_menu', function () {
            add_submenu_page(
                'edit.php?post_type=product',
                self::get_name_plural(),
                self::get_name_plural(),
                'manage_product_parts',
                ProductPart::get_taxonomy_name(), 
                [Admin\EditProductParts::class, 'init'], 1
            );
        }/*, 99*/);
    }

    /**
     * Fires when the plugin is first activated.
     * Adds the three different types of ProductPart terms to the ProductPart taxonomy.
     * @return	void
     */
    public static function on_activation(): void 
    {
        taxonomy_exists(self::get_taxonomy_name()) ?: self::register();

        // Add three terms to the ProductPart taxonomy.
        if (!term_exists('Types', self::get_taxonomy_name())) {
            wp_insert_term('Types', self::get_taxonomy_name(), [
                'description' => 'These are the different types of products that exist, e.g. "Shirt", "Pants", "Jacket", etc.',
                'slug' => 'types'
            ]);
        }
        if (!term_exists('Fabrics', self::get_taxonomy_name())) {
            wp_insert_term('Fabrics', self::get_taxonomy_name(), [
                'description' => 'These are the different types of fabrics that can be used to construct the final product, e.g. "Cotton", "Polyester", "Wool", etc.',
                'slug' => 'fabrics'
            ]);
        }
        if (!term_exists('Patterns', self::get_taxonomy_name())) {
            wp_insert_term('Patterns', self::get_taxonomy_name(), [
                'description' => 'These are the patterns that can be overlayed over the final product, e.g. "Plaid", "Stripes", "Polka Dots", etc.',
                'slug' => 'patterns'
            ]);
        }
    }
}