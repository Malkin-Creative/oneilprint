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

$id = 'stats-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$background_color = get_field('background_color');

if ($background_color == 'white') {
    $backgroundColor = ' background-light-silver p-6';
    $headerColor = ' text-blue-ada';
    $textColor = ' text-black';
} else {
    $backgroundColor = '';
    $headerColor = ' text-blue';
    $textColor = ' text-white';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="stats background-<?php echo $background_color; ?>" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row justify-content-center stats__row">
            <?php if( have_rows('stat_blocks') ): ?>
                <?php while( have_rows('stat_blocks') ) : the_row(); ?>
                    <?php 
                    $number_character_before = get_sub_field('number_character_before');
                    $number = get_sub_field('number');
                    $number_character_after = get_sub_field('number_character_after');
                    $subheader = get_sub_field('subheader');
                    $paragraph = get_sub_field('paragraph');
                    ?>
                    <div class="col stats__row__col<?php echo $backgroundColor; ?>">
                        <?php if ( $number_character_before || $number || $number_character_after ) : ?>
                            <h3 class="mb-2 oversized-h3<?php echo $headerColor; ?>">
                                <?php echo $number_character_before; ?><?php echo $number; ?><?php echo $number_character_after; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $subheader ) : ?>
                            <h3 class="mb-2<?php echo $headerColor; ?>">
                                <?php echo $subheader; ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $paragraph ) : ?>
                            <p class="text-md-regular<?php echo $textColor; ?>">
                                <?php echo $paragraph; ?>
                            </p>
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
