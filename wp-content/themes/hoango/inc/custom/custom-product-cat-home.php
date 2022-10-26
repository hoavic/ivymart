<?php
/* function home_customize_register($wp_customize) {

    $wp_customize->add_section('hoango_home', array(
        'title'    => __('Tùy biến trang chủ', 'hoango'),
        'description' => '',
        'priority' => 120,
    ));

    $wp_customize->add_setting('home_options[product_cats]', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'type' => 'option'
    ));

    $wp_customize->add_control('hoango_product_cats', array(
        'label' => __('Chọn danh mục hiển thị ở trang chủ', 'hoango'),
        'section' => 'hoango_home',
        'settings' => 'home_options[product_cats]'
    ));
}
add_action('customize_register', 'home_customize_register'); */

    $wp_customize->add_section('hoango_home', array(
        'title'    => __('Tùy biến trang chủ', 'hoango'),
        'description' => '',
        'priority' => 120,
    ));

 /*    function rjs_customize_register( $wp_customize ) {
    
        //Get an array with the category list
    $rjs_categories_full_list = get_categories(array( 'orderby' => 'name', ));
    
        //Create an empty array
    $rjs_choices_list = [];
    
        //Loop through the array and add the correct values every time
    foreach( $rjs_categories_full_list as $rjs_single_cat ) {
        $rjs_choices_list[$rjs_single_cat->slug] = esc_html__( $rjs_single_cat->name, 'text-domain' );
    }
    
        //Register the setting
    $wp_customize->add_setting( 'rjs_category_dropdown', array(
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
        'default' => 'uncategorized',
    ) );
    
        //Register the control
    $wp_customize->add_control( 'rjs_category_dropdown', array(
        'type' => 'choices',
        'section' => 'hoango_home',
        'label' => __( 'Select category' ),
        'description' => __( 'Description.' ),
        'choices' => $rjs_choices_list, //Add the list with options
    ) );
    
} */
 
add_action( 'customize_register', 'rjs_customize_register' );

?>
