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
	<footer id="colophon" class="site-footer wrapper">
		<div class="site-info">
			Bản quyền 2022 © <a href="<?php echo esc_url(get_bloginfo('url')); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( '%s', 'hoango' ), get_bloginfo('name') );
				?>
			</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
