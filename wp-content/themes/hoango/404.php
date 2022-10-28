<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hoango
 */

get_header();
?>

	<main id="primary" class="site-main site-boxed">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Ối! Không thể tìm thấy trang đó.', 'hoango' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Có vẻ như đường link sản phẩm này không còn tồn tại. Bạn có thể thử một trong các liên kết bên dưới hoặc dùng công cụ tìm kiếm?', 'hoango' ); ?></p>

					<?php
					get_search_form();

					echo do_shortcode('[recent_products columns="5" limit="10"]');

					the_widget( 'WP_Widget_Recent_Posts' );
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Chuyên mục bài viết', 'hoango' ); ?></h2>
						<ul>
							<?php
							wp_list_categories(
								array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								)
							);
							?>
						</ul>
					</div><!-- .widget -->

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
