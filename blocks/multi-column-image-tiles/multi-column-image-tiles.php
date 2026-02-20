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

$id = 'multi-col-img-tiles-' . $block['id'];

$row_id = get_field('row_id');
$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$number_of_tiles_in_each_row = get_field('number_of_tiles_in_each_row');
$background = get_field('background');
$background_color = get_field('background_color');
$background_gradient_start = get_field('background_gradient_start');
$background_gradient_end = get_field('background_gradient_end');
$background_gradient_angle = get_field('background_gradient_angle');

if ($background == 'solid') {
    $style = "background: {$background_color};";
} elseif ($background == 'gradient') {
    $style = "background: linear-gradient({$background_gradient_angle}deg, {$background_gradient_start}, {$background_gradient_end});";
} else {
    $style = '';
}

if ($number_of_tiles_in_each_row) {
    $tileNumber = $number_of_tiles_in_each_row;
} else {
    $tileNumber = '3';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="multi-col-img-tiles position-relative" id="<?php echo esc_attr( $id ); ?>" <?php echo get_block_wrapper_attributes([
        'style' => $style
    ]); ?>>
    <div class="container" id="<?php echo $row_id; ?>">
        <div class="row justify-content-center multi-col-img-tiles__content" style="grid-template-columns: repeat(<?php echo $tileNumber; ?>, 1fr);">
            <?php if( have_rows('columns') ): ?>
                <?php while( have_rows('columns') ) : the_row(); ?>
                    <?php 
                    $image_caption_color = get_sub_field('image_caption_color');
                    $image = get_sub_field('image');
                    $image_caption = get_sub_field('image_caption');

                    if ($image_caption_color == 'white') {
                        $captionColor = 'white';
                    } else {
                        $captionColor = 'steel';
                    }
                    ?>
                    <div class="col multi-col-img-tiles__content__col position-relative p-0">
                        <?php if ( $image ) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="multi-col-img-tiles__content__col__image w-100 object-fit-cover"/>
                        <?php endif; ?>
                        <?php if ( $image_caption ) : ?>
                            <div class="mt-2 mb-0 text-sm-regular text-<?php echo $captionColor; ?>">
                                <?php echo $image_caption; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
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
