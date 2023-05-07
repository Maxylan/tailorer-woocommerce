<?php

use Tailorer\Library\Admin\EditProductParts;
use Tailorer\Core;

// Die if called directly
if (!defined('ABSPATH')) {
    die();
}
?>

<div id="wpbody" role="main">
    <table class="wp-list-table widefat fixed striped table-view-list tags">
        <thead>
            <tr>
                <?php EditProductParts::render_product_part_row_headers(); ?>
            </tr>
        </thead>

        <tbody id="the-list" data-wp-lists="list:tag">
            <?php global $part;
            foreach(EditProductParts::$parts as $product_part) {
                $part = $product_part;
                include Core::partial('product-part-row');
            }
            unset($part);
            ?>
        </tbody>

        <tfoot>
            <tr>
                <?php EditProductParts::render_product_part_row_headers(); ?>
            </tr>
        </tfoot>

    </table>
</div>