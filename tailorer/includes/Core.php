<?php

/**
 * The core plugin namespace.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/classes
 */

namespace Tailorer;


/**
 * The core plugin class.
 *
 * This is the springboard from where hooks, cpt's are registered and helper 
 * functions available throughout the plugin are defined, effectively 
 * starting execution.
 *
 * @since      1.0-alpha
 * @package    Tailorer
 * @author     Maxylan (Max Olsson)
 */
final class Core
{
    /** Prevent instances of this from being created. */
    private function __construct()
    {
    }

    /**
     * Starts execution of the plugin!
     * 
     * @return  void
     */
    public static function run(): void
    {
        if (self::is_wc_active()) {
            // WooCommerce enabled
            self::register_routes();
            self::register_taxonomies();
            self::register_post_types();
            self::register_hooks();
        }
        else {
            // WooCommerce disabled
            MissingWoo::run();
        }
    }

    /**
     * Registers all routes.
     * 
     * @return  void
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
     */
    public static function activate(): void {
    }

    /**
     * Fires when the plugin is first deactivated.
     * 
     * @return  void
     */
    public static function deactivate(): void {
        
    }

    /**
     * Check if WooCommerce exists and is activated.
     * My recommendation is that you put WC in the folder "mu-plugins" so that
     * it will always be active, this plugin will not run without it.
     * 
     * @return  void
     */
    public static function is_wc_active(): bool {
        return defined('WC_ACTIVE') && WC_ACTIVE;
    }

    /**
     * Asserts if debugging is enabled.
     * 
     * @return  bool
     */
    public static function debug(): bool {
        return WP_DEBUG && defined('TAILORER_DEBUG') && TAILORER_DEBUG;
    }

    /**
     * Logs a value to the error log if debugging is enabled.
     * 
     * @see     \Tailorer\Core::debug()
     * @return  void
     */
    public static function log($value, bool $var_dump = false): void 
    {
        if (!self::debug()) {
            return;
        }

        $debug_log_prefix = __('- Tailorer:', 'tailorer').' ';

        if ($var_dump) {
            ob_start();
            var_dump($value);
            $value = ob_get_clean();
            error_log($debug_log_prefix . $value);
        }
        else if (!empty($value)) {
            if (is_array($value) || is_object($value)) {
                error_log($debug_log_prefix . print_r($value, true));
            }
            else {
                error_log($debug_log_prefix . $value);
            }
        }
    }
}