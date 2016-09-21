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
	<meta name="google-site-verification" content="_zkFo6lXB944rDuOoknwmwzuDec-5Kh92M329a5P-AY" />
	
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
<div class="login-form-box wow animated fadeInDown">
<span class="login-header close">X</span>
<!-- login form so I can access it any where mainly for the popup-->
	<?php get_template_part('templates/loginform'); ?>
</div>
<div class="master-overlay"></div>

<body <?php body_class(); ?> >

	<div class="header">

	<div class="searchbox">
		<?php get_template_part('templates/searchbox'); ?>		
	</div>



		<div class="header-container ">
			<?php $logo = get_field('logo', 'option'); 
			echo '<a class="logo" href="/home"><img src="'. $logo .'"></a>'; ?>
			
			<span class="home-nav">
			<?php wp_nav_menu(array('container_class' => 'nav ','sort_column' => 'menu_order','theme_location' => 'main')); ?></span>
				<span class="user-info"> 
<?php 		                 	

global $current_user, $wpdb;
$role = $wpdb->prefix . 'capabilities';
$current_user->role = array_keys($current_user->$role);
$role = $current_user->role[0];
$cnt = aiosc_TicketManager::count_new_tickets();
if($cnt > 0) {
            $args = array(
                'id'    => 'aiosc',
                'title' => '<span class="ab-icon" title="'.sprintf(__('You have %d new tickets in Queue','aiosc'),$cnt).'"></span><span class="ab-label">'.$cnt.'</span>',
                'href'  => aiosc_get_page_ticket_list(false,array('status'=>'queue')),
                'meta'  => array( 'class' => 'menupop' )
            );
        }
		            $current_user = wp_get_current_user(); 
		            if(!is_user_logged_in()) { 
						echo '<a  href="/register/">Register |</a> ';
						echo ' <a class="login-header">Login</a>';
		                 } else {
						echo '<div class="profile">';	
						echo '<span class="name">'.$current_user->user_firstname.'</span>';
		                echo '<span class="profile-arrow"></span>';
		                echo '<ul class="prof-nav">
						<li><a href="/events">My Events</a></li>
						<li><a href="/tickets">My Support Tickets</a></li>
						<li><a href="/new-ticket">New Support Ticket</a></li>';

if ($role == 'administrator') {

	echo '<li><a href="/wp-admin">Admin Dashboard</a></li>
	<li><a  href="/department-page">Permit Reporting</a></li>';
	    echo '<li><a href="'.$args['href'].'""> Review tickets</a></li>';

} elseif ( $role == 'department') {	
	echo '<li><a  href="/department-page">Permit Reporting</a></li>';
}
						echo '<li><a href="'.wp_logout_url('$index.php').'">Logout</a></li>';
		                echo '</div>';

		                  
		                 echo '<a class="search search-box"></a>';
		                 
								echo '<a class="lines-button mobile x" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>';
								echo '<a class="lines-button form  form-head x" type="button" role="button" aria-label="Toggle Navigation"><span class="lines"></span></a>';
		                    } ?>
		                </span>
		</div>
		<div class="mobile-contain  ">
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

			$thanks = $_GET['thanks'];
			$login = $_GET['login'];
			define( 'WP_INSTALLING', true );

			//active user
			global $current_site;
			// include GF User Registration functionality
			require_once(GFUser::get_base_path() . '/includes/signups.php');
			GFUserSignups::prep_signups_functionality();
		 	$key = !empty($_GET['key']) ? $_GET['key'] : $_POST['key'];
            $result = GFUserSignups::activate_signup($key);

	if ($login == 'failed') {

    echo '<div class="notification wow fadeInDown" style="padding: 3%; z-index:99999999; background: #498fe1; float: left; width: 75%; position: absolute; font-size: 23px; text-align: center; border-radius: 5px; left: 0; right: 0; margin: 4% auto; color: white; opacity: 0.9;"> Login Failure. <br> The entered username or password do not match our records. <a href="/password-reset/">Recover password?</a> </div>';
}		if ($thanks == 'Reg') {

    echo '<div class="notification wow fadeInDown" style="padding: 3%; z-index:99999999; background: #498fe1; float: left; width: 75%; position: absolute; font-size: 23px; text-align: center; border-radius: 5px; left: 0; right: 0; margin: 4% auto; color: white; opacity: 0.9;"> Congratulations! Registration has been successful! <br> Verfification link has been emailed to you! </div>';
}	if ($thanks == 'Ver') {

    echo '<div class="notification wow fadeInDown" style="padding: 3%; z-index:99999999; background: #498fe1; float: left; width: 75%; position: absolute; font-size: 23px; text-align: center; border-radius: 5px; left: 0; right: 0; margin: 4% auto; color: white; opacity: 0.9;"> E-mail has been verified! <br> You can now login! </div>';
}
	?>

