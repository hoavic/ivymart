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
		<div class="footer-wrap">
			<div class="wrapper">
				<div class="site-info">
					
					<?php
					
					$option = get_option('hoango_theme_options');

					//var_dump(get_option('hoango_theme_options'));

					echo '<div>
							<span>Giao hàng và thu tiền tận nơi toàn quốc.</span>';
					if ($option['telephone']) {
						echo '<span class="hotline">Hỗ trợ 24/7: '.$option['telephone'].'</span>';
					} else {
						echo '<span class="hotline">Hỗ trợ 24/7: ... </span>';
					}
							
						echo '</div>';

					echo '<div class="social-footer">';
						$facebook = '';
						if (isset($option['facebook'])) { $facebook = $option['facebook']; } 
						echo '<a href="'.$facebook.'" rel="nofollow" target="_blank">
							<span class="dashicons dashicons-facebook"></span>
						</a>';

						$instagram = '#';
						if (isset($option['instagram'])) { $instagram = $option['instagram']; } 
						echo '<a href="'.$instagram.'" rel="nofollow" target="_blank">
							<span class="dashicons dashicons-instagram"></span>
						</a>';

						if (isset($option['twitter'])) { 
							$twitter = $option['twitter']; 
							echo '<a href="'.$twitter.'" rel="nofollow" target="_blank">
								<span class="dashicons dashicons-twitter"></span>
							</a>';
						} 

						$youtube = '#';
						if (isset($option['youtube'])) { $youtube = $option['youtube']; } 
						echo '<a href="'.$youtube.'" rel="nofollow" target="_blank">
							<span class="dashicons dashicons-youtube"></span>
						</a>';
						
					echo '</div>';

					?>

				</div><!-- .site-info -->
			</div>
		</div>

		<div class="wrapper">
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
