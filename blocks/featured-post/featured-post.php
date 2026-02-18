<?php
/**
 * Hero block.
 *
 * @param array  $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool   $is_preview True during backend preview render.
 * @param int    $post_id The post ID the block is rendering content against.
 *                     This is either the post ID currently being displayed inside a query loop,
 *                     or the post ID of the post hosting this block.
 * @param array $context The context provided to the block by the post or it's parent block.
 */

// Support custom id values.
$block_id = '';
if ( ! empty( $block['anchor'] ) ) {
	$block_id = esc_attr( $block['anchor'] );
}

$id = 'featured-post-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$block_type = get_field('block_type');
$background = get_field('background');
$background_color = get_field('background_color');
$background_gradient_start = get_field('background_gradient_start');
$background_gradient_end = get_field('background_gradient_end');
$background_gradient_angle = get_field('background_gradient_angle');
$header_color = get_field('header_color');
$text_and_button_color = get_field('text_and_button_color');
$type_of_post = get_field('type_of_post');
$featured_case_study = get_field('featured_case_study');
$featured_story = get_field('featured_story');
$featured_post = get_field('featured_post');
$typeOfPost = $type_of_post->name;
$primary_cta = get_field('primary_cta');
$primary_cta_label = get_field('primary_cta_label');
if( $primary_cta ): 
    $primary_link_url = $primary_cta['url'];
    $primary_link_title = $primary_cta['title'];
    $primary_link_target = $primary_cta['target'] ? $primary_cta['target'] : '_self';
endif;
$anchorScrollPrimary = get_field('anchor_scroll_on_primary_cta');

if ($anchorScrollPrimary == 'anchor-scroll') {
    $anchor_scroll_primary = ' anchor-scroll';
} else {
    $anchor_scroll_primary = '';
}

$secondary_cta = get_field('secondary_call_to_action');
$secondary_cta_label = get_field('secondary_call_to_action_label');
if( $secondary_cta ): 
    $secondary_link_url = $secondary_cta['url'];
    $secondary_link_title = $secondary_cta['title'];
    $secondary_link_target = $secondary_cta['target'] ? $secondary_cta['target'] : '_self';
endif;
$anchorScrollSecondary = get_field('anchor_scroll_on_secondary_cta');

if ($anchorScrollSecondary == 'anchor-scroll') {
    $anchor_scroll_secondary = ' anchor-scroll';
} else {
    $anchor_scroll_secondary = '';
}

if ($text_and_button_color == 'light') {
    $textColor = 'white';
    $button = 'white-border';
    $buttonSmall = 'white-underline';
    $subheaderColor = 'white';
} else {
    $textColor = 'black';
    $button = 'secondary';
    $buttonSmall = 'steel-underline';
    $subheaderColor = 'blue-ada';
}

if ($background == 'solid') {
    $style = "background: {$background_color};";
} elseif ($background == 'gradient') {
    $style = "background: linear-gradient({$background_gradient_angle}deg, {$background_gradient_start}, {$background_gradient_end});";
} else {
    $style = '';
}

if ($block_type == 'full-width') {
    $blockType = ' full-width-featured';
} else {
    $blockType = '';
}

if ($typeOfPost == 'case-study') {
    $postId = $featured_case_study->ID;
    $postTitle = $featured_case_study->post_title;
    $subtitle = get_field('subtitle', $postId);
    $summary_excerpt = get_field('summary_excerpt', $postId);
    $post_cat = get_the_terms( $postId, 'industries' );
} elseif ($typeOfPost == 'story') {
    $postId = $featured_story->ID;
    $postTitle = $featured_story->post_title;
    $subtitle = '';
    $summary_excerpt = get_field('summary_excerpt', $postId);
} else {
    $postId = $featured_post->ID;
    $postTitle = $featured_post->post_title;
    $subtitle = '';
    $summary_excerpt = get_the_excerpt($postId);
}

