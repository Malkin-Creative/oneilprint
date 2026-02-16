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

$id = 'featured-post-grid-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$featured_team_members = get_field('featured_team_members');
$post_objects = $featured_team_members;
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="featured-post-grid position-relative" id="<?php echo esc_attr( $id ); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach( $post_objects as $post): 
                $postId = $post->ID;
                $permalink = get_permalink($postId);
                $title = get_the_title($postId);
                $thumbnail_id = get_post_thumbnail_id($postId);
                $featured_image_url = get_the_post_thumbnail_url($postId, 'full');
                $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                $job_title = get_field('job_title', $postId);
                $summary_of_bio = get_field('summary_of_bio', $postId);
                $full_bio = get_field('full_bio', $postId);
                $team_member_email = get_field('team_member_email', $postId);
                ?>
                <div class="col-12 col-md-6 col-lg-3 featured-post-grid__wrap position-relative pb-10 pb-md-8 pb-lg-0">
                    <?php if ($featured_image_url) : ?>
                        <div class="overlay object-fit-cover featured-post-grid__wrap__img">
                            <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100"/>
                        </div>
                    <?php endif; ?>
                    <?php if ($title) : ?>
                        <h3>
                            <?php echo $title; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($job_title) : ?>
                        <div class="text-md-regular text-black">
                            <?php echo $job_title; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($summary_of_bio) : ?>
                        <div class="text-md-regular mt-4 text-steel featured-post-grid__wrap__excerpt">
                            <?php echo $summary_of_bio; ?>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex align-items-center justify-content-between">
                        <a class="button button--blue-underline" href="<?php echo $permalink; ?>" aria-label="Open team member bio page">
                            Read bio
                        </a>
                        <?php if( have_rows('social_media', $postId) ): ?>
                            <div class="d-flex gap-2">
                                <?php while( have_rows('social_media', $postId) ) : the_row(); ?>
                                    <?php 
                                    $social_media_icon = get_sub_field('social_media_icon');
                                    $social_media_url = get_sub_field('social_media_url');
                                    $social_media_button_label = get_sub_field('social_media_button_label');
                                    ?>
                                    
                                    <?php if ( $social_media_url ) : ?>
                                        <a class="featured-post-grid__wrap__cta" href="<?php echo esc_attr( $social_media_url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $social_media_button_label ); ?>">
                                            <?php if ( $social_media_icon ) : ?>
                                                <img src="<?php echo esc_url($social_media_icon['url']); ?>" alt="<?php echo esc_attr($social_media_icon['alt']); ?>" />
                                            <?php endif; ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
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
