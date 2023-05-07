<?php

use Tailorer\Core;
use Tailorer\Library\Taxonomies;
use Tailorer\Library\Admin\EditProductParts;

// Die if called directly
if (!defined('ABSPATH')) {
    die();
}

global $part;
?>

<tr id="tag-<?= $part->term_id; ?>" class="level-0">
    <td class="name column-name has-row-actions column-primary" data-colname="Name"><strong><a class="row-title" href="<?= \admin_url('edit.php?post_type='.Taxonomies\ProductPart::get_associated_post_type($part) ?: 'product') ?>" aria-label="“<?= \esc_html($part->name); ?>” (Edit)"><?= $part->name; ?></a></strong><br>
        <?php // Row Actions
        $actions = [];
        foreach(EditProductParts::$row_actions as $action) 
        {
            $html = '<span class="'.$action.'">'.match($action) {
                'edit' => '<a href="' . \get_edit_term_link($part->term_id, $part->taxonomy) . '" aria-label="Edit “'.$part->name.'”">Edit</a>',
                'view_list' => '<a href="' . \admin_url('edit.php?post_type='.Taxonomies\ProductPart::get_associated_post_type($part) ?: 'product') . '" aria-label="View “'.$part->name.'” List">View List</a>',
                'view_store' => '<a href="' . \get_term_link($part->term_id, $part->taxonomy) . '" aria-label="View “'.$part->name.'” Storepage">View Storepage</a>',
                default => $action
            }.'</span>';
        
            $actions[] = \apply_filters("tailorer_edit_product_parts_row_action_{$action}", $html, $part);
        }
        
        echo '<div class="row-actions">' . implode(' | ', $actions) . '</div>';
        ?>
    </td>
    <td class="description column-description" data-colname="Description">
        <p><?= \esc_html($part->name); ?></p>
    </td>
    <td class="slug column-slug" data-colname="Slug"><?= $part->slug; ?></td>
    <td class="posts column-posts" data-colname="Count"><a href="<?= \admin_url('edit.php?post_type='.Taxonomies\ProductPart::get_associated_post_type($part) ?: 'product'); ?>"><?= count(EditProductParts::$posts[$part->term_id]); ?></a></td>
</tr>
