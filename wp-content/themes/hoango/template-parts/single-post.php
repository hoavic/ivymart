<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hoango
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php

			the_title( '<h1 class="entry-title">', '</h1>' );

        ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Tiếp tục đọc <span class="screen-reader-text"> "%s"</span>', 'hoango' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Trang:', 'hoango' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hoango_entry_footer(); ?>

		<?php 
		
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				//var_dump($categories);
				echo '<div class="related_posts archive-list"><div class="related-title"><h2>Bài viết liên quan</h2></div>';

				$args = array(
					'post_type' => 'post',
					'posts_per_page' => '5',
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'    => $categories[0]->term_id,
							),
						),
					);

				$query = new WP_Query($args);
				
				if ( $query->have_posts() ) {
					while($query -> have_posts()) {
						$query -> the_post();
						get_template_part( 'template-parts/loop', 'post' );
					}
				}

				wp_reset_query() ; 

				echo '</div>';
			}
		
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
