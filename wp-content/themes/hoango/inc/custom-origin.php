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
/* add_filter( 'rest_authentication_errors', 'wp_snippet_disable_rest_api' );
function wp_snippet_disable_rest_api( $access ) {
   return new WP_Error( 'rest_disabled', __('The WordPress REST API has been disabled.'), array( 'status' => rest_authorization_required_code()));
} */

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
    remove_meta_box( 'themeisle', 'dashboard', 'normal' );
    remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
}

/** REmove welcome panel */
add_action('admin_init', function() {
    remove_action('welcome_panel', 'wp_welcome_panel');
});

/* Disable WordPress Admin Bar for all users */
add_filter( 'show_admin_bar', '__return_false' );


/**
 * Hide Helplink
 */
/* add_filter('contextual_help_list','contextual_help_list_remove');

function contextual_help_list_remove(){
    global $current_screen;
    $current_screen->remove_help_tabs();
} */

/** Remove update link in sub-menu */
/* add_action( 'admin_menu', 'control_menu_items_shown' );
function control_menu_items_shown() {
    remove_submenu_page( 'index.php', 'update-core.php' );
} */

/** Remove Sitehealth link in sub-menu */
add_action( 'admin_menu', 'remove_menu_and_submenu', 999 );
function remove_menu_and_submenu() {
    remove_submenu_page( 'tools.php', 'site-health.php' );
    remove_submenu_page('woocommerce', 'ua-quanity-plus-minus-button');
    remove_submenu_page('woocommerce', 'wc-admin');
    remove_submenu_page('woocommerce', 'wc-admin&path=/customers');
    remove_submenu_page('woocommerce', 'wc-status');
    remove_submenu_page('woocommerce', 'wc-addons');
    remove_menu_page( 'plugins.php' );
    remove_menu_page( 'ultraaddons' );
    remove_menu_page('getwooplugins');

}

/** Show menu init */
/* add_action( 'admin_init', 'check_debug_admin_menu' );

function check_debug_admin_menu() {

    echo '<pre>' . print_r( $GLOBALS[ 'submenu' ], TRUE) . '</pre>';
} */

/* Disable automatic WordPress plugin updates: */
/* add_filter( 'auto_update_plugin', '__return_false' ); */

/* Disable automatic WordPress theme updates: */
/* add_filter( 'auto_update_theme', '__return_false' );

// Disable core update emails
add_filter( 'auto_core_update_send_email', '__return_false' );

// Disable plugin update emails
add_filter( 'auto_plugin_update_send_email', '__return_false' );

// Disable theme update emails
add_filter( 'auto_theme_update_send_email', '__return_false' ); */

// hide update notifications
/* function remove_core_updates(){

    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);

}
add_filter('pre_site_transient_update_core','remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins','remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes','remove_core_updates'); //hide updates for all themes */

// Hide dashboard update notifications for all users
/* function kinsta_hide_update_nag() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
    
add_action('admin_menu','kinsta_hide_update_nag'); */

// Change footer-thankyou
/* function change_footer_admin () 
{
    echo '<span id="footer-thankyou">Thiết kế bởi <strong>Hòa Ngô</strong>';
}
 
add_filter('admin_footer_text', 'change_footer_admin'); */

// Change footer-thankyou
/* function hoango_hide_footer_vesion() {
    remove_filter( 'update_footer', 'core_update_footer' ); 
}

add_action( 'admin_menu', 'hoango_hide_footer_vesion' ); */

/** Remove Archive in archive page */
add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );


/** Disable Comment all WP */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
     
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
 
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
 
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
 
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

/** Remove admin notices */
add_action('in_admin_header', function () {
    remove_all_actions('admin_notices');
    remove_all_actions('all_admin_notices');
/*     add_action('admin_notices', function () {
      echo '<p>Chào mừng bạn đến với trang quản trị Ivy Mart!</p>';
    }); */
  }, 1000);

?>