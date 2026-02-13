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
      'name'  => __('White (#ffffff)', 'bootscore-child'),
      'slug'  => 'white',
      'color' => '#ffffff',
    ],
    [
      'name'  => __('Navy (#141B4D)', 'bootscore-child'),
      'slug'  => 'navy',
      'color' => '#141B4D',
    ],
    [
      'name'  => __('Steel (#647692)', 'bootscore-child'),
      'slug'  => 'steel',
      'color' => '#647692',
    ],
    [
      'name'  => __('Silver (#C8D8EB)', 'bootscore-child'),
      'slug'  => 'silver',
      'color' => '#C8D8EB',
    ],
    [
      'name'  => __('Light Silver (#E3EBF5)', 'bootscore-child'),
      'slug'  => 'light_silver',
      'color' => '#E3EBF5',
    ],
    [
      'name'  => __('Lightest Silver (#F1F5FA)', 'bootscore-child'),
      'slug'  => 'lightest_silver',
      'color' => '#F1F5FA',
    ],
    [
      'name'  => __('Blue (#489FDF)', 'bootscore-child'),
      'slug'  => 'blue',
      'color' => '#489FDF',
    ],
    [
      'name'  => __('Blue ADA (#1179C5)', 'bootscore-child'),
      'slug'  => 'blue_ada',
      'color' => '#1179C5',
    ],
    [
      'name'  => __('Green (#00B373)', 'bootscore-child'),
      'slug'  => 'green',
      'color' => '#00B373',
    ],
    [
      'name'  => __('Green ADA (#11865C)', 'bootscore-child'),
      'slug'  => 'green_ada',
      'color' => '#11865C',
    ],
    [
      'name'  => __('Yellow (#F0B323)', 'bootscore-child'),
      'slug'  => 'yellow',
      'color' => '#F0B323',
    ],
    [
      'name'  => __('Orange (#FF8F1C)', 'bootscore-child'),
      'slug'  => 'orange',
      'color' => '#FF8F1C',
    ],
    [
      'name'  => __('Red (#F4364C)', 'bootscore-child'),
      'slug'  => 'red',
      'color' => '#F4364C',
    ],
    [
      'name'  => __('Red ADA (#DF2D42)', 'bootscore-child'),
      'slug'  => 'red_ada',
      'color' => '#DF2D42',
    ],
    [
      'name'  => __('Violet (#C964CF)', 'bootscore-child'),
      'slug'  => 'violet',
      'color' => '#C964CF',
    ],
    [
      'name'  => __('Black (#232323)', 'bootscore-child'),
      'slug'  => 'black',
      'color' => '#232323',
    ],
    [
      'name'  => __('Text (#475467)', 'bootscore-child'),
      'slug'  => 'text',
      'color' => '#475467',
    ],
    [
      'name'  => __('Brown (#89532F)', 'bootscore-child'),
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
  'acf/case-study-hero',
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
    'acf/case-study-hero',
  ];
}

// New menus
function register_my_theme_menus() {
  register_nav_menus(
    array(
      'top-main-menu' => __( 'Top Main Menu', 'oneilprint' ),
      'mobile-menu' => __( 'Mobile Menu', 'oneilprint' )
    )
  );
}
add_action( 'init', 'register_my_theme_menus' );

// Format Phone Number 
function format_phone_dots($phone) {
  // Remove all non-numeric characters
  $digits = preg_replace('/\D/', '', $phone);

  // Format only if 10 digits
  if (strlen($digits) === 10) {
      return substr($digits, 0, 3) . '.' . substr($digits, 3, 3) . '.' . substr($digits, 6);
  }

  // Fallback for unexpected input
  return $phone;
}
function format_phone_number($phone_number) {
    // Remove all non-numeric characters
    $numbers = preg_replace('/\D+/', '', $phone_number);

    // Remove leading country code if it's +1 (or just 1)
    if (strlen($numbers) === 11 && substr($numbers, 0, 1) === '1') {
        $numbers = substr($numbers, 1);
    }

    // Format as 602.258.7789
    if (strlen($numbers) === 10) {
        return substr($numbers, 0, 3) . '.' . substr($numbers, 3, 3) . '.' . substr($numbers, 6);
    }

    // If invalid, return the original
    return $phone_number;
}

// Format Fax
function format_fax_number($fax_number) {
    // Remove all non-numeric characters
    $faxNumbers = preg_replace('/\D+/', '', $fax_number);

    // Remove leading country code if it's +1 (or just 1)
    if (strlen($faxNumbers) === 11 && substr($faxNumbers, 0, 1) === '1') {
        $faxNumbers = substr($faxNumbers, 1);
    }

    // Format as 602.258.7789
    if (strlen($faxNumbers) === 10) {
        return substr($faxNumbers, 0, 3) . '.' . substr($faxNumbers, 3, 3) . '.' . substr($faxNumbers, 6);
    }

    // If invalid, return the original
    return $fax_number;
}

// add_action('init', function () {
//     foreach (glob(get_stylesheet_directory() . '/blocks/*/block.json') as $block) {
//         register_block_type(dirname($block));
//     }
// });

