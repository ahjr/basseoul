<?php
// $Id: webform-form.tpl.php,v 1.1.2.4 2009/01/11 23:09:35 quicksketch Exp $

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 */
?>
<?php
  include_once( 'form-formatting-helpers.php' );

  // If editing or viewing submissions, display the navigation at the top.
  if (isset($form['submission_info']) || isset($form['navigation'])) {
    print drupal_render($form['navigation']);
    print drupal_render($form['submission_info']);
  }

  // Hack away
  // If an arrival date is set, set a day value.  We're not interested in the day, but the date won't validate without one.
  if ($form['submitted']['basic_details']['arrived_in_korea']['month']['#value'] && $form['submitted']['basic_details']['arrived_in_korea']['year']['#value']) {
    $form['submitted']['basic_details']['arrived_in_korea']['day']['#value'] = "1";
  }
  
  // Display Basic details fieldset as a table
  $form['submitted']['basic_details']['family_name']['#prefix'] = '<table style="margin: 1em 0;"><tbody style="border-top: none;"><tr><td style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['family_name']['#suffix'] = '</td>';
  $form['submitted']['basic_details']['first_name']['#prefix'] = '<td  style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['first_name']['#suffix'] = '</td></tr>';
  $form['submitted']['basic_details']['telephone']['#prefix'] = '<tr><td  style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['telephone']['#suffix'] = '</td>';
  $form['submitted']['basic_details']['mobile']['#prefix'] = '<td  style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['mobile']['#suffix'] = '</td></tr>';
  $form['submitted']['basic_details']['e_mail']['#prefix'] = '<tr><td style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['e_mail']['#suffix'] = '</td>';
  $form['submitted']['basic_details']['arrived_in_korea']['#prefix'] = '<td style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['arrived_in_korea']['#suffix'] = '</td></tr>';
  $form['submitted']['basic_details']['month_of_birth']['#prefix'] = '<tr><td  style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['month_of_birth']['#suffix'] = '</td>';
  $form['submitted']['basic_details']['nationality']['#prefix'] = '<td  style="padding: 0; width: 50%;">';
  $form['submitted']['basic_details']['nationality']['#suffix'] = '</td></tr></tbody></table>';

  // Add a line break 
  $form['submitted']['further_details']['give_talk_select']['#suffix'] = $form['submitted']['further_details']['give_talk_select']['#suffix'].'<br />';
  $form['submitted']['membership_details']['newsletter']['#suffix'] = $form['submitted']['membership_details']['newsletter']['#suffix'].'<br />';

  // Display Spouse details as a table
  $form['submitted']['details_of_spousepartner']['surname']['#prefix'] = '<table style="margin: 1em 0;"><tbody style="border-top: none;"><tr><td style="padding: 0; width: 50%;">';
  $form['submitted']['details_of_spousepartner']['surname']['#suffix'] = '</td>';
  $form['submitted']['details_of_spousepartner']['forename']['#prefix'] = '<td  style="padding: 0; width: 50%;">';
  $form['submitted']['details_of_spousepartner']['forename']['#suffix'] = '</td></tr>';
  $form['submitted']['details_of_spousepartner']['nationality']['#prefix'] = '<tr><td colspan="2" style="padding: 0;">';
  $form['submitted']['details_of_spousepartner']['nationality']['#suffix'] = '</td></tr>';
  $form['submitted']['details_of_spousepartner']['company__occupation']['#prefix'] = '<tr><td colspan="2" style="padding: 0;">';
  $form['submitted']['details_of_spousepartner']['company__occupation']['#suffix'] = '</td></tr></tbody></table>';

  // Display Children in a table
  $personal_info_header = array('', 'Name','&nbsp;&nbsp;Sex','Birth year','School');
  fieldset_subfieldsets_to_table( $form['submitted']['children'], $personal_info_header );
#print_r($form);
  // Print out the main part of the form.
  // Feel free to break this up and move the pieces within the array.
  print drupal_render($form['submitted']);

  // Always print out the entire $form. This renders the remaining pieces of the
  // form that haven't yet been rendered above.
  print drupal_render($form);

  // Print out the navigation again at the bottom.
  if (isset($form['submission_info']) || isset($form['navigation'])) {
    unset($form['navigation']['#printed']);
    print drupal_render($form['navigation']);
  } 
?>