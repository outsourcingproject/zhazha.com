<?php
function wysiwyg_imagepaster_plugin() {
  $plugins['imagepaster'] = array(
    'title' => t('Image Paster'),
    'vendor url' => 'http://drupal.org/project/wysiwyg',
    'icon file' => 'paster.png',
    'icon title' => t('Paste images'),
    'settings' => array(),
  );
  return $plugins;
}
?>