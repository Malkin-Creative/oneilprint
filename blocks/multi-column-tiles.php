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

$id = 'multi-col-tiles-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$margin_top = get_field('margin_top');
$margin_bottom = get_field('margin_bottom');
$margin_top_mobile = $margin_top / 2;
$margin_bottom_mobile = $margin_bottom / 2;
$stack_columns_in_2_rows = get_field('stack_columns_in_2_rows');
$background = get_field('background');
$background_color = get_field('background_color');
$background_gradient_start = get_field('background_gradient_start');
$background_gradient_end = get_field('background_gradient_end');
$background_gradient_angle = get_field('background_gradient_angle');
$background_image = get_field('background_image');
$background_video = get_field('background_video');
$background_overlay_color = get_field('background_overlay_color');
$cta_position = get_field('cta_position');
$cta_column = get_field('cta_column');
$primary_cta = get_field('call_to_action');
$call_to_action_color = get_field('call_to_action_color');
$primary_cta_label = get_field('call_to_action_label');
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

if ($cta_position == 'left') {
    $ctaPosition = ' px-0';
} else {
    $ctaPosition = ' d-flex justify-content-center align-items-center';
}

if ($call_to_action_color == 'blue') {
    $ctaColor = 'primary';
} elseif ($call_to_action_color == 'steel') {
    $ctaColor = 'secondary';
} else {
    $ctaColor = 'yellow';
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

if ($background_overlay_color) {
    $overlayColor = $background_overlay_color;
    $overlayGradientStart = '';
    $overlayGradientEnd = '';
    $overlayGradientAngle = '';
}

if ($stack_columns_in_2_rows == '1') {
    $stackColumns = ' stack-columns';
} else {
    $stackColumns = '';
}

if ($cta_column) {
    $ctaColumn = ' cta-column';
} else {
    $ctaColumn = '';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="multi-col-tiles position-relative" id="<?php echo esc_attr( $id ); ?>"<?php if ($background == 'solid' || $background == 'gradient') : ?> style="background: <?php echo $backgroundColor; ?>; background: linear-gradient(<?php echo $backgroundGradientAngle; ?>deg,<?php echo $backgroundGradientStart; ?>,<?php echo $backgroundGradientEnd; ?>);"<?php endif; ?>>
    <?php if ($background == 'image') : ?>
        <div class="multi-col-tiles__bg-img overlay object-fit-cover w-100 h-100">
            <?php if ( $background_image ) : ?>
                <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" class="w-100 h-100"/>
            <?php endif; ?>
            <div class="multi-col-tiles__bg-img__overlay h-100 w-100 overlay"<?php if ($background == 'image') : ?> style="background: <?php echo $overlayColor; ?>;"<?php endif; ?>></div>
        </div>
    <?php endif; ?>
    <?php if ($background == 'video') : ?>
        <div class="multi-col-tiles__bg-video overlay w-100 h-100">
            <?php if ( $background_video ) : ?>
                <video autoplay muted playsinline loop width="100%" height="100%" class="object-fit-cover">
                    <source src="<?php echo $background_video; ?>" type="video/mp4">
                </video>
            <?php endif; ?>
            <div class="multi-col-tiles__bg-video__overlay h-100 w-100 overlay"<?php if ($background == 'video') : ?> style="background: <?php echo $overlayColor; ?>;"<?php endif; ?>></div>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row justify-content-center multi-col-tiles__content<?php echo $stackColumns; echo $ctaColumn; ?>">
            <?php if( have_rows('columns') ): ?>
                <?php while( have_rows('columns') ) : the_row(); ?>
                    <?php 
                    $header_color = get_sub_field('header_color');
                    $paragraph_color = get_sub_field('paragraph_color');
                    $button_color = get_sub_field('button_color');
                    $tile_background = get_sub_field('tile_background');
                    $tile_background_color = get_sub_field('tile_background_color');
                    $tile_background_gradient_start = get_sub_field('tile_background_gradient_start');
                    $tile_background_gradient_end = get_sub_field('tile_background_gradient_end');
                    $tile_background_gradient_angle = get_sub_field('tile_background_gradient_angle');
                    $icon = get_sub_field('icon');
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

                    if ($header_color == 'blue') {
                        $headerColor = 'blue-ada';
                    } elseif ($header_color == 'white') {
                        $headerColor = 'white';
                    } else {
                        $headerColor = 'black';
                    }

                    if ($paragraph_color == 'light') {
                        $paragraphColor = 'steel';
                    } else {
                        $paragraphColor = 'black';
                    }

                    if ($button_color == 'steel') {
                        $buttonColor = 'steel-underline';
                    } elseif ($button_color == 'white') {
                        $buttonColor = 'white-underline';
                    } elseif ($button_color == 'black') {
                        $buttonColor = 'black-underline';
                    }
                    ?>
                    <div class="col multi-col-tiles__content__col position-relative p-6 p-lg-4 d-flex flex-column justify-content-between"<?php if ($tile_background == 'solid' || $tile_background == 'gradient') : ?> style="background: <?php echo $tileBackgroundColor; ?>; background: linear-gradient(<?php echo $tileBackgroundGradientAngle; ?>deg,<?php echo $tileBackgroundGradientStart; ?>,<?php echo $tileBackgroundGradientEnd; ?>);"<?php endif; ?>>
                        <div>
                            <?php if ( $icon ) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" class="mb-4 multi-col-tiles__content__col__icon"/>
                            <?php endif; ?>
                            <?php if ( $header ) : ?>
                                <h3 class="mb-2 text-<?php echo $headerColor; ?>">
                                    <?php echo $header; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ( $paragraph ) : ?>
                                <p class="text-md-regular text-<?php echo $paragraphColor; ?>">
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
        <?php if ( $primary_cta ) : ?>
            <div class="row">
                <div class="col-12 mt-6 mt-md-8 mt-lg-10 multi-col-tiles__content__wrap__buttons<?php echo $ctaPosition; ?>">
                    <a class="button button--<?php echo $ctaColor; ?><?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $primary_cta_label ); ?>">
                        <?php echo esc_html( $primary_link_title ); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if ( ! $is_preview ) : ?>
	</div>
<?php endif; ?>

<style type="text/css">
    #<?php echo esc_attr( $id ); ?> {
        padding-top: <?php echo esc_attr( $padding_top ); ?>px;
        padding-bottom: <?php echo esc_attr( $padding_bottom ); ?>px;
        margin-top: <?php echo esc_attr( $margin_top ); ?>px;
        margin-bottom: <?php echo esc_attr( $margin_bottom ); ?>px;
    }
	@media (max-width: 767px) {
		#<?php echo esc_attr( $id ); ?> {
            padding-top: <?php echo esc_attr( $padding_top_mobile ); ?>px;
            padding-bottom: <?php echo esc_attr( $padding_bottom_mobile ); ?>px;
            margin-top: <?php echo esc_attr( $margin_top_mobile ); ?>px;
            margin-bottom: <?php echo esc_attr( $margin_bottom_mobile ); ?>px;
        }
	}
</style>
