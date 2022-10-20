<?php 

/** Hide Woo suggest */
add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );

/* Xóa tab đánh giá trong woocommerce */
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );

function wcs_woo_remove_reviews_tab( $tabs ) {
	unset( $tabs['reviews'] ); // Remove the reviews tab

	return $tabs;
}

/** Remove woo maketing menu */
add_filter( 'woocommerce_admin_features', function( $features ) {
    /**
     * Filter list of features and remove those not needed     *
     */
    return array_values(
        array_filter( $features, function($feature) {
            return $feature !== 'marketing';
        } ) 
    );
} );

/* Chuyển 0đ thành chữ “Liên hệ”. */

function hoangweb_wc_custom_get_price_html( $price, $product ) {
    if ( $product->get_price() == 0 ) {
        if ( $product->is_on_sale() && $product->get_regular_price() ) {
            $regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );
 
            $price = wc_format_price_range( $regular_price, __( 'Free!', 'woocommerce' ) );
        } else {
            $price = '' . __( 'Liên hệ', 'woocommerce' ) . '';
        }
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'hoangweb_wc_custom_get_price_html', 10, 2 );

?>