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

    <?php 
		if (!has_post_thumbnail() ) {
			echo '<div class="post-thumbnail blank-thumbnail"></div>';
		} else {
			hoango_post_thumbnail(); 
		}
		
	
	?>
	<div class="info-right">
		<header class="entry-header">
			<?php

				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php
				the_excerpt();
			?>
		</div><!-- .entry-content -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