$thumbnail_id = get_post_thumbnail_id( $postId );
$featured_image_url = get_the_post_thumbnail_url( $postId, 'full' );
$alt_text = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
$permalink = get_permalink( $postId );
$categories = get_the_category($postId);
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="featured-post position-relative<?php echo $blockType; ?>" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <?php if ($block_type == 'full-width') { ?>
            <div class="row featured-post__content" <?php echo get_block_wrapper_attributes([
                'style' => $style
            ]); ?>>
                <div class="col-12 col-lg-6 p-6 p-md-8 p-lg-10 featured-post__content__wrap">
                    <h2 class="mb-4" style="color: <?php echo $header_color; ?>">
                        Featured <?php echo $type_of_post->labels->singular_name; ?>:
                    </h2>
                    <div class="oversized-h3 mb-4 text-<?php echo $textColor; ?>">
                        <?php echo esc_html($postTitle); ?><?php if ($subtitle) : ?>: <?php echo $subtitle; ?><?php endif; ?>
                    </div>
                    <?php if ($summary_excerpt) : ?>
                        <div class="text-lg-regular mb-6 mb-md-8 mb-lg-10 text-<?php echo $textColor; ?>">
                            <?php echo $summary_excerpt; ?>
                        </div>
                    <?php endif; ?>
                    <a class="button button--<?php echo $button; ?>" href="<?php echo $permalink; ?>" aria-label="Open post">
                        View <?php echo $type_of_post->labels->singular_name; ?>
                    </a>
                </div>
                <div class="featured-post__content__bg-img overlay object-fit-cover h-100">
                    <?php if ($featured_image_url) : ?>
                        <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100 h-100"/>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col p-0">
                    <?php if ( $primary_cta || $secondary_cta ) : ?>
                        <div class="mt-6 mt-md-8 mt-lg-10 hero-default__content__wrap__buttons d-flex justify-content-center align-items-center">
                            <?php if ( $primary_cta ) : ?>
                                <a class="button button--primary<?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $primary_cta_label ); ?>">
                                    <?php echo esc_html( $primary_link_title ); ?>
                                </a>
                            <?php endif; ?>
                            <?php if ( $secondary_cta ) : ?>
                                <a class="button button--secondary<?php echo $anchor_scroll_secondary; ?>" href="<?php echo esc_url( $secondary_link_url ); ?>" target="<?php echo esc_attr( $secondary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $secondary_cta_label ); ?>">
                                    <?php echo esc_html( $secondary_link_title ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="col-12 col-md-8 featured-post__left">
                    <?php if ($featured_image_url) : ?>
                        <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100 mb-4 mb-md-0"/>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-4 featured-post__right">
                    <div class="p-6 p-md-8 d-flex flex-column h-100" <?php echo get_block_wrapper_attributes([
                        'style' => $style
                    ]); ?>>
                        <h2 class="mb-4 text-<?php echo $textColor; ?>">
                            <?php echo esc_html($postTitle); ?><?php if ($subtitle) : ?>: <?php echo $subtitle; ?><?php endif; ?>
                        </h2>
                        <?php if ($categories) : ?>
                            <?php $lastCat = end($categories); ?>
                            <p class="text-sm-bold mb-4 font-tertiary text-<?php echo $subheaderColor; ?>">
                                <?php foreach( $categories as $category): ?>
                                    <?php echo esc_html( $category->name );
                                        if ($category !== $lastCat) {
                                            echo ', ';
                                        }
                                    ?>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($summary_excerpt) : ?>
                            <div class="text-lg-regular mb-5 text-<?php echo $textColor; ?>">
                                <?php echo $summary_excerpt; ?>
                            </div>
                        <?php endif; ?>
                        <a class="button button--<?php echo $buttonSmall; ?>" href="<?php echo $permalink; ?>" aria-label="Open post">
                            View <?php echo $type_of_post->labels->singular_name; ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php if ( ! $is_preview ) : ?>
	</div>
<?php endif; ?>

<style type="text/css">
    #<?php echo esc_attr( $id ); ?> {
        padding-top: <?php echo esc_attr( $padding_top ); ?>px;
        padding-bottom: <?php echo esc_attr( $padding_bottom ); ?>px;
    }
	@media (max-width: 767px) {
		#<?php echo esc_attr( $id ); ?> {
            padding-top: <?php echo esc_attr( $padding_top_mobile ); ?>px;
            padding-bottom: <?php echo esc_attr( $padding_bottom_mobile ); ?>px;
        }
	}
</style>
