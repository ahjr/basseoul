<?php
// Amadou 3.x
// $Id: template.php,v 1.6.2.1.6.3.2.7 2007/12/07 23:05:15 jwolf Exp $

/* Register some theme functions for forms, theme functions
* that have not been registered by the module that created
* these forms...
*/
function amadou_theme(){
  return array(
    'contact_mail_page' => array(
      'arguments' => array('form' => NULL),
      'template' => 'contact-mail-page',
    ),
  );
}

function amadou_preprocess_contact_mail_page (&$vars) {
    $email_user = $_GET['user'];
	if ($email_user) {
	    $cid = db_result(db_query("SELECT cid FROM {contact} WHERE recipients LIKE \"%s@britishseoul.com\"", $email_user));
		if (!$cid) {
		    $cid = 3;
		}
		$vars['form']['cid']['#value'] = $cid;
	}
    $vars['form_markup'] = drupal_render($vars['form']);
}

/**
* Adjust content width according to the absence or presence of sidebars.
*
*   If only one sidebar is active, the mainContent width will expand to fill
*   the space of the missing sidebar.
*/
function amadou_get_mainContent_width($sidebar_left, $sidebar_right) {
  $width = 530;
  if (!$sidebar_left) {
    $width = $width + 180;
  }  
  if (!$sidebar_right) {
    $width = $width + 180;
  }  
  return $width;
}
function amadou_get_sideBars_width($sidebar_left, $sidebar_right) {
  $width = 415;
  if (!$sidebar_left) {
    $width = $width - 205;
  }  
  if (!$sidebar_right) {
    $width = $width - 205;
  }  
  return $width;
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
/*   if (!empty($breadcrumb)) {
     return '<div class="breadcrumb">'. implode(' :: ', $breadcrumb) .'</div>';
   } */
     $links = array();
  $path = '';

  // Get URL arguments
  $arguments = explode('/', $_REQUEST['q']);

  // Remove empty values
  foreach ($arguments as $key => $value) {
    if (empty($value)) {
      unset($arguments[$key]);
    }
  }
  $arguments = array_values($arguments);

  // Add 'Home' link
  $links[] = l(t('Home'), '<front>');

  // Add other links
  if (!empty($arguments)) {
    foreach ($arguments as $key => $value) {
      // Don't make last breadcrumb a link
      if ($key == (count($arguments) - 1)) {
        $links[] = drupal_get_title();
      } else {
        if (!empty($path)) {
          $path .= '/'. $value;
        } else {
          $path .= $value;
        }
        $links[] = l(drupal_ucfirst($value), $path);
      }
    }
  }

  // Set custom breadcrumbs
  drupal_set_breadcrumb($links);

  // Get custom breadcrumbs
  $breadcrumb = drupal_get_breadcrumb();

  // Hide breadcrumbs if only 'Home' exists
  if (count($breadcrumb) > 1) {
    return '<div class="breadcrumb">'. implode(' &raquo; ', $breadcrumb) .'</div>';
  }
 }

/**
* Catch the theme_links function 
*/
function phptemplate_links($links, $attributes = array('class' => 'links')) {
$output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = '';

      // Automatically add a class to each link and also to each LI
      if (isset($link['attributes']) && isset($link['attributes']['class'])) {
        $link['attributes']['class'] .= ' ' . $key;
        $class = $key;
      }
      else {
        $link['attributes']['class'] = $key;
        $class = $key;
      }

      // Add first and last classes to the list of links to help out themers.
      $extra_class = '';
      if ($i == 1) {
        $extra_class .= 'first ';
      }
      if ($i == $num_links) {
        $extra_class .= 'last ';
      }
      $output .= '<li class="'. $extra_class . $class .'">';

      // Is the title HTML?
      $html = isset($link['html']) && $link['html'];

      // Initialize fragment and query variables.
      $link['query'] = isset($link['query']) ? $link['query'] : NULL;
      $link['fragment'] = isset($link['fragment']) ? $link['fragment'] : NULL;

      if (isset($link['href'])) {
        $link_options = array('attributes'  => $link['attributes'],
                              'query'       => $link['query'],
                              'fragment'    => $link['fragment'],
                              'absolute'    => FALSE,
                              'html'        => $html);
        $output .= l($link['title'], $link['href'], $link_options);
      }
      else if ($link['title']) {
        //Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (!$html) {
          $link['title'] = check_plain($link['title']);
        }
        $output .= '<span'. drupal_attributes($link['attributes']) .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
} 

