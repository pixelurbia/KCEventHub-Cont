<?php
/*
Template Name: Form Page no steps
*/
?>

<?php get_template_part('templates/header'); ?>
<script type="text/javascript">
    $(document).ready(function() { 
        $('.header').addClass('form');
    });
</script>

<div class="content-wrap form-pages no-steps wow fadeInLeft">
    <div class="row bo">
            <div class="sidebar formNav">
            </div>
           <section>
                <?php while ( have_posts() ) : the_post(); ?>

                <?php     
                if(!is_user_logged_in()) {
                    echo '<div class="gform_title hide">Login</div>';
                    echo '<h5 class="login-notice">Hey there! You need to login before you can see this content!</h5>';
                    wp_login_form(); 
                    echo '<a class="register" href="/register/">Need an Account? Register Today!</a> ';

                } else {
                    the_content(); 
                } ?>

                <?php endwhile; ?>
            </section>
        
    </div>
</div>

<?php get_template_part('templates/footer'); ?>