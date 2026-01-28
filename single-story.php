<?php

/**
 * Template Post Type: Story
 *
 * @package Bootscore
 * @version 6.1.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header(); 

?>

<section class="container">
    <div class="row">
        <div class="col-12">
            <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
            } ?>
        </div>
    </div>
</section>

<?php the_content(); ?>

<?php get_footer();
