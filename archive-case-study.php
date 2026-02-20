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
$page = get_page_by_path('case-studies');

if ($page) {
    echo apply_filters('the_content', $page->post_content);
} ?>

<section class="featured-post-grid position-relative pt-4 pt-md-0 pb-6 pb-md-8 pb-lg-10" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row align-items-start justify-content-between pb-4 pb-md-0">
            <div class="col-12 col-md-4 col-lg-3">
                <h2 class="h3 text-blue-ada mb-4">
                    Filter Case Studies
                </h2>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column">
                <p class="text-sm-medium text-black mb-2">
                    Industry
                </p>
                <?php echo do_shortcode('[facetwp facet="industry"]'); ?>
            </div>
            <div class="col-12 col-md-4 flex-column">
                <p class="text-sm-medium text-black mb-2">
                    Services
                </p>
                <?php echo do_shortcode('[facetwp facet="services"]'); ?>
            </div>
        </div>
        <?php if ( have_posts() ) : ?>
            <div class="row facetwp-template">
                <?php while ( have_posts() ) : the_post(); 
                    $permalink = get_permalink(get_the_ID());
                    $title = get_the_title(get_the_ID());
                    $summary_excerpt = get_field('summary_excerpt', get_the_ID());
                    $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                    $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    $industries = get_the_terms( get_the_ID(), 'industries' );
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 featured-post-grid__wrap position-relative pb-10 pb-md-8">
                        <div class="overlay object-fit-cover featured-post-grid__wrap__img">
                            <?php if ($featured_image_url) : ?>
                                <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100"/>
                            <?php else : ?>
                                <img src="/wp-content/uploads/2026/01/default-social-sharing-image.jpeg" alt="Post Placeholder Image" class="w-100"/>
                            <?php endif; ?>
                        </div>
                        <?php if ($title) : ?>
                            <h3>
                                <?php echo $title; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
                            <?php $lastInd = end($industries); ?>
                            <p class="text-sm-bold mt-2 text-blue-ada font-tertiary mb-0">
                                <?php foreach( $industries as $industry): ?>
                                    <?php echo esc_html( $industry->name );
                                        if ($industry !== $lastInd) {
                                            echo ', ';
                                        }
                                    ?>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($summary_excerpt) : ?>
                            <div class="text-md-regular my-4 text-black font-tertiary featured-post-grid__wrap__excerpt">
                                <?php echo $summary_excerpt; ?>
                            </div>
                        <?php endif; ?>
                        <a class="button button--steel-underline" href="<?php echo $permalink; ?>" aria-label="Open post">
                            Read Case Study
                        </a>
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

<?php get_footer();
