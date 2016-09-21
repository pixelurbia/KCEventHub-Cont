<?php
/*
Template Name: Single Events Page
*/
?>


<?php get_template_part('templates/header'); ?>
<div class="single single-event">
  <div class="row">             
    <div class="contentwrap">
	<?php 
		$entryID = $_GET['entryID'];
		// $raceTitle = $_GET['title']; 
	?>

<?php
global $wpdb;
$entries = $wpdb->get_results("SELECT * FROM event_key WHERE entry_id = $entryID");
                        $eventArray = array();

                        foreach($entries as $entry){
                            $eventID = $entry->event_id;
                            $entryID = $entry->entry_id;
                            $eventType = $entry->event_type;
                            $formID = $entry->form_id;
                            $eventName = $entry->event_name;
                            $slug = $entry->form_page;
                            $formName = $entry->form_name;
                            $alcServ = $entry->alc_served;
                            $alcWho = $entry->alc_who_serv;
                            $nonProfit = $entry->non_profit;
                            $liqLic = $entry->liquor_licence;
                            $fPermit = $entry->food_permit;
                            $dPermit = $entry->dance_permit;
                            $nPermit = $entry->noise_permit;
                            $dateSub = $entry->date_submited;
                            $aPermit = $entry->animal_permit;
                            $park_permit = $entry->park_permit;
                            $fire_permit = $entry->fire_permit;
                            $ems_permit = $entry->ems_permit;
                            $traffic_permit = $entry->traffic_permit;
                            $admission = $entry->admission;
                            $event_status = $entry->event_status;
                            $is_child = $entry->is_child;
                            $location = $entry->location;
                            $event_date = $entry->event_date;
 							$address = $entry->address;
 							$addresstwo = $entry->addresstwo;
 							$state = $entry->state;
 							$city = $entry->city;
 							$zip = $entry->zip;
 							$first_name = $entry->first_name;
 							$last_name = $entry->last_name;
 							$email = $entry->email;
 							$phone = $entry->phone;
 							$description = $entry->description;
 							$image = $entry->event_image;

			
				echo '<div class="img-contain">';
				echo '<div class="img-cover"></div>';
				echo '<h1>'. $eventName .'</h1>';
				echo '<img src="'.$image.'">';
				echo '</div>';
			
                $entryY = substr($event_date, 0, 4);
                $entryM = substr($event_date, 5, 2);
                $entryD = substr($event_date, 8, 2);


				echo'<ul><br>';
echo '<li><h2>Location: '.$location.'</h2> <a href="https://www.google.com/maps/place/'.$location.'" target="_blank">Directions</a></li>';
echo '<h3>Event Details</h3>';
echo '<li>Date: '.$entryY.'-'.$entryD.'-'.$entryM.'</li>';
echo '<li>Event Planner: '.$first_name.' '.$last_name.'</li>';
echo '<li>Event Planner Phone: '.$phone .'</li>';
echo '<li>Event Planner Email: '.$email .'</li>';


echo '<li>'.$description.'</li>';


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