<?php
// $Id: views-view-list.tpl.php,v 1.3 2008/09/30 19:47:11 merlinofchaos Exp $
/**
 * @file views-view-list.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>
<div class="item-list">
  <?php if (!empty($title)) : ?>
    <a name="<?php print $title; ?>"><h3><?php print $title; ?></h3></a> <a href="#" style="display:inline;font-size:x-small;">[Back to top]</a>
  <?php endif; ?>
  <<?php print $options['type']; ?> id="community_links_ul">
    <?php foreach ($rows as $id => $row): ?>
	  <?php $row = preg_replace('%<a href="/" target="_new">(.*?)</a>%','\1',$row); ?>
      <li class="<?php print $classes[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
  </<?php print $options['type']; ?>>
</div>