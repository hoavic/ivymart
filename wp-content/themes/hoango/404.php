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
						echo '<form role="search" method="get" class="searchform" action="'.home_url( '/' ).'" >
								<label class="screen-reader-text" for="s">Tìm kiếm cho</label>
								<input type="text" placeholder="Nhập tên sản phẩm..." value="'.get_search_query().'" name="s" id="s" />
								<button type="submit" id="searchsubmit">
									<span class="dashicons dashicons-search"></span>
								</button>
								<input type="hidden" name="post_type" value="product">
							</form>';

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
