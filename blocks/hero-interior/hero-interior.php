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

$id = 'hero-default-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$background_graphic = get_field('background_graphic');
$header = get_field('header');
$paragraph = get_field('paragraph');
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
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="hero-interior position-relative" id="<?php echo esc_attr( $id ); ?>">
    <div class="hero-interior__bg w-100" <?php echo get_block_wrapper_attributes([
        'style' => $style
    ]); ?>></div>
    <?php if ( $background_graphic ) : ?>
        <div class="hero-interior__bg-graphic overlay object-fit-cover d-none d-md-flex">
            <img src="<?php echo esc_url($background_graphic['url']); ?>" alt="<?php echo esc_attr($background_graphic['alt']); ?>" class="w-100 h-100"/>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row hero-interior__content">
            <div class="hero-interior__content__wrap col-12">
                <?php if ( $header ) : ?>
                    <div class="mb-1 text-black">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $paragraph ) : ?>
                    <div class="mb-0 text-steel">
                        <?php echo $paragraph; ?>
                    </div>
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
