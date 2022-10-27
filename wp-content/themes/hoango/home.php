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

/*         echo '<div class="home-section box-home"><h2>Danh mục sản phẩm</h2>';
        echo do_shortcode('[product_categories ids="25,26,27,28,25,26,27,28" columns="8" hide_empty="0"]');
        echo '</div>'; */

        
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

        echo '<div class="home-section box-home"><div class="woocommerce columns-8"><ul class="products columns-8">';
        get_item_product_cat(25);
        get_item_product_cat(26);
        get_item_product_cat(27);
        get_item_product_cat(28);
        get_item_product_cat(37);
        get_item_custom_page(54, 183);
        get_item_custom_page(52, 184);
        get_item_custom_page(56, 185);
        echo '</ul></div></div>';

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
