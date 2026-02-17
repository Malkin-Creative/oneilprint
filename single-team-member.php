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
                yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
            } ?>
        </div>
    </div>
</section>

<?php
if ( 'team-member' === get_post_type() ) {
$title = get_the_title();
$thumbnail_id = get_post_thumbnail_id();
$featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
$alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
$job_title = get_field('job_title', get_the_ID());
$full_bio = get_field('full_bio', get_the_ID());
$primary_cta = get_field('team_member_email', get_the_ID());
if( $primary_cta ): 
    $primary_link_url = $primary_cta['url'];
    $primary_link_title = $primary_cta['title'];
    $primary_link_target = $primary_cta['target'] ? $primary_cta['target'] : '_self';
endif;
?>

<section class="split-content background-white image-left py-6">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5 split-content__content pt-lg-8">
                <div class="split-content__content__image position-relative">
                    <div class="w-100 h-100 d-flex split-content__content__image__details"></div>
                    <div class="split-content__content__image__bg" style="background: linear-gradient(45deg, #F0B323, #C964CF);">
                    </div>
                    <?php if ( $featured_image_url ) : ?>
                        <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100 object-fit-cover position-relative"/>
                    <?php else : ?>
                        <img src="/wp-content/uploads/2026/01/default-social-sharing-image.jpeg" alt="Team Member Placeholder Image" class="w-100 object-fit-contain position-relative"/>
                    <?php endif; ?>
                </div>
                <div class="pt-10 pt-md-15">
                    <?php if ($primary_cta) : ?>
                        <a class="button button--blue-underline email-button" href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>" rel="noopener" aria-label="Email Team Member">
                            <?php echo esc_html( $primary_link_title ); ?>
                        </a>
                    <?php endif; ?>
                    <?php if( have_rows('social_media') ): ?>
                        <div class="d-flex gap-3 pt-4">
                            <?php while( have_rows('social_media') ) : the_row(); ?>
                                <?php 
                                $social_media_icon = get_sub_field('social_media_icon');
                                $social_media_url = get_sub_field('social_media_url');
                                $social_media_button_label = get_sub_field('social_media_button_label');
                                ?>
                                
                                <?php if ( $social_media_url ) : ?>
                                    <a class="featured-post-grid__wrap__cta" href="<?php echo esc_attr( $social_media_url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $social_media_button_label ); ?>">
                                        <?php if ( $social_media_icon ) : ?>
                                            <img src="<?php echo esc_url($social_media_icon['url']); ?>" alt="<?php echo esc_attr($social_media_icon['alt']); ?>" />
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-7 mx-auto split-content__wrap">
                <?php if ($title) : ?>
                    <h1 class="mb-2 split-content__wrap__header text-black">
                        <?php echo $title; ?>
                    </h1>
                <?php endif; ?>
                <?php if ($job_title) : ?>
                    <h2 class="h3 mb-4 split-content__wrap__header text-steel">
                        <?php echo $job_title; ?>
                    </h2>
                <?php endif; ?>
                <?php if ($full_bio) : ?>
                    <div class="text-xl-regular mb-0 text-black">
                        <?php echo $full_bio; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="dividers position-relative icon pb-10 pb-md-12 pb-lg-15">
    <div class="container">
        <div class="row">
            <div class="col-12 position-relative">
                <div class="dividers__icon">
                </div>
            </div>
        </div>
    </div>
</section>
<?php the_content(); ?>

<?php } ?>

<?php get_footer();
