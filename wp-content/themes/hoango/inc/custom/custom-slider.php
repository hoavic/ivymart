<?php 
function slider_customize_register($wp_customize){

    $wp_customize->add_section('hoango_slider_info', array(
        'title'    => __('Tùy chỉnh banner trang chủ', 'hoango'),
        'description' => '',
        'priority' => 120,
    ));

    //  =============================
    //  = Địa chỉ              =
    //  =============================
    $wp_customize->add_setting('slider_options[bn1]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
	

}

add_action('customize_register', 'slider_customize_register');

?>