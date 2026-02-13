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
$subheader = get_field('subheader');
$paragraph = get_field('paragraph');
$text_alignment = get_field('text_alignment');
$text_color = get_field('text_color');
$background = get_field('background');
$background_color = get_field('background_color');
$background_gradient_start = get_field('background_gradient_start');
$background_gradient_end = get_field('background_gradient_end');
$background_gradient_angle = get_field('background_gradient_angle');
$background_image = get_field('background_image');
$background_video = get_field('background_video');
$overlay = get_field('overlay');
$overlay_color = get_field('overlay_color');
$overlay_gradient_start = get_field('overlay_gradient_start');
$overlay_gradient_end = get_field('overlay_gradient_end');
$overlay_gradient_angle = get_field('overlay_gradient_angle');
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

if ($text_color == 'light') {
    $textColor = 'white';
    $subheaderColor = 'white';
    $buttonPrimary = 'white';
    $buttonSecondary = 'white-border';
} else {
    $textColor = 'black';
    $subheaderColor = 'steel';
    $buttonPrimary = 'primary';
    $buttonSecondary = 'secondary';
}

if ($text_alignment == 'left') {
    $containerAlignment = '';
    $textAlignment = '';
} else {
    $containerAlignment = ' justify-content-center align-items-center';
    $textAlignment = ' text-center';
}

if ($background == 'solid') {
    $style = "background: {$background_color};";
} elseif ($background == 'gradient') {
    $style = "background: linear-gradient({$background_gradient_angle}deg, {$background_gradient_start}, {$background_gradient_end});";
} else {
    $style = '';
}

if ($overlay == 'solid') {
    $styleOverlay = "background: {$overlay_color};";
} elseif ($overlay == 'gradient') {
    $styleOverlay = "background: linear-gradient({$overlay_gradient_angle}deg, {$overlay_gradient_start}, {$overlay_gradient_end});";
} else {
    $styleOverlay = '';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="hero-default position-relative<?php if ($background == 'solid' || $background == 'gradient' || $background == 'image' || $background == 'video') : ?> hero-default__background<?php endif; ?>" id="<?php echo esc_attr( $id ); ?>">
    <?php if ( $background_graphic ) : ?>
        <div class="hero-default__bg-graphic overlay object-fit-cover d-none d-md-flex">
            <img src="<?php echo esc_url($background_graphic['url']); ?>" alt="<?php echo esc_attr($background_graphic['alt']); ?>" class="w-100 h-100"/>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row hero-default__content<?php echo $containerAlignment; ?>" <?php echo get_block_wrapper_attributes([
            'style' => $style
        ]); ?>>
            <?php if ($background == 'image') : ?>
                <div class="hero-default__bg-img overlay object-fit-cover w-100 h-100 p-0">
                    <?php if ( $background_image ) : ?>
                        <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" class="w-100 h-100"/>
                    <?php endif; ?>
                    <div class="hero-default__bg-img__overlay h-100 w-100 overlay" <?php echo get_block_wrapper_attributes([
                        'style' => $styleOverlay
                    ]); ?>></div>
                </div>
            <?php endif; ?>
            <?php if ($background == 'video') : ?>
                <div class="hero-default__bg-video overlay w-100 h-100 p-0">
                    <?php if ( $background_video ) : ?>
                        <video autoplay muted playsinline loop width="100%" height="100%">
                            <source src="<?php echo $background_video; ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                    <div class="hero-default__bg-video__overlay h-100 w-100 overlay" <?php echo get_block_wrapper_attributes([
                        'style' => $styleOverlay
                    ]); ?>></div>
                </div>
            <?php endif; ?>
            <div class="hero-default__content__wrap col-12 col-md-10 col-lg-6 d-flex flex-column<?php echo $containerAlignment; ?><?php if ($background == 'solid' || $background == 'gradient' || $background == 'image' || $background == 'video') : ?> py-8 px-6 py-md-8 py-lg-10 px-md-10<?php endif; ?>">
                <?php if ( $header ) : ?>
                    <div class="mb-1 text-<?php echo $textColor; ?><?php echo $textAlignment; ?>">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $subheader ) : ?>
                    <div class="h3 mb-5 text-<?php echo $subheaderColor; ?><?php echo $textAlignment; ?>">
                        <?php echo $subheader; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $paragraph ) : ?>
                    <div class="h4 mb-0 text-<?php echo $textColor; ?><?php echo $textAlignment; ?>">
                        <?php echo $paragraph; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $primary_cta || $secondary_cta ) : ?>
                    <div class="mt-6 hero-default__content__wrap__buttons d-flex<?php echo $containerAlignment; ?>">
                        <?php if ( $primary_cta ) : ?>
                            <a class="button button--<?php echo $buttonPrimary; ?><?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $primary_cta_label ); ?>">
                                <?php echo esc_html( $primary_link_title ); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ( $secondary_cta ) : ?>
                            <a class="button button--<?php echo $buttonSecondary; ?><?php echo $anchor_scroll_secondary; ?>" href="<?php echo esc_url( $secondary_link_url ); ?>" target="<?php echo esc_attr( $secondary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $secondary_cta_label ); ?>">
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
