<?php
/**
 * hoango Theme Customizer
 *
 * @package hoango
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hoango_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'hoango_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'hoango_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'hoango_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function hoango_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function hoango_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hoango_customize_preview_js() {
	wp_enqueue_script( 'hoango-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'hoango_customize_preview_js' );

/** Remove section, panel in customizer admin */
function hoango_customizer_remove( $wp_customize ) {
	$wp_customize->remove_panel( 'themes' );
    $wp_customize->remove_section( 'static_front_page' );
    $wp_customize->remove_control( 'custom_css' );
}
add_action( 'customize_register', 'hoango_customizer_remove' );

/**
 * Field Customize register
 */
function contact_customize_register($wp_customize){

    $wp_customize->add_section('hoango_contact_info', array(
        'title'    => __('Thông tin liên hệ', 'hoango'),
        'description' => '',
        'priority' => 120,
    ));

    //  =============================
    //  = Địa chỉ              =
    //  =============================
    $wp_customize->add_setting('hoango_theme_options[address]', array(
        'default'        => 'Địa chỉ trống',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('hoango_address', array(
        'label'      => __('Địa chỉ', 'hoango'),
        'section'    => 'hoango_contact_info',
        'settings'   => 'hoango_theme_options[address]',
    ));

	//  =============================
    //  = Số điện thoại               =
    //  =============================
    $wp_customize->add_setting('hoango_theme_options[telephone]', array(
        'default'        => 'Số điện thoại trống',
        'capability'     => 'edit_theme_options',
        'type'           => 'them_mod',

    ));

    $wp_customize->add_control('hoango_telephone', array(
        'label'      => __('Số điện thoại', 'hoango'),
        'section'    => 'hoango_contact_info',
        'settings'   => 'hoango_theme_options[telephone]',
    ));

	//  =============================
    //  = Email             =
    //  =============================
    $wp_customize->add_setting('hoango_theme_options[email]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('hoango_email', array(
        'label'      => __('Email', 'hoango'),
        'section'    => 'hoango_contact_info',
        'settings'   => 'hoango_theme_options[email]',
    ));

}

add_action('customize_register', 'contact_customize_register');


function social_customize_register($wp_customize) {
	/** 
	 * Add section Mang xa hoi
	 */

	$wp_customize->add_section('hoango_social_info', array(
        'title'    => __('Mạng xã hội', 'hoango'),
        'description' => '',
        'priority' => 120,
    ));

    //  =============================
    //  = Facebook            =
    //  =============================
    $wp_customize->add_setting('hoango_theme_options[facebook]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('hoango_facebook', array(
        'label'      => __('Facebook', 'hoango'),
        'section'    => 'hoango_social_info',
        'settings'   => 'hoango_theme_options[facebook]',
    ));

	//  =============================
    //  = Twitter            =
    //  =============================
    $wp_customize->add_setting('hoango_theme_options[twitter]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('hoango_twitter', array(
        'label'      => __('Twitter', 'hoango'),
        'section'    => 'hoango_social_info',
        'settings'   => 'hoango_theme_options[twitter]',
    ));

	//  =============================
    //  = Youtube           =
    //  =============================
    $wp_customize->add_setting('hoango_theme_options[youtube]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('hoango_youtube', array(
        'label'      => __('Youtube', 'hoango'),
        'section'    => 'hoango_social_info',
        'settings'   => 'hoango_theme_options[youtube]',
    ));

	    //  =============================
    //  = Tiktok            =
    //  =============================
    $wp_customize->add_setting('hoango_theme_options[tiktok]', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));

    $wp_customize->add_control('hoango_tiktok', array(
        'label'      => __('Tiktok', 'hoango'),
        'section'    => 'hoango_social_info',
        'settings'   => 'hoango_theme_options[tiktok]',
    ));

}

add_action('customize_register', 'social_customize_register');

/** Trang chu Custom */

//require get_template_directory() . '/inc/custom/custom-product-cat-home.php';

/** Remane Woocommerce to Gian hàng in Customize */
function my_customize_register($wp_customize) {     
    $wp_customize->get_panel('woocommerce')->title = __( 'Gian Hàng' );  
} 
    
add_action( 'customize_register', 'my_customize_register', 11);