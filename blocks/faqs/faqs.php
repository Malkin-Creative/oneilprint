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

$id = 'faqs-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$background_color = get_field('background_color');

if ($background_color == 'white') {
    $questionColor = 'blue-ada';
    $answerColor = 'black';
    $backgroundColor = 'white';
    $headerColor = 'black';
    $borderColor = ' silver';
} else {
    $questionColor = 'white';
    $answerColor = 'silver';
    $backgroundColor = 'navy';
    $headerColor = 'white';
    $borderColor = ' blue';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="faqs background-<?php echo $backgroundColor; ?>" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ( $header ) : ?>
                    <div class="faqs__header oversized-h2 mb-6 mb-md-8 mb-lg-10 text-<?php echo $headerColor; ?>">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if( have_rows('faqs') ): ?>
            <?php while( have_rows('faqs') ): the_row(); 
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
                ?>
                <?php if ( $question && $answer ) : ?>
                    <div class="row py-5 mb-5 mb-md-8 mb-lg-10 faqs__wrap<?php echo $borderColor; ?>">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="h3 text-<?php echo $questionColor; ?>">
                                <?php echo $header; ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-8 pl-md-6 pl-lg-18">
                            <div class="text-lg-regular text-<?php echo $answerColor; ?>">
                                <?php echo $answer; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
