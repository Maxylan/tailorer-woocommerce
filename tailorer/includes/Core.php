<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://newseed.se
 * @since      1.0.0
 *
 * @package    Digiteket
 * @subpackage Digiteket/classes
 */

namespace Tailorer;


/**
 * The core plugin class.
 *
 * This is the springboard from where hooks, cpt's are registered and helper 
 * functions available throughout the plugin are defined, effectively 
 * starting execution.
 *
 * @since      1.0.0
 * @package    Digiteket
 * @author     Maxylan (Max Olsson)
 */
final class Core
{
    /** Prevent instances of this from being created. @since 1.0.0 */
    private function __construct()
    {
    }

    /**
     * Starts execution of the plugin!
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function run(): void
    {
        self::register_routes();
        self::register_taxonomies();
        self::register_post_types();
        self::register_hooks();
    }

    /**
     * Registers all routes.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function register_routes(): void
    {
        // Routes\Login::register();
        // Routes\LostPassword::register();
        // Routes\ResetPassword::register();
        // Routes\Register::register();
        // Routes\Profile::register();
        // Routes\Settings::register();
        // Routes\Favourites::register();
        // Routes\CoursesCompleted::register();
        // Routes\Diploma::register();
    }

    /**
     * Registers all taxonomies.
     * Some register methods also register action/filter
     * hooks that are highly specific to the taxonomy.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function register_taxonomies(): void
    {
        // Taxonomies\Competence::register();
        // Taxonomies\Duration::register();
        // Taxonomies\License::register();
        // Taxonomies\Organization::register();
        // Taxonomies\Library::register();
        // Taxonomies\Municipality::register();
        // Taxonomies\Region::register();
        // Taxonomies\ContentType::register();
        // Taxonomies\TargetAudience::register();
    }

    /**
     * Registers all custom post types.
     * Some register methods also register action/filter
     * hooks that are highly specific to the cpt.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function register_post_types(): void
    {
        // PostTypes\Hooks::register_hooks();
        // PostTypes\Course::register();
        // PostTypes\InspirationArticle::register();
        // PostTypes\Resource::register();
        // PostTypes\Theme::register();
        // PostTypes\News::register();
    }

    /**
     * Registers all action/filter hooks.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function register_hooks(): void
    {
        // Registrators\Hooks::register_hooks();
        // Roles\Hooks::register_hooks();
        // Users\Hooks::register_hooks();
        // Routes\Hooks::register_hooks();
        // Courses\Hooks::register_hooks();
    }

    /**
     * Fires when the plugin is first activated.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function activate(): void {
    }

    /**
     * Fires when the plugin is first deactivated.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function deactivate(): void {
        
    }

    /**
     * Check if WooCommerce exists and is activated.
     * My recommendation is that you put WC in the folder "mu-plugins" so that
     * it will always be active, this plugin will not run without it.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function is_wc_active(): bool {
        return defined('WC_ACTIVE') && WC_ACTIVE;
    }

    /**
     * Asserts if debugging is enabled.
     * 
     * @return  bool
     * @since   1.0.0
     */
    public static function debug(): bool {
        return WP_DEBUG && defined('TAILORER_DEBUG') && TAILORER_DEBUG;
    }

    /**
     * Asserts if debugging is enabled.
     * 
     * @return  void
     * @since   1.0.0
     */
    public static function debug_log($value, bool $var_dump = false): void 
    {
        if (!self::debug()) {
            return;
        }

        if ($var_dump) {
            ob_start();
            var_dump($value);
            $value = ob_get_clean();
            error_log($value);
        }
        else if (!empty($value)) {
            if (is_array($value) || is_object($value)) {
                error_log(print_r($value, true));
            }
            else {
                error_log($value);
            }
        }
    }
}