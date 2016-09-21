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

