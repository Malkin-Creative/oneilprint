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

$id = 'tile-block-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$animation_toggle = get_field('animation_toggle');
$background = get_field('background');
$background_color = get_field('background_color');
$background_gradient_start = get_field('background_gradient_start');
$background_gradient_end = get_field('background_gradient_end');
$background_gradient_angle = get_field('background_gradient_angle');
$header = get_field('header');
$text_color = get_field('text_color');
$paragraph = get_field('paragraph');
$primary_cta = get_field('cta');
$call_to_action_color = get_field('call_to_action_color');
$primary_cta_label = get_field('cta_label');
if( $primary_cta ): 
    $primary_link_url = $primary_cta['url'];
    $primary_link_title = $primary_cta['title'];
    $primary_link_target = $primary_cta['target'] ? $primary_cta['target'] : '_self';
endif;
$anchorScrollPrimary = get_field('anchor_scroll_on_cta');

if ($anchorScrollPrimary == 'anchor-scroll') {
    $anchor_scroll_primary = ' anchor-scroll';
} else {
    $anchor_scroll_primary = '';
}

if ($text_color == 'light') {
    $textColor = 'white';
} else {
    $textColor = 'black';
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
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="tile-block position-relative" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4 pb-4 pb-lg-0">
                <div class="p-6 p-md-8 p-lg-10 h-100 tile-block__content--left"<?php if ($background == 'solid' || $background == 'gradient') : ?> style="background: <?php echo $backgroundColor; ?>; background: linear-gradient(<?php echo $backgroundGradientAngle; ?>deg,<?php echo $backgroundGradientStart; ?>,<?php echo $backgroundGradientEnd; ?>);"<?php endif; ?>>
                    <?php if ( $header ) : ?>
                        <h2 class="tile-block__content__header text-<?php echo $textColor; ?>">
                            <?php echo $header; ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ( $paragraph ) : ?>
                        <div class="tile-block__content__subheader mb-5 text-xl-regular text-<?php echo $textColor; ?>">
                            <?php echo $paragraph; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $primary_cta ) : ?>
                        <a class="button button--<?php echo $call_to_action_color; ?><?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $primary_cta_label ); ?>">
                            <?php echo esc_html( $primary_link_title ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-12 col-lg-8 tile-block__content">
                <?php if( have_rows('tiles') ): ?>
                    <?php while( have_rows('tiles') ) : the_row(); ?>
                        <?php 
                        $header_color = get_sub_field('header_color');
                        $paragraph_color = get_sub_field('paragraph_color');
                        $button_color = get_sub_field('button_color');
                        $tile_background = get_sub_field('tile_background');
                        $tile_background_color = get_sub_field('tile_background_color');
                        $tile_background_gradient_start = get_sub_field('tile_background_gradient_start');
                        $tile_background_gradient_end = get_sub_field('tile_background_gradient_end');
                        $tile_background_gradient_angle = get_sub_field('tile_background_gradient_angle');
                        $tile_background_image = get_sub_field('tile_background_image');
                        $tile_background_video = get_sub_field('tile_background_video');
                        $tile_background_overlay_color = get_sub_field('tile_background_overlay_color');
                        $header = get_sub_field('header');
                        $paragraph = get_sub_field('paragraph');
                        $cta = get_sub_field('cta');
                        $cta_label = get_sub_field('cta_label');
                        if( $cta ): 
                            $cta_url = $cta['url'];
                            $cta_title = $cta['title'];
                            $cta_target = $cta['target'] ? $cta['target'] : '_self';
                        endif;
                        $anchorScroll = get_sub_field('anchor_scroll_on_cta');

                        if ($anchorScroll == 'anchor-scroll') {
                            $anchor_scroll = ' anchor-scroll';
                        } else {
                            $anchor_scroll = '';
                        }

                        if ($tile_background == 'solid') {
                            $tileBackgroundColor = $tile_background_color;
                            $tileBackgroundGradientStart = '';
                            $tileBackgroundGradientEnd = '';
                            $tileBackgroundGradientAngle = '';
                        } else {
                            $tileBackgroundColor = $tile_background_gradient_start;
                            $tileBackgroundGradientStart = $tile_background_gradient_start;
                            $tileBackgroundGradientEnd = $tile_background_gradient_end;
                            $tileBackgroundGradientAngle = $tile_background_gradient_angle;
                        }

                        if ($tile_background_overlay_color) {
                            $overlayColor = $tile_background_overlay_color;
                            $overlayGradientStart = '';
                            $overlayGradientEnd = '';
                            $overlayGradientAngle = '';
                        }

                        if ($header_color == 'blue') {
                            $headerColor = 'blue-ada';
                        } elseif ($header_color == 'white') {
                            $headerColor = 'white';
                        } else {
                            $headerColor = 'black';
                        }

                        if ($button_color == 'steel') {
                            $buttonColor = 'steel-underline';
                        } elseif ($button_color == 'white') {
                            $buttonColor = 'white-underline';
                        } elseif ($button_color == 'black') {
                            $buttonColor = 'black-underline';
                        }
                        ?>
                        <div class="col tile-block__content__col position-relative p-6 p-lg-4 d-flex flex-column justify-content-between"<?php if ($tile_background == 'solid' || $tile_background == 'gradient') : ?> style="background: <?php echo $tileBackgroundColor; ?>; background: linear-gradient(<?php echo $tileBackgroundGradientAngle; ?>deg,<?php echo $tileBackgroundGradientStart; ?>,<?php echo $tileBackgroundGradientEnd; ?>);"<?php endif; ?>>
                            <?php if ($tile_background == 'image') : ?>
                                <div class="tile-block__bg-img overlay object-fit-cover w-100 h-100">
                                    <?php if ( $tile_background_image ) : ?>
                                        <img src="<?php echo esc_url($tile_background_image['url']); ?>" alt="<?php echo esc_attr($tile_background_image['alt']); ?>" class="w-100 h-100"/>
                                    <?php endif; ?>
                                    <div class="tile-block__bg-img__overlay h-100 w-100 overlay"<?php if ($tile_background == 'image') : ?> style="background: <?php echo $overlayColor; ?>;"<?php endif; ?>></div>
                                </div>
                            <?php endif; ?>
                            <?php if ($tile_background == 'video') : ?>
                                <div class="tile-block__bg-video overlay w-100 h-100">
                                    <?php if ( $tile_background_video ) : ?>
                                        <video autoplay muted playsinline loop width="100%" height="100%">
                                            <source src="<?php echo $tile_background_video; ?>" type="video/mp4">
                                        </video>
                                    <?php endif; ?>
                                    <div class="tile-block__bg-video__overlay h-100 w-100 overlay"<?php if ($tile_background == 'video') : ?> style="background: <?php echo $overlayColor; ?>;"<?php endif; ?>></div>
                                </div>
                            <?php endif; ?>
                            <div>
                                <?php if ( $header ) : ?>
                                    <h3 class="mb-2 text-<?php echo $headerColor; ?>">
                                        <?php echo $header; ?>
                                    </h3>
                                <?php endif; ?>
                                <?php if ( $paragraph ) : ?>
                                    <p class="text-md-regular text-<?php echo $paragraph_color; ?>">
                                        <?php echo $paragraph; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if ( $cta ) : ?>
                                    <a class="button button--<?php echo $buttonColor; ?><?php echo $anchor_scroll; ?>" href="<?php echo esc_url( $cta_url ); ?>" target="<?php echo esc_attr( $cta_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $cta_label ); ?>">
                                        <?php echo esc_html( $cta_title ); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
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
