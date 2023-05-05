<?php

namespace Tailorer\Library\Taxonomies;

use Tailorer\Library\Registrators;
use Tailorer\Library\PostTypes;

/**
 * Defines the Region Taxonomy for Tailorer.
 *
 * @link       https://newseed.se
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

    /** Taxonomy/Term Classname @var string Use getter to access instead of this. */
    public static string $term_class_name = Terms\Region::class; // 'Region'

    /**
     * Register the Region Taxonomy
     * @return	void
     */
    public static function register(): void
    {
        parent::register_taxonomy([
            'query_var' => false,
            'public' => true,
            'capabilities' => [
                'manage_terms' => 'manage_product_parts',
                'edit_terms' => 'edit_product_parts',
                'delete_terms' => 'delete_product_parts',
                'assign_terms' => 'assign_product_parts',
            ],
        ]);

        // Add this to the WooCommerce "Products" menu tab as a submenu
        add_action('admin_menu', function () {
            add_submenu_page(
                'edit.php?post_type=product',
                self::get_name_plural(),
                self::get_name_plural(),
                'manage_product_parts',
                'edit-tags.php?taxonomy=' . self::get_taxonomy_name() . '&post_type=product'
            );
        });
    }
}