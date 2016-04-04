<?php

/**
 * @file
 * template.php
 */

function pre($v)
{
  echo '<pre>' . print_r($v, 1) . '</pre>';
}

function get_summary($content)
{
  $tmp = strip_tags($content);
  $tmp = preg_replace('/( | )+/', ' ', $tmp);
  return mb_substr($tmp, 0, 500, 'utf-8');
}

function bootstrap_subtheme_process_page(&$variables)
{
  if (isset($variables['node']->type)) {
    $variables['theme_hook_suggestions'][] = 'page__node_type__' . $variables['node']->type;
  }
}

function bootstrap_subtheme_process_flag(&$variables)
{
  if ($variables['flag']->name == 'praise') {
    $variables['node'] = node_load($variables['entity_id']);
    if (isset($variables['node']->type)) {
      $variables['theme_hook_suggestions'][] = 'flag__node_type__' . $variables['node']->type;
    }
  }
}