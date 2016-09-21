<?php
/*
Template Name: app calendar
*/

echo '<div class="cal-c calapply clearfix">';

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
echo '<div class="top"> 

<div class="monthbtn">
			<a href="" id="fieldPrev" class="arrows prev"></a>
				<div class="monthname"></div>
				<div class="yearname"></div>
			<a href="" id="fieldNext"  class="arrows next"></a>
		</div>

		<div class="legend">
		<ul>
			<li class="leg seldate"><span class="two"></span> Selected Dates</li>
			<li class="leg avail"><span></span> Available Dates</li>
			<li class="leg blackout"><span></span> Limited Availability. Please contact race manager at jchronister@evenergy.com.</li>
		</ul>
		</div>

<select id="month-select">';
for($i = 1; $i <= 12; $i++) {
	echo '<option value="'. date("n", mktime(0, 0, 0, $i, 10)) .'"';
	if($cal->month_selected == $i) { echo ' selected'; }
	echo '>'. date("F", mktime(0, 0, 0, $i, 10)) .'</option>';
}
echo '</select>';
//loop available years
echo '<select id="year-select" class="year-select">';
$start = $cal->year_start;
$end = $cal->year_end;

for($i = $start; $i <= $end; $i++) {
	echo '<option';
	if($cal->year_selected == $i) { echo ' selected'; }
	echo '>'. $i .'</option>';
}
echo '</select>  </div>';

//one unordered list for the day of the week labels
echo '<div class="allcal"><div class="days clearfix"><ul>';
echo '<li>SU</li>';
echo '<li>MO</li>';
echo '<li>TU</li>';
echo '<li>WE</li>';
echo '<li>TH</li>';
echo '<li>FR</li>';
echo '<li>SA</li>';
echo '</ul></div>';

//another unordered list for the different days of the month
echo '<div class="cal clearfix"><ul>';

//empty spaces for day of the week alignment
for ($i = 1; $i < $cal->empty_spaces; $i++) {
	echo '<li></li>';
}
$padded_month = str_pad($cal->month_selected . "", 2, "0", STR_PAD_LEFT);
//loop each day of the month
for ($i = 1; $i <= $cal->days_in_month; $i++) {
	$padded_day = str_pad($i . "", 2, "0", STR_PAD_LEFT);
	$this_day = $cal->year_selected . $padded_month . $padded_day;
	//locate the blackout dates are there any? 
	$blackout_dates = get_posts(array(
		'post_type' => 'blackout',
		'meta_key' => 'date',
		'meta_value' => $this_day,
		'nopaging' => true
	));
		//if its today then yeah go for it duuuude
	if (date("Ymd") == $this_day) {
		//bam blackout dates
		if  (count($blackout_dates) > 0) {
			echo '<li class="blackout today adate"><span class="day">'.$i.'</span><i class="month"></i><p class="year"></p>';
		}
		else { 
			//if no blackout dates then normal today 
			echo '<li class="today adate"><span class="day">'.$i.'</span><i class="month"></i><p class="year"></p>'; 
		}
	} //print_r($blackout_dates);
	 else {
	 		if  (count($blackout_dates) > 0) {
			echo '<li class="blackout adate"><span class="day">'.$i.'</span><i class="month"></i><p class="year"></p>';
		}
		else { echo '<li class="adate"><span class="day">' .$i.'</span><i class="month"></i><p class="year"></p>'; }
	}
	echo '</li>';
}
echo '</ul></div></div></div></div>';

?>

