<?php
  drupal_add_js(drupal_get_path('theme','amadou').'/jquery.gallery/jquery.gallery.0.3.js','theme');
  
  $inline_js = "$('#slideshow_gallery').gallery({";
  $inline_js.= "interval: 5500,";
  $inline_js.= "height: '400px',";
  $inline_js.= "width: '500px'";
  $inline_js.= "});";
  drupal_add_js($inline_js, 'inline');
  
  $image = array();
?>

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
	<?php #print_r($node); ?>
      <?php #print $content; ?>
	  <?php print $node->content['print_links']['#value']; ?>
	  <?php print $node->content['field_event_date']['#children']; ?>
	  <?php print $node->content['body']['#value']; ?>
	  <div id="slideshow_gallery" class="gallery">
        <ul class="galleryBar">
      <?php foreach ($node->content['field_images']['field']['items'] as $id => $image) { ?>
	    <?php if (preg_match('/^#/',$id)) { continue; } ?>
          <li><a href="<?php print '../'.$image['#item']['filepath']; ?>" title="<?php print '/'.$image['#item']['data']['title']; ?>">
		  <?php print theme('imagecache', 'gallery_thumb', $image['#item']['filepath'], '', $image['#item']['data']['title']); ?></a></li>
      <?php  } ?>
  </ul>
</div>

	  
      <div style="clear: both;"></div>
    </div>
    
    <?php if ($links) : ?>
      <div class="links">
        <?php print $links; ?>
      </div>
    <?php endif; ?>
    
  </div>
