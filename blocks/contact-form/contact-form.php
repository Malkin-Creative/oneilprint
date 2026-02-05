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

$id = 'standard-form-' . $block['id'];

$padding_top = get_field('padding_top');
$padding_bottom = get_field('padding_bottom');
$padding_top_mobile = $padding_top / 2;
$padding_bottom_mobile = $padding_bottom / 2;
$form_selector = get_field('form_selector');
$office_icon = get_field('office_icon', 'options');
$office_intro_text = get_field('office_intro_text', 'options');
$office_address = get_field('office_address', 'options');
$phone_icon = get_field('phone_icon', 'options');
$phone_intro_text = get_field('phone_intro_text', 'options');
$phone_number = get_field('phone_number', 'options');
$fax_icon = get_field('fax_icon', 'options');
$fax_intro_text = get_field('fax_intro_text', 'options');
$fax_number = get_field('fax_number', 'options');

if ( $phone_number ) {
    $tel = preg_replace('/[^\d+]/', '', $phone_number);
    $formatted_phone = format_phone_number($phone_number);
}

if ( $fax_number ) {
    $fax = preg_replace('/[^\d+]/', '', $fax_number);
    $formatted_fax = format_fax_number($fax_number);
}

if ( $office_address ) {
    // Encode address for use in URL
    $encoded_address = urlencode($office_address);
    $google_maps_url = 'https://www.google.com/maps?q=' . $encoded_address;
}

?>

<?php if ( ! $is_preview ) : ?>
	<div
		id="<?php echo esc_attr( $block_id ); ?>"
		<?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>
	>
<?php endif; ?>

<section class="contact-form container" id="<?php echo esc_attr( $id ); ?>">
    <div class="row">
        <div class="col-12 col-md-7 col-lg-9 mb-8 mb-md-0">
            <div class="p-6 p-md-8 contact-form__form background-lightest-silver h-100">
                <?php if ( $form_selector ) :
                    gravity_form( $form_selector, false, false, false, '', true, 1 );
                endif; ?>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-3 pb-4 pb-md-0 px-md-6 px-lg-8">
            <div class="row contact-form__office mb-10">
                <div class="col-12">
                    <?php if ( $office_icon ) : ?>
                        <img src="<?php echo esc_url($office_icon['url']); ?>" alt="<?php echo esc_attr($office_icon['alt']); ?>" class="contact-form__office__icon mb-3" role="img" aria-hidden="true"/>
                    <?php endif; ?>
                    <h2 class="h3 text-blue-ada mb-1">
                        Office
                    </h2>
                    <?php if ( $office_intro_text ) : ?>
                        <p class="text-steel">
                            <?php echo $office_intro_text; ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( $office_address ) : ?>
                        <a href="<?php echo $google_maps_url; ?>" target="_blank" rel="noopener noreferrer" class="map-button text-black" role="button" aria-label="Open directions to <?php echo $office_address; ?> on Google Maps">
                            <?php echo $office_address; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row contact-form__phone mb-10">
                <div class="col-12">
                    <?php if ( $phone_icon ) : ?>
                        <img src="<?php echo esc_url($phone_icon['url']); ?>" alt="<?php echo esc_attr($phone_icon['alt']); ?>" class="contact-form__office__icon mb-3" role="img" aria-hidden="true"/>
                    <?php endif; ?>
                    <h2 class="h3 text-blue-ada mb-1">
                        Phone
                    </h2>
                    <?php if ( $phone_intro_text ) : ?>
                        <p class="text-steel">
                            <?php echo $phone_intro_text; ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( $phone_number ) : ?>
                        <a href="<?php echo $tel; ?>" class="text-black" role="button" aria-label="Call us at <?php echo $phone_number; ?>">
                            <?php echo esc_html($formatted_phone); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row contact-form__fax mb-10">
                <div class="col-12">
                    <?php if ( $fax_icon ) : ?>
                        <img src="<?php echo esc_url($fax_icon['url']); ?>" alt="<?php echo esc_attr($fax_icon['alt']); ?>" class="contact-form__office__icon mb-3" role="img" aria-hidden="true"/>
                    <?php endif; ?>
                    <h2 class="h3 text-blue-ada mb-1">
                        Fax
                    </h2>
                    <?php if ( $fax_intro_text ) : ?>
                        <p class="text-steel">
                            <?php echo $fax_intro_text; ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( $fax_number ) : ?>
                        <a href="<?php echo $fax; ?>" class="text-black" role="button" aria-label="Send fax to <?php echo $fax_number; ?>">
                            <?php echo esc_html($formatted_fax); ?>
                        </a>
                    <?php endif; ?>
                </div>
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
