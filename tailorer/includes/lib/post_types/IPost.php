<?php

namespace Tailorer\Library\PostTypes;

use Tailorer\Library\Registrators;
use Tailorer\Library\Taxonomies;

/**
 * Defines common methods and properties for the Custom Post Types.
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/PostTypes
 */
interface IPost
{
    public static function register(): void;

    // public function get_post(): \WP_Post|null;

    // public function is_valid(): bool;
}