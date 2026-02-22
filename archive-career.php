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

<section class="container py-6 mb-2 mb-md-6">
    <div class="row">
        <div class="col-12">
            <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<p id="breadcrumbs" class="mb-0">','</p>' );
            } ?>
        </div>
    </div>
</section>

<?php
$page = get_page_by_path('careers');

if ($page) {
    echo apply_filters('the_content', $page->post_content);
} ?>

<section class="faqs" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row align-items-start justify-content-between pb-4 pb-md-0">
            <div class="col-12 col-md-4 col-lg-3">
                <h2 class="h3 text-blue-ada mb-4">
                    Filter Career Listings
                </h2>
            </div>
            <div class="col-12 col-lg-9">
                <div class="row flex-column flex-md-row">
                    <div class="col col-md-4 mb-4 mb-md-8">
                        <p class="text-sm-medium text-black mb-2">
                            Company
                        </p>
                        <?php echo do_shortcode('[facetwp facet="company"]'); ?>
                    </div>
                    <div class="col col-md-4 mb-8">
                        <p class="text-sm-medium text-black mb-2">
                            Location
                        </p>
                        <?php echo do_shortcode('[facetwp facet="location"]'); ?>
                    </div>
                    <div class="col col-md-4 d-flex align-items-end mb-8">
                        <?php echo do_shortcode('[facetwp facet="clear_button"]'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ( have_posts() ) : ?>
            <div class="facetwp-template">
                <?php while ( have_posts() ) : the_post(); 
                    $permalink = get_permalink(get_the_ID());
                    $title = get_the_title(get_the_ID());
                    $company = get_the_terms( get_the_ID(), 'company' );
                    $job_type = get_the_terms( get_the_ID(), 'job-type' );
                    $location = get_the_terms( get_the_ID(), 'location' );
                    $excerpt = get_the_excerpt(get_the_ID());
                    ?>
                    <div class="row py-5 mb-5 mb-md-8 mb-lg-10 faqs__wrap silver">
                        <div class="col-12 col-md-6 col-lg-4 d-flex flex-column">
                            <?php if ( $title ) : ?>
                                <div class="h3 text-black">
                                    <?php echo $title; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($company) : ?>
                                <?php $lastComp = end($company); ?>
                                <p class="text-sm-bold mt-2 text-blue-ada font-tertiary">
                                    <?php foreach( $company as $companies): ?>
                                        <?php echo esc_html( $companies->name );
                                            if ($companies !== $lastComp) {
                                                echo ', ';
                                            }
                                        ?>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>
                            <p class="text-sm-bold text-blue-ada font-tertiary">
                                <?php if ($job_type) : ?>
                                <?php $lastJob = end($job_type); ?>
                                    <?php foreach( $job_type as $job_types): ?>
                                        <?php echo esc_html( $job_types->name );
                                            if ($job_types !== $lastJob) {
                                                echo ', ';
                                            }
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php echo ', '; ?>
                                <?php if ($location) : ?>
                                <?php $lastLoc = end($location); ?>
                                    <?php foreach( $location as $locations): ?>
                                        <?php echo esc_html( $locations->name );
                                            if ($locations !== $lastLoc) {
                                                echo ', ';
                                            }
                                        ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8 pl-md-6 pl-lg-18 d-flex">
                            <div class="text-lg-regular text-black">
                                <?php echo $excerpt; ?>
                            </div>
                            <a class="button button--steel-underline" href="<?php echo $permalink; ?>" aria-label="Open career page">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php
            $total_pages = FWP()->facet->pager_args['total_pages'] ?? 0;
            if ( $total_pages > 1 ) :
            ?>
                <div class="pagination archive">
                    <?php echo facetwp_display('facet', 'pagination'); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php get_footer();
