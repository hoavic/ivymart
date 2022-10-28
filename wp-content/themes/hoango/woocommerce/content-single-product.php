<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	
	<div class="product-quick-info">
		<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
		?>

		<div class="summary entry-summary">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			//do_action( 'woocommerce_single_product_summary' );
			woocommerce_template_single_title();
			woocommerce_template_single_price();
			if ( ! has_excerpt() ) {
				echo '<div class="woocommerce-product-details__short-description">
						<ul>
							<li>Nội dung phần mô tả ngắn 1</li>
							<li>Nội dung phần mô tả ngắn 2</li>
							<li>Nội dung phần mô tả ngắn 3</li>
						</ul>
					</div>';
			} else {
				woocommerce_template_single_excerpt();
			}
			
			woocommerce_template_single_add_to_cart();
			//woocommerce_template_loop_add_to_cart();
			$current_product_id = get_the_ID();

			$product = wc_get_product( $current_product_id );
			
			$cart_url = wc_get_cart_url();
			echo '<p class="action buttons">';
			if( $product->is_type( 'simple' ) ){
			echo '<a href="'.$cart_url.'?add-to-cart='.$current_product_id.'" class="buy-now button">
					<b>Mua Ngay</b>
					<span>Giao hàng thu tiền tận nơi toàn quốc</span>
				</a>';
			}
			$options = get_option('hoango_theme_options');
			echo '<a class="buy-now callorder" href="tel:'.$options["telephone"].'">
					<b>Gọi điện đặt hàng</b>
					<span>'.$options["telephone"].'</span>
				</a>';
			echo '</p>';
			woocommerce_template_single_meta();	
			?>
		</div>
	</div>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action( 'woocommerce_after_single_product_summary' );
	woocommerce_output_related_products();
	woocommerce_output_product_data_tabs();
	echo '<section class="related products more"><h2>Sản phẩm khác</h2>'.do_shortcode('[recent_products limit="8"]').'</section>';
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
