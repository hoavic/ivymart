<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hoango
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php

        echo '<div class="home-section box-home"><h2>Danh mục sản phẩm</h2>';
        echo do_shortcode('[product_categories ids="25,26,27,28,25,26,27,28" columns="8"]');
        echo '</div>';

        // Get Woocommerce product categories WP_Term objects
        $terms = get_terms( ['taxonomy' => 'product_cat'] );

        // Getting a visual raw output
        //echo '<pre>'; print_r( $terms ); echo '</pre>';

        foreach ($terms as $term) {
            $count = $term->count;
            if (!empty($count) &&  $count < 2) {
                continue;
            }
            show_product_in_cat($term->name, $term->slug);
        }

        function show_product_in_cat($name, $slug) {
            $shortcode = '[product_category category="'.$slug.'" columns="5" limit="10"]';
            echo '<div class="product-section box-home"><h2>'.$name.'</h2>';
            echo do_shortcode($shortcode);
            echo '</div>';
        }
        
		?>

	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
