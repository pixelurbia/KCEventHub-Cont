<?php
/*
Template Name: Single Custom Events
*/
?>


<?php get_template_part('templates/header'); ?>
<div class="single single-event">
  <div class="row">             
    <div class="contentwrap">
	<?php
			
				echo '<div class="img-contain">';
				echo '<div class="img-cover"></div>';
				$title = get_the_title();
				 while ( have_posts() ) : the_post();
				echo '<h1>'. $title .'</h1>';
				$image = get_field('event_image');
				echo '<img src="'.$image.'">';
				echo '</div>';
			

				echo'<ul><br>';

$enddate = DateTime::createFromFormat('Ymd', get_field('start_date'));
$startdate = DateTime::createFromFormat('Ymd', get_field('end_date'));
$location = get_field('location');
$planner = get_field('event_planner');
$phone = get_field('event_phone');
$email = get_field('event_email');

echo '<li><h2>Location:'. $location .'</h2><a href="https://www.google.com/maps/place/'. $location .'" target="_blank">Directions</a></li>';
echo '<h3>Event Details</h3>';
echo '<li>Dates: '. $startdate->format('d/m/y') .' to '. $enddate->format('d/m/y') .'</li>';
echo '<li>Event Planner: '. $planner .'</li>';
echo '<li>Event Planner Phone: '.$phone.'</li>';
echo '<li>Event Planner Email: '. $email .'</li><br><br>';


echo '<li>'. the_content() .'</li>';



echo'</ul>';


 ?>
 
      <?php endwhile; ?>

    </div><!--contentwrap-->
  </div>
</div>
<?php get_template_part('templates/footer'); ?>