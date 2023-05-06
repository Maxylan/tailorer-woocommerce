<?php

namespace Tailorer\Library\PostTypes;

use Tailorer\Library\Registrators;
use Tailorer\Library\Taxonomies;

/**
 * Defines Custom Post Type "Pattern".
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/PostTypes
 */
class Pattern extends Registrators\PostType
{
    /** Custom Post Type Singular Slug @var string Use getter to access. */
    protected static string $singular_cptslug = 'pattern';

    /** Custom Post Type Singular Name @var string Use getter to access. */
    protected static string $singular_cptname = 'part_pattern';

    /** Custom Post Type Singular Nicename @var string Use getter to access. */
    protected static string $singular_nicename = 'Pattern';

    /** Custom Post Type Plural Slug @var string Use getter to access. */
    protected static string $plural_cptslug = 'patterns';

    /** Custom Post Type Plural Name @var string Use getter to access. */
    protected static string $plural_cptname = 'part_patterns';

    /** Custom Post Type Plural Nicename @var string Use getter to access. */
    protected static string $plural_nicename = 'Patterns';

    /**
     * Register the "Pattern" post type
     * @return	void
     */
    public static function register(): void
    {
        // Registers the taxonomy.
        parent::register_post_type([
            'exclude_from_search' => false,
            'has_archive' => self::get_post_type_slug_plural(),
            'show_in_menu' => 'edit.php?page='.Taxonomies\ProductPart::get_taxonomy_name_plural(),
            'menu_slug' => 'edit.php?page='.Taxonomies\ProductPart::get_taxonomy_name_plural().'&post_type='.self::get_post_type_name(),
            'menu_title' => self::get_name_plural(),
            'show_in_rest' => true,
            'public' => true,
            'supports' => [],
            'taxonomies' => [
                Taxonomies\ProductPart::get_taxonomy_name(),
                'product_cat',
                'product_tag'
            ],
            'rewrite' => [
                'slug' => self::get_post_type_slug(),
                'with_front' => false,
            ],
            'labels' => [
                'all_items'     => self::get_name_plural(),
                'add_new'       => __('Create a new', 'tailorer') . ' ' . strtolower(self::get_name()),
                'add_new_item'  => __('Create a new', 'tailorer') . ' ' . strtolower(self::get_name())
            ]
        ]);

        self::remove_quick_edit();
    }
}