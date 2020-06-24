<?php
/**
 * Admin notice sticky
 *
 * @package wpengine/common-mu-plugin
 */

?>
<div class="wpe-notices updated wpe-notices-<?php echo esc_attr( $class ); ?>" title="<?php echo esc_attr( $id ); ?>">
	<p class="wpe-notices-<?php echo esc_attr( $class ); ?>">
		<strong><?php echo esc_attr( ucwords( $class ) ); ?>: </strong><?php esc_html_e( $message, 'wpengine' ); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText ?>
	</p>
</div>
