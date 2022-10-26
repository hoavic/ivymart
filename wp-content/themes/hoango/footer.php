<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hoango
 */

?>
	</div>
	<footer id="colophon" class="site-footer">
		<div class="wrapper">
			<div class="site-info">
				
				<?php
				
				$option = get_option('hoango_theme_options');

				//var_dump(get_option('hoango_theme_options'));

				echo '<div>
						<span>Giao hàng và thu tiền tận nơi toàn quốc.</span>
						<span class="hotline">Hỗ trợ 24/7: '.$option['telephone'].'</span>
					</div>';

				echo '<div class="social-footer">
					<a href="'.$option['facebook'].'"><span class="dashicons dashicons-facebook"></span></a>
					<a href="#"><span class="dashicons dashicons-instagram"></span></a>
					<a href="#"><span class="dashicons dashicons-youtube"></span></a>
				</div>';

				?>

			</div><!-- .site-info -->

			<div class="sidebar-footer">
				<?php 
					echo '<section id="block-7" class="widget widget_block">
							<div class="wp-container-1 wp-block-group">
								<div class="wp-block-group__inner-container contact-block">
									<h2>Liên hệ</h2>
									<ul>';	
										
										if (!empty($option['address'])) {
											echo '<li><span class="dashicons dashicons-building"></span> '.$option["address"].'</li>';
										}
										if (!empty($option['telephone'])) {
											echo '<li><span class="dashicons dashicons-smartphone"></span> <a href="tel:'.$option['telephone'].'">'.$option['telephone'].'</a></li>';
										}	
										if (!empty($option['hotline'])) {
											echo '<li><span class="dashicons dashicons-smartphone"></span> <a href="tel:'.$option['hotline'].'">'.$option['hotline'].'</a></li>';
										}		
										echo '<li><span class="dashicons dashicons-clock"></span> Thứ 2-6: 8h - 20h; Thứ 7-CN: 9h - 17h</li>
									</ul>
								</div>
							</div>
						</section>';
					dynamic_sidebar( 'sidebar-footer' ); 
				?>
			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
