<?php
/*
Template Name: Form Page
*/
?>

<?php 
get_template_part('templates/header'); 

  
  $user = wp_get_current_user();
  $user = $user->user_nicename;
  // $shuffled = str_shuffle($user);

  for ($i = -1; $i <= 4; $i++) {
    $bytes = openssl_random_pseudo_bytes($i, $cstrong);
    $hex   = bin2hex($bytes);       
  }
    $hex = $user .'-'. $hex; 
    echo '<div class="hex hide" value="'. $hex .'"></div>';
  $dupe = $_GET['duplicate'];
  if( $dupe == 'Yes') { ?>
    <script type="text/javascript">
        $(document).ready(function() { 
          // alert('working');
        $('.event-name').removeClass('hide');

        var hex = $('.hex').attr('value');
        $('.uniKeyDupe input').attr('value', hex);

         var warning = true;
                window.onbeforeunload = function() { 
                if (warning) {
                    return "You have made changes on this page that you have not yet confirmed. If you navigate away from this page you will lose your unsaved changes";
                }
                }
                
                    $('form').submit(function() {
                    window.onbeforeunload = null;
                    });

       });

           $(document).ready(function() { 
                        $('.header').addClass('form');
                    });
           
    </script>
<?php } //end if ?>
<script type="text/javascript">
    $(document).ready(function() { 
        $('.header').addClass('form');

    });
</script>
<div class="content-wrap form-pages jq wow fadeInLeft">
    <div class="row bo">
    <div class="save-area hide">
    <div class="formone"></div>
    <div class="formtwo"></div>
    <div class="formthree"></div>
    <div class="formfour"></div>
    <!-- so, gravity forms does not have the edit feature on its own, I am using parts of a plugin to make it work and for some reason on multipage forms the upload feature does not work on edits. this fxies that -->

    </div>
            <div class="sidebar formNav">
            	<div class="sidebar-inner"></div>
            </div>
           <section>
                <?php while ( have_posts() ) : the_post(); ?>

				<?php     
				if(!is_user_logged_in()) {
					    echo '<h5 class="login-notice">Please login to view this content</h5>';
                    get_template_part('templates/loginform');
                    echo '<script>
                    $(document).ready(function() {
                      $(".formName").text("Login");
                    });
                    </script>';
              	} else {
                  ?>



                <?php
              		$ueID= $_GET['update_entry_id'];
					echo '<div class="updateEntry" value="'.$ueID.'"></div>';
              		the_content(); 
              	} ?>

                <?php endwhile; ?>
            </section>
        
    </div>
</div>

<?php get_template_part('templates/footer'); ?>