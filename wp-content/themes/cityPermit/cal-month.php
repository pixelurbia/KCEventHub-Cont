<?php
/*
Template Name: cal-month
*/

get_template_part('templates/header'); ?>

<div class="single events-page calendar-page ">
    <div class="row bo">
        <div class="contentwrap">
        <div class="events-col">
<?php        
 					$title = get_the_title();
                    echo '<h1>'. $title .'</h1>';

                    ?>
             <ul class="cal-filter">
                <h5>Show me:</h5>
                <li value="1" ><i class="eventtype-filter1" ></i>Athletic/Recreation</li>
                <li value="2" ><i class="eventtype-filter2" ></i>Airt Fair/Museum/Special Atrraction</li>
                <li value="3" class="hide" ><i class="eventtype-filter3" ></i>Block Party</li>
                <li value="4" ><i class="eventtype-filter4" ></i>Concert/Performance</li>
                <li value="5" ><i class="eventtype-filter5" ></i>Festival/Street Fair/Carnival</li>
                <li value="6" class="hide" ><i class="eventtype-filter6" ></i>Film Production</li>
                <li value="7"  ><i class="eventtype-filter7" ></i>Parade/Procession/March/Rally</li>
                <li value="8" ><i class="eventtype-filter8" ></i>Race/Walk/Ride</li>
                <li value="9" ><i class="eventtype-filter9" ></i>Promotion Advertising</li>
                <li vvalue="10" class="hide" ><i class="eventtype-filter10" ></i>Small Park Event/Wedding</li>
                <li vvalue="11" ><i class="eventtype-filter11" ></i>Other</li>
            </ul>
                    <?php
echo '<div class="cal-c clearfix">';

$cal = new Calendar();

if($_GET['calmonth']) {
	$cal->specify_month($_GET['calmonth'], $_GET['calyear']);
} else {
	$cal->this_month();
}

$cal->load_month_events();



//toggle view button
echo '<div class="cal-controls clearfix ">';


//loop each month of the year
echo '<select class="hide" id="month-select">';
for($i = 1; $i <= 12; $i++) {
	echo '<option value="'. date("n", mktime(0, 0, 0, $i, 10)) .'"';
	if($cal->month_selected == $i) { echo ' selected'; }
	echo '>'. date("F", mktime(0, 0, 0, $i, 10)) .'</option>';
}
echo '</select>';



//loop available years
echo '<select class="hide" id="year-select">';
$start = $cal->year_start;
$end = $cal->year_end;

for($i = $start; $i <= $end; $i++) {
	echo '<option';
	if($cal->year_selected == $i) { echo ' selected'; }
	echo '>'. $i .'</option>';
} 
echo '</select>';
//contruct date so I can get next and previous
	$curmonth = $cal->month_start;
	$next_month = date("M", strtotime("$curmonth +1 month"));
	$last_month = date("M", strtotime("$curmonth -1 month"));
			
echo '<select class="hide" id="city-select">';

	echo '<option value="99">Neighborhoods</option>';
	echo '<option value="kansas-city-metro">Kansas City Metro</option>';

	
echo '</select>';

echo '<ul class="hide cal-view"><li class="activeview calactive"><span>Cal View</span></li>';
echo '<li><a class="calstring" href="/event-list">List View</a></li></ul></div>';
echo '<div class="toptitle">';

echo '<h5 id="Prev">'.$last_month.'</h5>';
echo '<h3 id="month-label"></h3>';
echo '<h5 id="Next">'.$next_month.'</h5>';

echo'</div>';
//one unordered list for the day of the week labels
echo '<div class="allcal blured"><div class="days clearfix"><ul>';
echo '<li>Sun</li>';
echo '<li>Mon</li>';
echo '<li>Tut</li>';
echo '<li>Wen</li>';
echo '<li>Thu</li>';
echo '<li>Fri</li>';
echo '<li>Sat</li>';
echo '</ul></div>';

