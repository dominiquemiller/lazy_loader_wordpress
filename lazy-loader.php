<?php
/**
 * Plugin Name: ECT lazy blog post loader 
 * Plugin URI: 
 * Description: This plugin adds uses AJAX to auto load blog posts 
 * Version: 1.0.0
 * Author: Dominique Miller
 * Author URI: 
 * License: GPL2
 */


include( plugin_dir_path( __FILE__ ) . 'lazy-ajax.php');

include( plugin_dir_path( __FILE__ ) . 'lazy-enqueue.php');

include( plugin_dir_path( __FILE__ ) . 'lazy-template.php');

// add Plugin User settings to admin panel
add_action('admin_menu', 'lazy_loader_menu');

function lazy_loader_menu() {
  add_menu_page('Lazy Loader Settings', 
                'Lazy Loader',
                'administrator',
                'lazy-loader-settings',
                'lazy_loader_settings_page',
                'dashicons-admin-generic' );
}

//register the user selectable settings
add_action('admin_init', 'lazy_loader_settings');

function lazy_loader_settings() {
  register_setting( 'lazy-loader-settings-group', 'fetch_count');
  register_setting( 'lazy-loader-settings-group', 'container_id');
  register_setting( 'lazy-loader-settings-group', 'lazy_posts_index');
  register_setting( 'lazy-loader-settings-group', 'lazy_spinner_color');
  register_setting( 'lazy-loader-settings-group', 'lazy_spinner_height');
  register_setting( 'lazy-loader-settings-group', 'lazy_spinner_speed');
}

