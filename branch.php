<?php

require_once 'branch.civix.php';
use CRM_branch_ExtensionUtil as E;

/**
 * Supports multiple theme variations/streams.
 */

function branch_civicrm_themes(&$themes) {
  $themes['albany'] = array(
    'ext' => 'branch',
    'title' => 'Albany (GPO front-end)',
    'prefix' => 'albany/',
    'search_order' => array( 'albany',  '_riverlea_core_', '_fallback_'),
  );
}

/**
 * Check if current active theme is a branch theme
 * @return bool
 */
function _branch_is_active() {
  $themeKey = Civi::service('themes')->getActiveThemeKey();
  $themeExt = Civi::service('themes')->get($themeKey)['ext'];
  return ($themeExt === 'branch');
}

function branch_civicrm_config(&$config) {
  _branch_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_alterBundle(). Add Bootstrap JS.
 */
function branch_civicrm_alterBundle(CRM_Core_Resources_Bundle $bundle) {
  if (!_branch_is_active()) {
    return;
  }

  if ($bundle->name === 'bootstrap3') {
    $bundle->clear();
    $bundle->addStyleFile('branch', 'core/css/_bootstrap.css');
    $bundle->addScriptFile('branch', 'js/bootstrap.min.js', [
      'translate' => FALSE,
    ]);
    $bundle->addScriptFile('branch', 'js/noConflict.js', [
      'translate' => FALSE,
    ]);
  }
}


/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function branch_civicrm_install() {
  _branch_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function branch_civicrm_enable() {
  _branch_civix_civicrm_enable();
}
