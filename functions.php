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

// Add custom colors to theme.json
add_action('after_setup_theme', function () {
  add_theme_support('editor-color-palette', [
    [
      'name'  => __('White', 'bootscore-child'),
      'slug'  => 'white',
      'color' => '#ffffff',
    ],
    [
      'name'  => __('Navy', 'bootscore-child'),
      'slug'  => 'navy',
      'color' => '#141B4D',
    ],
    [
      'name'  => __('Steel', 'bootscore-child'),
      'slug'  => 'steel',
      'color' => '#647692',
    ],
    [
      'name'  => __('Silver', 'bootscore-child'),
      'slug'  => 'silver',
      'color' => '#C8D8EB',
    ],
    [
      'name'  => __('Light Silver', 'bootscore-child'),
      'slug'  => 'light_silver',
      'color' => '#E3EBF5',
    ],
    [
      'name'  => __('Lightest Silver', 'bootscore-child'),
      'slug'  => 'lightest_silver',
      'color' => '#F1F5FA',
    ],
    [
      'name'  => __('Blue', 'bootscore-child'),
      'slug'  => 'blue',
      'color' => '#489FDF',
    ],
    [
      'name'  => __('Blue ADA', 'bootscore-child'),
      'slug'  => 'blue_ada',
      'color' => '#1179C5',
    ],
    [
      'name'  => __('Green', 'bootscore-child'),
      'slug'  => 'green',
      'color' => '#00B373',
    ],
    [
      'name'  => __('Green ADA', 'bootscore-child'),
      'slug'  => 'green_ada',
      'color' => '#11865C',
    ],
    [
      'name'  => __('Yellow', 'bootscore-child'),
      'slug'  => 'yellow',
      'color' => '#F0B323',
    ],
    [
      'name'  => __('Orange', 'bootscore-child'),
      'slug'  => 'orange',
      'color' => '#FF8F1C',
    ],
    [
      'name'  => __('Red', 'bootscore-child'),
      'slug'  => 'red',
      'color' => '#F4364C',
    ],
    [
      'name'  => __('Red ADA', 'bootscore-child'),
      'slug'  => 'red_ada',
      'color' => '#DF2D42',
    ],
    [
      'name'  => __('Violet', 'bootscore-child'),
      'slug'  => 'violet',
      'color' => '#C964CF',
    ],
    [
      'name'  => __('Black', 'bootscore-child'),
      'slug'  => 'black',
      'color' => '#232323',
    ],
    [
      'name'  => __('Text', 'bootscore-child'),
      'slug'  => 'text',
      'color' => '#475467',
    ],
    [
      'name'  => __('Brown', 'bootscore-child'),
      'slug'  => 'brown',
      'color' => '#89532F',
    ]
  ]);
});

add_filter('acf/fields/color_picker_args', function ($args, $field) {
  $args['palettes'] = [
    '#ffffff', // White
    '#141B4D', // Navy
    '#647692', // Steel
    '#C8D8EB', // Silver
    '#E3EBF5', // Light Silver
    '#F1F5FA', // Lightest Silver
    '#489FDF', // Blue
    '#1179C5', // Blue ADA
    '#00B373', // Green
    '#11865C', // Green ADA
    '#F0B323', // Yellow
    '#FF8F1C', // Orange
    '#F4364C', // Red
    '#DF2D42', // Red ADA
    '#C964CF', // Violet
    '#232323', // Black
    '#475467', // Text
    '#89532F', // Brown
  ];
  return $args;
}, 10, 2);

$allowed_blocks = [
  'acf/contact-form',
  'acf/cta',
  'acf/dividers',
  'acf/faqs',
  'acf/featured-post',
  'acf/featured-post-grid',
  'acf/full-width-image',
  'acf/hero-collage',
  'acf/hero-default',
  'acf/hero-title',
  'acf/hero-video',
  'acf/home-hero-background-media',
  'acf/home-hero-collage',
  'acf/iframe',
  'acf/logo-block',
  'acf/multi-column-image-tiles',
  'acf/multi-column-tiles',
  'acf/newsletter',
  'acf/split-content',
  'acf/standard-content',
  'acf/standard-form',
  'acf/statistics',
  'acf/testimonials',
  'acf/tile-block',
  'acf/timeline',
  'acf/video',
];

add_filter('allowed_block_types_all', 'my_allowed_block_types', 10, 2);
function my_allowed_block_types($allowed_blocks, $block_editor_context) {
  // Return only your custom ACF blocks
  return [
    'acf/contact-form',
    'acf/cta',
    'acf/dividers',
    'acf/faqs',
    'acf/featured-post',
    'acf/featured-post-grid',
    'acf/full-width-image',
    'acf/hero-collage',
    'acf/hero-default',
    'acf/hero-title',
    'acf/hero-video',
    'acf/home-hero-background-media',
    'acf/home-hero-collage',
    'acf/iframe',
    'acf/logo-block',
    'acf/multi-column-image-tiles',
    'acf/multi-column-tiles',
    'acf/newsletter',
    'acf/split-content',
    'acf/standard-content',
    'acf/standard-form',
    'acf/statistics',
    'acf/testimonials',
    'acf/tile-block',
    'acf/timeline',
    'acf/video',
  ];
}

// New menus
function register_my_theme_menus() {
  register_nav_menus(
    array(
      'top-main-menu' => __( 'Top Main Menu', 'your-theme-slug' )
    )
  );
}
add_action( 'init', 'register_my_theme_menus' );

// Walker main menus for ADA compliance
class ADA_Compliant_Walker_Nav_Menu extends Walker_Nav_Menu {
  // Start level (sub-menu)
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    if ( $depth > 0 ) return; // Prevent >1 level dropdowns

    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul role=\"menu\" class=\"sub-menu\" aria-label=\"Submenu\">\n";
  }

  // End level
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    if ( $depth > 0 ) return;
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  // Start element (menu item)
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    $has_children = in_array('menu-item-has-children', $classes);

    $class_names = join(' ', array_filter($classes));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    $output .= $indent . '<li' . $class_names . ' role="none">';

    $attributes  = ' class="menu-link text-steel text-xs-medium"';
    $attributes .= ' role="menuitem"';
    $attributes .= ' tabindex="0"';
    $attributes .= ' href="' . esc_attr($item->url) . '"';

    if ( $has_children && $depth === 0 ) {
      $attributes .= ' aria-haspopup="true" aria-expanded="false"';
    }

    $title = apply_filters('the_title', $item->title, $item->ID);
    $output .= '<a' . $attributes . '>' . $title . '</a>';
  }

  // End element
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}
