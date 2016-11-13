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
 */
?>
<table class="<?php print $class; ?>">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <tbody>
    <?php foreach ($rows as $count => $row): ?>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <td valign="top" style="width: 50px;" rowspan="2" class="views-field views-field-field_multiple_image_field_fid"><?php print $row['field_multiple_image_field_fid']; ?></td>
        <td class="views-field views-field-title"><span class="views-field-title-span"><?php print $row['title']; ?></span><br /><span class="view-field-event-date-span"><?php print $row['field_event_date_value']; ?></span></td>
      </tr>
      <tr class="<?php print implode(' ', $row_classes[$count]); ?>">
        <td valign="top" class="views-field views-field-field_short_description_value"><?php print $row['field_short_description_value']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
