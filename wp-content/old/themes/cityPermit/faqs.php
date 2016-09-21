<?php
/*
Template Name: FAQs
*/
?>

<?php get_template_part('templates/header'); ?>
<div class="faq single wow fadeInLeft">
  <div class="row">             
    <div class="contentwrap">
      <h1><?php the_title(); ?></h1>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div><!--contentwrap-->
<?php 
$catquery =  new WP_Query(array(
  'post_type' => 'faqs',
  'posts_per_page' => 9999,
  'order'=>'ASC'
) ); 
?>
<?php while ( $catquery->have_posts() ) : $catquery->the_post(); ?>
  <div class="faq-box">
    <div class="question" id='<?php echo get_the_slug(); ?>'>
      <h3>Q: <?php the_title(); ?></h3>
        <div class="answer">
          <?php the_content(); ?>
        </div><!--answer-->
    </div><!--question-->
  </div><!--faq-box-->
  <?php wp_reset_query(); ?>
<?php endwhile; ?>
  </div>
</div>
<?php get_template_part('templates/footer'); ?>