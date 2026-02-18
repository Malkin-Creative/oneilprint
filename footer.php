<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 * @version 6.1.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

// Variables
$footer_logo = get_field('footer_logo', 'options');
$office_address = get_field('office_address', 'options');
$phone_number = get_field('phone_number', 'options');
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


<?php do_action( 'bootscore_before_footer' ); ?>

<footer id="footer" class="footer position-relative">
  <div class="container py-10 py-md-13 position-relative">
    <div class="row">
      <div class="col-12 col-md-4 col-lg-3 d-flex flex-md-column">
        <?php if ( $footer_logo ) : ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer__logo--buton mb-10">
            <img src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt']); ?>" class="footer__logo__img"/>
          </a>
        <?php endif; ?>
        <?php if ( $office_address ) : ?>
          <a href="<?php echo $google_maps_url; ?>" target="_blank" rel="noopener noreferrer" class="map-button text-white mb-4" role="button" aria-label="Open directions to <?php echo $office_address; ?> on Google Maps">
            <?php echo $office_address; ?>
          </a>
        <?php endif; ?>
        <div class="d-flex gap-1 mb-2">
          <p class="text-blue-ada text-xs-bold">
            O
          </p>
          <?php if ( $phone_number ) : ?>
            <a href="<?php echo $tel; ?>" class="text-white" role="button" aria-label="Call us at <?php echo $phone_number; ?>">
              <?php echo esc_html($formatted_phone); ?>
            </a>
          <?php endif; ?>
        </div>
        <div class="d-flex gap-1">
          <p class="text-blue-ada text-xs-bold">
            F
          </p>
          <?php if ( $fax_number ) : ?>
            <a href="<?php echo $fax; ?>" class="text-white" role="button" aria-label="Send fax to <?php echo $fax_number; ?>">
              <?php echo esc_html($formatted_fax); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="col-12 col-md-8 col-lg-9">
        <div class="row">
          <div class="col-12 col-lg-9">
            <div class="row">
              <div class="col-6 col-lg-3">
                <p class="text-yellow text-sm-regular font-secondary mb-8">
                  Solutions
                </p>
                <?php // Primary Menu
                  wp_nav_menu( array(
                    'theme_location' => 'footer-solutions-menu',
                    'container'      => false, // disables default wrapping
                  ));
                ?>
              </div>
              <div class="col-6 col-lg-3">
                <p class="text-yellow text-sm-regular font-secondary mb-8">
                  About
                </p>
                <?php // Primary Menu
                  wp_nav_menu( array(
                    'theme_location' => 'footer-about-menu',
                    'container'      => false, // disables default wrapping
                  ));
                ?>
              </div>
              <div class="col-6 col-lg-3">
                <p class="text-yellow text-sm-regular font-secondary mb-8">
                  Resources
                </p>
                <?php // Primary Menu
                  wp_nav_menu( array(
                    'theme_location' => 'footer-resources-menu',
                    'container'      => false, // disables default wrapping
                  ));
                ?>
              </div>
              <div class="col-6 col-lg-3">
                <p class="text-yellow text-sm-regular font-secondary mb-8">
                  Our Companies
                </p>
                <?php // Primary Menu
                  wp_nav_menu( array(
                    'theme_location' => 'footer-companies-menu',
                    'container'      => false, // disables default wrapping
                  ));
                ?>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3">
            <p class="text-yellow text-sm-regular font-secondary mb-6">
              Follow Us
            </p>
            <?php if( have_rows('socials', 'options') ): ?>
              <div class="d-flex gap-3">
                <?php while( have_rows('socials', 'options') ) : the_row(); ?>
                  <?php 
                  $social_media_image = get_sub_field('social_media_image');
                  $social_media_url = get_sub_field('social_media_url');
                  $social_media_button_label = get_sub_field('social_media_button_label');
                  ?>
                  
                  <?php if ( $social_media_url ) : ?>
                    <a class="footer__socials" href="<?php echo esc_attr( $social_media_url ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $social_media_button_label ); ?>">
                      <?php if ( $social_media_image ) : ?>
                        <img src="<?php echo esc_url($social_media_image['url']); ?>" alt="<?php echo esc_attr($social_media_image['alt']); ?>" />
                      <?php endif; ?>
                    </a>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <p class="text-yellow text-sm-regular font-secondary mb-6">
              Affiliations
            </p>
            <?php if( have_rows('affiliations', 'options') ): ?>
              <div class="d-flex gap-3 align-items-center">
                <?php while( have_rows('affiliations', 'options') ) : the_row(); ?>
                  <?php 
                  $affiliation_image = get_sub_field('affiliation_image');
                  $image_caption = get_sub_field('image_caption');
                  ?>
                  
                  <?php if ( $affiliation_image ) : ?>
                    <img src="<?php echo esc_url($affiliation_image['url']); ?>" alt="<?php echo esc_attr($affiliation_image['alt']); ?>" />
                  <?php endif; ?>
                  <?php if ( $image_caption ) : ?>
                    <p class="text-xs-regular mb-0">
                      <?php echo $image_caption; ?>
                    </p>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 footer__bottom position-relative">
    <div class="container position-relative">
      <div class="row align-items-center">
        <div class="col-12 col-md-4">
          <p class="text-blue text-xs-regular">
            © <?php echo date('Y'); ?> O'Neil Printing. All rights reserved.
          </p>
        </div>
        <div class="col-12 col-md-4">
          iubenda
        </div>
        <div class="col-12 col-md-4 d-flex gap-1 align-items-center justify-content-end">
          <a class="text-blue text-xs-regular" href="https://www.rule29.com/" target="_blank" rel="noopener noreferrer" aria-label="Open Rule29 website">
            Design by Rule29
          </a>|
          <a class="text-blue text-xs-regular" href="https://malkinmade.com/" target="_blank" rel="noopener noreferrer" aria-label="Open Malkin Made website">
            Development by Malkin Made
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
<?php if (get_field('footer_code', 'options') ) : ?>
  <?php echo get_field('footer_code', 'options'); ?>
<?php endif; ?>
</body>

</html>
