<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.

}

class WPPB_Dokan_Shortcode {
	public function get_name(){
		return 'wppb_dokan_shortcode';
	}
	public function get_icon() {
		return 'wppb-font-Page-grid';
	}
	public function get_category_name(){
		return __( 'Dokan Addons', 'wppb-dokan' );
	}
	public function get_title(){
		return __( 'WPPB Dokan', 'wppb-dokan' );
	}
	
	# headline Settings Fields
	public function get_settings() {
		$settings = array(
			'product_shortcode' => array(
				'type' 		=> 'select',
				'title' 	=> __('Select Column', 'wppb-dokan'),
				'values' 	=> array(
							'[dokan-dashboard]' => __( 'Dashboard', 'wppb-dokan' ),
	                        '[dokan-stores]' => __( 'Store Listing', 'wppb-dokan' ),
	                        '[dokan-my-orders]' => __( 'My Orders', 'wppb-dokan' ),
                            '[dokan-top-rated-product]' => __( 'Top Rated Products', 'wppb-dokan' ),
                            'dokan-best-selling-product' => __( 'Best Selling Products', 'wppb-dokan' ),
	                        '[dokan-customer-migration]' => __( 'Become a Vendor ', 'wppb-dokan' ),
					),
				'std' 		=> 'dokan-best-selling-product',
            ),
            'products_number' => array(
				'type' 			=> 'number',
				'title' 		=> __('Number of Slider', 'wppb-dokan'),
                'std' 			=> '8',
			),
			'woo_column' => array(
				'type' => 'select',
				'responsive' => true,
				'title' => __('Post Column','winkel'),
				'placeholder' => __('Number of Column','winkel'),
				'values' => array(
                    '12' =>  __( 'One Column', 'winkel' ),
                    '6' =>  __( 'Two Column', 'winkel' ),
                    '4' =>  __( 'Three Column', 'winkel' ),
                    '3' =>  __( 'Four Column', 'winkel' )
                ),
                'std' => '3'
			),
			'woo_order_by' => array(
			    'type' 	 => 'select',
			    'title'  => __('Select title element','winkel'),
			    'values' => array(
			        	'DESC' 		=> __( 'Descending', 'winkel' ),
                        'ASC' 		=> __( 'Ascending', 'winkel' ),
			    ),
			    'std' => 'DESC',
			),			
            'seller_id_switch' => array(
				'type' => 'switch',
				'title' => __('Own ID','wp-pagebuilder'),
                'std' => '1',
                'depends' => array(array('product_shortcode', '==', 'dokan-best-selling-product')),
			),
            'seller_id' => array(
				'type' 			=> 'text',
				'title' 		=> __('Seller ID', 'wppb-dokan'),
                'std' 			=> '4',
                'depends' => array(array('seller_id_switch', '!=', '1')),
			),
		);

		return $settings;
	}

	# Title Render HTML
	public function render($data = null){
        $settings 		    = $data['settings']; 
        $shortcode          = $settings['product_shortcode'];
        $products_number    = $settings['products_number'];
        $seller_id_switch   = $settings['seller_id_switch'];
        $seller_id          = $settings['seller_id'];

        if( $shortcode == 'dokan-best-selling-product' ){
            if( $seller_id_switch ){
                $shortcode = '[dokan-best-selling-product no_of_product="'.$products_number.'" seller_id="'.get_current_user_id().'" ]';
            }else{
                $shortcode = '[dokan-best-selling-product no_of_product="'.$products_number.'" seller_id="'.$seller_id.'" ]';
            }
        }

        return do_shortcode( $shortcode  );
	 }
}