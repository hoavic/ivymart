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

	<header id="masthead" class="site-header wrapper">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$hoango_description = get_bloginfo( 'description', 'display' );
			if ( $hoango_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $hoango_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<div class="right-header">


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
					echo '<ul><li><a href="#">DANH MỤC SẢN PHẨM</a>';
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
		if ( function_exists('yoast_breadcrumb') && !is_home()) {
			yoast_breadcrumb( '<div class="wrapper"><p id="breadcrumbs">','</p></div>' );
		}
	?>
	<div class="wrapper">