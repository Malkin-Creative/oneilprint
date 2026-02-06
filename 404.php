<?php

/**
 *
 *
 * @package Bootscore
 * @version 6.1.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header(); ?>

<?php
$page = get_page_by_path('404-2');

if ($page) {
    echo apply_filters('the_content', $page->post_content);
}

get_footer();
