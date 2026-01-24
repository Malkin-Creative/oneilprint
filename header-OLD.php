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
  <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
              <div class="text-white">
                <?php echo get_field('cookie_policy_bar_text', 'options'); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-12 col-md-3 col-lg-2 d-flex align-items-center justify-content-end">
            <button id="close-cookie" class="banner-close text-white py-0" aria-label="Dismiss banner" title="Close banner">Allow & Close</button>
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
              <p class="text-white">
                <?php echo get_field('announcement_bar_text', 'options'); ?>
              </p>
            <?php endif; ?>
          </div>
          <div class="col-12 col-md-3 col-lg-2 d-flex align-items-center justify-content-end">
            <?php if ( $announcement_bar_link ) : ?>
              <a class="button button--text text-white" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $announcement_bar_link_label ); ?>">
                <span>
                  <?php echo esc_html( $link_title ); ?>
                </span>
              </a>
            <?php endif; ?>
            <button id="close-announcement" class="banner-close text-white" aria-label="Dismiss announcement" title="Close announcement"></button>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <header id="masthead" class="site-header">
    <?php do_action( 'bootscore_after_masthead_open' ); ?>
    <nav id="nav-main" class="navbar <?= apply_filters('bootscore/class/header/navbar/breakpoint', 'navbar-expand-lg'); ?>">
      <div class="container header__container">
        <?php do_action( 'bootscore_before_navbar_brand' ); ?>
        <!-- Navbar Brand -->
        <div class="header__container__logo">
          <a class="<?= apply_filters('bootscore/class/header/navbar-brand', 'navbar-brand'); ?>" href="<?= esc_url(home_url()); ?>">
            <img src="<?= esc_url(apply_filters('bootscore/logo', get_stylesheet_directory_uri() . '/assets/img/logo/adf-action-logo-on-dark.svg', 'default')); ?>" alt="<?php bloginfo('name'); ?> Logo" class="d-td-none">
          </a> 
        </div> 
        <!-- Offcanvas Navbar -->
        <div class="offcanvas offcanvas-<?= apply_filters('bootscore/class/header/offcanvas/direction', 'end', 'menu'); ?>" tabindex="-1" id="offcanvas-navbar">
          <div class="offcanvas-header <?= apply_filters('bootscore/class/offcanvas/header', '', 'menu'); ?>">
            <span class="h5 offcanvas-title"><?= apply_filters('bootscore/offcanvas/navbar/title', __('Menu', 'bootscore')); ?></span>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body <?= apply_filters('bootscore/class/offcanvas/body', '', 'menu'); ?>">
            <!-- Bootstrap 5 Nav Walker Main Menu -->
            <?php get_template_part('template-parts/header/main-menu'); ?>
            <a class="header__container__button button button--primary" href="https://adfaction.givevirtuous.org/donate/adf-action-donation-page" target="_blank" rel="noopener" aria-label="Visit ADF Action's Donate Page (opens in a new tab)">
              <span>
                Donate
              </span>
            </a>
          </div>
        </div>
        <div class="header-actions <?= apply_filters('bootscore/class/header-actions', 'd-flex align-items-center'); ?>">
          <!-- Navbar Toggler -->
          <button class="<?= apply_filters('bootscore/class/header/button', 'btn btn-outline-secondary', 'nav-toggler'); ?> <?= apply_filters('bootscore/class/header/navbar/toggler/breakpoint', 'd-lg-none'); ?> <?= apply_filters('bootscore/class/header/action/spacer', 'ms-1 ms-md-2', 'nav-toggler'); ?> nav-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar" aria-label="<?php esc_attr_e( 'Toggle main menu', 'bootscore' ); ?>">
            <?= apply_filters('bootscore/icon/menu', '<i class="fa-solid fa-bars"></i>'); ?> <span class="visually-hidden-focusable">Menu</span>
          </button>
          <?php do_action( 'bootscore_after_nav_toggler' ); ?>
        </div><!-- .header-actions -->
      </div><!-- .container -->
    </nav><!-- .navbar -->
    <?php do_action( 'bootscore_before_masthead_close' ); ?>
  </header><!-- #masthead -->
  <?php do_action( 'bootscore_after_masthead' ); ?>
