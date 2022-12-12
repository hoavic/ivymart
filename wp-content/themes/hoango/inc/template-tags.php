<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package hoango
 */

if ( ! function_exists( 'hoango_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function hoango_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Ngày đăng %s', 'post date', 'hoango' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'hoango_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function hoango_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'bởi %s', 'post author', 'hoango' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'hoango_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function hoango_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'hoango' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Danh mục: %1$s', 'hoango' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'hoango' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Từ khóa: %1$s', 'hoango' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Để lại bình luận <span class="screen-reader-text"> on %s</span>', 'hoango' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'hoango' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'hoango_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function hoango_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail('medium'); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'medium',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


if ( ! function_exists( 'cat_nav_shortcode' )) :

	/*         echo '<div class="home-section box-home"><h2>Danh mục sản phẩm</h2>';
	echo do_shortcode('[product_categories ids="25,26,27,28,25,26,27,28" columns="8" hide_empty="0"]');
	echo '</div>'; */

	function cat_nav_shortcode() {

		$option = get_option('hoango_theme_options');

		$cat_nav = $option['cat_nav'];
	
		echo '<div class="home-section box-home"><div class="woocommerce columns-8"><ul class="products columns-8">';
	/*         get_item_product_cat(25);
		get_item_product_cat(26);
		get_item_product_cat(27);
		get_item_product_cat(28);
		get_item_product_cat(37); */
	
		foreach ($cat_nav as $cat_id) {
			get_item_product_cat($cat_id);
		}
	
		get_item_custom_page(54, 183);
		get_item_custom_page(52, 184);
		get_item_custom_page(56, 185);
		echo '</ul></div></div>';

	}

	function get_item_product_cat($id) {
		$term =  get_term( $id, 'product_cat' );

		if (empty($term)) {return;}
		$thumbnail_id = get_term_meta( $id, 'thumbnail_id', true ); 
		if (empty($thumbnail_id)) {$thumbnail_id = 40;}

		echo '<li class="product-category product">
			<a href="'.get_term_link($term).'">';		
				echo wp_get_attachment_image($thumbnail_id, 'thumbnail', '', array('alt' => $term->name));        
				echo '<h2 class="woocommerce-loop-category__title">'.$term->name.'</h2>
			</a>
		</li>';
	}

	function get_item_custom_page($id, $img_id = 40) {

		$post = get_post($id);
		if (empty($post)) {return;}
		$link = get_permalink($post);
		if (empty($link)) {return;}
		echo '<li class="product-category product">
			<a href="'.$link.'">';		
				echo wp_get_attachment_image($img_id, 'thumbnail', '', array('alt' => get_the_title($post)));        
				echo '<h2 class="woocommerce-loop-category__title">'.get_the_title($post).'</h2>
			</a>
		</li>';
	}

endif;


