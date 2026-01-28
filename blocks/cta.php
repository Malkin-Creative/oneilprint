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

$id = 'cta-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$paragraph = get_field('paragraph');
$background = get_field('background');
$background_color = get_field('background_color');
$background_gradient_start = get_field('background_gradient_start');
$background_gradient_end = get_field('background_gradient_end');
$background_gradient_angle = get_field('background_gradient_angle');
$background_image = get_field('background_image');
$background_video = get_field('background_video');
$tile_content_style = get_field('tile_content_style');
$tile_background = get_field('tile_background');
$tile_background_color = get_field('tile_background_color');
$tile_background_gradient_start = get_field('tile_background_gradient_start');
$tile_background_gradient_end = get_field('tile_background_gradient_end');
$tile_background_gradient_angle = get_field('tile_background_gradient_angle');
$tile_background_image = get_field('tile_background_image');
$tile_background_video = get_field('tile_background_video');
$primary_cta = get_field('primary_call_to_action');
$primary_cta_label = get_field('primary_call_to_action_label');
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

if ($tile_content_style == 'light') {
    $textColor = 'black';
    $buttonPrimary = 'primary';
    $buttonSecondary = 'secondary';
} else {
    $textColor = 'white';
    $buttonPrimary = 'white';
    $buttonSecondary = 'white-border';
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
} else {
    $backgroundColor = '';
    $backgroundGradientStart = '';
    $backgroundGradientEnd = '';
    $backgroundGradientAngle = '';
}

if ($tile_background == 'solid') {
    $tileBackgroundColor = $tile_background_color;
    $tileBackgroundGradientStart = '';
    $tileBackgroundGradientEnd = '';
    $tileBackgroundGradientAngle = '';
} elseif ($tile_background == 'gradient') {
    $tileBackgroundColor = $tile_background_gradient_start;
    $tileBackgroundGradientStart = $tile_background_gradient_start;
    $tileBackgroundGradientEnd = $tile_background_gradient_end;
    $tileBackgroundGradientAngle = $tile_background_gradient_angle;
} else {
    $tileBackgroundColor = '';
    $tileBackgroundGradientStart = '';
    $tileBackgroundGradientEnd = '';
    $tileBackgroundGradientAngle = '';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="cta position-relative" id="<?php echo esc_attr( $id ); ?>"<?php if ($background == 'solid' || $background == 'gradient') : ?> style="background: <?php echo $backgroundColor; ?>; background: linear-gradient(<?php echo $backgroundGradientAngle; ?>deg,<?php echo $backgroundGradientStart; ?>,<?php echo $backgroundGradientEnd; ?>);"<?php endif; ?>>
    <?php if ($background == 'image') : ?>
        <div class="cta__bg-img overlay object-fit-cover w-100 h-100">
            <?php if ( $background_image ) : ?>
                <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" class="w-100 h-100"/>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($background == 'video') : ?>
        <div class="cta__bg-video overlay w-100 h-100">
            <?php if ( $background_video ) : ?>
                <video autoplay muted playsinline loop width="100%" height="100%">
                    <source src="<?php echo $background_video; ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row justify-content-center cta__content"<?php if ($tile_background == 'solid' || $tile_background == 'gradient') : ?> style="background: <?php echo $tileBackgroundColor; ?>; background: linear-gradient(<?php echo $tileBackgroundGradientAngle; ?>deg,<?php echo $tileBackgroundGradientStart; ?>,<?php echo $tileBackgroundGradientEnd; ?>);"<?php endif; ?>>
            <?php if ($tile_background == 'image') : ?>
                <div class="cta__content__bg-img overlay object-fit-cover w-100 h-100">
                    <?php if ( $tile_background_image ) : ?>
                        <img src="<?php echo esc_url($tile_background_image['url']); ?>" alt="<?php echo esc_attr($tile_background_image['alt']); ?>" class="w-100 h-100"/>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($tile_background == 'video') : ?>
                <div class="cta__content__bg-video overlay w-100 h-100">
                    <?php if ( $tile_background_video ) : ?>
                        <video autoplay muted playsinline loop width="100%" height="100%">
                            <source src="<?php echo $tile_background_video; ?>" type="video/mp4">
                        </video>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-10 col-lg-7 py-8 px-6 py-md-8 py-lg-10 px-md-10 px-lg-12 cta__content__wrap">
                <?php if ( $header ) : ?>
                    <h2 class="text-left text-md-center px-lg-6 mb-2 text-<?php echo $textColor; ?>">
                        <?php echo $header; ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $paragraph ) : ?>
                    <p class="h3 text-left text-md-center text-<?php echo $textColor; ?>">
                        <?php echo $paragraph; ?>
                    </p>
                <?php endif; ?>
                <?php if ( $primary_cta || $secondary_cta ) : ?>
                    <div class="mt-6 d-flex justify-content-center align-items-center cta__content__wrap__buttons">
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
