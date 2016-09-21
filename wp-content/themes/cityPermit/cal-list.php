<?php
/*
Template Name: cal-list
*/

get_template_part('templates/header');

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
echo '<select id="month-select">';
for($i = 1; $i <= 12; $i++) {
	echo '<option value="'. date("n", mktime(0, 0, 0, $i, 10)) .'"';
	if($cal->month_selected == $i) { echo ' selected'; }
	echo '>'. date("F", mktime(0, 0, 0, $i, 10)) .'</option>';
}
echo '</select>';

//loop available years
echo '<select id="year-select">';
$start = $cal->year_start;
$end = $cal->year_end;

for($i = $start; $i <= $end; $i++) {
	echo '<option';
	if($cal->year_selected == $i) { echo ' selected'; }
	echo '>'. $i .'</option>';
}
echo '</select>';

//council 
echo '<select id="city-select">';

	echo '<option value="99">Neighborhoods</option>';
	echo '<option value="kansas-city-metro">Kansas City Metro</option>';
	echo '<option value="brookside-waldo">Brookside</option>';
	echo '<option value="crossroads">Crossroads</option>';
	echo '<option value="crown-center">Crown Center</option>';
	echo '<option value="down-town-airport">Downtown Airport</option>';
	echo '<option value="east-of-troost">East of Troost</option>';
	echo '<option value="kemper-arena">Kemper Arena</option>';
	echo '<option value="longview-lake">Longview Lake</option>';
	echo '<option value="midtown">Midtown</option>';
	echo '<option value="martin-city">Martin City</option>';
	echo '<option value="north-of-the-river">North of the river</option>';
	echo '<option value="plaza">Plaza</option>';
	echo '<option value="river-market">River Market</option>';
	echo '<option value="southeast-kansas-city">Southeast Kansas City</option>';
	echo '<option value="sprint-center">Sprint Center</option>';
	echo '<option value="swope-park">Swope Park</option>';
	echo '<option value="theis-park">Theis Park</option>';
	echo '<option value="westport">Westport</option>';
	
	
echo '</select>';

echo '<ul class="cal-view"><li class="calactive"><a href="/calendar" class="calstring"><span>Cal View</span></a></li>';
echo '<li class="activeview">List View</li></ul></div>';

echo '<div class="cal-list">';

//loop events and create a header whenever the day changes
$current_day = "";
foreach ($cal->events as $event) {
  $day_name = date("l F jS, Y", $event['date_object']);
  if($current_day != $day_name) {
  	$current_day = $day_name;
  	echo '<div class="list-day">';
  	echo $day_name;
  	echo '</div>';
  }
  echo '<a class="' . $event['neighborhood'] . '" href="' . $event['permalink'] . '"><div class="list-event">';
  echo '<span>' . $event['title'] . '</span>';
  echo '</div></a>';
}

echo '<div class="pagination">';

//pagination
if($cal->num_pages > 1) {
	if($cal->page > 1) {
		echo $cal->paginate_link($cal->page-1, 'Prev');
	}
	for($i = 1; $i <= $cal->num_pages; $i++) {
		if($cal->page == $i) {
			echo $i .' ';
		} else {
			echo $cal->paginate_link($i);
		}
	}
	if($cal->page < $cal->num_pages) {
		echo $cal->paginate_link($cal->page+1, 'Next');
	}
}
echo '</div>';

echo '</div>';

//tag filters


echo '</div>';

get_template_part('templates/footer');

?>
