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

?>


<?php do_action( 'bootscore_before_footer' ); ?>

<footer id="footer" class="bootscore-footer">

  <!-- <?php if (is_active_sidebar('footer-top')) : ?>
    <div class="<?= apply_filters('bootscore/class/footer/top', 'border-bottom py-5'); ?> bootscore-footer-top">
      <div class="<?= apply_filters('bootscore/class/container', 'container', 'footer-top'); ?>">  
        <?php dynamic_sidebar('footer-top'); ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if (is_active_sidebar('footer-info')) : ?>
    <div class="<?= apply_filters('bootscore/class/footer/info', 'bg-body-tertiary text-body-secondary border-top py-2 text-center'); ?> bootscore-footer-info">
        <div class="<?= apply_filters('bootscore/class/container', 'container', 'footer-info'); ?>">
        
        <?php do_action( 'bootscore_footer_info_after_container_open' ); ?>
        
        <?php dynamic_sidebar('footer-info'); ?>
        </div>
    </div>
  <?php endif; ?> -->
</footer>

<!-- To top button -->
<a href="#" class="<?= apply_filters('bootscore/class/footer/to_top_button', 'btn button--primary shadow'); ?> position-fixed zi-1000 top-button" aria-label="<?php esc_attr_e('Return to top', 'bootscore' ); ?>"><?= apply_filters('bootscore/icon/chevron-up', '<i class="fa-solid fa-chevron-up"></i>'); ?><span class="visually-hidden-focusable">To top</span></a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
