<?php 

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    //add_theme_support( 'wc-product-gallery-zoom' );
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
    if (is_single()) {
        echo '<section id="main" class="site-main">';
    } else {
        echo '<section id="main" class="site-main site-boxed">';
    }
    
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
 
            $price = wc_format_price_range( $regular_price, __( 'MIỄN PHÍ!', 'woocommerce' ) );
        } else {
            $price = '' . __( 'LIÊN HỆ', 'woocommerce' ) . '';
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
    global $product;
    $product_type = $product->get_type(); // Get the Product Type
	
    // Change text depending on Product type
    switch ( $product_type ) {
        case "variable":
            return __('Thêm vào giỏ hàng', 'woocommerce');
            break;
        case "grouped":
            return __('Thêm vào giỏ hàng', 'woocommerce');
            break;
        case "external":
            // Button label is added when editing the product
            if ($product->get_button_text()) {
                return esc_html( $product->get_button_text() );
                break;
            }
            return __('Chuyển đến sản phẩm', 'woocommerce');
            break;
        default:
            return __('Thêm vào giỏ hàng', 'woocommerce');
    }
    
}

// Change button text on WooCommerce Shop pages
add_filter( 'woocommerce_product_add_to_cart_text', 'woocustomizer_edit_shop_button_text' );
function woocustomizer_edit_shop_button_text() {
    return __( 'Chọn Mua', 'woocommerce' );
/*     global $product;
    $product_type = $product->get_type(); // Get the Product Type
	
    // Change text depending on Product type
    switch ( $product_type ) {
        case "variable":
            return __( 'Chọn Mua', 'woocommerce' );
            break;
        case "grouped":
            return __( 'Chọn Mua', 'woocommerce' );
            break;
        case "external":
            // Button label is added when editing the product
            return esc_html( $product->get_button_text() );
            break;
        default:
            return __( 'Chọn Mua', 'woocommerce' );
    } */
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

/**
 * Rename product data tabs
 */
/* add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	return '';

} */
/**
 * Remove "Description" Heading Title @ WooCommerce Single Product Tabs
 */
add_filter( 'woocommerce_product_description_heading', function() {return 'MÔ TẢ SẢN PHẨM';} );


function woo_cart_but() {
    ob_start();
    $cart_count = WC()
        ->cart->cart_contents_count; // Set variable for cart item count
    $cart_url = wc_get_cart_url(); // Set Cart URL
    
?>
       <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="Giỏ hàng">
        <?php
    if ($cart_count > 0)
    {
?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
    }
?>
        </a>
        <?php
    return ob_get_clean();
}

//Add a filter to get the cart count
add_filter('woocommerce_add_to_cart_fragments', 'woo_cart_but_count');
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count($fragments) {
    ob_start();
    $cart_count = WC()
        ->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e('View your shopping cart'); ?>">
    <?php
    if ($cart_count > 0)
    {
?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
    }
?></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

// Chuyen 'Checkout' to 'Đặt hàng ngay'
add_filter( 'gettext', function( $translated_text ) {
    if ( 'Checkout' === $translated_text ) {
        $translated_text = 'Đặt hàng ngay';
    }
    return $translated_text;
} );


/* Thanh Toán - Xóa - Sửa Field */
function nz_edit_cko($fields){
	$fields['billing']['billing_first_name']['label'] = 'Họ tên';
	$fields['billing']['billing_first_name']['placeholder'] = 'Nhập họ tên quý khách';
	$fields['billing']['billing_email']['label'] = 'Email';
	$fields['billing']['billing_email']['placeholder'] = 'Địa chỉ Email';
	$fields['billing']['billing_phone']['label'] = 'Số điện thoại';
	$fields['billing']['billing_phone']['placeholder'] = 'Nhập số điện thoại';
	$fields['billing']['billing_address_1']['label'] = 'Địa chỉ nhận hàng';
	$fields['billing']['billing_address_1']['placeholder'] = 'Số nhà - Quận/Huyện - Thành phố...';
	$fields['order']['order_comments']['label'] = 'Ghi chú thêm về đơn hàng';
	$fields['order']['order_comments']['placeholder'] = 'Ví dụ thời gian giao hàng, địa chỉ giao hàng, gọi trước khi giao...';
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_city']);
    return $fields;
}
add_filter('woocommerce_checkout_fields','nz_edit_cko');

// Disable Woocommerce bloat
add_filter( 'woocommerce_admin_disabled', '__return_true' );

/** Change time format woo */
add_filter( 'post_date_column_time' ,'woo_custom_post_date_column_time_withDate' );
function woo_custom_post_date_column_time_withDate( $post ) {
$t_time = get_the_time( __( 'd/m/Y g:i:s A', 'woocommerce' ), $post );
return $t_time;
}

add_filter( 'post_date_column_time' , 'woo_custom_post_date_column_time' );
function woo_custom_post_date_column_time( $post ) {
    $h_time = get_the_time( __( 'd/m/Y', 'woocommerce' ), $post );
    return $h_time;
}

/**

 *    Khi het hàng -> hiển thị TẠM HẾT HÀNG!

 */

add_filter( 'woocommerce_variable_sale_price_html', 'theanand_remove_prices', 10, 2 );

add_filter( 'woocommerce_variable_price_html', 'theanand_remove_prices', 10, 2 );

add_filter( 'woocommerce_get_price_html', 'theanand_remove_prices', 10, 2 );

function theanand_remove_prices( $price, $product ) {

    if ( ! $product->is_in_stock()) {

    $price = 'TẠM HẾT HÀNG!';

    }

    return $price;

}


/** Hiện % giảm giá  */
function woocommerce_custom_sale_savings() {
    global $product;
    if ( ! $product->is_on_sale() ) return;
    if ( $product->is_type( 'simple' ) ) {
       $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
    } elseif ( $product->is_type( 'variable' ) ) {
       $max_percentage = 0;
       foreach ( $product->get_children() as $child_id ) {
          $variation = wc_get_product( $child_id );
          $price = $variation->get_regular_price();
          $sale = $variation->get_sale_price();
          if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
          if ( $percentage > $max_percentage ) {
             $max_percentage = $percentage;
          }
       }
    }
    if ( $max_percentage > 0 ) {
      return  '<span class="onsale">-' . round($max_percentage) . '%</span>';
    } 
}
 
 add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_savings', 10, 3);

?>