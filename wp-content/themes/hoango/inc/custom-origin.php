<?php 

/**
 * Add admin-style.css
 * 
 */

add_action( 'admin_enqueue_scripts', 'hoango_admin_style');

function hoango_admin_style() {
  wp_enqueue_style( 'admin-style', get_stylesheet_directory_uri() . '/admin-style.css' );
} 

/** Disable Rest API */
add_filter( 'rest_authentication_errors', 'wp_snippet_disable_rest_api' );
function wp_snippet_disable_rest_api( $access ) {
   return new WP_Error( 'rest_disabled', __('The WordPress REST API has been disabled.'), array( 'status' => rest_authorization_required_code()));
}

/**
 * Remove logo in admin bar
 * 
 */
function example_admin_bar_remove_logo() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'example_admin_bar_remove_logo', 0 );

/**
 * Remove wp News, site health in admin
 * 
 */
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

function remove_dashboard_widgets () {

    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );

}

/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );


/**
 * Hide Helplink
 */
add_filter('contextual_help_list','contextual_help_list_remove');

function contextual_help_list_remove(){
    global $current_screen;
    $current_screen->remove_help_tabs();
}

/** Remove update link in sub-menu */
add_action( 'admin_menu', 'control_menu_items_shown' );
function control_menu_items_shown() {
    remove_submenu_page( 'index.php', 'update-core.php' );
}

/** Remove Sitehealth link in sub-menu */
add_action( 'admin_menu', 'remove_site_health_submenu' );
function remove_site_health_submenu() {
    remove_submenu_page( 'tools.php', 'site-health.php' );
}

/* Disable automatic WordPress plugin updates: */
add_filter( 'auto_update_plugin', '__return_false' );

/* Disable automatic WordPress theme updates: */
add_filter( 'auto_update_theme', '__return_false' );

// Disable core update emails
add_filter( 'auto_core_update_send_email', '__return_false' );

// Disable plugin update emails
add_filter( 'auto_plugin_update_send_email', '__return_false' );

// Disable theme update emails
add_filter( 'auto_theme_update_send_email', '__return_false' );

// hide update notifications
function remove_core_updates(){

    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);

}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes

// Hide dashboard update notifications for all users
function kinsta_hide_update_nag() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
    
add_action('admin_menu','kinsta_hide_update_nag');

// Change footer-thankyou
function change_footer_admin () 
{
    echo '<span id="footer-thankyou">Thi????t k???? b????i <strong>Ho??a Ng??</strong>';
}
 
add_filter('admin_footer_text', 'change_footer_admin');

// Change footer-thankyou
function hoango_hide_footer_vesion() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
}

add_action( 'admin_menu', 'hoango_hide_footer_vesion' );

?>