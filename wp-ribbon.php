<?php
/*
  Plugin Name: WP Ribbon
  Plugin URI: https://github.com/mikcat/wp-ribbon
  Description: Configurable remembrance/mourning ribbon wordpress plugin
  Author: mikcat
  Version: 1.0
 */

if (!function_exists('add_action')) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

define('WPRIBBON__PLUGIN_DIR', plugin_dir_path(__FILE__));

if (is_admin()) {
  require_once( WPRIBBON__PLUGIN_DIR . 'options.php' );
}

$options = get_option('wpribbon-settings');

if ($options && !empty($options['enabled'])) {
  require_once( WPRIBBON__PLUGIN_DIR . 'ribbon.php' );
}