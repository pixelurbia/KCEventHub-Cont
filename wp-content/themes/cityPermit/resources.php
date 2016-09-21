<?php
/*
Template Name: Resources
*/
?>

<?php get_template_part('templates/header'); ?>
<div class="single support-page">
  <div class="row">             
    <div class="contentwrap">
      <h1><?php the_title(); ?></h1>  
      <div class="resource-filter">
        <p>Please choose one of the following resources you would like to view:
        <br>If you need additional support <a href="/new-ticket">Open a support ticket.</a></p>
      <h5 value="permits" class="live">Permits | </h5> 
      <h5 value="instructions" class="opaq">Instructions | </h5> 
      <h5 value="departments" class="opaq">Departments | </h5>
        <h5 value="other" class="opaq">Other </h5>  
        </div>
      <br>
      <br>
    </div><!--contentwrap-->
    <div class="permits res-type wow fadeInRight">
    <?php 
    $catquery =  new WP_Query(array(
      'post_type' => 'resources',
      'taxonomy' => 'resources_category',
      'term' => 'permits',
      'posts_per_page' => 9999,
      'order'=>'ASC',
      'orderby'=>'title'
    ) ); 
    ?>
    <?php while ( $catquery->have_posts() ) : $catquery->the_post(); ?>
      <div class="resource">
        <div class="download">
          <h3><?php the_title(); ?></h3>
          <?php 
          $file = get_field('resource_file'); 
          $linkOut = get_field('resource_link');
          if (!empty($linkOut)){
            echo '<a target="_blank" href="'. $linkOut .'"></a>';
         } else {
          echo '<a target="_blank" href="'. $file .'"></a>';
         }
          
          echo '<ul>';
          $dept = get_field('department');
          $cont = get_field('contact');
          $dl = get_field('deadline');
          echo '<li>Department: '. $dept .'</li>';
          echo '<li>Contact: '.$cont .'</li>';
          echo '<li>Deadline: '. $dl.'</li>';
          echo '</ul>';
          ?>
        </div>
      </div>
      <?php wp_reset_query(); ?>
    <?php endwhile; ?>
</div>
<div class="instructions res-type wow fadeInRight hide">
<?php 
      $instructions =  new WP_Query(array(
        'post_type' => 'resources',
        'taxonomy' => 'resources_category',
        'term' => 'instructions',
        'posts_per_page' => 9999,
        'order'=>'ASC',
        'orderby'=>'title'
      ) ); 
      ?>
      <?php while ( $instructions->have_posts() ) : $instructions->the_post(); ?>
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
            // echo '<li>Department: '. $dept .'</li>';
            // echo '<li>Contact: '.$cont .'</li>';
            // echo '<li>Deadline: '. $dl.'</li>';
            echo '</ul>';
            ?>
</div>
</div>
        <?php wp_reset_query(); ?>
      <?php endwhile; ?>
</div>
<div class="other res-type wow fadeInRight hide">
  <?php 
      $other =  new WP_Query(array(
        'post_type' => 'resources',
        'taxonomy' => 'resources_category',
        'term' => 'other',
        'posts_per_page' => 9999,
        'order'=>'ASC',
        'orderby'=>'title'
      ) ); 
      ?>
      <?php while ( $other->have_posts() ) : $other->the_post(); ?>
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
            // echo '<li>Department: '. $dept .'</li>';
            // echo '<li>Contact: '.$cont .'</li>';
            // echo '<li>Deadline: '. $dl.'</li>';
            echo '</ul>';
            ?>
</div>
</div>
        <?php wp_reset_query(); ?>
      <?php endwhile; ?>
</div>
<div class="departments res-type wow fadeInRight hide">
      <?php 
      $contacts =  new WP_Query(array(
        'post_type' => 'resources',
        'taxonomy' => 'resources_category',
        'term' => 'contacts',
        'posts_per_page' => 9999,
        'order'=>'ASC',
        'orderby'=>'title'
      ) ); 
      ?>
      <?php while ( $contacts->have_posts() ) : $contacts->the_post(); ?>
        <div class="contact">

             <h3><?php the_title(); ?></h3>
            <?php 
            echo '<ul>';
            $dept = get_field('name_of_contact');
            $cont = get_field('contact_method');
            $dl = get_field('deadline');
            echo '<li>Contact: '. $dept .'</li>';
            echo '<li>Address: '.$cont .'</li>';
            echo '<li>Phone: '. $dl.'</li>';
            echo '</ul>';
            ?>

        </div>
        <?php wp_reset_query(); ?>
      <?php endwhile; ?>

</div>

  </div>

</div>
<?php get_template_part('templates/footer'); ?>