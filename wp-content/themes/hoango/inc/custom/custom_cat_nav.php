<?php 

if( ! function_exists('yourtheme_customize_register') ) {

    function cat_nav_customize_register($wp_customize) {

        require_once( __DIR__ . '/cat_nav_select.php' );

        $product_cats = get_terms( array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby'   => 'term_id',
        ) );

        if( count( $product_cats ) ) {		
            foreach( $product_cats as $product_cat ) {
              $choices[ $product_cat->term_id ] = $product_cat->name;
            }		
        }

        $wp_customize->add_section('hoango_cat_nav', array(
            'title'    => __('Thanh danh mục', 'hoango'),
            'description' => '',
            'priority' => 120,
        ));

        //  =============================
        //  = Facebook            =
        //  =============================
        $wp_customize->add_setting('hoango_theme_options[cat_nav]', array(
            'default'        => '',
            'capability'     => 'edit_theme_options',
            'type'           => 'option',

        ));

        $wp_customize->add_control(
            new Countries_Dropdown_Custom_control(
                $wp_customize, 'cat_ids', array(
                'label' => __( 'Chọn danh mục muốn hiển thị', 'hoango' ),
                'extra' => __( 'Giữ CTRL + Nhấp chuột vào danh mục muốn chọn. (Tối đa 5 danh mục)', 'hoango' ),
                'section' => 'hoango_cat_nav',
                'settings' => 'hoango_theme_options[cat_nav]',
                'type'     => 'multiple-select',
                'choices'	=> $choices
                )
            )
        );

    }

    add_action('customize_register', 'cat_nav_customize_register');
}