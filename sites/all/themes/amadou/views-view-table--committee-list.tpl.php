<?php
// $Id: views-view-table.tpl.php,v 1.8 2009/01/28 00:43:43 merlinofchaos Exp $
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $class: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * @ingroup views_templates
 
 


        <?php foreach ($row as $field => $content): ?>
          <td class="views-field views-field-<?php print $fields[$field]; ?>">
            <?php print $content; ?>
          </td>
        <?php endforeach; ?>

 
 */
?>
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <tbody>
    <?php foreach ($rows as $count => $row): ?>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <td valign="top" rowspan="2" class="views-field views-field_image_fid"><?php print $row['field_image_fid']; ?></td>
        <td class="views-field views-field-title" style="font-size: small; "><b><?php print $row['title']; ?></b></td>
      </tr>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <td valign="top" class="views-field views-field-body" style="font-size: 0.8em;"><?php print $row['body']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