/**
* Customize a TinyMCE theme.
*
* @param init
*   An array of settings TinyMCE should invoke a theme. You may override any
*   of the TinyMCE settings. Details here:
*
*    http://tinymce.moxiecode.com/wrapper.php?url=tinymce/docs/using.htm
*
* @param textarea_name
*   The name of the textarea TinyMCE wants to enable.
*
* @param theme_name
*   The default tinymce theme name to be enabled for this textarea. The
*   sitewide default is 'simple', but the user may also override this.
*
* @param is_running
*   A boolean flag that identifies id TinyMCE is currently running for this
*   request life cycle. It can be ignored.
*/
function phptemplate_tinymce_theme($init, $textarea_name, $theme_name, $is_running) {

  switch ($textarea_name) {
    // Disable tinymce for these textareas
    case 'log': // book and page log
    case 'img_assist_pages':
    case 'caption': // signature
    case 'pages':
    case 'access_pages': //TinyMCE profile settings.
    case 'user_mail_welcome_body': // user config settings
    case 'user_mail_approval_body': // user config settings
    case 'user_mail_pass_body': // user config settings
    case 'synonyms': // taxonomy terms
    case 'description': // taxonomy terms
      unset($init);
      break;

    // Force the 'simple' theme for some of the smaller textareas.
    case 'signature':
    case 'site_mission':
    case 'site_footer':
    case 'site_offline_message':
    case 'page_help':
    case 'user_registration_help':
    case 'user_picture_guidelines':
      $init['theme'] = 'simple';
      foreach ($init as $k => $v) {
        if (strstr($k, 'theme_advanced_')) unset($init[$k]);
      }
      break;
  }

  // Add some extra features when using the advanced theme. 
  // If $init is available, we can extend it
  if (isset($init)) {
    switch ($theme_name) {
     case 'advanced':
   $init['width'] = '100%';
       break;
  
    }
  }

  // Always return $init
  return $init;
}

// Allow node-[NID].tpl.php
function phptemplate_preprocess_node(&$vars) {
    $vars['template_files'][] = 'node-' . $vars['nid'];
    return $vars;
}

// Disable sticky table headers
function phptemplate_preprocess_page(&$vars) {
/*  global $user;
  if ($user->uid == 3) {
    print_r($vars);
  }*/
  $js = drupal_add_js();
  unset($js['module']['misc/tableheader.js']);
  $vars['scripts'] = drupal_get_js('header', $js);

//  if (preg_match('%jquery\.gallery%',$vars['scripts'])) {
//    drupal_add_css(drupal_get_path('theme','amadou').'/jquery.gallery/jquery.gallery.css','theme');
//	$vars['styles'] = drupal_get_css();
//  }
}

/**
 * Return a themed sitemap box.
 *
 * @param $title
 *   The subject of the box.
 * @param $content
 *   The content of the box.
 * @param $class
 *   Optional extra class for the box.
 * @return
 *   A string containing the box output.
 */
function amadou_site_map_box($title, $content, $class = '') {
  return  '<div class="sitemap-box '. $class .'"><div class="content">'. $content .'</div></div>';
}

function amadou_views_pre_render(&$view) {
  if ($view->name == "content_management") {
	$i=0;
    foreach ($view->result as $result) {
	  if (!(node_access("edit",node_load($result->nid)) || node_access("delete",node_load($result->nid)))) {
		unset($view->result[$i]);
	  }
	$i++;
	}
  }
}


/* AJR - This needs fixing to allow calling via email prefix for ease of use */
/*function phptemplate_form_alter($form_id, &$form) {
  if ($form_id == 'contact_mail_page' && !empty($_GET['cid'])) {
	$form['cid']['#value'] = $_GET['cid'];
  }
}*/
function phptemplate_preprocess_contact_mail_page (&$vars) {
    print_r($vars);
}

/*!
 * Dynamic display block preprocess functions
 * Copyright (c) 2008 - 2009 P. Blaauw All rights reserved.
 * Version 1.6 (01-OCT-2009)
 * Licenced under GPL license
 * http://www.gnu.org/licenses/gpl.html
 */

 /**
 * Override or insert variables into the ddblock_cycle_block_content templates.
 *   Used to convert variables from view_fields to slider_items template variables
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * 
 */
