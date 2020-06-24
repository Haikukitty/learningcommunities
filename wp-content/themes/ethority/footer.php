<?php
/**
 * Template for displaying the site footer.
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>

  <footer class="boxed-mini">
    <div class="copyright" style="margin-top:30px;">
      <p>
        <?php echo ot_get_option( 'eth_footer_text' ); ?>
      </p>
    </div>

    <div id="back-to-top" class="back-to-top">
      <a href="#"><i class="fa fa-chevron-up back-top"></i></a>
    </div>
  </footer>

</div> <!-- /.site-container -->

<?php wp_footer(); ?>
</body>
</html>