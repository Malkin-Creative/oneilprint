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
  <?php if (get_field('header_code', 'options') ) : ?>
    <?php echo get_field('header_code', 'options'); ?>
  <?php endif; ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if (get_field('body_code', 'options') ) : ?>
  <?php echo get_field('body_code', 'options'); ?>
<?php endif; ?>
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
              <a class="button text-white text-md-medium" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $announcement_bar_link_label ); ?>">
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


  <?php // Variables
  $header_logo = get_field('header_logo', 'options');
  ?>
  <header id="masthead" class="site-header header">
    <?php do_action( 'bootscore_after_masthead_open' ); ?>
    <div class="container">
      <div class="row d-none d-lg-flex">
        <div class="col-12 d-flex justify-content-end">
          <div class="header--top background-lightest-silver px-2 py-2 d-flex align-items-center">
            <nav class="nav menu-top-main-menu-container" aria-label="Top Main Menu">
              <?php // Top Menu
                wp_nav_menu( array(
                  'theme_location' => 'top-main-menu',
                  'walker'         => new ADA_Menu_Walker(),
                  'container' => false, // disables default wrapping
                ));
              ?>
            </nav>
            <!-- <form id="search-form" class="searchform" action="/search/" method="get" aria-expanded="false">
              <label for="searchinput" aria-labelledby="searchinput" class="sr-only" style="display: none">Search</label>
              <input placeholder="Search" type="text" name="q" id="searchinput" class="text-steel" aria-label="Search site">
              <input type="submit" name="searchsubmit" class="submit button" value=""/>
              <button type="button" id="close-search" class="banner-close text-xs-medium text-steel py-0" aria-label="Close search bar" title="Close search bar">
                <p class="mb-0">Close</p>
              </button>
            </form> -->
            <form id="search-form" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" aria-expanded="false">
              <label for="searchinput" class="sr-only">
                Search the site
              </label>
              <input type="search" name="s" id="searchinput" class="text-steel" placeholder="Search" autocomplete="off">
              <button type="submit" class="submit button" aria-label="Submit search">
                <span class="submit-text text-white">Search</span>
              </button>
              <button type="button" id="close-search" class="banner-close text-xs-medium text-steel py-0" aria-label="Close search" hidden>
                Close
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="row justify-content-between pt-2 pb-4">
        <div class="col-6 col-md-4 col-lg-2 header__logo">
          <?php if ( $header_logo ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo--buton">
              <img src="<?php echo esc_url($header_logo['url']); ?>" alt="<?php echo esc_attr($header_logo['alt']); ?>" class="header__logo__img"/>
            </a>
          <?php endif; ?>
        </div>
        <div class="col-lg-10 d-none d-lg-flex align-items-center justify-content-end position-relative">
          <nav class="nav menu-main-menu-container" aria-label="Main Menu navigation">
            <?php // Primary Menu
              wp_nav_menu( array(
                'theme_location' => 'main-menu',
                'walker'         => new ADA_Menu_Walker(),
                'container'      => false, // disables default wrapping
              ));
            ?>
          </nav>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end d-lg-none header__mobile">
          <nav>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primary-menu" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
              <span class="toggler-icon"></span>
            </button>
          </nav>
        </div>
        <div id="mobile-menu" class="mobile-overlay" aria-hidden="true">
          <div class="mobile-menu-inner">
            <?php
            wp_nav_menu([
              'theme_location' => 'main-menu',
              'container'      => false,
              'walker'         => new ADA_Menu_Walker(),
              'menu_class'     => 'mobile-menu',
              'fallback_cb'    => false
            ]);
            ?>
            <form id="search-form" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" aria-expanded="false">
              <label for="searchinput" class="sr-only">
                Search the site
              </label>
              <input type="search" name="s" id="searchinput" class="text-steel" placeholder="Search" autocomplete="off">
              <button type="submit" class="submit button" aria-label="Submit search">
                <span class="submit-text text-white">Search</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php do_action( 'bootscore_before_masthead_close' ); ?>
  </header><!-- #masthead -->
  <?php do_action( 'bootscore_after_masthead' ); ?>
