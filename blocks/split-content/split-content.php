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

$id = 'split-content-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$block_alignment = get_field('block_alignment');
$background_color = get_field('backgroundcolor');
$image = get_field('image');
$header = get_field('header');
$paragraph = get_field('paragraph');
$tile_background = get_field('tile_background');
$tile_background_color = get_field('tile_background_color');
$tile_background_gradient_start = get_field('tile_background_gradient_start');
$tile_background_gradient_end = get_field('tile_background_gradient_end');
$tile_background_gradient_angle = get_field('tile_background_gradient_angle');
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

if ($background_color == 'light') {
    $backgroundColor = ' background-white';
    $buttonColor = 'primary';
    $textColor = 'black';
} elseif ($background_color == 'dark') {
    $backgroundColor = ' background-navy';
    $buttonColor = 'white';
    $textColor = 'white';
} else {
    $backgroundColor = ' background-white';
    $buttonColor = 'primary';
    $textColor = 'black';
}

if ($block_alignment == 'image-left') {
    $blockAlignment = ' image-left';
} else {
    $blockAlignment = ' image-right';
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

<section class="split-content<?php echo $backgroundColor; ?><?php echo $blockAlignment; ?>" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 mx-auto split-content__wrap">
                <?php if ($header) : ?>
                    <div class="h2 mb-2 split-content__wrap__header text-<?php echo $textColor; ?>">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ($paragraph) : ?>
                    <div class="mb-0 text-<?php echo $textColor; ?>">
                        <?php echo $paragraph; ?>
                    </div>
                <?php endif; ?>
                <?php if ($primary_cta) : ?>
                    <div class="mt-6 split-content__wrap__buttons">
                        <a class="button button--<?php echo $buttonColor; echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $primary_cta_label ); ?>">
                            <?php echo esc_html( $primary_link_title ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-6 col-lg-6 split-content__content">
                <?php if ( $image ) : ?>
                    <div class="split-content__content__image position-relative">
                        <div class="w-100 h-100 d-flex split-content__content__image__details"></div>
                        <?php if ( $tile_background ) : ?>
                            <div class="split-content__content__image__bg" <?php echo get_block_wrapper_attributes([
                                'style' => $style
                            ]); ?>>
                            </div>
                        <?php endif; ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-100 object-fit-cover position-relative"/>
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
