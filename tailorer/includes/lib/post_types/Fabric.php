<?php

namespace Tailorer\Library\PostTypes;

use Tailorer\Core;
use Tailorer\Library\Registrators;
use Tailorer\Library\Taxonomies;

/**
 * Defines Custom Post Type "Fabric".
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/PostTypes
 */
class Fabric extends Registrators\PostType implements IPost
{
    /** Custom Post Type Singular Slug @var string Use getter to access. */
    protected static string $singular_cptslug = 'fabric';

    /** Custom Post Type Singular Name @var string Use getter to access. */
    protected static string $singular_cptname = 'part_fabric';

    /** Custom Post Type Singular Nicename @var string Use getter to access. */
    protected static string $singular_nicename = 'Fabric';

    /** Custom Post Type Plural Slug @var string Use getter to access. */
    protected static string $plural_cptslug = 'textiles';

    /** Custom Post Type Plural Name @var string Use getter to access. */
    protected static string $plural_cptname = 'part_fabrics';

    /** Custom Post Type Plural Nicename @var string Use getter to access. */
    protected static string $plural_nicename = 'Textiles';

    /**
     * Register the "Fabric" post type
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
                'all_items'     => self::get_name_plural()
            ]
        ]);

        self::remove_quick_edit();
    }

    /**
     * Create an instance of the "Fabric" post type.
     * @throws  \LogicException|\Exception If no post or an invalid post is provided.
     * @return	Fabric
     */
    public function __construct(Fabric|\WP_Post|string|int $post = null) {
        if (empty($post)) {
            throw new \LogicException('No post provided.');
        }
        
        if ($post instanceof Fabric) {
            // $post = $post->get_post();
        }
        else if (is_numeric($post) || ($post instanceof \WP_Post && $post->post_type === self::get_post_type_name())) {
            $post = \get_post($post);
        } 
        else {
            // Get post by slug or title.
            $posts = get_posts([ 
                'name' => $post,
                'post_type' => self::get_post_type_name(),
                'post_status' => 'publish',
                'numberposts' => 1
            ]);
            
            if (empty($posts)) {
                throw new \Exception(
                    'Failed to initialize "'.self::get_name().'" '. (
                        is_string($post) ? 'with value "'.$post.'"' : (
                            Core::debug() ? 'with object "'.print_r($post, true).'"' : 'with "'.get_class($post).'" instance.'
                        )
                    )
                );
            }

            $post = $posts[0];
            unset($posts);
        }
            
        if (empty($post)) {
            throw new \LogicException('Product Part: "'.self::get_name().'" was passed an invalid post parameter. '. $post);
        }
    }
}

\class_alias(Fabric::class, 'T_Fabric');