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

use Tailorer\Library\Registrators;
use Tailorer\Library\Taxonomies;
use Tailorer\Library\PostTypes;
use Tailorer\Library\Admin;
use Tailorer\Library\Users;

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
        // Routes\::register();
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
        Taxonomies\ProductPart::register();
        Users\Roles::register_capabilities();
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
        PostTypes\Type::register();
    }

    /**
     * Registers all action/filter hooks.
     * 
     * @return  void
     */
    public static function register_hooks(): void
    {
        Admin\Hooks::register_hooks();
    }

    /**
     * Fires when the plugin is first activated.
     * 
     * @return  void
     */
    public static function activate(): void {
        Taxonomies\ProductPart::on_activation();
        \flush_rewrite_rules();
    }

    /**
     * Fires when the plugin is first deactivated.
     * 
     * @return  void
     */
    public static function deactivate(): void {
        // TODO!
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
            else if (is_bool($value)) {
                error_log($debug_log_prefix . ($value ? 'true' : 'false'));
            }
            else {
                error_log($debug_log_prefix . $value);
            }
        }
    }

    /**
     * Returns the path to a view template
     * 
     * @return  bool
     */
    public static function view(string $template): bool 
    {
        $filename = TAILORER_DIR . 'includes/lib/views/template-'.$template.'.php';

        if (file_exists($filename)) {
            include $filename;
            return true;
        }

        return false;
    }

    /**
     * Returns the path to a partial template
     * 
     * @return  bool
     */
    public static function partial(string $partial): bool 
    {
        $filename = TAILORER_DIR . 'includes/lib/views/partials/partial-'.$partial.'.php';

        if (file_exists($filename)) {
            include $filename;
            return true;
        }

        return false;
    }
}