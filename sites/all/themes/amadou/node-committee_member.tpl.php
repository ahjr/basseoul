  <div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>">
  
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
<?php 
  $position = $node->field_position[0]['safe'];
  $image = preg_replace('/^.*?src="(.*?)thumbnail\.(.*?)".*$/s','\1\2',$node->content['image_attach']['#value']);
  $body = $node->content['body']['#value'];
?>
      <?php print $node->content['print_links']['#value']; ?>
      <table style="margin: 0">
	    <tbody>
		<tr>
		  <td style="border-bottom: 1px dotted #CCCCCC"><h3><?php print $position; ?></h3></td>
		  <td rowspan="2" valign="top"><?php print $node->field_image[0]['view']; ?></td>
		</tr>
		<tr><td><?php print $body; ?></td></tr>
	  </tbody>
	  </table>

      <div style="clear: both;"></div>
    </div>
   
    <?php if ($links) : ?>
      <div class="links">
        <?php print $links; ?>
      </div>
    <?php endif; ?>
    
  </div>
