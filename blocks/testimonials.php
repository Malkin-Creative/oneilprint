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

$id = 'testimonials-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$testimonial_type = get_field('testimonial_type');
$collage_image = get_field('collage_image');
$collage_icon = get_field('collage_icon');
$stars = get_field('stars');
$testimonial_content = get_field('testimonial_content');
$testimonial_name = get_field('testimonial_name');
$testimonial_title = get_field('testimonial_title');
$tile_background = get_field('tile_background');
$tile_background_color = get_field('tile_background_color');
$tile_background_gradient_start = get_field('tile_background_gradient_start');
$tile_background_gradient_end = get_field('tile_background_gradient_end');
$tile_background_gradient_angle = get_field('tile_background_gradient_angle');

if ($testimonial_type == 'collage') {
    $testimonialType = 'collage';
} else {
    $testimonialType = 'columns';
}

if ($background == 'solid') {
    $backgroundColor = $background_color;
    $backgroundGradientStart = '';
    $backgroundGradientEnd = '';
    $backgroundGradientAngle = '';
} elseif ($background == 'gradient') {
    $backgroundColor = $background_gradient_start;
    $backgroundGradientStart = $background_gradient_start;
    $backgroundGradientEnd = $background_gradient_end;
    $backgroundGradientAngle = $background_gradient_angle;
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="testimonials position-relative testimonials--<?php echo $testimonialType; ?> container" id="<?php echo esc_attr( $id ); ?>">
    <div class="row">
        <div class="col-12">
            <?php if ($header) : ?>
                <h2 class="mb-8 text-steel">
                    <?php echo $header; ?>
                </h2>
            <?php endif; ?>
        </div>
    </div>
    <div class="row align-items-center testimonials__row">
        <?php if($testimonial_type = 'collage'): ?>

        <?php endif; ?>
        <?php if($testimonial_type = 'columns'): ?>
            <?php if( have_rows('testimonials') ): ?>
                <?php while( have_rows('testimonials') ) : the_row(); ?>
                    <?php 
                    $stars = get_sub_field('stars');
                    $testimonial_content = get_sub_field('testimonial_content');
                    $testimonial_name = get_sub_field('testimonial_name');
                    $testimonial_title = get_sub_field('testimonial_title');
                    ?>
                    <div class="col multi-col-tiles__content__col position-relative p-6 p-lg-4 d-flex flex-column justify-content-between"<?php if ($tile_background == 'solid' || $tile_background == 'gradient') : ?> style="background: <?php echo $tileBackgroundColor; ?>; background: linear-gradient(<?php echo $tileBackgroundGradientAngle; ?>deg,<?php echo $tileBackgroundGradientStart; ?>,<?php echo $tileBackgroundGradientEnd; ?>);"<?php endif; ?>>
                        <div>
                            <?php if ( $icon ) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="mb-4 multi-col-tiles__content__col__icon"/>
                            <?php endif; ?>
                            <?php if ( $header ) : ?>
                                <h3 class="mb-2 text-<?php echo $headerColor; ?>">
                                    <?php echo $header; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ( $paragraph ) : ?>
                                <p class="text-md-regular text-<?php echo $paragraphColor; ?>">
                                    <?php echo $paragraph; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div>
                            <?php if ( $cta ) : ?>
                                <a class="button button--<?php echo $buttonColor; ?><?php echo $anchor_scroll; ?>" href="<?php echo esc_url( $cta_url ); ?>" target="<?php echo esc_attr( $cta_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $cta_label ); ?>">
                                    <?php echo esc_html( $cta_title ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        <?php endif; ?>
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
