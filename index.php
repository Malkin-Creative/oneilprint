<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.1.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header(); ?>

<section class="archive-hero hero pb-10 position-relative mb-10 mb-md-15">
    <div class="overlay object-fit-cover">
        <div class="overlay object-fit-cover">
            <img class="no-lazyload" src="/wp-content/uploads/2025/04/american-flag-bg-overlay-1-scaled-1.jpg" alt="American Flag" />
        </div>
    </div>
    <div class="container hero__container">
        <div class="row">
            <div class="col-11 m-auto col-md-12">
                <h1 class="hero__header h1-large">
                    <strong>News & Commentary</strong>
                </h1>
            </div>
        </div>
    </div>
</section>
<section class="archive container">
    <div class="row">
        <?php if( have_posts() ):
            while( have_posts() ) : the_post(); ?>
                <div class="col-11 mx-auto col-md-12 archive__col mb-10 mb-md-15">
                    <p class="archive__col__date subheader mb-4 mb-md-8">
                        <?php the_time('F jS, Y'); ?>
                    </p>
                    <div class="archive__col__wrap row justify-content-between">
                        <div class="col-12 col-md-4 p-0 mb-4 mb-md-0">
                            <?php echo get_the_post_thumbnail(); ?>
                        </div>
                        <div class="col-12 col-md-7 p-0 mb-4 mb-md-6">
                            <h2>
                                <?php the_title(); ?>
                            </h2>
                            <div class="pb-4 pb-md-8">
                                <?php the_content(); ?>
                            </div>
                            <a class="button button--secondary" href="<?php the_permalink(); ?>" aria-label="Open <?php the_title(); ?> Post">
                                <span>
                                    Read More
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
