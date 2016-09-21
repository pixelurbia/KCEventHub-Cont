
<body <?php body_class(); ?> >
	<div class="header">
<div class="header-container wow fadeInDown ">
			<?php $logo = get_field('logo', 'option'); 
			echo '<a class="logo" href="/home"><img src="'. $logo .'"></a>'; ?>
			
<span class="home-nav"><?php wp_nav_menu(array('container_class' => 'nav ','sort_column' => 'menu_order','theme_location' => 'main')); ?></span>
				<span class="user-info"> 
		            <?php 
		            $current_user = wp_get_current_user(); 
		            if(!is_user_logged_in()) { 
						echo '<span class="login-header">Login</span>';
						echo '	<div class="mobi-nav dark"></div>';
		                 } else {
		                 echo '<span><a href="'.wp_logout_url('$index.php').'">Logout</a></span>';
		                 echo '<a class="search"></a>';
		                 echo '	<div class="mobi-nav dark"></div>
								<div class="app-nav dark"></div>';
		                    } ?>
		                </span>
</div>
<div class="mobile-contain wow fadeInDown ">
			<?php 
			// $logo = get_field('logo', 'option'); 
			// echo '<a class="logo" href="/home"><img src="'. $logo .'"></a>'; ?>
			<span class="user-info"> 
		            <?php 
		            $current_user = wp_get_current_user(); 
		            if(!is_user_logged_in()) { 
						// echo '<span class="login-header">Login</span>';
						echo '	<div class="mobi-nav dark"></div>';
		                 } else {
		                 echo '<span><a href="'.wp_logout_url('$index.php').'">Logout</a></span>';
						echo '<a class="search"></a>';
		                 echo '	<div class="mobi-nav dark"></div>';
		                    } ?>

		                </span>
				<?php wp_nav_menu(array('container_class' => 'nav ','sort_column' => 'menu_order','theme_location' => 'main')); ?>
				
			
		</div>
<div class="form-container ">
	<h4 class="formName"></h4>
		<div class="mobi-nav"></div>
		<div class="app-nav"></div>
</div>
	
	</div>
		
	<?php 
		global $post;
		$slug = get_post( $post )->post_name;
		echo '<div class="page-slug">' .$slug .'</div>'; 
	?>