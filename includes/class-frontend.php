<?php
namespace Otomaties\WC_Variation_General_Thumbnail;

class Frontend {

	/**
	 * Add filters
	 */
	public function __construct() {
		add_filter( 'woocommerce_available_variation', array( $this, 'custom_variation_image' ), 10, 3 );
		add_filter( 'woocommerce_product_get_image', array( $this, 'custom_product_image' ), 10, 5 );
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
			$attribute_image = $this->find_image( $variation );
			if( $attribute_image ) {
				$attr['image'] = wc_get_product_attachment_props( $attribute_image );
			}
		}

		return $attr;

	}

	public function custom_product_image($image, $product, $size, $attr, $placeholder) {
		if ( $product->is_type( 'variation' ) ) {
			$attribute_image = $this->find_image( $product );
			if( $attribute_image ) {
				return wp_get_attachment_image( $attribute_image, $size );
			}
		}
		return $image;
	}


	public function find_image( $variation ) {
		$image = false;
		$product_id = $variation->get_parent_id();
		$attributes = $variation->get_variation_attributes();

		foreach ( $attributes as $attribute_name => $value ) {
			$stripped_attribute = str_replace( 'attribute_', '', $attribute_name );
			$attribute_image = get_post_meta( $product_id, 'variation_image_' . $stripped_attribute . '_' . $value, true );
			if ( $attribute_image ) {
				$image = $attribute_image;
				break;
			}
		}
		
		return $image;
	}
}
new Frontend();