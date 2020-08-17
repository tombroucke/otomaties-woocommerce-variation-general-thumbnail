<?php
/**
 * Linked product options.
 *
 * @package WooCommerce/admin
 */

defined( 'ABSPATH' ) || exit;
?>

<div id="variation_images" class="panel woocommerce_options_panel hidden">
	<div class="options_group show_if_variable">
		<div class="options_group">
			<?php $product_variation_attributes = $product_object->get_variation_attributes(); ?>
			<?php if ( $product_object->is_type( 'variable' ) && $product_variation_attributes ) : ?>
				<?php foreach ( $product_variation_attributes as $attribute_name => $product_terms ) : ?>
					<table class="widefat striped table-attribute-thumbnails">
						<thead>
							<tr>
								<th colspan="2"><strong><?php echo wc_attribute_label( $attribute_name ); ?></strong></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $product_terms as $product_term ) : ?>
								<tr>
									<th>
										<?php echo esc_html( ucfirst( $product_term ) ); ?>
									</th>
									<td>
										<?php
										$image_id = get_post_meta( $thepostid, 'variation_image_' . $attribute_name . '_' . $product_term, true );
										$thumbnail = wp_get_attachment_image( $image_id, 'thumbnail' );
										if ( $thumbnail ) {
											printf( '<a href="#" class="btn-media-upload">%s</a><br /><a href="#" class="btn-media-remove">%s</a>', $thumbnail, __( 'Remove image', 'wc-variation-general-thumbnail' ) );
										} else {
											printf( '<a href="#" class="btn-media-upload">Upload image</a><a href="#" class="btn-media-remove" style="display:none">%s</a>', __( 'Remove image', 'wc-variation-general-thumbnail' ) );
										}
										?>
										<input type="hidden" name="variation_images[<?php echo esc_html( $attribute_name ); ?>][<?php echo esc_html( $product_term ); ?>]" value="<?php echo esc_html( get_post_meta( $thepostid, 'variation_image_' . $attribute_name . '_' . $product_term, true ) ); ?>">
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endforeach; ?>
				<?php wp_nonce_field( 'variation_images_' . $product_object->get_ID(), 'save_variation_images' ); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
