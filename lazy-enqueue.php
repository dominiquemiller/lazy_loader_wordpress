<?php

add_action( 'wp_enqueue_scripts', 'lazy_enqueued_scripts' );

function lazy_enqueued_scripts() {
  // Enqueue syle 
  wp_enqueue_style( 'lazy-loader-css',  plugin_dir_url( __FILE__ ) . '/css/styles.css' );

  // Register the script
  wp_register_script( 'lazy-loader-js',  plugin_dir_url( __FILE__ ) . '/js/lazy-loader.js', array( 'jquery' ), '1.0', true );

  // Send global max num of pages to js script
  $element_id = get_option('container_id') != '' ? get_option('container_id') : '#more-blog-posts';
  $fetch_count = get_option('fetch_count') != '' ? get_option('fetch_count') : 6;
  $spinner_color = get_option('lazy_spinner_color') != '' ? get_option('lazy_spinner_color') : '#007cba';
  $spinner_height = get_option('lazy_spinner_height') != '' ? get_option('lazy_spinner_height') : '2'; 
  $spinner_speed = get_option('lazy_spinner_speed') != '' ? get_option('lazy_spinner_speed') : '1000';

  $the_query = new WP_Query( array( 'posts_per_page' => $fetch_count,
                                         'post_type' => 'post') );

  $max_pages = $the_query->max_num_pages;

  $translation_array = array(
    'max' => $max_pages,
    'elementID' => $element_id,
    'fetchCount' => $fetch_count,
    'spinnerColor' => $spinner_color,
    'spinnerHeight' => $spinner_height,
    'spinnerSpeed' => $spinner_speed,
    'index' => get_option('lazy_posts_index')
    );

  wp_localize_script( 'lazy-loader-js', 'pagination', $translation_array );

  // Enqueued script with localized data.
  wp_enqueue_script( 'lazy-loader-js' );
  
}

// restrict loading of script to user selected page
function only_load_on_post_index() {
  $index_page = get_option('lazy_posts_index');
 
  if( !is_page( $index_page ) ) {
      wp_dequeue_script('lazy-loader-js');
  }
}

add_action( 'wp_enqueue_scripts', 'only_load_on_post_index' );

// enqueue css and js for plugin settings
function lazy_loader_plugin_style() {
        wp_register_style( 'lazy_loader_css', plugin_dir_url( __FILE__ ) . '/css/styles.css', false, '1.0.0' );
        wp_enqueue_style( 'lazy_loader_css' );

        wp_enqueue_script( 'lazy-spinner-settings', plugin_dir_url( __FILE__ ) . '/js/lazy-spinner-settings.js', array( 'jquery' ), '1.0', true );
}

add_action( 'admin_enqueue_scripts', 'lazy_loader_plugin_style' );

