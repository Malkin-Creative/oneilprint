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

$id = 'newsletter-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$subheader = get_field('subheader');
$form_selector = get_field('form_selector');

?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="newsletter background-light-silver" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4 mb-md-0">
                <?php if ( $header ) : ?>
                    <div class="text-blue-ada text-xl-medium mb-0">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $subheader ) : ?>
                    <div class="text-md-regular text-black mb-0">
                        <?php echo $subheader; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-lg-9 newsletter__form">
                <?php if ( $form_selector ) :
                    gravity_form( $form_selector, false, false, false, '', true, 1 );
                endif; ?>
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
