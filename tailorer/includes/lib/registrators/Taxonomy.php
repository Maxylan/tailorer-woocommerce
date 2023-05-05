<?php

namespace Tailorer\Library\Registrators;

use Tailorer\Core;

/**
 * Handles registering Taxonomies for Tailorer.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Registrators
 */
class Taxonomy
{
    /** Prevent instantiating objects of this class. */
    private function __construct()
    {
    }

    /**
     * Registers the inheriting Taxonomy, either during init immideatly when plugin is first activated.
     * 
     * @param	array			$args
     * @param	array|string	$object_type
     * @return	void
     */
    protected static function register_taxonomy($args = [], array|string $object_type = ''): void
    {
        $register = function () use ($args, $object_type) {
            register_taxonomy(
                static::get_taxonomy_name(),
                $object_type,
                array_merge(
                    [
                        'hierarchical' => false,
                        'query_var' => true,
                        'show_admin_column' => true,
                        'show_ui' => true,
                    ],
                    $args,
                    ['labels' => static::get_labels($args)]
                )
            );
        };

        current_action('activate_'.TAILORER_NAME.'/'.TAILORER_NAME.'.php') ? $register(): add_action('init', $register, 2);
    }

    /**
     * Sets and returns all labels associated with the Taxonomy. 
     * Used during taxonomy registration.
     * 
     * @param	$register_args	Args passed to self::register()
     * @return	array
     */
    private static function get_labels($register_args): array
    {
        $labels = [
            'name'              => static::get_name_plural(),
            'singular_name'     => static::get_name(),
            'search_items'      => __('Search', 'tailorer') . ' ' . static::get_name_plural(),
            'all_items'         => __('All', 'tailorer') . ' ' . static::get_name_plural(),
            'parent_item'       => __('Parent-', 'tailorer') . ' ' . static::get_name(),
            'parent_item_colon' => __('Parent-', 'tailorer') . ' ' . static::get_name() . ':',
            'edit_item'         => __('Edit', 'tailorer') . ' ' . static::get_name(),
            'update_item'       => __('Update', 'tailorer') . ' ' . static::get_name(),
            'add_new_item'      => __('Add', 'tailorer') . ' ' . static::get_name(),
            'new_item_name'     => __('New', 'tailorer') . ' ' . static::get_name() . ' ' . __('name', 'tailorer'),
            'menu_name'         => static::get_name_plural(),
            'back_to_items'     => __('Back to', 'tailorer') . ' ' . static::get_name_plural(),
        ];

        if (isset($register_args['labels'])) {
            $labels = array_merge($labels, $register_args['labels']);
        }

        return $labels;
    }

    /**
     * Marks all posts labled with the deleted term as Drafts.
     * 
     * @hook    pre_delete_term
     * @param	$term_id
     * @param	$taxonomy_name
     * @return	void
     */
    public static function on_term_deletion($term_id, $taxonomy_name): void
    {
        // Gets courses connected to the tax term.
        $connected_posts = get_posts([
            'numberposts' => -1,
            'fields' => 'ids',
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy_name,
                    'field' => 'term_id',
                    'terms' => [$term_id],
                ],
            ],
        ]);

        foreach ($connected_posts as $post) {

            wp_update_post([
                'ID' => $post,
                'post_status' => 'draft',
            ]);
        }
    }

    /**
     * Hides the description-field of terms of this taxonomy.
     * 
     * @return	void
     */
    protected static function hide_description_field(): void
    {
        add_action('load-edit-tags.php', function () {
            if (self::current_admin_screen_belongs_to_taxonomy()) {
                $css = '<style>
              .term-description-wrap {
                display:none;
              }
              </style>';

                echo $css;
            }
        });
    }

    /**
     * Returns the HTML Content that should be in the admin-table-column for 
     * inheriting Taxonomies taht register their own table-column functions 
     * named something along the lines of..
     * 'get_admin_table_column_content_{column-name}'
     * 
     * @param $column_name
     * @param $post_id
     * @return string
     */
    public static function set_admin_table_column_content($content, $column_name, $term_id): string
    {
        $function_name = 'get_admin_table_column_content_' . strtolower(str_replace('-', '_', $column_name));

        if (method_exists(static::class, $function_name)) {

            $class = static::class;

            $content = $class::$function_name($term_id);
        }

        return $content;
    }

    /**
     * Removes the option to quick-edit terms of this taxonomy.
     * 
     * @return	void
     */
    protected static function remove_quick_edit(): void
    {
        add_filter(static::get_taxonomy_name() . '_row_actions', function ($actions) {
            unset($actions['inline hide-if-no-js']);
            return $actions;
        }, 10, 1);
    }

    /**
     * Removes the option to delete terms of this taxonomy.
     * 
     * @return	void
     */
    protected static function remove_delete_option(): void
    {
        add_filter(static::get_taxonomy_name() . '_row_actions', function ($actions) {
            unset($actions['delete']);
            return $actions;
        }, 10, 1);
    }


    /**
     * Immideatly redirects the user-agent to this taxonomy's edit tags screen
     * 
     * @return	void
     */
    public static function redirect_to_admin_page(): void
    {
        wp_redirect(admin_url('edit-tags.php?taxonomy=' . static::get_taxonomy_name()));
        exit;
    }

    /**
     * Determines wether or not your current screen belongs to a taxonomy.
     * @return	bool
     */
    public static function current_admin_screen_belongs_to_taxonomy(): bool
    {
        $current_screen = get_current_screen();
        return (isset($current_screen->taxonomy) && $current_screen->taxonomy === static::get_taxonomy_name());
    }

    /**
     * Determines wether or not your current screen is the taxonomy listing / tag-editing screen
     * @return	bool
     */
    public static function current_admin_screen_is_listing_taxonomy(): bool
    {
        $current_screen = get_current_screen();

        return ($current_screen->base === 'edit-tags' &&
            isset($current_screen->post_type) &&
            $current_screen->taxonomy === static::get_taxonomy_name()
        );
    }

    /**
     * Gets the name of this Taxonomy.
     * @return	string
     */
    public static function get_taxonomy_name(): string
    {
        return static::$singular_taxname;
    }

    /**
     * Gets this taxonomy's nicename in singular form.
     * @return	string
     */
    public static function get_name(): string
    {
        return static::$singular_nicename;
    }

    /**
     * Gets the plural name of this Taxonomy.
     * @return	string
     */
    public static function get_taxonomy_name_plural(): string
    {
        return static::$plural_taxname;
    }

    /**
     * Gets this taxonomy's nicename in plural form.
     * @return	string
     */
    public static function get_name_plural(): string
    {
        return static::$plural_nicename;
    }

    /**
     * Gets all the terms associated with the Taxonomy
     * 
     * @param	array $args
     * @param	string $return_type
     * @return	array
     */
    public static function get_all_terms($return_type = 'objects', $args = []): array
    {
        $terms = get_terms(array_merge([
            'taxonomy' => static::get_taxonomy_name(),
            'hide_empty' => false,
            'fields' => $return_type,
        ], $args));

        return is_wp_error($terms) ? [] : $terms;
    }
}