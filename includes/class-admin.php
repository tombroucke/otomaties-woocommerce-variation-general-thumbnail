<?php
namespace Otomaties\WC_Variation_General_Thumbnail;

class Admin {

	/**
	 * Add hooks & filters
	 */
	public function __construct() {
		add_filter( 'woocommerce_product_data_tabs', array( $this, 'variation_images_tab' ) );
		add_action( 'woocommerce_product_data_panels', array( $this, 'variation_images_panel' ) );
		add_action( 'woocommerce_process_product_meta_variable', array( $this, 'save_variation_images' ) );
	}

	/**
	 * Add tab to product data
	 *
	 * @param  array $tabs Default product tabs.
	 * @return array       Appended product tabs.
	 */
	public function variation_images_tab( $tabs ) {

		$tabs['variation_images'] = array(
			'label'    => __( 'Variation images', 'woocommerce' ),
			'target'   => 'variation_images',
			'class'    => array( 'show_if_variable' ),
			'priority' => 65,
		);

		return $tabs;
	}

	/**
	 * Variation images template
	 *
	 * @return void
	 */
	public function variation_images_panel() {
		global $post, $thepostid, $product_object;
		include plugin_dir_path( dirname( __FILE__ ) ) . '/templates/html-variation-images.php';
	}

	/**
	 * Save variation images
	 *
	 * @param  int $post_id Product ID.
	 * @return void
	 */
	public function save_variation_images( $post_id ) {
		if ( isset( $_POST['variation_images'] ) && check_admin_referer( 'variation_images_' . $post_id, 'save_variation_images' ) ) {
			$attributes = wp_unslash( $_POST['variation_images'] );
			foreach ( $attributes as $attribute => $terms ) {
				foreach ( $terms as $term => $image ) {
					if ( $image ) {
						update_post_meta( $post_id, 'variation_image_' . $attribute . '_' . $term, filter_var( $image, FILTER_SANITIZE_STRING ) );
					} else {
						delete_post_meta( $post_id, 'variation_image_' . $attribute . '_' . $term );
					}
				}
			}
		}
	}
}
new Admin();