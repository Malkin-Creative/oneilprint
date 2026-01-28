<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 * @version 6.1.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
  
  <!-- Skip Links -->
  <a class="skip-link visually-hidden-focusable" href="#primary"><?php esc_html_e( 'Skip to content', 'bootscore' ); ?></a>
  <a class="skip-link visually-hidden-focusable" href="#footer"><?php esc_html_e( 'Skip to footer', 'bootscore' ); ?></a>

  <!-- Top Bar Widget -->
  <?php if (is_active_sidebar('top-bar')) : ?>
    <?php dynamic_sidebar('top-bar'); ?>
  <?php endif; ?>
  
  <?php do_action( 'bootscore_before_masthead' ); ?>

  <?php if (get_field('cookie_policy_bar', 'options') ) : ?>
    <div class="cookie-policy background-navy py-3" role="region" aria-label="Cookie Policy">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-9 col-lg-10">
            <?php if (get_field('cookie_policy_bar_text', 'options') ) : ?>
              <div class="text-white text-sm-regular">
                <?php echo get_field('cookie_policy_bar_text', 'options'); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-12 col-md-3 col-lg-2 d-flex align-items-center justify-content-end">
            <button id="close-cookie" class="banner-close text-md-medium text-white py-0" aria-label="Dismiss banner" title="Close banner">Allow & Close</button>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if (get_field('announcement_bar', 'options') ) : ?>
    <?php 
    $announcement_bar_link = get_field('announcement_bar_link', 'options');
    $announcement_bar_link_label = get_field('announcement_bar_link_label', 'options');
    if( $announcement_bar_link ): 
        $link_url = $announcement_bar_link['url'];
        $link_title = $announcement_bar_link['title'];
        $link_target = $announcement_bar_link['target'] ? $announcement_bar_link['target'] : '_self';
    endif; ?>
    <div class="announcement-bar background-blue-ada py-3" role="region" aria-label="Cookie Policy">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12 col-md-9 col-lg-10">
            <?php if (get_field('announcement_bar_text', 'options') ) : ?>
              <p class="text-white text-sm-regular">
                <?php echo get_field('announcement_bar_text', 'options'); ?>
              </p>
            <?php endif; ?>
          </div>
          <div class="col-12 col-md-3 col-lg-2 d-flex align-items-center justify-content-end">
            <?php if ( $announcement_bar_link ) : ?>
              <a class="button button--text text-white text-md-medium" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $announcement_bar_link_label ); ?>">
                <span>
                  <?php echo esc_html( $link_title ); ?>
                </span>
              </a>
            <?php endif; ?>
            <button id="close-announcement" class="banner-close text-md-medium text-white" aria-label="Dismiss announcement" title="Close announcement"></button>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <header id="masthead" class="site-header header">
    <?php do_action( 'bootscore_after_masthead_open' ); ?>
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-end">
          <div class="header--top background-lightest-silver px-2 py-2 d-flex align-items-center">
            <nav class="nav menu-top-main-menu-container" aria-label="Top Main Menu">
              <?php // Top Menu
                wp_nav_menu( array(
                  'theme_location' => 'top-main-menu',
                  'walker'         => new ADA_Compliant_Walker_Nav_Menu(),
                  'container' => false, // disables default wrapping
                ));
              ?>
            </nav>
            <!-- <div class="clear"></div> -->
            <form id="search-form" class="searchform" action="/search/" method="get" aria-expanded="false">
              <label for="searchinput" aria-labelledby="searchinput" class="sr-only" style="display: none">Search</label>
              <input placeholder="Search" type="text" name="q" id="searchinput" class="text-steel" aria-label="Search site">
              <input type="submit" name="searchsubmit" class="submit button" value=""/>
              <button type="button" id="close-search" class="banner-close text-xs-medium text-steel py-0" aria-label="Close search bar" title="Close search bar">
                <p class="mb-0">Close</p>
              </button>
            </form>
            <!-- <script>
              jQuery(function () {
                form_rules.add_rule({form: 7, parent: '#searchinput', type: 'text'});
              });
            </script> -->
          </div>
        </div>
      </div>
    </div>
    <div class="wrap header__content">
      <?php
      if ( $id == 1 ) {
        ?>
        <a class="logobox" href="<?php echo home_url(); ?>"><img class="logomain" width="200" src="<?php echo get_template_directory_uri(); ?>/assets/logomain-new.png" alt="Batavia Public School District 101">
        </a>
      <?php } else if ( $id == 2 ) { ?>
        <a class="logobox" href="<?php echo home_url(); ?>"><img class="logomain" src="<?php echo get_template_directory_uri(); ?>/assets/logo-hs.png" alt="Batavia High School">
        </a>
      <?php } else if ( $id == 3 ) { ?>
        <a class="logobox" href="<?php echo home_url(); ?>"><img height="113" class="logomain" src="<?php echo get_template_directory_uri(); ?>/assets/logo-agsv2.png" alt="Alice Gustafson School">
        </a>
      <?php } else if ( $id == 4 ) { ?>
        <a class="logobox" href="<?php echo home_url(); ?>"><img height="80" class="logomain" src="<?php echo get_template_directory_uri(); ?>/assets/gmw-logo.png" alt="Grace McWayne School">
        </a>
      <?php } ?>
      <nav class="nav menu-main-menu-container" aria-label="Main Manu navigation">
        <?php // Primary Menu
          wp_nav_menu( array(
            'theme_location' => 'main-menu',
              'walker'         => new ADA_Compliant_Walker_Nav_Menu(),
            'container' => false, // disables default wrapping
          ));
        ?>
      </nav>
      <?php

        /*
          * Render top level menu
          * First level items only
          *
          * First level items have menu_item_parent set to 0
          * The label to use is post_title first, title if it's empty
          */
        $locations = get_nav_menu_locations();
        $menu_header = false;
        $header_items = array();
        $parent_ids = array();
        if ( isset( $locations[ 'menu-main' ] ) ) {
          $menu_header = $locations[ 'menu-main' ];
        }
        if ( $menu_header !== false ) {
          $header_items = wp_get_nav_menu_items( $menu_header );
        }
        ?>
        <?php
        if ( !empty( $header_items ) ) {
          $active_ids = array();
          // if (isset($post)) {
          // foreach($header_items as $item) {
          // if ($item->object_id == $post->ID) {
          // $active_ids[] = $item->ID;
          // $active_ids[] = $item->menu_item_parent;
          // }
          // }
          // }

          foreach ( $header_items as $item ) {
            if ( $item->menu_item_parent != 0 )
              continue;
            $parent_ids[] = $item->ID;
            $label = !empty( $item->post_title ) ? $item->post_title : $item->title;
            $url = $item->url;
            $class = ""; //in_array($item->ID, $active_ids) ? 'current-menu-item' : '';
            $children = wp_get_nav_menu_items( $menu_header, array( 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID ) );
            if ( empty( $children ) ) {
              echo '<a href="' . $url . '" ><li class="' . $class . ' menu-no-children">' . $label . '</li></a>';
            } else {
              echo '<li class="' . $class . ' has-children"  data-nav="' . $label . '">' . $label . '</li>';
            }
          }
        }
      ?>
    </div>
    <?php do_action( 'bootscore_before_masthead_close' ); ?>
  </header><!-- #masthead -->
  <?php do_action( 'bootscore_after_masthead' ); ?>
