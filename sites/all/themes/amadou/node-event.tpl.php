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
    
    <?php /*if ($taxonomy) : ?>
      <div class="taxonomy">
        Tagged:&nbsp;&nbsp;<?php print $terms; ?>
      </div>
    <?php endif; */?>
    
    <div class="content node-event">
<?php
  if (preg_match('%Repeats%',$content)) { 
    print preg_replace('%<span class="date-display-single">.*?</span></span>%','',$content);
  }
  else {
    print $content;
  }
?>
      <div style="clear: both;"></div>
    </div>
    
    <?php if ($links) : ?>
		<?php
		# Grab the year and month of this event to feed to the link, so when we click
		# on Calendar at the bottom, it goes to the month of this event
		date_default_timezone_set($node->field_date[0]['timezone']);
		
		//get server time as a unix timestamp
		$unixtime = strtotime(preg_replace('/T/',' ',$node->field_date[0]['value']) . ' '.$node->field_date[0]['timezone_db']); 
		
		//convert to human readable local time
		$month_view = date('Y-m', $unixtime);
		?>
      <div class="links">
        <?php print (preg_replace('%"/events/calendar"%','"/events/calendar/'.$month_view.'"',$links)); ?>
      </div>
    <?php endif; ?>
    
  </div>
