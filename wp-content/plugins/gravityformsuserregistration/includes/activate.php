<!DOCTYPE HTML>
<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie8" lang="en"><![endif]--> 
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>
    <title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php 
        $fc = get_field('favicon', 'option'); 
        $fc
    ?>
    <link rel="shortcut icon" href="<?php echo $fc ?>"/>
    <link rel="icon" type="image/x-icon" href="<?php echo $fc ?>" />

    <!-- Add jQuery library and UI -->
    <script src="//code.jquery.com/jquery-1.11.0.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,800,700,600,300' rel='stylesheet' type='text/css'>
    <?php wp_head(); ?>

    <!--[if IE 8]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/ie8.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js"></script>
    <![endif]-->
    <!--[if gte IE 10]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/wow.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/master.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js"></script>
    <![endif]-->
    <!--[if gte IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/wow.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/master.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <![endif]-->
    <!--[if !IE]><!-->
    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/wow.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/master.js"></script>
    <!--<![endif]-->

</head>
<div class="login-form-box  wow fadeInDown">
<!-- login form so I can access it any where mainly for the popup-->
    <?php 
    echo '<span class="login-header close">X</span>';
    wp_login_form(); 
    echo '<a class="register" href="/register/">Need an Account? Register Today!</a> ';?>
</div>
<div class="master-overlay"></div>

<body <?php body_class(); ?> >
    <div class="header">
        <div class="header-container wow fadeInDown ">
            <?php $logo = get_field('logo', 'option'); 
            echo '<a class="logo" href="/home"><img src="'. $logo .'"></a>'; ?>
            
            <span class="home-nav">
            <?php wp_nav_menu(array('container_class' => 'nav ','sort_column' => 'menu_order','theme_location' => 'main')); ?></span>
                <span class="user-info"> 
                    <?php 
                    $current_user = wp_get_current_user(); 
                    if(!is_user_logged_in()) { 
                        echo '<a  href="/register/">Register |</a> ';
                        echo ' <a class="login-header">Login</a>';
                         } else {
                         echo '<span class="logout"><a href="/events">My Events | </a><a href="'.wp_logout_url('$index.php').'">Logout</a></span>';
                         echo '<a class="search"></a>';
                         get_template_part('templates/searchbox');
                                echo '<a class="lines-button mobile x" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>';
                                echo '<a class="lines-button form  form-head x" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>';
                            } ?>
                        </span>
        </div>
        <div class="mobile-contain wow fadeInDown ">
            <span class="user-info"> 
                    <?php 
                    $current_user = wp_get_current_user(); 
                    if(!is_user_logged_in()) { 

                        echo '<a class="lines-button mobile x close" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>';
                         } else {
                        echo '<a class="lines-button mobile x close" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>';
                            } ?>

                        </span>
                <?php wp_nav_menu(array('container_class' => 'nav ','sort_column' => 'menu_order','theme_location' => 'mobile')); ?>
            
        </div>
<div class="form-container ">
    <h4 class="formName"></h4>
    <a class="lines-button mobile x mobile-form" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>
    <a class="lines-button form hide-m x" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>
</div>
    
    </div> 
        
    <?php 
        global $post;
        $slug = get_post( $post )->post_name;
        echo '<div class="page-slug">' .$slug .'</div>'; 
    ?>


<div class="single">
  <div class="row">             
    <div class="contentwrap"> 

<?php

define( 'WP_INSTALLING', true );

global $current_site;

// include GF User Registration functionality
require_once(GFUser::get_base_path() . '/includes/signups.php');

GFUserSignups::prep_signups_functionality();

do_action( 'activate_header' );

function do_activate_header() {
    do_action( 'activate_wp_head' );
}
add_action( 'wp_head', 'do_activate_header' );

function wpmu_activate_stylesheet() {
    ?>
    <style type="text/css">
        h1 a {color:#a9a9a9!important;}
        form { margin-top: 2em; }
        #submit, #key { width: 90%; font-size: 24px; }
        #language { margin-top: .5em; }
        .error { background: #f66; }
        span.h3 { padding: 0 8px; font-size: 1.3em; font-family: "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif; font-weight: bold; color: #333; }
    </style>
    <?php
}
add_action( 'wp_head', 'wpmu_activate_stylesheet' );

get_header(); ?>

<div id="content" class="widecolumn">
    <?php if ( empty($_GET['key']) && empty($_POST['key']) ) { ?>

        <h2><?php _e('Activation Key Required') ?></h2>
        <form name="activateform" id="activateform" method="post" action="<?php echo network_site_url('/'); ?>">
            <p>
                <label for="key"><?php _e('Activation Key:') ?></label>
                <br /><input type="text" name="key" id="key" value="" size="50" />
            </p>
            <p class="submit">
                <input id="submit" type="submit" name="Submit" class="submit" value="<?php esc_attr_e('Activate') ?>" />
            </p>
        </form>

    <?php } else {

            $key = !empty($_GET['key']) ? $_GET['key'] : $_POST['key'];
            $result = GFUserSignups::activate_signup($key);
        if ( is_wp_error($result) ) {
            if ( 'already_active' == $result->get_error_code() || 'blog_taken' == $result->get_error_code() ) {
                $signup = $result->get_error_data();
                print "<script language='Javascript'>document.location.href='localhost:8888/?thanks=Ver';</script>";
                ?>
                <h2><?php _e('Your account is now active!'); ?></h2>

                <?php
                echo '<p class="lead-in">';
                if ( $signup->domain . $signup->path == '' ) {
                    printf( __('Your account has been activated. You may now <a class="login-header">Login</a> to the site using your chosen username of &#8220;%2$s&#8221;. Please check your email inbox at %3$s for your password and login instructions. If you do not receive an email, please check your junk or spam folder. If you still do not receive an email within an hour, you can <a href="%4$s">reset your password</a>.'), network_site_url( 'wp-login.php', 'login' ), $signup->user_login, $signup->user_email, network_site_url( 'wp-login.php?action=lostpassword', 'login' ) );
                } else {
                    printf( __('Your site at <a href="%1$s">%2$s</a> is active. You may now log in to your site using your chosen username of &#8220;%3$s&#8221;. Please check your email inbox at %4$s for your password and login instructions. If you do not receive an email, please check your junk or spam folder. If you still do not receive an email within an hour, you can <a href="%5$s">reset your password</a>.'), 'http://' . $signup->domain, $signup->domain, $signup->user_login, $signup->user_email, network_site_url( 'wp-login.php?action=lostpassword' ) );
                }
                echo '</p>';
            } else {
                ?>
                <h2><?php _e('An error occurred during the activation'); ?></h2>
                <?php
                echo '<p>'.$result->get_error_message().'</p>';
            }
        } else {
            extract($result);
            $url = is_multisite() ? get_blogaddress_by_id( (int) $blog_id) : home_url('', 'http');
            $user = new WP_User( (int) $user_id);
            print "<script language='Javascript'>document.location.href='localhost:8888/?thanks=Ver';</script>";
            ?>
            <h2><?php _e('Your account is now active!'); ?></h2>

            <div id="signup-welcome">
                <p><span class="h3"><?php _e('Username:'); ?></span> <?php echo $user->user_login ?></p>
                <p><span class="h3"><?php _e('Password:'); ?></span> <?php echo $password; ?></p>
            </div>
            
            <?php if ( $url != network_home_url('', 'http') ) : ?>
                <p class="view"><?php echo 'Your account is now activated. You can now <a class="login-header">Login</a>'?></p>
            <?php else: ?>

            <?php endif;
        }
    }
    ?>
</div>
<script type="text/javascript">
    var key_input = document.getElementById('key');
    key_input && key_input.focus();
</script>

 </div><!--contentwrap-->
  </div>
</div>
<div class="footer">

    <a class="kcmo-logo"></a>
    <div class="copyright">
    <?php echo date("Y"); ?> &copy; <a href="http://kcmo.gov">kcmo.gov</a>
    <a class="link">Privacy Policy</a>
    <a class="link">Terms of Use</a>
    </div>
<?php wp_footer(); ?>
</div>
</body>
</html>
