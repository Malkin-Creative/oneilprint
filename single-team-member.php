<?php

/**
 * Template Post Type: Team Member
 *
 * @package Bootscore
 * @version 6.1.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header(); ?>

<section class="container py-6">
    <div class="row">
        <div class="col-12">
            <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
            } ?>
        </div>
    </div>
</section>

<?php the_content();

get_footer();
