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

$id = 'logo-block-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="logo-block" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($header) : ?>
                    <div class="h2 mb-8 mb-md-14 text-steel text-center">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row justify-content-center align-items-center logo-block__row">
            <?php if( have_rows('logos') ): ?>
                <?php while( have_rows('logos') ) : the_row(); ?>
                    <?php $logo = get_sub_field('logo');
                    $logo_link = get_sub_field('logo_link');
                    $logo_link_label = get_sub_field('logo_link_label'); ?>
                    <div class="col-2 text-center">
                        <?php if ( $logo ) : ?>
                            <?php if ( $logo_link ) : ?>
                                <a class="logo-block__row__icon p-1 object-fit-contain d-flex h-100 justify-content-center" href="<?php echo $logo_link; ?>" aria-label="<?php echo esc_attr( $logo_link_label ); ?>">
                            <?php else : ?>
                                <div class="logo-block__row__icon p-1 object-fit-contain d-flex h-100 justify-content-center">
                            <?php endif; ?>
                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" class=""/>
                            <?php if ( $logo_link ) : ?>
                                </a>
                            <?php else : ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
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
