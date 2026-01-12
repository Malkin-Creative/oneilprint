<?php

/**
 * Template Post Type: post
 *
 * @package Bootscore
 * @version 6.1.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header(); ?>

<section class="error-hero error-404 not-found hero pt-10 position-relative">
    <div class="overlay object-fit-cover">
        <div class="overlay object-fit-cover">
            <img class="no-lazyload" src="/wp-content/uploads/2025/04/american-flag-bg-overlay-1-scaled-1.jpg" alt="American Flag" />
        </div>
    </div>
    <div class="container error-hero__container py-20 py-md-40 page-404">
        <div class="row">
            <div class="col-11 m-auto col-md-8">
                <h1 class="hero__header h1-large mb-10 text-center">
                    <strong>Sorry, but we could not find the page you were looking for.</strong>
                </h1>
                <p class="text-center">
                    You can return to the ADF Action <a href="<?php echo get_home_url();?>/">homepage</a> or use the navigation to help get you to where you want to go. If you have arrived here via a broken link or would like to send us a message, feel free to <a href="<?php echo get_home_url();?>/get-involved/">Contact Us</a>.
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
