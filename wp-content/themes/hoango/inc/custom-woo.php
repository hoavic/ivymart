<?php 

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

/** REmove ddddđ */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
    echo '<section id="main">';
}

function my_theme_wrapper_end() {
    echo '</section>';
}

/** Remove woo breadcrum*/
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

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
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
} */
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
function woo_dequeue_unused_css() {

    wp_dequeue_style('woocommerce-layout');
    wp_deregister_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-general');
    wp_deregister_style('woocommerce-general');
    wp_dequeue_style('woocommerce-smallscreen');
    wp_deregister_style('woocommerce-smallscreen');

 }
add_action('wp_enqueue_scripts', 'woo_dequeue_unused_css', 330);

/** Đổi text Add to cart (Thêm vào giỏ hàng) -> Mua ngay */
add_filter('woocommerce_product_single_add_to_cart_text','QL_customize_add_to_cart_button_woocommerce');
function QL_customize_add_to_cart_button_woocommerce(){
    return __('Thêm vào giỏ hàng', 'woocommerce');
}

/* remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 30 ); */

/* Create Buy Now Button dynamically after Add To Cart button */

/* function add_content_after_addtocart() {

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
add_action( 'woocommerce_after_add_to_cart_button', 'add_content_after_addtocart' ); */
   

?>