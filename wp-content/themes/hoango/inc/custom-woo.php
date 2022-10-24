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

// Remove the category count for WooCommerce categories
add_filter( 'woocommerce_subcategory_count_html', '__return_null' );

/**
 * Set WooCommerce image dimensions upon theme activation
 */
// Remove each style one by one
/* add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
} */

/** Đổi text Add to cart (Thêm vào giỏ hàng) -> Mua ngay */
add_filter('woocommerce_product_single_add_to_cart_text','QL_customize_add_to_cart_button_woocommerce');
function QL_customize_add_to_cart_button_woocommerce(){
return __('Thêm vào giỏ hàng', 'woocommerce');
}

/* Create Buy Now Button dynamically after Add To Cart button */

function add_content_after_addtocart() {

    $current_product_id = get_the_ID();
    
    $product = wc_get_product( $current_product_id );
    
    $cart_url = wc_get_cart_url();
    
    if( $product->is_type( 'simple' ) ){
    echo '<a href="'.$cart_url.'?add-to-cart='.$current_product_id.'" class="buy-now button">Mua Ngay</a>';
    }
    $options = get_option('hoango_theme_options');
    echo '<a class="btn_buy callorder" href="tel:'.$options["telephone"].'">
            <b>Gọi điện đặt hàng</b>
            <span>'.$options["telephone"].'</span>
        </a>';
}
add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart' );
   

?>