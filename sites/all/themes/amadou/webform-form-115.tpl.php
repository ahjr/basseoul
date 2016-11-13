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
  // If editing or viewing submissions, display the navigation at the top.
  if (isset($form['submission_info']) || isset($form['navigation'])) {
    print drupal_render($form['navigation']);
    print drupal_render($form['submission_info']);
  }

  // Hack away
  unset($form['submitted']['tt_fieldset']['t_or_t'][0]['#title']);
  unset($form['submitted']['tt_fieldset']['t_or_t'][1]['#title']);
  unset($form['submitted']['tt_fieldset']['tables']['#title']);
  unset($form['submitted']['tt_fieldset']['tickets']['#title']);
  unset($form['submitted']['sponsorship_level']['#options'][0]);
  unset($form['submitted']['tt_fieldset']['t_or_t']['#title']);

  $form['submitted']['tt_fieldset']['t_or_t']['#prefix'] = '<table style="margin: 0;"><tbody style="border: none;"><tr><td>' . $form['submitted']['tt_fieldset']['t_or_t']['#prefix'];
  $form['submitted']['tt_fieldset']['t_or_t']['#suffix'] = $form['submitted']['tt_fieldset']['t_or_t']['#suffix'] . '</td>';
  $form['submitted']['tt_fieldset']['tables']['#prefix'] = '<td style="padding-left: 1em;">' . $form['submitted']['tt_fieldset']['tables']['#prefix'];
  $form['submitted']['tt_fieldset']['tickets']['#suffix'] = $form['submitted']['tt_fieldset']['tickets']['#suffix'] . '</td></tr></tbody></table>';

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
