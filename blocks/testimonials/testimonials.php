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

$row_id = get_field('row_id');
$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$testimonial_type = get_field('testimonial_type');
$background_graphic = get_field('background_graphic');
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

if ($background_graphic == 'yes') {
    $backgroundGraphic = ' background-graphic';
} else {
    $backgroundGraphic = '';
}

if ($tile_background == 'solid') {
    $style = "background: {$tile_background_color};";
} elseif ($tile_background == 'gradient') {
    $style = "background: linear-gradient({$tile_background_gradient_angle}deg, {$tile_background_gradient_start}, {$tile_background_gradient_end});";
} else {
    $style = '';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="testimonials container" id="<?php echo esc_attr( $id ); ?>">
    <div class="row">
        <div class="col-12">
            <?php if ($header) : ?>
                <div class="h2 mb-lg-8 text-steel">
                    <?php echo $header; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row testimonials__row position-relative testimonials--<?php echo $testimonialType; echo $backgroundGraphic; ?>" id="<?php echo $row_id; ?>">
        <?php if($testimonial_type == 'collage'): ?>
            <div class="col-12 col-lg-6 testimonials__row--left">
                <?php if ( $stars ) : ?>
                    <img src="<?php echo esc_url($stars['url']); ?>" alt="<?php echo esc_attr($stars['alt']); ?>" class="mb-4 mb-md-6 mb-lg-10 testimonials__row__stars"/>
                <?php endif; ?>
                <?php if ( $testimonial_content ) : ?>
                    <div class="mb-5 text-black oversized-h3">
                        <?php echo $testimonial_content; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $testimonial_name ) : ?>
                    <div class="text-lg-medium text-black mb-0">
                        <?php echo $testimonial_name; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $testimonial_title ) : ?>
                    <div class="text-md-regular text-steel font-tertiary">
                        <?php echo $testimonial_title; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-6 testimonials__row--right">
                <?php if( $collage_image ): ?>
                    <?php $count = 1; ?>
                    <?php foreach( $collage_image as $image ): ?>
                        <div class="testimonials__row__image overlay object-fit-cover testimonials__row__image-<?php echo $count; ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                        <?php $count = $count + 1; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ( $collage_icon ) : ?>
                    <div class="testimonials__row__image overlay testimonials__row__image-<?php echo $count; ?>" <?php echo get_block_wrapper_attributes([
                        'style' => $style
                    ]); ?>>
                        <img src="<?php echo esc_url($collage_icon['url']); ?>" alt="<?php echo esc_attr($collage_icon['alt']); ?>" class="testimonials__row__image__icon"/>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php if($testimonial_type == 'columns'): ?>
            <?php if( have_rows('testimonials') ): ?>
                <?php while( have_rows('testimonials') ) : the_row(); ?>
                    <?php 
                    $stars = get_sub_field('stars');
                    $testimonial_content_size = get_sub_field('testimonial_content_size');
                    $testimonial_content = get_sub_field('testimonial_content');
                    $testimonial_name = get_sub_field('testimonial_name');
                    $testimonial_title = get_sub_field('testimonial_title');

                    if ($testimonial_content_size == 'small') {
                        $testimonialContentSize = ' text-xl-regular';
                    } else {
                        $testimonialContentSize = ' oversized-h3';
                    }
                    ?>
                    <div class="col testimonials__row__col">
                        <?php if ( $stars ) : ?>
                            <img src="<?php echo esc_url($stars['url']); ?>" alt="<?php echo esc_attr($stars['alt']); ?>" class="mb-4 testimonials__row__col__stars"/>
                        <?php else : ?>
                            <div class="mb-4 testimonials__row__col__blue-line"></div>
                        <?php endif; ?>
                        <?php if ( $testimonial_content ) : ?>
                            <div class="mb-5 text-black<?php echo $testimonialContentSize; ?>">
                                <?php echo $testimonial_content; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $testimonial_name ) : ?>
                            <div class="text-lg-medium text-black mb-0">
                                <?php echo $testimonial_name; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $testimonial_title ) : ?>
                            <div class="text-md-regular text-steel font-tertiary">
                                <?php echo $testimonial_title; ?>
                            </div>
                        <?php endif; ?>
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
