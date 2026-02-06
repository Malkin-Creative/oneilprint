<?php

/**
 * Template Post Type: Story
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
                yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
            } ?>
        </div>
    </div>
</section>

<?php
if ( 'career' === get_post_type() ) {
$title = get_the_title();
$job_summary = get_field('job_summary', get_the_ID());
$company = get_the_terms(get_the_ID(), 'company');
$location = get_the_terms(get_the_ID(), 'location');
?>

<section class="single-story container position-relative">
    <div class="row single-story__row py-4 justify-content-center">
        <div class="col-12 col-md-8">
            <?php if ( $title ) : ?>
                <h1 class="mb-2 text-black text-center">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>
            <?php if ( ! empty( $company ) && ! is_wp_error( $company ) ) : ?>
                <?php $lastCompany = end($company); ?>
            <?php endif; ?>
            <?php if ( ! empty( $location ) && ! is_wp_error( $location ) ) : ?>
                <?php $lastLoc = end($location); ?>
            <?php endif; ?>
            <?php if ( $lastCompany || $lastLoc ) : ?>
                <span class="text-steel mb-0 h3 text-center d-flex justify-content-center">
                    <?php foreach( $company as $companies): ?>
                        <?php echo esc_html( $companies->name ); echo ', '; ?>
                    <?php endforeach; ?>
                    <?php foreach( $location as $locations): ?>
                        <?php echo esc_html( $locations->name );
                            if ($locations !== $lastLoc) {
                                echo ', ';
                            }
                        ?>
                    <?php endforeach; ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="dividers position-relative icon py-10 py-md-12 py-lg-15">
    <div class="dividers__icon">
    </div>
</section>
<div class="container p-0">
    <div class="row p-0">
        <div class="col-12 col-md-10 p-0">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<section class="newsletter background-light-silver py-6 py-md-8 py-lg-10">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4 mb-md-0">
                <h2 class="text-blue-ada text-xl-medium mb-0">
                    Stay Informed
                </h2>
                <p class="text-md-regular text-black mb-0">
                    Get the latest updates on print, creative, and technology solutions delivered straight to your inbox.
                </p>
            </div>
            <div class="col-12 col-lg-9 newsletter__form">
                <?php gravity_form( 5, false, false, false, '', true, 1 ); ?>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<?php get_footer();
