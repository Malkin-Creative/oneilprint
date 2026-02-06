<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.1.1
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header(); ?>

<?php if ( ! is_front_page() && ! is_home() ) { ?>
    <section class="container py-6">
        <div class="row">
            <div class="col-12">
                <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
                    yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
                } ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php the_content();

get_footer();
