<?php
// $Id$ 

/*!
 * Dynamic display block module template: chromatic-blue10l - pager template
 * Copyright (c) 2008 - 2009 P. Blaauw All rights reserved.
 * Version 1.0 (13-DEC-2009)
 * Licenced under GPL license
 * http://www.gnu.org/licenses/gpl.html
 */

/**
 * @file
 * Dynamic display block module template: chromatic-blue10l - pager template
 * - Number pager
 *
 * Available variables:
 * - $delta: Block number of the block.
 * - $pager: Type of pager to add
 *
 * notes: don't change the ID names, they are used by the jQuery script.
 */
?>
<!-- number pager -->
<div id="ddblock-<?php print $pager ."-". $delta ?>" class="<?php print $pager ?> <?php print $pager ?>-<?php print $pager_position ?> clear-block">
</div>
