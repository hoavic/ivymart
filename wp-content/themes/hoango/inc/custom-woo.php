<?php 

/** Hide Woo suggest */
add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );

/* Xóa tab đánh giá trong woocommerce */
/* add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );

function wcs_woo_remove_reviews_tab( $tabs ) {
	unset( $tabs['reviews'] ); // Remove the reviews tab

	return $tabs;
} */

/** Change Woocommerce to Gian hang in menu */
add_action( 'admin_menu', 'ak_rename_woocommerce_dashboard_menu', 999 );
function ak_rename_woocommerce_dashboard_menu() {

    global $menu;
    // Replace this with your custom name
    $new_name = 'Gian Hàng';
    // Find WooCommerce reference and change it
    foreach($menu as $key => $item){
        if(isset($item[0]) && $item[0] == 'WooCommerce'){
            $menu[$key][0] = $new_name;
            break;
        }
    }

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

/**
 * Show cart contents / total Ajax
 */
/* add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> – <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
} */

?>