//another unordered list for the different days of the month
echo '<div class="cal clearfix"><ul class="eventDays">';

//empty spaces for day of the week alignment
for ($i = 1; $i < $cal->empty_spaces; $i++) {
	echo '<li></li>';
}
$padded_month = str_pad($cal->month_selected . "", 2, "0", STR_PAD_LEFT);
//loop each day of the month


for ($i = 1; $i <= $cal->days_in_month; $i++) {
	$padded_day = str_pad($i . "", 2, "0", STR_PAD_LEFT);
	$this_day = $cal->year_selected . $padded_month . $padded_day;
	if (date("Ymd") == $this_day) {
		echo '<li class="today"><span class="day">'.$i.'</span><ol>';
	} else {
		echo '<li><span class="day">' .$i.'</span><ol>';
	}
	foreach ($cal->events as $event) {
		if($i == date("j", $event['date_object']) && $cal->month_selected == date("n", $event['date_object']) && $cal->year_selected == date("Y", $event['date_object']) ) {

			echo '<li class="dateitem etype'.$event['event_type'].'"><i class="eventtype-filter'.$event['event_type'].'"></i><a href="' . $event['permalink'] . '">' . $event['title'] . '</a></li>';
			 echo '<div class="box event">';
				echo '<h5 class="top">'. $event['title']  .'</h5>';
				echo '<div class="top-data">';
                            // echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
								$eventY = substr($event['date'], 0, 4);
								$eventM = substr($event['date'], 4, 2);
								$eventD = substr($event['date'], 6, 2);

                            echo '<h6 class="part eventdate">Start Date: '.  $eventY.'-'.$eventD.'-'.$eventM.'</h6>'; 
                         echo '<h6 class="part eventtype-title eventtype-title'.$event['event_type'].'">';
                                if ( $event['event_type'] == '1' ) {
                                echo 'Athletic/Recreation';
                            } if( $event['event_type'] == '2') {
                                echo 'Airt Fair/Museum/Special Atrraction';
                                } if( $event['event_type'] == '3') {
                                    echo 'Block Party';
                                    } if( $event['event_type'] == '4') {
                                        echo 'Concert/Performance';
                                        } if( $event['event_type'] == '5') {
                                            echo 'Festival/Street Fair/Carnival';
                                            } if( $event['event_type'] == '6') {
                                                echo 'Film Production';
                                                } if( $event['event_type'] == '7') {
                                                    echo 'Parade/Procession/March/Rally';
                                                    } if( $event['event_type'] == '8') {
                                                        echo 'Promotion Advertising';
                                                         } if( $event['event_type'] == '9') {
                                                            echo 'Race/Walk/Ride';
                                                             } if( $event['event_type'] == '10') {
                                                             echo 'Small Park Event/Wedding';
                                                                } if( $event['event_type'] == '11') {
                                                                    echo 'Other';
                                                                }

                            echo '</h6>';  
                            echo '</div>';
                    echo '<a href="' . $event['permalink'] .'">View More Details</a>';
 						echo '<div class="eventtype" value="'.$event['event_type'].'"></div>';
                            echo '</div>';
		}
	}

$mydb = new wpdb('racekc','2ZW2GvtKEbCqNtsM','racekc','betadb1');
$races = $mydb->get_results("SELECT *
	    FROM wp_posts
	    INNER JOIN wp_postmeta ON (wp_posts.ID = wp_postmeta.post_id) 
	    WHERE wp_posts.post_type = 'races'
	    AND wp_posts.post_status = 'publish'
	    AND wp_postmeta.meta_key = 'start_date'
	    GROUP BY wp_posts.ID
	    ORDER BY wp_postmeta.meta_value DESC");

foreach ($races as $race) {
// var_dump($race);
	 			// for ($i = 0; $i < count($array); ++$i) {
        		// print $array[$i];
				// $metaDate = $race->meta_value;
				// $date = 19881123 (23/11/1988)
				// echo $metaDate .'<br>';
				// extract Y,M,D
				$metaY = substr($race->meta_value, 0, 4);
				$metaM = substr($race->meta_value, 4, 2);
				$metaD = substr($race->meta_value, 6, 2);
				// $raceDay = ''. $m .''. $d.'';
				// echo $cal->year_selected;
				// echo  .'<br>';
	if($i == $metaD && $cal->month_selected == $metaM && $cal->year_selected == $metaY ) {
   // var_dump($race);

   echo '<li class="dateitem etype8"><i class="eventtype-filter8"></i><a href="/race/?raceid=' . $race->ID . '&isRace=Yes&title='. $race->post_title .'">' . $race->post_title. ''. $metaY.'</a></li><br>';
    echo '<div class="box event">';
				echo '<h5 class="top">'. $race->post_title .'</h5>';
				echo '<div class="top-data">';
                            // echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
                            echo '<h6 class="part eventdate">Start Date: '. $metaY .'-'.$metaD.'-'.$metaM.'</h6>'; 
                            echo '<h6 class="part eventtype-title eventtype-title8">';
                        		echo 'Race/Walk/Ride';
							echo '</h6>'; 
                            echo '</div>';
                    echo '<a href="/race/?raceid=' . $race->ID . '&isRace=Yes&title='. $race->post_title .'">View More Details</a>';
 						echo '<div class="eventtype" value="8"></div>';
                            echo '</div>';
	}
}

	global $wpdb;
	$entries = $wpdb->get_results("SELECT * FROM event_key WHERE form_id = 2 AND event_status = 'Pending'");

                        foreach($entries as $entry){

                            $eventType = $entry->event_type;
                            $location = $entry->location;
                            $event_date = $entry->event_date;
							 $eventName = $entry->event_name;
							 $entryID = $entry->entry_id;
							 $etype = $entry->event_type;
                         	// echo $entry->event_date;
				$entryY = substr($entry->event_date, 0, 4);
				$entryM = substr($entry->event_date, 5, 2);
				$entryD = substr($entry->event_date, 8, 2);
			

	if($i == $entryD && $cal->month_selected == $entryM && $cal->year_selected == $entryY ) {
   echo '<li class="dateitem  etype'.$etype.'"><i class="eventtype-filter'.$etype.'"></i><a href="/event/?entryID='.$entryID.'">' . $eventName . ''. $entryY.'</a></li><br>';
   echo '<div class="box event '.$eventID.'">';
				echo '<h5 class="top formID'. $formID .'">'.$eventName.'</h5>';
				echo '<div class="top-data">';
                            echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
                            echo '<h6 class="part eventdate">Event Date: '.$entryY.'-'.$entryD.'-'.$entryM.'</h6>'; 
                            echo '<h6 class="part eventtype-title eventtype-title'.$eventType.'">';
                                if ( $eventType == '1' ) {
                                echo 'Athletic/Recreation';
                            } if( $eventType == '2') {
                                echo 'Airt Fair/Museum/Special Atrraction';
                                } if( $eventType == '3') {
                                    echo 'Block Party';
                                    } if( $eventType == '4') {
                                        echo 'Concert/Performance';
                                        } if( $eventType == '5') {
                                            echo 'Festival/Street Fair/Carnival';
                                            } if( $eventType == '6') {
                                                echo 'Film Production';
                                                } if( $eventType == '7') {
                                                    echo 'Parade/Procession/March/Rally';
                                                    } if( $eventType == '8') {
                                                        echo 'Promotion Advertising';
                                                         } if( $eventType == '9') {
                                                            echo 'Race/Walk/Ride';
                                                             } if( $eventType == '10') {
                                                             echo 'Small Park Event/Wedding';
                                                                } if( $eventType == '11') {
                                                                    echo 'Other';
                                                                }

                            echo '</h6>'; 
                            echo '</div>';
                    echo '<a href="/event/?entryID='.$entryID.'">View More Details</a>';
 						echo '<div class="eventtype" value="'.$eventType.'"></div>';
                            echo '</div>';
	}
}

	echo '</ol></li>';
}

echo '</ul></div></div></div>';
echo '</div>';
                  
echo '<div class="sidebar filter cal-sidebar">
            <h3>Upcoming Events</h3>
            <div class="eArea">';
				$t = 0;


$mydb = new wpdb('racekc','2ZW2GvtKEbCqNtsM','racekc','betadb1');
$races = $mydb->get_results("SELECT *
	    FROM wp_posts
	    INNER JOIN wp_postmeta ON (wp_posts.ID = wp_postmeta.post_id) 
	    WHERE wp_posts.post_type = 'races'
	    AND wp_posts.post_status = 'publish'
	    AND wp_postmeta.meta_key = 'start_date'
	    GROUP BY wp_posts.ID
	    ORDER BY wp_postmeta.meta_value ASC");



foreach ($races as $race) {
	if ( $t < 3 ) { 
	// echo $t;
// var_dump($race);
	 			// for ($i = 0; $i < count($array); ++$i) {
        		// print $array[$i];
				// $metaDate = $race->meta_value;
				// $date = 19881123 (23/11/1988)
				// echo $metaDate .'<br>';
				// extract Y,M,D
				$metaY = substr($race->meta_value, 0, 4);
				$metaM = substr($race->meta_value, 4, 2);
				$metaD = substr($race->meta_value, 6, 2);
                $today = date('Ymd');
				// $raceDay = ''. $m .''. $d.'';
				// echo $cal->year_selected;
				// echo  .'<br>';
		$raceDate = $metaY.''.$metaM.''.$metaD; 

	if( $raceDate >= $today ) {
   // var_dump($race);

   echo '<li class="dateitem etype8"><i class="eventtype-filter8"></i><a href="/race/?raceid=' . $race->ID . '&isRace=Yes&title='. $race->post_title .'">' . $race->post_title. ''. $metaY.'</a></li><br>';
    echo '<div class="box event">';
				echo '<h5 class="top">'. $race->post_title .'</h5>';
				echo '<div class="top-data">';
                            // echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
                            echo '<h6 class="part eventdate">Start Date: '. $metaY .'-'.$metaD.'-'.$metaM.'</h6>'; 
                            echo '<h6 class="part eventtype-title eventtype-title8">';
                        		echo 'Race/Walk/Ride';
							echo '</h6>'; 
                            echo '</div>';
                    echo '<a href="/race/?raceid=' . $race->ID . '&isRace=Yes&title='. $race->post_title .'">View More Details</a>';
 						echo '<div class="eventtype" value="8"></div>';
                            echo '</div>';
                            $t++;
	}
	
}

}

	global $wpdb;
	$entries = $wpdb->get_results("SELECT * FROM event_key WHERE form_id = 2 AND event_status = 'Pending'");
				
				$i = 0;


	          foreach($entries as $entry){
	          	if ( $i < 3 ) {
 			
                            $eventType = $entry->event_type;
                            $location = $entry->location;
                            $event_date = $entry->event_date;
							 $eventName = $entry->event_name;
							 $entryID = $entry->entry_id;
							 $etype = $entry->event_type;
                         	// echo $entry->event_date;
							 $today = date('Ymd');
				$entryY = substr($entry->event_date, 0, 4);
				$entryM = substr($entry->event_date, 5, 2);
				$entryD = substr($entry->event_date, 8, 2);
				$theDate = $entryY.''.$entryM.''.$entryD; 


	if( $theDate >= $today ) {
   echo '<li class="dateitem  etype'.$etype.'"><i class="eventtype-filter'.$etype.'"></i><a href="/event/?entryID='.$entryID.'">' . $eventName . ''. $entryY.'</a></li><br>';
   echo '<div class="box event '.$eventID.'">';
				echo '<h5 class="top formID'. $formID .'">'.$eventName.'</h5>';
				echo '<div class="top-data">';
                            echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
                            echo '<h6 class="part eventdate">Event Date: '.$dates .'</h6>'; 
                            echo '<h6 class="part eventtype-title eventtype-title'.$eventType.'">';
                                if ( $eventType == '1' ) {
                                echo 'Athletic/Recreation';
                            } if( $eventType == '2') {
                                echo 'Airt Fair/Museum/Special Atrraction';
                                } if( $eventType == '3') {
                                    echo 'Block Party';
                                    } if( $eventType == '4') {
                                        echo 'Concert/Performance';
                                        } if( $eventType == '5') {
                                            echo 'Festival/Street Fair/Carnival';
                                            } if( $eventType == '6') {
                                                echo 'Film Production';
                                                } if( $eventType == '7') {
                                                    echo 'Parade/Procession/March/Rally';
                                                    } if( $eventType == '8') {
                                                        echo 'Promotion Advertising';
                                                         } if( $eventType == '9') {
                                                            echo 'Race/Walk/Ride';
                                                             } if( $eventType == '10') {
                                                             echo 'Small Park Event/Wedding';
                                                                } if( $eventType == '11') {
                                                                    echo 'Other';
                                                                }

                            echo '</h6>'; 
                            echo '</div>';
                    echo '<a href="/event/?entryID='.$entryID.'">View More Details</a>';
 						echo '<div class="eventtype" value="'.$eventType.'"></div>';
                            echo '</div>';
	}
	$i++;
}

}


    $i = 0;
foreach ($cal->events as $event) {

    if ( $i < 5 ) {
        $today = date('Ymd');
        $eventDate =  date("Ymd", $event['date_object']);

        if($eventDate >= $today) {

    echo '<li class="dateitem etype'.$event['event_type'].'"><i class="eventtype-filter'.$event['event_type'].'"></i><a href="' . $event['permalink'] . '">' . $event['title'] . '</a></li>';
             echo '<div class="box event">';
                echo '<h5 class="top">'. $event['title']  .'</h5>';
                echo '<div class="top-data">';
                            // echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
                                $eventY = substr($event['date'], 0, 4);
                                $eventM = substr($event['date'], 4, 2);
                                $eventD = substr($event['date'], 6, 2);

                            echo '<h6 class="part eventdate">Start Date: '.  $eventY.'-'.$eventD.'-'.$eventM.'</h6>'; 
                         echo '<h6 class="part eventtype-title eventtype-title'.$event['event_type'].'">';
                                if ( $event['event_type'] == '1' ) {
                                echo 'Athletic/Recreation';
                            } if( $event['event_type'] == '2') {
                                echo 'Airt Fair/Museum/Special Atrraction';
                                } if( $event['event_type'] == '3') {
                                    echo 'Block Party';
                                    } if( $event['event_type'] == '4') {
                                        echo 'Concert/Performance';
                                        } if( $event['event_type'] == '5') {
                                            echo 'Festival/Street Fair/Carnival';
                                            } if( $event['event_type'] == '6') {
                                                echo 'Film Production';
                                                } if( $event['event_type'] == '7') {
                                                    echo 'Parade/Procession/March/Rally';
                                                    } if( $event['event_type'] == '8') {
                                                        echo 'Promotion Advertising';
                                                         } if( $event['event_type'] == '9') {
                                                            echo 'Race/Walk/Ride';
                                                             } if( $event['event_type'] == '10') {
                                                             echo 'Small Park Event/Wedding';
                                                                } if( $event['event_type'] == '11') {
                                                                    echo 'Other';
                                                                }

                            echo '</h6>';  
                            echo '</div>';
                    echo '<a href="' . $event['permalink'] .'">View More Details</a>';
                        echo '<div class="eventtype" value="'.$event['event_type'].'"></div>';
                            echo '</div>';

}
$i++;
}
}
              
echo '</div></div>';
echo '</div></div></div>';



get_template_part('templates/footer');

?>
