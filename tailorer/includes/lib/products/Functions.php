<?php

namespace Tailorer\Library\Products;

/**
 * Defines functionality surrounding Tailorer's custom product type(s?).
 *
 * @link       https://github.com/Maxylan
 * @since      1.0-alpha
 *
 * @package    Tailorer
 * @subpackage Tailorer/Library/Products
 */
final class Functions
{
    /** Disallow creating instances */
    private function __construct()
    {
    }

    /**
     * Automatically draft all WooCommerce products that has a relation to the 
     * Custom Post Type that was deleted.
     * 
     * @return int  The number of products that were drafted.
     */
    public static function draft_attached_products($deleted_post): int
    {
        // TODO!!
        return 0;
    }
}