function amadou_preprocess_ddblock_cycle_block_content(&$vars) {
    if ($vars['settings']['view_name'] == 'node_gallery') {
      if (!empty($vars['content'])) {
        foreach ($vars['content'] as $key1 => $result) {
          // add slide_image variable 
		  if (isset($result->node_data_field_multiple_image_field_field_multiple_image_field_fid)) {
            // get image id
            $fid = $result->node_data_field_multiple_image_field_field_multiple_image_field_fid;
            // get path to image
            $filepath = db_result(db_query("SELECT filepath FROM {files} WHERE fid = %d", $fid));
            //  use imagecache (imagecache, preset_name, file_path, alt, title, array of attributes)
            if (module_exists('imagecache') && is_array(imagecache_presets()) && $vars['imgcache_slide'] <> '<none>'){
              $slider_items[$key1]['slide_image'] = 
              theme('imagecache', 
                    $vars['imgcache_slide'], 
                    $filepath,
                    $result->node_title);
            }
            else {          
              $slider_items[$key1]['slide_image'] = 
                '<img src="' . base_path() . $filepath . 
                '" alt="' . $result->node_title . 
                '"/>';     
            }          
          }      
    //  add slide_title and slide_text variable from imagefield title and description
    if (isset($result->node_data_field_multiple_image_field_field_multiple_image_field_data)) {
      $data=unserialize($result->node_data_field_multiple_image_field_field_multiple_image_field_data);
      if (isset($data['description'])) {
       $slider_items[$key1]['slide_text'] = $data['description'];
	  }
      if (isset($data['title'])) {
		$slider_items[$key1]['slide_title'] =  $data['title'];
      }
    }

	// add slide_read_more variable and slide_node variable
          if (isset($result->nid)) {
            $slider_items[$key1]['slide_read_more'] =  l('View image', $filepath);
            $slider_items[$key1]['slide_node'] =  'node/' . $result->nid;
          }
        }
        $vars['slider_items'] = $slider_items; 
      }
    }
}  
/**
 * Override or insert variables into the ddblock_cycle_pager_content templates.
 *   Used to convert variables from view_fields  to pager_items template variables
 *  Only used for custom pager items
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 *
 */
function amadou_preprocess_ddblock_cycle_pager_content(&$vars) {
    if ($vars['pager_settings']['view_name'] == 'node_gallery') {
      if (!empty($vars['content'])) {
        foreach ($vars['content'] as $key1 => $result) {
          // add pager_item_image variable
          if (isset($result->node_data_field_multiple_image_field_field_multiple_image_field_fid)) {
            $fid = $result->node_data_field_multiple_image_field_field_multiple_image_field_fid;
            $filepath = db_result(db_query("SELECT filepath FROM {files} WHERE fid = %d", $fid));
            //  use imagecache (imagecache, preset_name, file_path, alt, title, array of attributes)
            if (module_exists('imagecache') && 
                is_array(imagecache_presets()) && 
                $vars['imgcache_pager_item'] <> '<none>'){
              $pager_items[$key1]['image'] = 
                theme('imagecache', 
                      $vars['pager_settings']['imgcache_pager_item'],              
                      $filepath,
                      $result->node_data_field_multiple_image_field_field_multiple_image_field_data);
            }
            else {          
              $pager_items[$key1]['image'] = 
                '<img src="' . base_path() . $filepath . 
                '" alt="' . $result->node_data_field_multiple_image_field_field_multiple_image_field_data . 
                '"/>';     
            }          
          }
          // add pager_item _text variable from imagefield alternative text
          if (isset($result->node_data_field_multiple_image_field_field_multiple_image_field_data)) {
		    $data=unserialize($result->node_data_field_multiple_image_field_field_multiple_image_field_data);
		  if (isset($data['alt'])) {
		    $pager_items[$key1]['text'] =  $data['alt'];
            }          
		  }
        }
      }
      $vars['pager_items'] = $pager_items;
    }
}

/* Poke about with the search form to allow it to be used in the header */
function phptemplate_preprocess_fuzzysearch_block_form (&$vars) {
//  remove label (title) of input field
  unset($vars['form']['fuzzysearch_block_form']['#title']);

//  rebuild the rendered version (search form, rest remains unchanged)
  unset($vars['form']['fuzzysearch_block_form']['#printed']);
  $vars['search']['fuzzysearch_block_form'] = drupal_render($vars['form']['fuzzysearch_block_form']);

/**
* Additional
*/
//  collect all form elements to make it easier to print the whole form.
  $vars['search_form'] = implode($vars['search']);
  
	#print_r($vars);
	
}
