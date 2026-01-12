<?php

/**
 * @package Bootscore Child
 *
 * @version 6.0.0
 */


// Exit if accessed directly
defined('ABSPATH') || exit;

require_once('inc/widgets.php'); // Register widget area and disables Gutenberg in widgets

/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles() {

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  
  // custom.js
  // Get modification time. Enqueue file with modification date to prevent browser from loading cached scripts when file content changes. 
  $modificated_CustomJS = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/custom.js'));
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), $modificated_CustomJS, false, true);
}

// Get current year
function adf_footer_shortcode() {
  $year = date('Y');
  return "© $year ADF Action is a registered 501(C)(4). All rights reserved.";
}
add_shortcode('adf_footer', 'adf_footer_shortcode');

function my_custom_block_editor_styles() {
  add_editor_style(get_stylesheet_directory_uri() . '/assets/css/main.css');
}
add_action('after_setup_theme', 'my_custom_block_editor_styles');
