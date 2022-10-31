<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hoango
 */

get_header();
?>
	<?php 

	function get_item_product_cat($id) {
		$term =  get_term( $id, 'product_cat' );

		if (empty($term)) {return;}
		$thumbnail_id = get_term_meta( $id, 'thumbnail_id', true ); 
		if (empty($thumbnail_id)) {$thumbnail_id = 40;}

		echo '<li class="product-category product">
			<a href="'.get_term_link($term).'">';		
				echo wp_get_attachment_image($thumbnail_id, 'thumbnail', '', array('alt' => $term->name));        
				echo '<h2 class="woocommerce-loop-category__title">'.$term->name.'</h2>
			</a>
		</li>';
	}

	function get_item_custom_page($id, $img_id = 40) {

		$post = get_post($id);
		if (empty($post)) {return;}
		$link = get_permalink($post);
		if (empty($link)) {return;}
		echo '<li class="product-category product">
			<a href="'.$link.'">';		
				echo wp_get_attachment_image($img_id, 'thumbnail', '', array('alt' => get_the_title($post)));        
				echo '<h2 class="woocommerce-loop-category__title">'.get_the_title($post).'</h2>
			</a>
		</li>';
	}

       echo '<div class="home-section box-home"><div class="woocommerce columns-8"><ul class="products columns-8">';
	   get_item_product_cat(25);
	   get_item_product_cat(26);
	   get_item_product_cat(27);
	   get_item_product_cat(28);
	   get_item_product_cat(37);
	   get_item_custom_page(54, 183);
	   get_item_custom_page(52, 184);
	   get_item_custom_page(56, 185);
	   echo '</ul></div></div>';
	?>
	<main id="primary" class="site-main site-boxed">

			<header class="woocommerce-products-header">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>

				<?php
				/**
				 * Hook: woocommerce_archive_description.
				 *
				 * @hooked woocommerce_taxonomy_archive_description - 10
				 * @hooked woocommerce_product_archive_description - 10
				 */
				do_action( 'woocommerce_archive_description' );
				?>
			</header>
			<?php
			if ( woocommerce_product_loop() ) {

				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}

			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );

		?>

	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
