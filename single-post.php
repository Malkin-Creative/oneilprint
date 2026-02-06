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
if ( 'post' === get_post_type() ) {
$title = get_the_title();
$subtitle = get_the_excerpt();
$thumbnail_id = get_post_thumbnail_id();
$featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
$alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
$author = get_the_terms(get_the_ID(), 'post_author');
$category = get_the_category(get_the_ID());
$topic = get_the_terms(get_the_ID(), 'topic');
?>

<section class="single-story container position-relative">
    <div class="row single-story__row py-4">
        <div class="col-12 col-md-8">
            <?php if ( $title ) : ?>
                <h1 class="mb-2 text-black">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>
            <?php if ( $subtitle ) : ?>
                <span class="single-story__row__excerpt text-steel mb-0 h3">
                    <?php echo $subtitle; ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-6 mt-md-8 mt-lg-10">
        <div class="col-12 col-md-8 single-story__row__left">
            <?php if ( $featured_image_url ) : ?>
                <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100 mb-md-8 mb-lg-10 position-relative sm-hide"/>
            <?php endif; ?>
            <?php the_content(); ?>
        </div>
        <div class="col-12 col-md-4 single-story__row__right">
            <?php if ( $featured_image_url ) : ?>
                <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100 mb-4 position-relative sm-show md-hide lg-hide"/>
            <?php endif; ?>
            <div class="background-lightest-silver p-6 p-md-8 p-lg-10 d-flex flex-column">
                <?php if ( ! empty( $author ) && ! is_wp_error( $author ) ) : ?>
                    <div class="col">
                        <span class="text-blue-ada text-sm-medium mb-0">
                            Author
                        </span>
                        <?php $lastAuthor = end($author); ?>
                        <p class="text-lg-medium text-black text-tertiary">
                            <?php foreach( $author as $authors): ?>
                                <?php echo esc_html( $authors->name );
                                    if ($authors !== $lastAuthor) {
                                        echo ', ';
                                    }
                                ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $category ) && ! is_wp_error( $category ) ) : ?>
                    <div class="col">
                        <span class="text-blue-ada text-sm-medium mb-0">
                            Category
                        </span>
                        <?php $lastCat = end($category); ?>
                        <p class="text-lg-medium text-black text-tertiary">
                            <?php foreach( $category as $categories): ?>
                                <?php echo esc_html( $categories->name );
                                    if ($categories !== $lastCat) {
                                        echo ', ';
                                    }
                                ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $topic ) && ! is_wp_error( $topic ) ) : ?>
                    <div class="col">
                        <span class="text-blue-ada text-sm-medium mb-0">
                            Topic
                        </span>
                        <?php $lastTopic = end($topic); ?>
                        <p class="text-lg-medium text-black text-tertiary">
                            <?php foreach( $topic as $topics): ?>
                                <?php echo esc_html( $topics->name );
                                    if ($topics !== $lastTopic) {
                                        echo ', ';
                                    }
                                ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="dividers position-relative icon pt-10 pt-md-12 pt-lg-15">
    <div class="dividers__icon">
    </div>
</section>
<?php 
$args = array(
    'post_type'      => 'post', 
    'posts_per_page' => 3,
    'post__not_in'   => array( get_the_ID() ), 
    'orderby'        => 'date',
    'order'          => 'DESC'
);
$related_query = new WP_Query( $args );

if ($related_query->have_posts()) : ?>
    <section class="featured-post-grid py-10 py-md-12 py-lg-15">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-6 mb-md-8 mb-lg-10">
                    <h2 class="featured-post-grid__header oversized-h2 mb-4 text-center">
                        Related Posts
                    </h2>
                </div>
            </div>
            <div class="row">
                <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                    $permalink = get_permalink(get_the_ID());
                    $title = get_the_title(get_the_ID());
                    $excerpt = get_the_excerpt();
                    $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                    $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    $categories = get_the_category(get_the_ID());
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 featured-post-grid__wrap position-relative pb-10 pb-md-8 pb-lg-0">
                        <?php if ($featured_image_url) : ?>
                            <div class="overlay object-fit-cover featured-post-grid__wrap__img">
                                <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100"/>
                            </div>
                        <?php endif; ?>
                        <?php if ($title) : ?>
                            <h3>
                                <?php echo $title; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ($categories) : ?>
                            <?php $lastCat = end($categories); ?>
                            <p class="text-sm-bold mt-2 text-blue-ada text-tertiary">
                                <?php foreach( $categories as $category): ?>
                                    <?php echo esc_html( $category->name );
                                        if ($category !== $lastCat) {
                                            echo ', ';
                                        }
                                    ?>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($excerpt) : ?>
                            <p class="text-md-regular mt-4 text-black text-tertiary featured-post-grid__wrap__excerpt">
                                <?php echo $excerpt; ?>
                            </p>
                        <?php endif; ?>
                        <a class="button button--steel-underline" href="<?php echo $permalink; ?>" aria-label="Open post">
                            Read Post
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php wp_reset_postdata(); // Reset post data after the custom loop ?>
<?php endif; ?>
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
