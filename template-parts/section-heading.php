<?php
/**
 * Section heading.
 *
 * Expected $args: id, title, action_url, action_label.
 *
 * @package Three_Columns
 */

$three_columns_id           = isset( $args['id'] ) ? sanitize_html_class( $args['id'] ) : '';
$three_columns_title        = isset( $args['title'] ) ? $args['title'] : '';
$three_columns_action_url   = isset( $args['action_url'] ) ? $args['action_url'] : '';
$three_columns_action_label = isset( $args['action_label'] ) ? $args['action_label'] : '';
?>
<div class="section-heading">
	<h2 class="section-title"<?php echo $three_columns_id ? ' id="' . esc_attr( $three_columns_id ) . '"' : ''; ?>><?php echo esc_html( $three_columns_title ); ?></h2>
	<?php if ( $three_columns_action_url && $three_columns_action_label ) : ?>
		<a class="section-action" href="<?php echo esc_url( $three_columns_action_url ); ?>"><?php echo esc_html( $three_columns_action_label ); ?></a>
	<?php endif; ?>
</div>
