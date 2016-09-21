<?php
/*
Template Name: Resources
*/
?>

<?php get_template_part('templates/header'); ?>
<div class="single">
  <div class="row">             
    <div class="contentwrap">
      <h1><?php the_title(); ?></h1>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div><!--contentwrap-->
<?php 
$catquery =  new WP_Query(array(
  'post_type' => 'resources',
  'posts_per_page' => 9999,
  'order'=>'ASC'
) ); 
?>
<?php while ( $catquery->have_posts() ) : $catquery->the_post(); ?>
  <div class="resource">
    <div class="download">
      <h3><?php the_title(); ?></h3>
      <?php 
      $file = get_field('resource_file'); 
      echo '<a target="_blank" href="'. $file .'"></a>';
      echo '<ul>';
      $dept = get_field('department');
      $cont = get_field('contact');
      $dl = get_field('deadline');
      echo '<li>Department: '. $dept .'</li>';
      echo '<li>Contact: '.$cont .'</li>';
      echo '<li>Deadline: '. $dl.'</li>';
      echo '</ul>';
      ?>

 

    </div><!--question-->
  </div><!--faq-box-->
  <?php wp_reset_query(); ?>
<?php endwhile; ?>

<ul class="permit-contact">
<h4>KC Film & Media</h4>
<li>Stephane Scupham  </li>
<li>816-691-3842  </li>
<li>Varies by event</li>
</ul>
 
<ul class="permit-contact">
<h4>KC Fire Department </h4>
<li>EMS Services  </li>
<li>816-784-9100  </li>
<li>60 days prior</li>
</ul>
 
<ul class="permit-contact">
<h4>KC Fire Department </h4>
<li>Tents & Canopies  </li>
<li>816-784-9200  </li>
<li>60 days prior</li>
</ul>

<ul class="permit-contact">
<h4>KC Police Dept. Off-Duty Staffing </h4>
<li>Matt Masters  </li>
<li>816-234-5388  </li>
<li>30 days prior</li>
</ul>
 
<ul class="permit-contact">
<h4>KC Police Dept., Streets & Traffic </h4>
<li>Kevin Gooch </li>
<li>816-329-0911  </li>
<li>30 days prior</li>
</ul>
 
<ul class="permit-contact">
<h4>Parks Department</h4>
<li>Use and concession agreements</li>
<li>816-513-7500  </li>
<li>60 days prior</li>
</ul>
  </div>
</div>
<?php get_template_part('templates/footer'); ?>