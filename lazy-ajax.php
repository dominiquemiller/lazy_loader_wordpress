<?php

// AJAX  infinite paginate
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');

function wp_infinitepaginate() {
  $loopFile        = $_POST['loop_file'];
  $paged           = $_POST['page_no'];
  $posts_per_page  = get_option('fetch_count');

  query_posts(array('paged' => $paged,
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page));

  get_template_part( $loopFile );

  exit;
}

