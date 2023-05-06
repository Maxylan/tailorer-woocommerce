<?php

namespace Tailorer\Library\Registrators;

/**
 * Handles registering Custom Post Types for Tailorer.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Registrators
 */
class PostType
{
    /** Prevent instantiating objects of this class. @since	1.0.0 */
    private function __construct()
    {
    }

    /**
     * Registers the inheriting Custom Post Type during init.
     * 
     * @param	array	$args
     * @since	1.0.0
     */
    protected static function register_post_type($args = []): void
    {
        add_action('init', function () use ($args) {
            $result = \register_post_type(
                self::get_post_type_name(),
                array_merge([
                    'capability_type' => 'page',
                    'description' => '',
                    'has_archive' => true,
                    'hierarchical' => false,
                    'public' => true,
                    'publicly_queryable' => true,
                    'query_var' => true,
                    'show_in_menu' => true,
                    'show_ui' => true,
                    'supports' => [
                        'title', 
                        'thumbnail', 
                        'excerpt', 
                        'editor'
                    ]
                ], $args, ['labels' => self::get_labels($args)])
            );
        });
    }

    /**
     * Sets and returns all labels associated with the Taxonomy. 
     * Used during taxonomy registration.
     * 
     * @param	$register_args	Args passed to self::register()
     * @return	array
     * @since	1.0.0
     */
    private static function get_labels($register_args): array
    {
        $labels = [
            'name'             => self::get_name_plural(),
            'singular_name' => self::get_name(),
            'menu_name'     => self::get_name_plural(),
            'name_admin_bar' => self::get_name(),
            'add_new'         => __('Create new', 'tailorer') . ' ' . strtolower(self::get_name()),
            'add_new_item'     => __('Create', 'tailorer') . ' ' . self::get_name(),
            'new_item'         => __('New', 'tailorer') . ' ' . self::get_name(),
            'edit_item'     => __('Edit', 'tailorer') . ' ' . self::get_name(),
            'view_item'     => __('View', 'tailorer') . ' ' . self::get_name(),
            'all_items'     => __('All', 'tailorer') . ' ' . strtolower(self::get_name_plural()),
            'search_items'     => __('Search', 'tailorer') . ' ' . strtolower(self::get_name_plural()),
            'parent_item_colon' => __('Parent', 'tailorer') . ' ' . self::get_name_plural() . ':',
            'not_found'     => __('No', 'tailorer') . ' ' . self::get_name_plural() . ' ' . __('was found.', 'tailorer'),
            'not_found_in_trash' => __('No', 'tailorer') . ' ' . self::get_name_plural() . ' ' . __('could be found in the trash.', 'tailorer'),
        ];

        if (isset($register_args['labels'])) {

            $labels = array_merge($labels, $register_args['labels']);
        }

        return $labels;
    }

    /**
     * Gets the slug of this custom post type.
     * @return string
     * @since	1.0.0
     */
    public static function get_post_type_slug(): string
    {
        return static::$singular_cptslug;
    }

    /**
     * Gets the name of this custom post type.
     * @return string
     * @since	1.0.0
     */
    public static function get_post_type_name(): string
    {
        return static::$singular_cptname;
    }

    /**
     * Gets this custom post type's nicename in singular form.
     * @return	string
     * @since	1.0.0
     */
    public static function get_name(): string
    {
        return static::$singular_nicename;
    }

    /**
     * Gets the plural slug of this custom post type.
     * @return	string
     * @since	1.0.0
     */
    public static function get_post_type_slug_plural(): string
    {
        return static::$plural_cptslug;
    }

    /**
     * Gets the plural name of this custom post type.
     * @return	string
     * @since	1.0.0
     */
    public static function get_post_type_name_plural(): string
    {
        return static::$plural_cptname;
    }

    /**
     * Gets this custom post type's nicename in plural form.
     * @return	string
     * @since	1.0.0
     */
    public static function get_name_plural(): string
    {
        return static::$plural_nicename;
    }

    /**
     * Removes the option to quick-edit posts of this type.
     * 
     * @return	void
     * @since	1.0.0
     */
    public static function remove_quick_edit(): void
    {
        add_filter('post_row_actions', function ($actions) {
            if (static::is_editing_my_post_type()) {
                unset($actions['inline hide-if-no-js']);
            }

            return $actions;
        }, 10, 1);
    }

    /**
     * Determines wether or not your current screen is the edit screen for 
     * posts of the custom post type.
     * @return	bool
     */
    public static function is_editing_my_post_type(): bool
    {
        $current_screen = get_current_screen();
        return ($current_screen->base === 'edit' &&
            isset($current_screen->post_type) &&
            $current_screen->post_type === static::get_post_type_name()
        );
    }

    /**
     * Determines wether or not your current screen is the listing screen for posts of the custom post type
     * @return	bool
     */
    public static function is_listing_my_post_type(): bool
    {
        $current_screen = get_current_screen();

        return ($current_screen->base === 'post' &&
            isset($current_screen->post_type) &&
            $current_screen->post_type === static::get_post_type_name()
        );
    }
}