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
	<?php #$img_src = preg_replace('/alt=.*? /','alt="'.$row[title].'" ',$row[image_attach_images]); ?>
	<?php #$img_src = preg_replace('/title=.*? /','title="'.$row[title].'" ',$row[image_attach_images]); ?>
	<?php #$img_src = preg_replace('/\>/', ' style="border: 1px solid #CCCCCC"\>',$row[image_attach_images]); ?>
        <td class="views-field" align="center">
          <?php if ($row['field_sponsor_url_value']) { ?>
		    <a href="<?php print $row[field_sponsor_url_value]; ?>" target="_new">
		  <?php } ?>
		  <?php print $row['image_attach_images']; #$img_src; ?>
          <?php if ($row['field_sponsor_url_value']) { ?>
	        </a>
		  <?php } ?>
		</td></tr>
    <?php endforeach; ?>
  </tbody>
</table>
