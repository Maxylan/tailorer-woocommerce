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
            <?php
            foreach(EditProductParts::$parts as $part) {
                include Core::partial('product-part-row') ?: \get_theme_file_path('index.php');
            }
            ?>
        </tbody>

        <tfoot>
            <tr>
                <?php EditProductParts::render_product_part_row_headers(); ?>
            </tr>
        </tfoot>

    </table>
</div>