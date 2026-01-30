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

$id = 'timeline-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="timeline container position-relative" id="<?php echo esc_attr( $id ); ?>">
    <div class="row justify-content-center timeline__row position-relative">
        <?php if( have_rows('columns') ): ?>
            <?php while( have_rows('columns') ) : the_row(); ?>
                <?php 
                $background_color = get_sub_field('background_color');
                $image_position = get_sub_field('image_position');
                $image = get_sub_field('image');
                $preheader = get_sub_field('preheader');
                $header = get_sub_field('header');
                $paragraph = get_sub_field('paragraph');

                if ($image_position == 'left') {
                    $imagePosition = ' left';
                } else {
                    $imagePosition = ' right';
                }
                ?>
                <div class="col-12 p-0 timeline__row__col position-relative background-<?php echo $background_color; echo $imagePosition; ?>">
                    <div class="timeline__row__col__content p-6">
                        <?php if ( $preheader ) : ?>
                            <h3 class="mb-4 text-blue-ada">
                                <?php echo $preheader; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $header ) : ?>
                            <h2 class="mb-4 text-black oversized-h3">
                                <?php echo $header; ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ( $paragraph ) : ?>
                            <p class="text-md-regular text-black mb-0">
                                <?php echo $paragraph; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php if ( $image ) : ?>
                        <div class="timeline__row__col__image overlay object-fit-cover">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-100 h-100"/>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
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
    }
	@media (max-width: 767px) {
		#<?php echo esc_attr( $id ); ?> {
            padding-top: <?php echo esc_attr( $padding_top_mobile ); ?>px;
            padding-bottom: <?php echo esc_attr( $padding_bottom_mobile ); ?>px;
        }
	}
</style>
