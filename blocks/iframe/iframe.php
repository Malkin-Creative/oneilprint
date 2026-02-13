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

$id = 'iframe-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$subheader = get_field('subheader');
$iframe_embed = get_field('iframe_embed');
$paragraph = get_field('paragraph');
$block_alignment = get_field('block_alignment');
$link = get_field('link');
$link_label = get_field('link_label');
if( $link ): 
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
endif;
$link_anchor_scroll = get_field('anchor_scroll_on_cta');

if ($link_anchor_scroll == 'anchor-scroll') {
    $anchor_scroll_primary = ' anchor-scroll';
} else {
    $anchor_scroll_primary = '';
}

if ($block_alignment == 'left') {
    $textPosition = '';
    $buttonPosition = '';
} else {
    $textPosition = ' text-center';
    $buttonPosition = ' justify-content-center';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="iframe" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-column">
                <?php if ($header) : ?>
                    <div class="h2 mb-2 mb-md-3 text-black<?php echo $textPosition; ?>">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ($subheader) : ?>
                    <div class="mb-5 text-lg-regular text-black<?php echo $textPosition; ?>">
                        <?php echo $subheader; ?>
                    </div>
                <?php endif; ?>
                <?php if ($iframe_embed) : ?>
                    <div class="mb-5">
                        <?php echo $iframe_embed; ?>
                    </div>
                <?php endif; ?>
                <?php if ($paragraph) : ?>
                    <div class="mb-5 text-md-regular text-steel<?php echo $textPosition; ?>">
                        <?php echo $paragraph; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $link ) : ?>
                    <div class="d-flex<?php echo $buttonPosition; ?>">
                        <a class="button button--primary<?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $link_label ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>
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
