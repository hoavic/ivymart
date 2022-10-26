<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hoango
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'hoango' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="wrapper">
			<div class="site-branding">
				<?php
				
				$logo = get_bloginfo( 'name' );

				if ( has_custom_logo() ) {
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo_arr = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					$logo = '<img src="' . esc_url( $logo_arr[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
				}

				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $logo; ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo $logo; ?></a></p>
					<?php
				endif;	?>
			</div><!-- .site-branding -->

			<div class="right-header">

				<div class="widget_search">
					<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>" >
						<div class="custom-form"><label class="screen-reader-text" for="s">Tìm kiếm cho</label>
						<input type="text" placeholder="Nhập tên sản phẩm..." value="<?php echo get_search_query(); ?>" name="s" id="s" />
						<button type="submit" id="searchsubmit">
							<span class="dashicons dashicons-search"></span>
						</button>
					</div>
					</form>
				</div>

				<div class="widget_hotline">
					<span class="dashicons dashicons-phone"></span>
					<div class="callme">

					<?php 
						$options = get_option('hoango_theme_options');
						if (!empty($options['telephone'])) {
							echo '<p><a href="tel:'.$options['telephone'].'">Tel: <span>'.$options['telephone'].'</span></a></p>';
						}
						if (!empty($options['hotline'])) {
							echo '<p><a href="tel:'.$options['hotline'].'">Hotline: <span class="hotline">'.$options['hotline'].'</span></a></p>';
						}
					?>
						
						
					</div>
					<?php 
						get_option('hoango_theme_options');

					?>
				</div>
				
				<div class="widget_shopping_cart_icon">
					<?php 
						//woocommerce_mini_cart(); 
						echo woo_cart_but();
					?>
				</div>
				

			</div>
		</div>
	</header><!-- #masthead -->
	<nav id="site-navigation" class="main-navigation">
		<div class="action-button">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<svg viewBox="0 0 100 80" width="25" height="25"> 
					<rect width="90" height="18" rx="0"></rect> 
					<rect y="30" width="100" height="18" rx="0"></rect> 
					<rect y="60" width="80" height="18" rx="0"></rect> 
				</svg>
				<?php esc_html_e( 'MENU', 'hoango' ); ?>
			</button>
			<button class="search-toggle" aria-controls="search-form" aria-expanded="false">
			<svg width="25" height="25" viewBox="0 0 16 16"> 
				<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
		 	</svg>
			</button>
		</div>		
		<div class="wrapper nav-wrap">
				
				<?php
					echo '<ul><li class="menu-item"><a href="#"><i class="_mi _before dashicons dashicons-editor-ul" aria-hidden="true"></i> DANH MỤC SẢN PHẨM</a>';
						wp_nav_menu(
							array(
								'theme_location' => 'menu-danh-muc',
								'menu_id'        => 'product-menu',
								'container'	=>	'false' 
							)
						);
					echo '</li></ul>';
					wp_nav_menu(
						array(
							'theme_location' => 'menu-ngang',
							'menu_id'        => 'primary-menu',
							'container'	=>	'false' 
						)
					);
				?>

		</div>
	</nav><!-- #site-navigation -->
	<?php 
/* 		if ( function_exists('yoast_breadcrumb') && !is_home()) {
			yoast_breadcrumb( '<div class="wrapper"><p id="breadcrumbs">','</p></div>' );
		} */

		if ( function_exists('woocommerce_breadcrumb') && !is_home()) {
			echo '<div class="wrapper">';
			woocommerce_breadcrumb( '', );
			echo '</div>';
		}

		if (is_home()) {
			echo '<div class="wrapper">
					<div class="home-slider swiper mySwiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide slide_1">
								<img src="wp-content/themes/hoango/img/bn-vichy.jpg" alt="Banner 1">
							</div>
							<div class="swiper-slide slide_2">
								<img src="wp-content/themes/hoango/img/bn1.jpg" alt="Banner 2">
							</div>
							<div class="swiper-slide slide_3">
								<img src="wp-content/themes/hoango/img/bn-la-roche-cam.jpg" alt="Banner 3">
							</div>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
				</div>';
			echo '<link rel="stylesheet" href="wp-content/themes/hoango/js/swiperjs/swiper-bundle.min.css"/>

			<script src="wp-content/themes/hoango/js/swiperjs/swiper-bundle.min.js"></script>';

			echo '<script>
			const swiper = new Swiper(".mySwiper", {
			  slidesPerView: 1,
			  spaceBetween: 30,
			  loop: true,
			  pagination: {
				el: ".swiper-pagination",
				clickable: true,
			  },
			  navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			  },
			});
		  
			</script>';
		}
		
	?>
	<div class="wrapper <?php if(!is_home() && !is_tax('product_cat') && !is_page('cua-hang')) {echo 'has-sidebar';} ?>">