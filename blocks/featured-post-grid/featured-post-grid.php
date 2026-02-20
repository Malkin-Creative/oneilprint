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

$row_id = get_field('row_id');
$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$header = get_field('header');
$subheader = get_field('subheader');
$block_alignment = get_field('block_alignment');
$header_color = get_field('header_color');
$text_and_button_color = get_field('text_and_button_color');
$featured_post_selections = get_field('featured_post_selections');
$post_type_selection = get_field('post_type');
$post_type_object_selection = get_post_type_object($post_type_selection);
$call_to_action = get_field('call_to_action');
$call_to_action_label = get_field('call_to_action_label');
if( $call_to_action ): 
    $link_url = $call_to_action['url'];
    $link_title = $call_to_action['title'];
    $link_target = $call_to_action['target'] ? $call_to_action['target'] : '_self';
endif;
$anchor_scroll_on_cta = get_field('anchor_scroll_on_cta');

if ($anchor_scroll_on_cta == 'anchor-scroll') {
    $anchor_scroll_primary = ' anchor-scroll';
} else {
    $anchor_scroll_primary = '';
}

if ($block_alignment == 'left') {
    $textPosition = '';
    $buttonPosition = '';
} else {
    $textPosition = ' text-center';
    $buttonPosition = ' d-flex justify-content-center';
}
?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="featured-post-grid position-relative" id="<?php echo esc_attr( $id ); ?>">
    <div class="container" id="<?php echo $row_id; ?>">
        <div class="row">
            <div class="col-12 mb-6 mb-md-8 mb-lg-10">
                <?php if ($header) : ?>
                    <div class="featured-post-grid__header oversized-h2 mb-4<?php echo $textPosition; ?>">
                        <?php echo $header; ?>
                    </div>
                <?php endif; ?>
                <?php if ($subheader) : ?>
                    <div class="h4 font-tertiary text-steel<?php echo $textPosition; ?>">
                        <?php echo $subheader; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($featured_post_selections) : ?>
            <div class="row">
                <?php foreach( $featured_post_selections as $post): 
                    $postId = $post->ID;
                    $post_type = get_post_type($postId);
                    $post_type_object = get_post_type_object($post_type);
                    $permalink = get_permalink($postId);
                    $title = get_the_title($postId);
                    $summary_excerpt = get_field('summary_excerpt', $postId);
                    $excerpt = get_the_excerpt($postId);
                    $thumbnail_id = get_post_thumbnail_id($postId);
                    $featured_image_url = get_the_post_thumbnail_url($postId, 'full');
                    $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                    $categories = get_the_category($postId);
                    $industries = get_the_terms( $postId, 'industries' );
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 featured-post-grid__wrap position-relative pb-10 pb-md-8">
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
                        <?php if ($categories) : ?>
                            <?php $lastCat = end($categories); ?>
                            <p class="text-sm-bold mt-2 text-blue-ada font-tertiary">
                                <?php foreach( $categories as $category): ?>
                                    <?php echo esc_html( $category->name );
                                        if ($category !== $lastCat) {
                                            echo ', ';
                                        }
                                    ?>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                        <?php if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
                            <?php $lastInd = end($industries); ?>
                            <p class="text-sm-bold mt-2 text-blue-ada font-tertiary">
                                <?php foreach( $industries as $industry): ?>
                                    <?php echo esc_html( $industry->name );
                                        if ($industry !== $lastInd) {
                                            echo ', ';
                                        }
                                    ?>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($summary_excerpt) : ?>
                            <div class="text-md-regular my-4 text-black font-tertiary featured-post-grid__wrap__excerpt">
                                <?php echo $summary_excerpt; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($excerpt) : ?>
                            <p class="text-md-regular my-4 text-black font-tertiary featured-post-grid__wrap__excerpt">
                                <?php echo $excerpt; ?>
                            </p>
                        <?php endif; ?>
                        <a class="button button--steel-underline" href="<?php echo $permalink; ?>" aria-label="Open post">
                            Read <?php echo esc_html($post_type_object->labels->singular_name); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <?php 
            $args = array(
                'post_type'      => $post_type_selection, 
                'posts_per_page' => 3,
                'post__not_in'   => array( get_the_ID() ), 
                'orderby'        => 'date',
                'order'          => 'DESC'
            );
            $related_query = new WP_Query( $args );

            if ($related_query->have_posts()) : ?>
                <div class="row">
                    <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                        $permalink = get_permalink(get_the_ID());
                        $title = get_the_title(get_the_ID());
                        $summary_excerpt = get_field('summary_excerpt', get_the_ID());
                        $excerpt = get_the_excerpt(get_the_ID());
                        $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                        $featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                        $categories = get_the_category(get_the_ID());
                        $industries = get_the_terms( get_the_ID(), 'industries' );
                        ?>
                        <div class="col-12 col-md-6 col-lg-4 featured-post-grid__wrap position-relative pb-10 pb-md-8 pb-lg-0">
                            <div class="overlay object-fit-cover featured-post-grid__wrap__img">
                                <?php if ($featured_image_url) : ?>
                                    <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100"/>
                                <?php else : ?>
                                    <img src="/wp-content/uploads/2026/01/default-social-sharing-image.jpeg" alt="Post Placeholder Image" class="w-100"/>
                                <?php endif; ?>
                            </div>
                            <?php if ($title) : ?>
                                <h3>
                                    <?php echo $title; ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($categories) : ?>
                                <?php $lastCat = end($categories); ?>
                                <p class="text-sm-bold mt-2 text-blue-ada font-tertiary">
                                    <?php foreach( $categories as $category): ?>
                                        <?php echo esc_html( $category->name );
                                            if ($category !== $lastCat) {
                                                echo ', ';
                                            }
                                        ?>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>
                            <?php if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
                                <?php $lastInd = end($industries); ?>
                                <p class="text-sm-bold mt-2 text-blue-ada font-tertiary">
                                    <?php foreach( $industries as $industry): ?>
                                        <?php echo esc_html( $industry->name );
                                            if ($industry !== $lastInd) {
                                                echo ', ';
                                            }
                                        ?>
                                    <?php endforeach; ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($summary_excerpt) : ?>
                                <div class="text-md-regular my-4 text-black font-tertiary featured-post-grid__wrap__excerpt">
                                    <?php echo $summary_excerpt; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($excerpt) : ?>
                                <div class="text-md-regular my-4 text-black font-tertiary featured-post-grid__wrap__excerpt">
                                    <?php echo $excerpt; ?>
                                </div>
                            <?php endif; ?>
                            <a class="button button--steel-underline" href="<?php echo $permalink; ?>" aria-label="Open post">
                                Read <?php if ($post_type_selection) : echo esc_html($post_type_object_selection->labels->singular_name); else : ?>Post<?php endif; ?>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 mt-lg-10<?php echo $buttonPosition; ?>">
                <?php if ( $call_to_action ) : ?>
                    <a class="button button--primary<?php echo $anchor_scroll_primary; ?>" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" rel="noopener" aria-label="<?php echo esc_attr( $call_to_action_label ); ?>">
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
