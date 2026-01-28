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

$id = 'dividers-' . $block['id'];

$divider_type = get_field('divider_type');
$cutout_position = get_field('cutout_position');
$cutout_color = get_field('cutout_color');
$icon = get_field('icon');
$background_color = get_field('background_color');

if ($cutout_position == 'left') {
    $cutoutPosition = ' cutout-left';
} else {
    $cutoutPosition = ' cutout-right';
}

if ($divider_type == 'icon') {
    $dividerType = ' icon';
} else {
    $dividerType = '';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="dividers position-relative<?php echo $dividerType; ?>" id="<?php echo esc_attr( $id ); ?>" style="background: <?php echo $background_color; ?>;">
    <?php if ($divider_type == 'cutout') : ?>
        <div class="dividers__cutout h-100 overlay<?php echo $cutoutPosition; ?>" style="background: <?php echo $cutout_color; ?>;">
        </div>
    <?php endif; ?>
    <?php if ($divider_type == 'icon') : ?>
        <div class="dividers__icon">
        </div>
    <?php endif; ?>
</section>

<?php if ( ! $is_preview ) : ?>
	</div>
<?php endif; ?>
