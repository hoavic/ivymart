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
				Bản quyền 2022 © <a href="<?php echo esc_url(get_bloginfo('url')); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( '%s', 'hoango' ), get_bloginfo('name') );

					echo get_option('hoango_theme_options');

					var_dump(get_option('hoango_theme_options'));
					?>
				</a>
			</div><!-- .site-info -->
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
