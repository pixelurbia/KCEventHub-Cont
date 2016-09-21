<?php
/*
Template Name: Search
*/
?>

<?php get_template_part('templates/header'); ?>
<div class="single events-page ">
  <div class="row">             
    <div class="contentwrap">

<h1>Search Results</h1>

<div class="postlist">

<?php if ( have_posts() ) : ?>

<?php while ( have_posts() ) : the_post();

echo '<div class="box event">';
?>

          <div class="thecontent">
          <h3><?php the_title(); ?></h3>
           <h5 class="tax "><?php the_taxonomies( ' ' ,' ', ' '  ); ?><h5>


          <p class="content"><?php the_excerpt(); ?></p>
        <?php if( get_field('download_manual') ): ?>
          <a href="<?php the_field('download_manual'); ?>" >Download Manual</a>
        <?php endif; ?>

<br>
<a href="<?php the_permalink(); ?>" > Read More</a>
          </div>
          </div>
        
      <?php endwhile; ?>

<?php else : ?>
  <br>
  <br>
  <br>
<h4> No results found </h4>
<?php endif; ?>
</div>
</div>


  </div><!--faq-box-->
  </div>
</div>
<?php get_template_part('templates/footer'); ?>