<?php
/*
Template Name: Form Page no steps
*/
?>

<?php get_template_part('templates/header'); ?>
<script type="text/javascript">
    $(document).ready(function() { 
        $('.header').addClass('form');
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
</script>

<div class="content-wrap form-pages no-steps wow fadeInLeft">
    <div class="row bo">
            <div class="sidebar formNav">
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
                } else { ?>
           


                <?php
                    the_content(); 
                } ?>

                <?php endwhile; ?>
            </section>
        
    </div>
</div>

<?php get_template_part('templates/footer'); ?>