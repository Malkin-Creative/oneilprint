<?php

/**
 *
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

<?php
$page = get_page_by_path('team-members');

if ($page) {
    echo apply_filters('the_content', $page->post_content);
}

get_footer();