add_action('init', function () {

    foreach (glob(get_stylesheet_directory() . '/blocks/*/block.json') as $block_json) {

        $dir  = dirname($block_json);
        $meta = json_decode(file_get_contents($block_json), true);

        $args = [];

        // Only restrict THIS block
        if (($meta['name'] ?? '') === 'acf/case-study-hero') {
            $args['post_types'] = ['case-study'];
        }

        register_block_type($dir, $args);
    }

});


function enqueue_admin_scripts_and_styles() {
	wp_enqueue_script('admin-scripts', get_stylesheet_directory_uri() . '/assets/js/admin_custom.js', array('wp-blocks', 'wp-element', 'wp-hooks'), '', true);
//We use wp_localize_script to pass data
wp_localize_script( 'admin-scripts', 'passed_data', array( 'templateUrl' => get_stylesheet_directory_uri() ) );
}
add_action('admin_enqueue_scripts', 'enqueue_admin_scripts_and_styles');

// Custom nav walker
class ADA_Menu_Walker extends Walker_Nav_Menu {

  private string $label_id = '';
  private string $panel_id = '';
  private string $footer_items = '';

  private function make_id($string) {
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9\-_]+/', '-', $string);
    return trim($string, '-');
  }

  public function start_lvl(&$output, $depth = 0, $args = null) {
    if ($depth === 0) {
      $output .= "\n<div id=\"{$this->panel_id}\" role=\"region\" class=\"sub-menu\" aria-labelledby=\"{$this->label_id}\">\n";
      $output .= "  <button type=\"button\" class=\"close-button\" aria-label=\"Close submenu\">\n";
      $output .= "    <span aria-hidden=\"true\">×</span>\n";
      $output .= "    <span class=\"sr-only\">Close menu</span>\n";
      $output .= "  </button>\n";
      $output .= "  <div class=\"mega-menu__grid\">\n";
    }
  }

  public function end_lvl(&$output, $depth = 0, $args = null) {
    if ($depth === 0) {

      $output .= "  </div>";

      if (!empty($this->footer_items)) {
        $output .= "<div class=\"mega-menu__footer\">";
        $output .= $this->footer_items;
        $output .= "</div>";
        $this->footer_items = '';
      }

      $output .= "\n</div>\n";
    }
  }

  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {

    $has_children = in_array('menu-item-has-children', (array) $item->classes, true);
    $target = $item->target ? ' target="_blank" rel="noopener"' : '';
    $url    = esc_url($item->url);
    $title  = esc_html($item->title);

    // LEVEL 0 (top nav)
    if ($depth === 0) {

      $slug = $this->make_id($title ?: $item->ID);
      $this->label_id = $slug . '-label';
      $this->panel_id = $slug . '-menu';
      $mega_menu    = get_field('mega_menu', $item);

      if ($mega_menu) {
        $megaMenu = ' mega-menu-dropdown';
      } else {
        $megaMenu = ' normal-menu-dropdown';
      }

      // Build proper WP classes
      $classes = array_filter((array) $item->classes);
      $classes[] = 'menu-item';

      $class_attr = esc_attr(implode(' ', $classes));

      $output .= "<li class=\"{$class_attr}{$megaMenu}\">";
      $output .= "<a href=\"{$url}\" id=\"{$this->label_id}\" class=\"top-link\"{$target}>{$title}</a>";

      if ($has_children) {
        $output .= "<button type=\"button\" class=\"toggle-button\" aria-expanded=\"false\" aria-controls=\"{$this->panel_id}\">";
        $output .= "  <span aria-hidden=\"true\"></span>";
        $output .= "  <span class=\"sr-only\">{$title} submenu</span>";
        $output .= "</button>";
      }
    }

    // LEVEL 1 (tiles)
    if ($depth === 1) {

      $icon     = get_field('icon', $item);
      $subtitle = get_field('subtitle', $item);
      $badge    = get_field('badge', $item);
      $full_btn = get_field('full_width_button', $item);

      $html = '';

      $classes = 'mega-menu__item d-flex align-items-center';
      $classesTitle = 'mega-menu__title text-md-bold d-flex align-items-center';

      if ($full_btn) {
        $classes .= ' button button--white-underline';
        $classesTitle = '';
      }

      $html .= "<a href=\"{$url}\" class=\"{$classes}\" role=\"menuitem\"{$target}>";

      if ($icon) {
        $html .= "<div class=\"mega-menu__icon\"><img src=\"{$icon['url']}\" alt=\"\" /></div>";
      }

      $html .= "<div class=\"mega-menu__text\">";
      $html .= "<div class=\"{$classesTitle}\">{$title}";

      if ($badge) {
        $html .= "<span class=\"mega-menu__badge d-flex\"><img src=\"{$badge['url']}\" alt=\"\" /></span>";
      }

      $html .= "</div>";

      if ($subtitle) {
        $html .= "<div class=\"mega-menu__subtitle text-sm-regular text-tertiary text-steel mt-1\">{$subtitle}</div>";
      }

      $html .= "</div></a>\n";

      if ($full_btn) {
        $this->footer_items .= $html;
      } else {
        $output .= $html;
      }
    }
  }

  public function end_el(&$output, $item, $depth = 0, $args = null) {
    if ($depth === 0) {
      $output .= "</li>\n";
    }
  }
}

// Add styles to editor
add_action('after_setup_theme', function() {
    add_editor_style('assets/css/editornew.css');
});

