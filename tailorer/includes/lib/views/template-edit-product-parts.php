<?php

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
                <td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></td>
                <th scope="col" id="name" class="manage-column column-name column-primary sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=name&amp;order=asc"><span>Name</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="description" class="manage-column column-description sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=description&amp;order=asc"><span>Description</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="slug" class="manage-column column-slug sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=slug&amp;order=asc"><span>Slug</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" id="posts" class="manage-column column-posts num sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=count&amp;order=asc"><span>Count</span><span class="sorting-indicator"></span></a></th>
            </tr>
        </thead>

        <tbody id="the-list" data-wp-lists="list:tag">
            <tr id="tag-17" class="level-0">
                <th scope="row" class="check-column"><label class="screen-reader-text" for="cb-select-17">Select Fabrics</label><input type="checkbox" name="delete_tags[]" value="17" id="cb-select-17"></th>
                <td class="name column-name has-row-actions column-primary" data-colname="Name"><strong><a class="row-title" href="http://dev.tailorer.se/wp-admin/term.php?taxonomy=product_part&amp;tag_ID=17&amp;post_type=product&amp;wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_part%26post_type%3Dproduct" aria-label="“Fabrics” (Edit)">Fabrics</a></strong><br>
                    <div class="hidden" id="inline_17">
                        <div class="name">Fabrics</div>
                        <div class="slug">fabrics</div>
                        <div class="parent">0</div>
                    </div>
                    <div class="row-actions"><span class="edit"><a href="http://dev.tailorer.se/wp-admin/term.php?taxonomy=product_part&amp;tag_ID=17&amp;post_type=product&amp;wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_part%26post_type%3Dproduct" aria-label="Edit “Fabrics”">Edit</a> | </span><span class="view"><a href="http://dev.tailorer.se/?parts=fabrics" aria-label="View “Fabrics” archive">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
                </td>
                <td class="description column-description" data-colname="Description">
                    <p>These are the different types of fabrics that can be used to construct the final product, e.g. “Cotton”, “Polyester”, “Wool”, etc.</p>
                </td>
                <td class="slug column-slug" data-colname="Slug">fabrics</td>
                <td class="posts column-posts" data-colname="Count"><a href="edit.php?parts=fabrics&amp;post_type=product">0</a></td>
            </tr>
            <tr id="tag-18" class="level-0">
                <th scope="row" class="check-column"><label class="screen-reader-text" for="cb-select-18">Select Patterns</label><input type="checkbox" name="delete_tags[]" value="18" id="cb-select-18"></th>
                <td class="name column-name has-row-actions column-primary" data-colname="Name"><strong><a class="row-title" href="http://dev.tailorer.se/wp-admin/term.php?taxonomy=product_part&amp;tag_ID=18&amp;post_type=product&amp;wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_part%26post_type%3Dproduct" aria-label="“Patterns” (Edit)">Patterns</a></strong><br>
                    <div class="hidden" id="inline_18">
                        <div class="name">Patterns</div>
                        <div class="slug">patterns</div>
                        <div class="parent">0</div>
                    </div>
                    <div class="row-actions"><span class="edit"><a href="http://dev.tailorer.se/wp-admin/term.php?taxonomy=product_part&amp;tag_ID=18&amp;post_type=product&amp;wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_part%26post_type%3Dproduct" aria-label="Edit “Patterns”">Edit</a> | </span><span class="view"><a href="http://dev.tailorer.se/?parts=patterns" aria-label="View “Patterns” archive">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
                </td>
                <td class="description column-description" data-colname="Description">
                    <p>These are the patterns that can be overlayed over the final product, e.g. “Plaid”, “Stripes”, “Polka Dots”, etc.</p>
                </td>
                <td class="slug column-slug" data-colname="Slug">patterns</td>
                <td class="posts column-posts" data-colname="Count"><a href="edit.php?parts=patterns&amp;post_type=product">0</a></td>
            </tr>
            <tr id="tag-16" class="level-0">
                <th scope="row" class="check-column"><label class="screen-reader-text" for="cb-select-16">Select Types</label><input type="checkbox" name="delete_tags[]" value="16" id="cb-select-16"></th>
                <td class="name column-name has-row-actions column-primary" data-colname="Name"><strong><a class="row-title" href="http://dev.tailorer.se/wp-admin/term.php?taxonomy=product_part&amp;tag_ID=16&amp;post_type=product&amp;wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_part%26post_type%3Dproduct" aria-label="“Types” (Edit)">Types</a></strong><br>
                    <div class="hidden" id="inline_16">
                        <div class="name">Types</div>
                        <div class="slug">types</div>
                        <div class="parent">0</div>
                    </div>
                    <div class="row-actions"><span class="edit"><a href="http://dev.tailorer.se/wp-admin/term.php?taxonomy=product_part&amp;tag_ID=16&amp;post_type=product&amp;wp_http_referer=%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dproduct_part%26post_type%3Dproduct" aria-label="Edit “Types”">Edit</a> | </span><span class="view"><a href="http://dev.tailorer.se/?parts=types" aria-label="View “Types” archive">View</a></span></div><button type="button" class="toggle-row"><span class="screen-reader-text">Show more details</span></button>
                </td>
                <td class="description column-description" data-colname="Description">
                    <p>These are the different types of products that exist, e.g. “Shirt”, “Pants”, “Jacket”, etc.</p>
                </td>
                <td class="slug column-slug" data-colname="Slug">types</td>
                <td class="posts column-posts" data-colname="Count"><a href="edit.php?parts=types&amp;post_type=product">0</a></td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-2">Select All</label><input id="cb-select-all-2" type="checkbox"></td>
                <th scope="col" class="manage-column column-name column-primary sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=name&amp;order=asc"><span>Name</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" class="manage-column column-description sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=description&amp;order=asc"><span>Description</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" class="manage-column column-slug sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=slug&amp;order=asc"><span>Slug</span><span class="sorting-indicator"></span></a></th>
                <th scope="col" class="manage-column column-posts num sortable desc"><a href="http://dev.tailorer.se/wp-admin/edit-tags.php?taxonomy=product_part&amp;post_type=product&amp;orderby=count&amp;order=asc"><span>Count</span><span class="sorting-indicator"></span></a></th>
            </tr>
        </tfoot>

    </table>
</div>