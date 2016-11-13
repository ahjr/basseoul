<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>">

<head>
  <meta name="google-site-verification" content="QZd4RkYTJ91IAnvGbWYBxdamBv3pplBOPXaWRUPSRPs" />
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
    <!--[if IE 6]>
      <style type="text/css" media="all">@import "<?php print base_path() . path_to_theme() ?>/ie-fixes/ie6.css";</style>
    <![endif]-->
    <!--[if lt IE 7.]>
      <script defer type="text/javascript" src="<?php print base_path() . path_to_theme() ?>/ie-fixes/pngfix.js"></script>
    <![endif]-->
</head>

<body id="primary">

  <!-- begin container -->
  <div id="container">

<?php /*
    <!-- primary links -->
    <div id="menu">
      <?php if (isset($primary_links)) : ?>
        <?php print theme('links', $primary_links) ?>
      <?php endif; ?>
    </div><!-- end primary links -->

*/ ?>
    <!-- begin header -->

    <div id="header">

      <!-- site logo -->
      <div id="header_top" class="header_top">
	  <?php if ($logo) : ?>
        <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>">
          <img class="logo" src="<?php print $logo ?>" alt="<?php print t('Home') ?>" />
        </a>
      <?php endif; ?><!-- end site logo -->
	  <?php if ($header_top) : ?>
	    <div style="float: right; position:relative; top: 20px; right: 10px;"><?php print $header_top; ?></div>
	  <?php endif; ?>
	  </div>

<?php /*
      <!-- site name -->
      <?php if ($site_name) : ?>
        <h1>
	  <a href="<?php print $base_path ?>" title="<?php print t('Home') ?>">
	    <?php print $site_name; ?>
	  </a>
	</h1>
      <?php endif; ?><!-- end site name -->
	  
      <!-- site slogan -->
      <?php if ($site_slogan) : ?>
        <h2>
	<?php print $site_slogan; ?>
	  </h2>
      <?php endif; ?><!-- end site slogan -->
*/ ?>

    <?php  if ($header_bottom) : ?>
	  <div id="header_bottom" class="header_bottom">
	    <?php print preg_replace('%\<h2 class="title"\>.*?\</h2\>%s','',$header_bottom); ?>
		<div class="header_login">
<?php global $user;
#  Check if user is logged in.  Show welcome message if yes, login message if no.
  if ($user->uid) {
    print l("My account", "user");
	print " | ";
    print l("Logout","logout");
  } else {
    print l("Login","user/login");
#	print " | ";
#	print l("Register","user/register");
  }
?>		</div><!-- end header_login -->
      </div><!-- end header_bottom -->
	<?php endif; ?>
    </div><!-- end header -->

    <!-- content -->
    <!-- begin mainContent -->
    <div id="mainContent" style="width: <?php print amadou_get_mainContent_width( $sidebar_left, $sidebar_right) ?>px;">
        
    <?php if ($mission): print '<div class="mission">'. $mission .'</div>'; endif; ?>
    <?php if ($breadcrumb): print '<div class="breadcrumb">'. $breadcrumb . '</div>'; endif; ?>
    <?php if ($title) : print '<h1 class="pageTitle">' . $title . '</h1>'; endif; ?>
    <?php if ($tabs) : print '<div class="tabs">' . $tabs . '</div>'; endif; ?>
    <?php if ($help) : print '<div class="help">' . $help . '</div>'; endif; ?>
    <?php if ($messages) : print '<div class="messages">' .$messages . '</div>'; endif; ?>
    <?php print $content_top; ?>
    <?php print $content; ?>
    <?php print $content_bottom; ?>
    <?php print $feed_icons; ?>

    </div><!-- end mainContent -->

        <?php if ($sidebar_left) : ?>
    <div id="sideBars-left-bg" style="width: 200px;">
      <div id="sideBars-left" style="width: 200px;">

        <!-- left sidebar -->
          <div id="leftSidebar">
            <?php print $sidebar_left; ?>
          </div>
		
      </div><!-- end sideBars -->
    </div><!-- end sideBars-bg -->
        <?php endif; ?>
	
    <!-- begin sideBars -->
    <div id="sideBars-right-bg" style="width: 210px;">
      <div id="sideBars-right" style="width: 210px;">
<?php /*
    <div id="sideBars-right-bg" style="width: <?php print amadou_get_sideBars_width( $sidebar_left, $sidebar_right) ?>px;">
      <div id="sideBars-right" style="width: <?php print amadou_get_sideBars_width( $sidebar_left, $sidebar_right) ?>px;">
<?php /*
        <!-- left sidebar -->
        <?php if ($sidebar_left) : ?>
          <div id="leftSidebar">
            <?php print $sidebar_left; ?>
          </div>
        <?php endif; ?>
*/ ?>
        
        <!-- right sidebar -->
        <?php if ($sidebar_right) : ?>
          <div id="rightSidebar">
            <?php print $sidebar_right; ?>
          </div>
        <?php endif; ?>

      </div><!-- end sideBars -->
    </div><!-- end sideBars-bg -->
    


    <!-- footer -->
    <div id="footer">
      <?php print $footer_message; ?>
      <?php print $footer; ?>
    </div><!-- end footer -->
    
  </div><!-- end container -->

  <?php print $closure ?>
</body>
</html>
