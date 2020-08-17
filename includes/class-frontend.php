<?php
namespace Otomaties\WC_Variation_General_Thumbnail;

class Frontend {

	/**
	 * Add filters
	 */
	public function __construct() {
		add_filter( 'woocommerce_available_variation', array( $this, 'custom_variation_image' ), 10, 3 );
	}

	/**
	 * Change variation image
	 *
	 * @param array      $attr      ariation attributes.
	 * @param WC_Product $product   WC_Product object.
	 * @param WC_Product $variation WC_Product object (variation).
	 * @return array                 Updated variation attributes
	 */
	public function custom_variation_image( $attr, $product, $variation ) {

		// Get the variation image.
		$default_image = get_post_meta( $variation->get_ID(), '_thumbnail_id', true );

		// Only find the attribute image if no default image is set.
		if ( ! $default_image ) {
			$attributes = $variation->get_variation_attributes();
			foreach ( $attributes as $attribute_name => $value ) {
				$stripped_attribute = str_replace( 'attribute_', '', $attribute_name );
				$attribute_image = get_post_meta( $product->get_ID(), 'variation_image_' . $stripped_attribute . '_' . $value, true );
				if ( $attribute_image ) {
					$attr['image'] = wc_get_product_attachment_props( $attribute_image );
					break;
				}
			}
		}

		return $attr;

	}
}
new Frontend();