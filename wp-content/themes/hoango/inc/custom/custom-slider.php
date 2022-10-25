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

/*     $wp_customize->add_control('hoango_address', array(
        'label'      => __('Ảnh thứ nhất', 'hoango'),
        'section'    => 'hoango_slider_info',
        'settings'   => 'slider_options[address]',
    )); */

/*     $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'slider_bn1',
            array(
                'label'      => __( 'Upload ảnh 1', 'theme_name' ),
                'section'    => 'hoango_slider_info',
                'settings'   => 'slider_options[address]'
            )
        )
    ); */

	//  =============================
    //  = Số điện thoại               =
    //  =============================
    $wp_customize->add_setting('slider_options[telephone]', array(
        'default'        => 'Số điện thoại trống',
        'capability'     => 'edit_theme_options',
        'type'           => 'them_mod',

    ));

    $wp_customize->add_control('hoango_telephone', array(
        'label'      => __('Số điện thoại', 'hoango'),
        'section'    => 'hoango_slider_info',
        'settings'   => 'slider_options[telephone]',
    ));

	

}

add_action('customize_register', 'slider_customize_register');

?>