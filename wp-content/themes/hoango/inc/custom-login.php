<?php 


/**  */
add_action( 'login_enqueue_scripts', 'hoango_login_logo' );
function hoango_login_logo() { 
    $logo_link = get_template_directory_uri() . '/img/logo-ivy-hori.png';
    ?>
    <style type="text/css">
        .login {
            display: flex;
        }

        .login #login {
            padding: 20px 0px;
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: rgb(60 66 87 / 12%) 0px 7px 14px 0px, rgb(0 0 0 / 12%) 0px 3px 6px 0px;
        }

        .login #login #backtoblog a, 
        .login #login #nav a {
            color: #848687;
        }

        .login #login #backtoblog a:hover, 
        .login #login #nav a:hover {
            color: #9e7c0e;
        }

        #login h1 a, .login h1 a {
            background-image: url(<?php echo $logo_link; ?>);
            background-size: 250px 110px;
            background-repeat: no-repeat;
            background-position: center;
            height:150px;
            width:320px;
        }

        .login #login .message,
        .login #login #login_error  {
            border-radius: 4px;  
            margin: 0 20px;  
        }

        .login #login .message  {
            border-left: 4px solid #9e7c0e;
        }

        #loginform {
            border: none;
            box-shadow: none;
            border-radius: 10px;
        }

        .login #login label {
            margin-bottom: 5px;
            color: #848687;
        }

        .login #login input {border: 1px solid #dcdcde;padding: 3px 10px;}

        .login #login input:focus {
            outline: #9e7c0e;
            border-color: #9e7c0e;
            box-shadow: inset 0px 0px 0px 1px #9e7c0e;
        }

        #wp-submit {
            border-color: #9e7c0e;
            background: #9e7c0e;
        }

        #nav, #backtoblog {
            text-align: center;
        }
        
    </style>
<?php }

/** Change logo url */
function wpb_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'wpb_login_logo_url' );

/**Change logo title */
function wpb_login_logo_url_title() {
    return 'Ivy Mart';
}
add_filter( 'login_headertitle', 'wpb_login_logo_url_title' );

/** Remove language change in login page */
add_filter( 'login_display_language_dropdown', '__return_false' );

?>