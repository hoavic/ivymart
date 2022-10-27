<?php 
function slider_customize_register($wp_customize) {
 //Footer
 $wp_customize->add_section('hoango_slider', array(
    'title' => __('Tùy chỉnh Slider', 'hoango'),
    'priority' => 130,
    'description' => __( 'Lưu ý: chọn ảnh có kích thước tối thiểu 1250x300px.' ),
 ));

/* //Anh 1
$wp_customize->add_setting("slider_1", array(
   'transport' => 'postMessage',
)); 

$wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize,'slider_1',array(
   'label' => __('Chọn Ảnh Thứ 1', 'hoango'),
   'section' => 'hoango_slider',
   'settings' => 'slider_1',
))); */

// Banner 1
$wp_customize->add_setting('slider_1', array(
   'type' => 'theme_mod',
   'capability' => 'edit_theme_options',
   'transport'         => 'postMessage',
   'sanitize_callback' => 'absint'
));

$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'slider_1', array(
   'section' => 'hoango_slider',
   'label' => 'Ảnh Thứ 1',
   'width' => 1250,
   'height' => 300,
   'flex-height' => true,
   'flex-width'  => true,
)));

// Banner 2
$wp_customize->add_setting('slider_2', array(
   'type' => 'theme_mod',
   'capability' => 'edit_theme_options',
   'transport'         => 'postMessage',
   'sanitize_callback' => 'absint'
));

$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'slider_2', array(
   'section' => 'hoango_slider',
   'label' => 'Ảnh Thứ 2',
   'width' => 1250,
   'height' => 300,
   'flex-height' => true,
   'flex-width'  => true,
)));

// Banner 3
$wp_customize->add_setting('slider_3', array(
   'type' => 'theme_mod',
   'capability' => 'edit_theme_options',
   'transport'         => 'postMessage',
   'sanitize_callback' => 'absint'
));

$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'slider_3', array(
   'section' => 'hoango_slider',
   'label' => 'Ảnh Thứ 3',
   'width' => 1250,
   'height' => 300,
   'flex-height' => true,
   'flex-width'  => true,
)));

// Banner 4
$wp_customize->add_setting('slider_4', array(
   'type' => 'theme_mod',
   'capability' => 'edit_theme_options',
   'transport'         => 'postMessage',
   'sanitize_callback' => 'absint'
));

$wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'slider_4', array(
   'section' => 'hoango_slider',
   'label' => 'Ảnh Thứ 4',
   'width' => 1250,
   'height' => 300,
   'flex-height' => true,
   'flex-width'  => true,
)));
 
}

add_action('customize_register','slider_customize_register');
