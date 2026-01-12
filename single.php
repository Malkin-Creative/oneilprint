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

<section class="single-hero hero pb-10 position-relative">
    <div class="overlay object-fit-cover">
        <div class="overlay object-fit-cover">
            <img class="no-lazyload" src="/wp-content/uploads/2025/04/american-flag-bg-overlay-1-scaled-1.jpg" alt="American Flag" />
        </div>
    </div>
    <div class="container hero__container">
        <div class="row">
            <div class="col-11 m-auto col-md-12">
                <h1 class="hero__header h1-large mb-10">
                    <strong><?php the_title(); ?></strong>
                </h1>
                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<p class="breadcrumbs">','</p>' );
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="single container py-10 py-md-15">
    <div class="row">
        <div class="col-11 mx-auto col-lg-8 single__col">
            <?php echo get_the_post_thumbnail(); ?>
            <p class="subheader my-4 my-md-8">
                <?php the_time('F jS, Y'); ?>
            </p>
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php get_footer();
