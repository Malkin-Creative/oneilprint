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
  
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
<?php if (get_field('footer_code', 'options') ) : ?>
  <?php echo get_field('footer_code', 'options'); ?>
<?php endif; ?>
</body>

</html>
