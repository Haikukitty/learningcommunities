<?php
/**
 * Template for displaying the search form.
 *
 * @package    Ethority
 * @since      1.2.0
 */
?>

<form action="<?php echo esc_url( home_url() ); ?>/" id="searchform" class="searchform">
  <input type="text" class="s" name="s" value="<?php the_search_query(); ?>" placeholder="<?php esc_attr( _e('Search the site..', 'eth-theme') ); ?>" />
  <button type="submit"><i class="fa fa-search"></i></button>
</form>