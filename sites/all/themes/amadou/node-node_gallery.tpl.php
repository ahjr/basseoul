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
	<div class="node-gallery">
      <?php print $content; ?>
	</div>
<?php
$block = module_invoke('ddblock', 'block', 'view','1');
print $block['content'];
?>
     <div style="margin-top: 0.5em;">Click on the slideshow to move to the next image.</div>
	 <div style="margin-bottom: 0.5em;">Hover your mouse pointer over the slideshow to pause scrolling.</div>
      <div style="clear: both;"></div>
    </div>
    
    <?php if ($links) : ?>
      <div class="links">
        <?php print $links; ?>
      </div>
    <?php endif; ?>
    
  </div>
