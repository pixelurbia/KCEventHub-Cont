<?php
/*
Template Name: Events
*/
?>

<?php get_template_part('templates/header'); ?>

<div class="single events-page wow fadeInLeft">
    <div class="row bo">
        <div class="contentwrap">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php  
                if(!is_user_logged_in()) {
                    echo '<h5 class="login-notice">Hey there! You need to login before you can see this content!</h5>';
                    wp_login_form(); 
                    echo '<a class="register" href="/register/">Need an Account? Register Today!</a> ';
                } else {
                    $title = get_the_title();
                    echo '<h1>'. $title .'</h1>';
                    the_content(); 

                    //db call and sorting
                    global $wpdb;
                        $curuser = wp_get_current_user();
                        $curuser = $curuser->ID;
                        $num_of_entries = 30;
                        $ordby = 'event_id';
                        $a_or_d = 'DESC';
                        
                        $entries = $wpdb->get_results("SELECT * FROM event_key WHERE user_id = $curuser ORDER BY $ordby $a_or_d");
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

                                                        
                            $events[$eventID][$eventName][$entryID]['form_id'] = $formID;
                            $events[$eventID][$eventName][$entryID]['event_name'] = $eventName;
                            $events[$eventID][$eventName][$entryID]['form_name'] = $formName;
                            $events[$eventID][$eventName][$entryID]['slug'] = $slug;
                            $events[$eventID][$eventName][$entryID]['alc_served'] = $alcServ;
                            $events[$eventID][$eventName][$entryID]['alc_who_serv'] = $alcWho;
                            $events[$eventID][$eventName][$entryID]['non_profit'] = $nonProfit;
                            $events[$eventID][$eventName][$entryID]['liquor_licence'] = $liqLic;
                            $events[$eventID][$eventName][$entryID]['event_type'] = $eventType;
                            $events[$eventID][$eventName][$entryID]['food_permit'] = $fPermit;
                            $events[$eventID][$eventName][$entryID]['dance_permit'] = $dPermit;
                            $events[$eventID][$eventName][$entryID]['noise_permit'] = $nPermit;
                            $events[$eventID][$eventName][$entryID]['park_permit'] = $park_permit;
                            $events[$eventID][$eventName][$entryID]['fire_permit'] = $fire_permit;
                            $events[$eventID][$eventName][$entryID]['ems_permit'] = $ems_permit;
                            $events[$eventID][$eventName][$entryID]['traffic_permit'] = $traffic_permit;
                            $events[$eventID][$eventName][$entryID]['admission'] = $admission;
                            $events[$eventID][$eventName][$entryID]['date_submited'] = $dateSub;
                    }
                      $allEvents = array($events);

            foreach ($events as $eID => $eValue){
                echo '<div class="box event '.$eID.'">';
                foreach ($eValue as $eName => $eKey){
                    // var_dump($enID);
                    echo '<ul class="'.$eName.' ">';
                    foreach ($eKey as $enID => $enData)
                    {

                        // var_dump($enData);
                        $id = $enData['form_id'];
                        $eventType = $enData['event_type'];
                        $eventType = intval($eventType);
                        $fPermit = $enData['food_permit'];
                        $dPermit = $enData['dance_permit'];
                        $nPermit = $enData['noise_permit'];
                        $aPermit = $enData['animal_permit'];
                        $park_permit = $enData['park_permit'];
                        $fire_permit = $enData['fire_permit'];
                        $ems_permit = $enData['ems_permit'];
                        $ems_permit = intval($ems_permit);
                        $traffic_permit = $enData['traffic_permit'];
                        $admission = $enData['admission'];
                        $alcServ = $enData['alc_served'];
                        $alch = $enData['alc_who_serv'];
                        $alch = intval($alch);
                        $nonp = $enData['non_profit'];
                        $liq = $enData['liquor_licence'];
                        $id = intval($id);

                // if ( $id != '3' ) { 
                    echo '<h3 class="top formID'. $id .'">'. $enData['event_name'] .'</h3>';
                    echo '<div class="bottom formID'. $id .' ">';

        
                        if ( $fPermit == 'Yes') { echo '<li>Temporary Food Permit <a href="/wp-content/uploads/2015/05/Temporary-FOOD-Permit-App-KCMO-Health.pdf"><i></i></a></li>'; }
                        if ( $dPermit == 'Yes') { echo '<li>Daily Dance Hall Permit  <a href="/wp-content/uploads/2015/05/Daily-Dance-Hall-permit.pdf"><i></i></a></li>'; }
                        if ( $nPermit == 'Yes') { echo '<li>Noise Permit  <a href="/wp-content/uploads/2015/05/KCMO-Noise-Permit.pdf"><i></i></a></li>'; }
                        if ( $aPermit == 'Yes') { echo '<li>Animal Show Permit  <a href="/wp-content/uploads/2015/05/ANIMAL_SHOW_APPLICATION.pdf"><i></i></a></li>'; }
                        // if ( $alchServ == 'Yes') { echo '<li>Catering Permit  <a href="/wp-content/uploads/2015/05/Catering-alcohol-Permit-App-STATE-OF-MO.pdf"><i></i></a></li>'; }
                        // if ( $alch == '1') { echo '<li>ME  <a href="/wp-content/uploads/2015/05/Catering-alcohol-Permit-App-STATE-OF-MO.pdf"><i></i></a></li>'; }
                        if ( $alch == '2') { 
                            echo '<li>KCMO Catering Permit (Alcohol) <a href="/wp-content/uploads/2015/05/Application_for_Catering_Permit.pdf"><i></i></a>'; 
                            echo  '<br><br>Please advise the company servering the alcohol that they will need to submit the permits to the city and the state.';
                            echo  '<br><a href="/faqs#what-steps-do-i-need-to-take-to-get-alcohol-permits-for-my-event">Here are the permits and steps to follow.</a></li>';
                        }
                        if ( $nonp == 'Yes') {echo '<li>KCMO Non-Profit Special Event Permit <a href="/wp-content/uploads/2015/05/Non-profit-special-event-permit-application.pdf"><i></i></a></li>'; } 
                        if ( $alch == '1' && $nonp == 'No') {echo '<li>KCMO Catering Permit (Alcohol)  <a href="/wp-content/uploads/2015/05/Application_for_Catering_Permit.pdf"><i></i></a></li>';}
                        if ( $liq == 'Yes') { echo '<li>State of MO Temporary Caterers Permit<a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0024.pdf"><i></i></a></li>'; }
                        if ( $liq == 'No') { echo '<li>State of MO Picnic License <a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0027.pdf"><i></i></a></li>'; }
                        if ( $eventType == '3') { echo '<li>Block Party <a href="/wp-content/uploads/2015/05/Block-Party-Permit-App-KCMO-Public-Works.pdf"><i></i></a></li>'; }
                        if ( $eventType == '5') { echo '<li>Festival Permit <a href="/wp-content/uploads/2015/05/Festival-Permit-App-KCMO-Public-Works.pdf"><i></i></a></li>'; }
                        if ( $eventType == '7') { echo '<li>Parade Permit <a href="/wp-content/uploads/2015/05/Parade-Permit-App-KCMO-Public-Works.pdf"><i></i></a></li>'; }
                        if ( $eventType == '9') { echo '<li>Please visit <a href="http://kcraceday.org" target="blank">KC Race Day</a> to finish your Race permit!</li>'; }
                        if ( $park_permit == 'Yes') { echo '<li>Your event requires a Use and Concession Agreement from the Parks Department. Contact Parks Department for assistance 816-513-7500 or visit www.kcparks.org</li>'; }
                        if ( $ems_permit  >= '1000') { echo '<li>Your event may require EMS presence. Contact Brian Trickey at KCFD for assistance at 816-784-9100</li>'; }
                        if ( $fire_permit == 'Yes') { echo '<li>Your event may require Fire Department Permits. Contact Pat Downing at KCFD for assistance at 816-784-9200.</li>'; }
                        if ( $traffic_permit  == 'Yes') { echo '<li>Your event may require Traffic Officer presence. Contact Kevin Gooch at KCPD Traffic division for assistance 816-329-0911.</li>'; }
                        if ( $admission == 'Yes' && $alcServ == 'Yes' && $dPermit == 'Yes' && $nPermit == 'Yes') { echo '<li>Your event may require Off-Duty Security presence. Contact Matt Masters, KCPD Off-duty coordinator for assistance 816-234-5388.</li>'; }


                        // echo $enID;

                        echo '<li>'.$enData['form_name'].'';
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '</li>';
                        echo '</div>';
                        // } 
                    }
                    echo '</ul>';             
                }
                echo '</div>';
            }




} ?>
    <?php endwhile; ?>

    </div>
    </div>
</div>



<?php get_template_part('templates/footer'); ?>