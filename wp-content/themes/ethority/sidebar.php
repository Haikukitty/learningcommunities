<?php
/**
 * Template for displaying the sidebar.
 *
 * @package Ethority
 * @since   1.2.0
 */
?>

<?php if ( is_active_sidebar( 'eth-content-sidebar' ) ) : ?>

  <?php dynamic_sidebar( 'eth-content-sidebar' ); ?>

<?php endif; ?>