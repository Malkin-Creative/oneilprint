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

if ($text_and_button_color == 'light') {
    $textColor = 'white';
    $button = 'white-border';
} else {
    $textColor = 'black';
    $button = 'secondary';
}

if ($background == 'solid') {
    $backgroundColor = $background_color;
    $backgroundGradientStart = '';
    $backgroundGradientEnd = '';
    $backgroundGradientAngle = '';
} else {
    $backgroundColor = $background_gradient_start;
    $backgroundGradientStart = $background_gradient_start;
    $backgroundGradientEnd = $background_gradient_end;
    $backgroundGradientAngle = $background_gradient_angle;
}

if ($typeOfPost == 'case-study') {
    $postId = $featured_case_study->ID;
    $postTitle = $featured_case_study->post_title;
    $subtitle = get_field('subtitle', $postId);
    $summary_excerpt = get_field('summary_excerpt', $postId);
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
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="featured-post position-relative" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row featured-post__content" style="background: <?php echo $backgroundColor; ?>; background: linear-gradient(<?php echo $backgroundGradientAngle; ?>deg,<?php echo $backgroundGradientStart; ?>,<?php echo $backgroundGradientEnd; ?>);">
            <div class="col-12 col-lg-6 p-6 p-md-8 p-lg-10 featured-post__content__wrap">
                <h2 class="mb-4" style="color: <?php echo $header_color; ?>">
                    Featured <?php echo $type_of_post->labels->singular_name; ?>:
                </h2>
                <h3 class="oversized-h3 mb-4 text-<?php echo $textColor; ?>">
                    <?php echo esc_html($postTitle); ?><?php if ($subtitle) : ?>: <?php echo $subtitle; ?><?php endif; ?>
                </h3>
                <?php if ($summary_excerpt) : ?>
                    <p class="text-lg-regular mb-6 mb-md-8 mb-lg-10 text-<?php echo $textColor; ?>">
                        <?php echo $summary_excerpt; ?>
                    </p>
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
