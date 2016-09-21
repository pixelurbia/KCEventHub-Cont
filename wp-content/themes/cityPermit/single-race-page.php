<?php
/*
Template Name: Single Races Page
*/
?>


<?php get_template_part('templates/header'); ?>
<div class="single single-event">
  <div class="row">             
    <div class="contentwrap">
	<?php 
		$raceID = $_GET['raceid'];
		$raceTitle = $_GET['title']; 
		// var_dump($raceID);
	?>

<?php
	// $mydb = new wpdb('root','root','racekc','localhost'); //dev
	$mydb = new wpdb('racekc','2ZW2GvtKEbCqNtsM','racekc','betadb1');
	$mydb->query('SET SESSION group_concat_max_len = 100000');
	$races = $mydb->get_results("SELECT meta_value, GROUP_CONCAT(meta_value) as metaval FROM wp_postmeta WHERE post_id = $raceID ");

foreach ($races as $race ) {
	$race = get_object_vars($race);
			$r = $race['metaval']; 
			$r = explode(',',$r);
			$img = $r['30'];
			// $mydb = new wpdb('root','root','racekc','localhost'); //dev
			$mydb = new wpdb('racekc','2ZW2GvtKEbCqNtsM','racekc','betadb1');
			$images = $mydb->get_results("SELECT meta_value, GROUP_CONCAT(meta_value) as metayul FROM wp_postmeta WHERE post_id = $img");
			foreach ($images as $image ) {
				$im = get_object_vars($image); 
				$imt = $im['metayul']; 
				$ime = explode(',',$imt);
				
				echo '<div class="map-contain">';
				echo '<a target="_blank" href="http://kcraceday.org/wp-content/uploads/'.$ime[0].'"><img src="http://kcraceday.org/wp-content/uploads/'.$ime[0].'"></a>';
				echo '</div>';
			}
				echo '<div class="img-contain">';
				echo '<div class="img-cover"></div>';
				echo '<h1>'. $raceTitle .'</h1>';
				echo '<div class="raceimg"></div>';
				echo '</div>';
			

 				$entryY = substr($r['10'], 0, 4);
                $entryM = substr($r['10'], 4, 2);
                $entryD = substr($r['10'], 6, 2);
				// var_dump($r);
				echo'<ul><br>';
				if ( $r['2'] == '0' || $r['2'] == '1') {

					echo '<li><h2>Location: '.$r['4'].'</h2> <a href="https://www.google.com/maps/place/'.$r['4'].'" target="_blank">Directions</a></li>';
					echo '<h3>Race Stats</h3>';
					echo '<li>Length: '.$r['5'].'</li>';
					echo '<li>Start time: '.$r['8'].'</li>';
					echo '<li>End time: '.$r['8'].'</li>';
					echo '<li>Date: '.$entryY.'-'.$entryD.'-'.$entryM.'</li>';
					echo '<li>Beneficiary: '.$r['14'].'</li>';
					echo '<li>Day of event Phone: '.$r['17'].'</li>';
					echo '<li>Day of event contact: '.$r['19'].'</li>';
					echo '<li>Race Director Name: '.$r['21'].'</li>';
					echo '<li>Race Director Email:'.$r['23'].'</li>';
					echo '<li>No. of Participants: '.$r['25'].'</li>';
					echo '<li>Race Website: <a target="_blank" href='.$r['27'].'>'.$r['27'].'</a></li>';
					echo '<li><h3>Race Route: </h3></li>';
					echo '<li>'.$r['33'].'</li>';
					echo '<li><h3>About:</h3></li>';
					echo '<li>'.$r['36'].''.$r['37'].''.$r['38'].''.$r['39'].'</li>';

				} else {

				echo '<li><h2>Location: '.$r['2'].'</h2> <a href="https://www.google.com/maps/place/'.$r['2'].'" target="_blank">Directions</a></li>';
				echo '<h3>Race Stats</h3>';
				echo '<li>Length: '.$r['4'].'</li>';
				echo '<li>Start time: '.$r['5'].'</li>';
				echo '<li>End time: '.$r['8'].'</li>';
				echo '<li>Date: '.$entryY.'-'.$entryD.'-'.$entryM.'</li>';
				echo '<li>Beneficiary: '.$r['14'].'</li>';
				echo '<li>Day of event Phone: '.$r['16'].'</li>';
				echo '<li>Day of event contact: '.$r['18'].'</li>';
				echo '<li>Race Director Name: '.$r['20'].'</li>';
				echo '<li>Race Director Email:'.$r['22'].'</li>';
				echo '<li>No. of Participants: '.$r['24'].'</li>';
				echo '<li>Race Website: <a target="_blank" href='.$r['26'].'>'.$r['26'].'</a></li>';
				echo '<li><h3>Race Route: </h3></li>';
				echo '<li>'.$r['34'].'</li>';
				echo '<li><h3>About:</h3></li>';
				echo '<li>'.$r['36'].''.$r['37'].''.$r['38'].''.$r['39'].'</li>';

				}



	// $text = explode(" ", $race[,]);
echo'</ul>';
	// var_dump($text);

	// $race = explode(" ", $pizza);
}
 

 ?>
 
      

    </div><!--contentwrap-->
  </div>
</div>
<?php get_template_part('templates/footer'); ?>