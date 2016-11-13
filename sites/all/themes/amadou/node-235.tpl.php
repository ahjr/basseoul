  <div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>" style="border-bottom: 0px none; margin-bottom: 0px;">
  
    <?php if ($picture) { print $picture; } ?>
    
    <?php if ($page == 0) : ?>
      <h2 class="nodeTitle">
        <a href="<?php print $node_url; ?>">
          <?php print $title; ?>
        </a>
      </h2>
    <?php endif; ?>
    
    <?php if ($submitted) : ?>
      <div class="submitted">
        <?php print t('By ') . theme('username', $node) . t(' - Posted on ') . format_date($node->created, 'custom', "F jS, Y"); ?>
      </div> 
    <?php endif; ?>
    
    <?php if ($taxonomy) : ?>
      <div class="taxonomy">
        Tagged:&nbsp;&nbsp;<?php print $terms; ?>
      </div>
    <?php endif; ?>
    
    <div class="content">
<?php print $node->content['print_links']['#value']; ?>
   <div class="page-images">
<?php if ($node->field_image_attach) {
  foreach ($node->field_image_attach as $id => $value) { 
    if ($value['filepath']) {
?>
    <div class="image-container">
	  <div class="image-container-inner"><?php print $value['view']; ?></div>
	  <div class="caption"><?php print $value['data']['title']; ?></div></div>
<?php	} #end if
    } #end foreach
  } #end if
?>  
      </div>
	  <?php print $node->content['body']['#value']; ?>
      <div style="clear: both;"></div>
    </div>
    
    <?php if ($links) : ?>
      <div class="links">
        <?php print $links; ?>
      </div>
    <?php endif; ?>
    
  </div>
