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

$id = 'hero-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$background_video = get_field('background_video');
$background_image = get_field('background_image');
$header = get_field('header');
$subheader = get_field('subheader');
$primary_cta = get_field('primary_cta');
$primary_cta_label = get_field('primary_cta_label');
if( $primary_cta ): 
    $link_url = $primary_cta['url'];
    $link_title = $primary_cta['title'];
    $link_target = $primary_cta['target'] ? $primary_cta['target'] : '_self';
endif;
$anchorScrollPrimary = get_field('anchor_scroll_on_primary_cta');

if ($anchorScrollPrimary == 'anchor-scroll') {
    $anchor_scroll_primary = ' anchor-scroll';
} else {
    $anchor_scroll_primary = '';
} ?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="hero--home position-relative" id="<?php echo esc_attr( $id ); ?>">
    <div class="overlay object-fit-cover hero--home__bg-image">
        <?php if ( $background_image ) : ?>
            <img class="no-lazyload" src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
        <?php endif; ?>
        <?php if ( $background_video ) : ?>
            <video autoplay muted loop playsinline aria-hidden="true">
                <source src="<?php echo $background_video; ?>" type="video/mp4">
            </video>
        <?php endif; ?>
    </div>
    <div class="container hero--home__container">
        <div class="row">
            <div class="col-11 mx-auto col-md-12 text-center">
                <?php if ( $header ) : ?>
                    <div class="hero--home__header text-center h1-large">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $subheader ) : ?>
                    <p class="hero--home__subheader text-center mb-10">
                        <?php echo $subheader; ?>
                    </p>
                <?php endif; ?>
                <?php if ( $primary_cta ) : ?>
                    <a class="hero--home__button button button--secondary<?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $primary_cta_label ); ?>">
                        <?php echo esc_html( $link_title ); ?>
                    </a>
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
