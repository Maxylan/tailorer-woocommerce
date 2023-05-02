<?php

namespace Tailorer\Library\Registrators;

/**
 * Defines all action/filter hooks to be added for Registrators.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Registrators
 */
final class Hooks
{
    /** Disallow creating instances @since 1.0.0 */
    private function __construct()
    {
    }

    /**
     * Registers/Adds all action/filter hooks associated with the Registrators.
     * @return  void
     * @since   1.0.0
     */
    public static function register_hooks(): void
    {
        // Draft all posts categorized under the specific term when term is deleted.
        add_action('pre_delete_term', [Taxonomy::class, 'on_term_deletion'], 10, 2);
    }
}