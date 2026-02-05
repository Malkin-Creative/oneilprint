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

$id = 'home-hero-collage-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$subheader = get_field('subheader');
$main_imagery = get_field('main_imagery');
$primary_image = get_field('primary_image');
$secondary_image = get_field('secondary_image');
$tertiary_image = get_field('tertiary_image');
$main_video = get_field('main_video');
$icon = get_field('icon');
$rectangle_background = get_field('rectangle_background');
$background_color = get_field('background_color');
$background_gradient_start = get_field('background_gradient_start');
$background_gradient_end = get_field('background_gradient_end');
$background_gradient_angle = get_field('background_gradient_angle');
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

if ($rectangle_background == 'solid') {
    $style = "background: {$background_color};";
} elseif ($rectangle_background == 'gradient') {
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

<section class="home-hero-collage" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row home-hero-collage__content background-lightest-silver position-relative px-6 px-lg-14">
            <?php if ( $rectangle_background ) : ?>
                <div class="home-hero-collage__content__bg" <?php echo get_block_wrapper_attributes([
                    'style' => $style
                ]); ?>>
                </div>
            <?php endif; ?>
            <?php if ( $primary_image ) : ?>
                <div class="home-hero-collage__content__image-primary overlay object-fit-cover h-100 p-0">
                    <img src="<?php echo esc_url($primary_image['url']); ?>" alt="<?php echo esc_attr($primary_image['alt']); ?>" class="w-100 h-100 position-relative"/>
                </div>
            <?php endif; ?>
            <?php if ( $secondary_image ) : ?>
                <div class="home-hero-collage__content__image-secondary overlay object-fit-cover p-0">
                    <img src="<?php echo esc_url($secondary_image['url']); ?>" alt="<?php echo esc_attr($secondary_image['alt']); ?>" class="w-100 h-100 position-relative"/>
                </div>
            <?php endif; ?>
            <?php if ( $tertiary_image ) : ?>
                <div class="home-hero-collage__content__image-tertiary overlay object-fit-cover p-0">
                    <img src="<?php echo esc_url($tertiary_image['url']); ?>" alt="<?php echo esc_attr($tertiary_image['alt']); ?>" class="w-100 h-100 position-relative"/>
                </div>
            <?php endif; ?>
            <?php if ( $icon ) : ?>
                <div class="home-hero-collage__content__icon background-white overlay p-0">
                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>"/>
                </div>
            <?php endif; ?>
            <?php if ( $main_video ) : ?>
                <div class="home-hero-collage__content__bg-video overlay p-0">
                    <video autoplay muted playsinline loop width="100%" height="100%">
                        <source src="<?php echo $main_video; ?>" type="video/mp4">
                    </video>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-5 py-6 py-md-20 home-hero-collage__content__wrap">
                <?php if ($header) : ?>
                    <div class="mb-2 h1-jumbo text-navy home-hero-collage__content__wrap__header">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ($subheader) : ?>
                    <h3 class="text-steel mb-0">
                        <?php echo $subheader; ?>
                    </h3>
                <?php endif; ?>
                <?php if ( $primary_cta || $secondary_cta ) : ?>
                    <div class="mt-4 mt-md-5 d-flex home-hero-collage__content__wrap__buttons">
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
