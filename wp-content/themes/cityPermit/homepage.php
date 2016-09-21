<?php
/*
Template Name: Home Page
*/
?>


<?php get_template_part('templates/header'); ?>

<div class="content-wrap wow fadeInLeft">
    <div class="row bo">    
         
              <?php 
            $featImg = get_field('featured_image'); 
            echo '<section class="hero" style="background:url('. $featImg .')">';
                ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="home-overlay">
                        <?php the_content(); ?>
                        <a href="/event-type/"class="btn mauto">Apply Now</a>
                    </div>

                <?php endwhile; ?>
            </section>
            <div class="sidebar">
                        <?php get_template_part('templates/common-sidebar'); ?>
            </div>
    </div>
</div>

<?php get_template_part('templates/footer'); ?>