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

$id = 'full-width-image-' . $block['id'];

$image_style = get_field('image_style');
$top_inset_color = get_field('top_inset_color');
$bottom_inset_color = get_field('bottom_inset_color');
$image = get_field('image');
$image_height = get_field('image_height');
$height = get_field('height');
$parallax_effect = get_field('parallax_effect');
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="full-width-image position-relative">
    <?php if ($image_style == 'inset') : ?>
        <div class="container">
            <div class="row full-width-image__content">
                <div class="col-12 position-relative">
    <?php endif; ?>

    <div class="full-width-image__bg-img position-relative<?php if ($image_height == 'preset') : ?> object-fit-cover<?php endif; ?> w-100"<?php if ($image_height == 'preset') : ?> style="height: <?php echo $height; ?>px;"<?php endif; ?>>
        <?php if ( $image ) : ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-100 h-100"/>
        <?php endif; ?>
        <?php if ($top_inset_color) : ?>
            <div class="full-width-image__inset-top" style="background: <?php echo $top_inset_color; ?> !important;">
            </div>
        <?php endif; ?>
        <?php if ($bottom_inset_color) : ?>
            <div class="full-width-image__inset-bottom" style="background: <?php echo $bottom_inset_color; ?> !important;">
            </div>
        <?php endif; ?>
    </div>

    <?php if ($image_style == 'inset') : ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php if ( ! $is_preview ) : ?>
	</div>
<?php endif; ?>
