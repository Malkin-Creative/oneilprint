<?php 
// Exit if accessed directly
defined('ABSPATH') || exit;

get_header(); ?>

<?php global $wp_query; ?>

<section class="container py-6">
    <div class="row">
        <div class="col-12">
            <?php if ( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<div id="breadcrumbs">','</div>' );
            } ?>
        </div>
    </div>
</section>
<section class="search">
    <div class="container">
        <div class="row">
            <?php if (have_posts()) : ?>
                <div class="col-12">
                    <h1 class="text-black">
                        Search Results For
                        <span class="search__title">'<?php echo get_search_query(); ?>'</span>
                    </h1>
                    <h2 class="h3 text-steel">
                        Results <?php echo count($wp_query->posts); ?> of <?php echo number_format_i18n($wp_query->found_posts); ?>
                    </h2>
                </div>
                <div class="search__results col-12">
                    <?php while (have_posts()) : the_post();
                        $postId = $post->ID; 
                        $summary_excerpt = get_field('summary_excerpt', $postId);
                        $subnav_item_subtitle = get_field('subnav_item_subtitle', $postId);
                        $summary_of_bio = get_field('summary_of_bio', $postId);
                        $excerpt = get_the_excerpt($postId);
                        ?>
                        <article class="search__results__result pt-8 pb-4 pb-md-8">
                            <div class="row align-items-center">
                                <!-- Featured Image -->
                                <div class="col-12 d-flex align-items-md-center flex-column flex-md-row search__results__result__col">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php
                                            the_post_thumbnail(
                                            'full',
                                            [
                                                'class' => 'object-fit-cover',
                                                'alt'   => esc_attr( get_the_title() )
                                            ]
                                            );
                                        ?>
                                    <?php endif; ?>
                                    <div class="py-4">
                                        <h3 class="mb-0 text-black">
                                            <?php the_title(); ?>
                                        </h3>
                                        <?php if ($summary_excerpt) : ?>
                                            <p class="text-md-regular mt-4 text-black text-tertiary search__results__result__excerpt">
                                                <?php echo $summary_excerpt; ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if ($excerpt) : ?>
                                            <p class="text-md-regular mt-4 text-black text-tertiary search__results__result__excerpt">
                                                <?php echo $excerpt; ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if ($subnav_item_subtitle) : ?>
                                            <p class="text-md-regular mt-4 text-black text-tertiary search__results__result__excerpt">
                                                <?php echo $subnav_item_subtitle; ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if ($summary_of_bio) : ?>
                                            <p class="text-md-regular mt-4 text-black text-tertiary search__results__result__excerpt">
                                                <?php echo $summary_of_bio; ?>
                                            </p>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>" class="button button--steel-underline mt-4">
                                            View Result
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
