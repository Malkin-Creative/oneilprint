<?php
/**
 * Standard Content block.
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

$id = 'standard-content-' . $block['id'];

$row_id = get_field('row_id');
$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$block_alignment = get_field('block_alignment');
$text_alignment = get_field('text_alignment');
$column_count = get_field('column_count');
$header_size = get_field('header_size');
$background_color = get_field('background_color');
$header = get_field('header');
$header_of_second_column = get_field('header_of_second_column');
$paragraph = get_field('paragraph');
$paragraph_of_second_column = get_field('paragraph_of_second_column');
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

if ($text_alignment == 'left') {
    $textAlignment = '';
} else {
    $textAlignment = ' text-center';
}

if ($block_alignment == 'left') {
    $blockAlignment = '';
} else {
    $blockAlignment = ' mx-auto';
}

if ($column_count == 'two' || $header_size == 'large') {
    $columnCount = ' col-md-12 col-lg-10';
} else {
    $columnCount = ' col-md-10 col-lg-8';
}

if ($header_size == 'small') {
    $headerSize = ' h2';
} else {
    $headerSize = ' oversized-h2';
}

if ($background_color == 'white') {
    $backgroundColor = ' background-white';
    $textColor = 'black';
    $buttonPrimary = 'primary';
    $buttonSecondary = 'secondary';
} elseif ($background_color == 'light-silver') {
    $backgroundColor = ' background-light-silver';
    $textColor = 'black';
    $buttonPrimary = 'primary';
    $buttonSecondary = 'secondary';
} elseif ($background_color == 'blue') {
    $backgroundColor = ' background-blue-ada';
    $textColor = 'white';
    $buttonPrimary = 'white';
    $buttonSecondary = 'white-border';
} elseif ($background_color == 'steel') {
    $backgroundColor = ' background-steel';
    $textColor = 'white';
    $buttonPrimary = 'white';
    $buttonSecondary = 'white-border';
} else {
    $backgroundColor = ' background-navy';
    $textColor = 'white';
    $buttonPrimary = 'white';
    $buttonSecondary = 'white-border';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="standard-content<?php echo $backgroundColor; ?>" id="<?php echo esc_attr( $id ); ?>">
    <div class="container" id="<?php echo $row_id; ?>">
        <div class="row">
            <div class="col-12 standard-content__wrap<?php echo $blockAlignment; echo $columnCount; ?>">
                <?php if ($column_count == 'one') : ?>
                    <?php if ($header) : ?>
                        <div class="mb-4 standard-content__wrap__header text-<?php echo $textColor; echo $textAlignment; echo $headerSize; ?>">
                            <?php echo $header; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($paragraph) : ?>
                        <div class="mb-0 text-<?php echo $textColor; echo $textAlignment; ?>">
                            <?php echo $paragraph; ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if ($header_of_second_column) : ?>
                        <div class="standard-content__wrap__columns">
                            <div>
                                <?php if ($header) : ?>
                                    <div class="mb-4 standard-content__wrap__header text-<?php echo $textColor; echo $textAlignment; echo $headerSize; ?>">
                                        <?php echo $header; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($paragraph) : ?>
                                    <div class="mb-0 text-<?php echo $textColor; echo $textAlignment; ?>">
                                        <?php echo $paragraph; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if ($header_of_second_column) : ?>
                                    <div class="mb-4 standard-content__wrap__header text-<?php echo $textColor; echo $textAlignment; echo $headerSize; ?>">
                                        <?php echo $header_of_second_column; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($paragraph_of_second_column) : ?>
                                    <div class="mb-0 text-<?php echo $textColor; echo $textAlignment; ?>">
                                        <?php echo $paragraph_of_second_column; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if ($header) : ?>
                            <div class="mb-4 standard-content__wrap__header text-<?php echo $textColor; echo $textAlignment; echo $headerSize; ?>">
                                <?php echo $header; ?>
                            </div>
                        <?php endif; ?>
                        <div class="standard-content__wrap__columns">
                            <?php if ($paragraph) : ?>
                                <div class="mb-0 text-<?php echo $textColor; echo $textAlignment; ?>">
                                    <?php echo $paragraph; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($paragraph_of_second_column) : ?>
                                <div class="mb-0 text-<?php echo $textColor; echo $textAlignment; ?>">
                                    <?php echo $paragraph_of_second_column; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ( $primary_cta || $secondary_cta ) : ?>
                    <div class="mt-6 d-flex justify-content-center align-items-center standard-content__wrap__buttons">
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
