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

$id = 'standard-form-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$subheader = get_field('subheader');
$background = get_field('background');
$text_color = get_field('text_color');
$form_selector = get_field('form_selector');
$intro_background_color = get_field('intro_background_color');
$intro_background_gradient_start = get_field('intro_background_gradient_start');
$intro_background_gradient_end = get_field('intro_background_gradient_end');
$intro_background_gradient_angle = get_field('intro_background_gradient_angle');

if ($text_color == 'light') {
    $textColor = 'white';
} else {
    $textColor = 'black';
}

if ($background == 'solid') {
    $style = "background: {$intro_background_color};";
} elseif ($background == 'gradient') {
    $style = "background: linear-gradient({$intro_background_gradient_angle}deg, {$intro_background_gradient_start}, {$intro_background_gradient_end});";
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

<section class="standard-form container" id="<?php echo esc_attr( $id ); ?>">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 pb-4 pb-md-0">
            <div class="p-6 p-md-8 p-lg-10 h-100 standard-form__content" <?php echo get_block_wrapper_attributes([
                'style' => $style
            ]); ?>>
                <?php if ( $header ) : ?>
                    <h2 class="standard-form__content__header text-<?php echo $textColor; ?>">
                        <?php echo $header; ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $subheader ) : ?>
                    <div class="standard-form__content__subheader text-xl-regular text-<?php echo $textColor; ?>">
                        <?php echo $subheader; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-8">
            <div class="p-6 p-md-8 standard-form__form background-lightest-silver">
                <?php if ( $form_selector ) :
                    gravity_form( $form_selector, false, false, false, '', true, 1 );
                endif; ?>
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
