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

$id = 'hero-video-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$subheader = get_field('subheader');
$paragraph = get_field('paragraph');
$video = get_field('video');
$cover_image = get_field('cover_image');
$video_title = get_field('video_title');
$video_time_length = get_field('video_time_length');
$video_transcript = get_field('video_transcript');
$primary_cta = get_field('primary_cta');
$primary_cta_label = get_field('primary_cta_label');
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
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="hero-video" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-7 col-lg-6 mb-10 mb-md-0">
                <?php if ($header) : ?>
                    <div class="mb-2 h1 text-black hero-video__header">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ($subheader) : ?>
                    <div class="h3 text-steel mb-0">
                        <?php echo $subheader; ?>
                    </div>
                <?php endif; ?>
                <?php if ($paragraph) : ?>
                    <div class="text-black text-xl-regular mt-4 mt-md-5">
                        <?php echo $paragraph; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $primary_cta || $secondary_cta ) : ?>
                    <div class="mt-4 mt-md-5 d-flex hero-video__buttons">
                        <?php if ( $primary_cta ) : ?>
                            <a class="button button--primary<?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $primary_link_url ); ?>" target="<?php echo esc_attr( $primary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $primary_cta_label ); ?>">
                                <?php echo esc_html( $primary_link_title ); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ( $secondary_cta ) : ?>
                            <a class="button button--secondary<?php echo $anchor_scroll_secondary; ?>" href="<?php echo esc_url( $secondary_link_url ); ?>" target="<?php echo esc_attr( $secondary_link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $secondary_cta_label ); ?>">
                                <?php echo esc_html( $secondary_link_title ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-5 col-lg-6 hero-video__wrap">
                <?php if ( $video ) : ?>
                    <div class="hero-video__wrap__thumb object-fit-cover mb-2 position-relative">
                        <img src="<?php echo esc_url($cover_image['url']); ?>" alt="<?php echo esc_attr($cover_image['alt']); ?>" class="w-100 h-100"/>
                        <button class="hero-video__wrap__thumb__play-btn h-100 w-100 overlay" data-video-id="AZLVquJsZ-0" aria-haspopup="dialog" aria-controls="videoModal" aria-label="Play video: Watch our story">
                        </button>
                    </div>
                <?php endif; ?>
                <div class="d-flex hero-video__wrap__details">
                    <?php if ($video_title || $video_time_length) : ?>
                        <div class="d-flex align-items-center">
                            <p class="text-black text-sm-bold mb-0">
                                <?php echo $video_title; ?>&nbsp;&nbsp;
                            </p>
                            <p class="text-black text-sm-regular mb-0">
                                |  <?php echo $video_time_length; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                    <?php if ( $video_transcript ) : ?>
                        <a class="button button--black-underline" href="<?php echo $video_transcript; ?>" target="_blank" rel="noopener" aria-label="Open video transcript">
                            View Transcript
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="video-modal" id="videoModal" role="dialog" aria-modal="true" aria-labelledby="videoModalTitle">
  <div class="video-modal-inner" role="document">
    <button class="close-modal" aria-label="Close video">
      ✕
    </button>
    <div class="video-frame h-100"></div>
  </div>
</div>

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
