<?php

namespace Tailorer\Library\Users;

use Tailorer\Core;
use Tailorer\Library\Taxonomies;

/**
 * Handles roles and capabilities for users.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Taxonomies
 */
final class Roles
{
    /**
     * Register the Region Taxonomy
     * @return	void
     */
    public static function register_capabilities(): void
    {
        $capabilities = [];

        // Add the $capabilities of all taxonomies to the admin role.
        $capabilities = array_merge($capabilities, array_values(Taxonomies\ProductPart::$capabilities));

        $role = get_role('administrator');
        $role->capabilities = array_merge(
            $role->capabilities, array_combine( $capabilities, array_fill(0, count(Taxonomies\ProductPart::$capabilities), true) )
        );
    }
}