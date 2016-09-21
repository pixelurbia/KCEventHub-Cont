<?php
/*
Template Name: Register
*/
?>

<?php get_template_part('templates/header'); ?>
<script type="text/javascript">
    $(document).ready(function() { 
        $('.header').addClass('form');
    });
</script>

<div class="content-wrap form-pages register no-steps wow fadeInLeft">
    <div class="row bo">
            <div class="sidebar formNav">
            </div>
           <section>
                <?php while ( have_posts() ) : the_post(); ?>
<blockquote>
Special events help build a sense of belonging and community pride. This online event site was designed to help event planners bring people together in Kansas City safely and successfully in both city-wide and neighborhood events.
<br>
Sign in or create your account to get started on your event permits today!
</blockquote>
                <?php     
                    the_content(); 
                     ?>

                <?php endwhile; ?>
            </section>
        
    </div>
</div>

<?php get_template_part('templates/footer'); ?>