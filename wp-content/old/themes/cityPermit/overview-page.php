<?php
/*
Template Name: overview
*/
?>

<?php get_template_part('templates/header'); ?>

<div class="single overview events-page wow fadeInLeft">
    <div class="row bo">
        <div class="contentwrap">

            <?php while ( have_posts() ) : the_post(); ?>
            <?php  
                //get uniKey that passed by the end of the app to show only that one
                $uniKey = $_GET['uniKey'];

                if(!is_user_logged_in()) {
                    echo '<div class="gform_title hide">Login</div>';
                    echo '<h5 class="login-notice">Hey there! You need to login before you can see this content!</h5>';
                    wp_login_form(); 
                    echo '<a class="register" href="http://kceventhub.org/register/">Need an Account? Register Today!</a> ';
                } else {
                    $title = get_the_title();
                        $output .= '<h1>Congratulations!</h1>';
                        $output .= '<p>Thank you for submitting your application for your Outdoor Event Permit! Below 
                         is a list of the additional permits you will need to hold your event. Each permit has its own deadlines and fees. 
                         <br><br>Please review the guidelines and instructions for each permit carefully.You will receive a Tentative
                         Outdoor Event Permit via email after location and date review by the city. 
                         Final Outdoor Event Permits will be issued once the permits below have been processed by the appropriate 
                         city departments, approximately 7-10 days prior to your event.</p><br><br>';
            
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

                            //making a new array to better organize it all
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
            //spit it back out
            foreach ($events as $eID => $eValue){
                if ( $eID == $uniKey ) {
                $output .= '<div class=" event '.$eID.'">';
                foreach ($eValue as $eName => $eKey){
                    $output .= '<ul class="'.$eName.'">';
                    foreach ($eKey as $enID => $enData)
                    {
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

                if ( $id != '3' ) {  //only the main app
                    $output .= '<h3>'. $enData['event_name'] .'</h3><br>';

                        if ( $fPermit == 'Yes') { $output .= '<li>Temporary Food Permit <a href="http://kceventhub.org/wp-content/uploads/2015/05/Temporary-FOOD-Permit-App-KCMO-Health.pdf"><i></i></a></li>'; }
                        if ( $dPermit == 'Yes') { $output .= '<li>Daily Dance Hall Permit  <a href="http://kceventhub.org/wp-content/uploads/2015/05/Daily-Dance-Hall-permit.pdf"><i></i></a></li>'; }
                        if ( $nPermit == 'Yes') { $output .= '<li>Noise Permit  <a href="/wp-contenthttp://kceventhub.org/uploads/2015/05/KCMO-Noise-Permit.pdf"><i></i></a></li>'; }
                        if ( $aPermit == 'Yes') { $output .= '<li>Animal Show Permit  <a href="http://kceventhub.org/wp-content/uploads/2015/05/ANIMAL_SHOW_APPLICATION.pdf"><i></i></a></li>'; }
                        // if ( $alchServ == 'Yes') { $output .= '<li>Catering Permit  <a href="/wp-content/uploads/2015/05/Catering-alcohol-Permit-App-STATE-OF-MO.pdf"><i></i></a></li>'; }
                        // if ( $alch == '1') { $output .= '<li>ME  <a href="/wp-content/uploads/2015/05/Catering-alcohol-Permit-App-STATE-OF-MO.pdf"><i></i></a></li>'; }
                        if ( $alch == '2') { 
                            $output .= '<li>KCMO Catering Permit (Alcohol) <a href="http://kceventhub.org/wp-content/uploads/2015/05/Application_for_Catering_Permit.pdf"><i></i></a>'; 
                            $output .=  '<br><br>Please advise the company servering the alcohol that they will need to submit the permits to the city and the state.';
                            $output .=  '<br><a href="http://kceventhub.org/faqs#what-steps-do-i-need-to-take-to-get-alcohol-permits-for-my-event">Here are the permits and steps to follow.</a></li>';
                        }
                        if ( $nonp == 'Yes') { $output .= '<li>KCMO Non-Profit Special Event Permit <a href="http://kceventhub.org/wp-content/uploads/2015/05/Non-profit-special-event-permit-application.pdf"><i></i></a></li>'; } 
                        if ( $alch == '1' && $nonp == 'No') {$output .= '<li>KCMO Catering Permit (Alcohol)  <a href="http://kceventhub.org/wp-content/uploads/2015/05/Application_for_Catering_Permit.pdf"><i></i></a></li>';}
                        if ( $liq == 'Yes') { $output .= '<li>State of MO Temporary Caterers Permit<a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0024.pdf"><i></i></a></li>'; }
                        if ( $liq == 'No') { $output .= '<li>State of MO Picnic License <a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0027.pdf"><i></i></a></li>'; }
                        if ( $eventType == '3') { $output .= '<li>Block Party <a href="http://kceventhub.org/wp-content/uploads/2015/05/Block-Party-Permit-App-KCMO-Public-Works.pdf"><i></i></a></li>'; }
                        if ( $eventType == '5') { $output .= '<li>Festival Permit <a href="http://kceventhub.org/wp-content/uploads/2015/05/Festival-Permit-App-KCMO-Public-Works.pdf"><i></i></a></li>'; }
                        if ( $eventType == '7') { $output .= '<li>Parade Permit <a href=http://kceventhub.org"/wp-content/uploads/2015/05/Parade-Permit-App-KCMO-Public-Works.pdf"><i></i></a></li>'; }
                        if ( $eventType == '9') { $output .= '<li>Please visit <a href="http://kcraceday.org" target="blank">KC Race Day</a> to finish your Race permit!</li>'; }
                        if ( $park_permit == 'Yes') { $output .= '<li>Your event requires a Use and Concession Agreement from the Parks Department. Contact Parks Department for assistance 816-513-7500 or visit www.kcparks.org</li>'; }
                        if ( $ems_permit  >= '1000') { $output .= '<li>Your event may require EMS presence. Contact Brian Trickey at KCFD for assistance at 816-784-9100</li>'; }
                        if ( $fire_permit == 'Yes') { $output .= '<li>Your event may require Fire Department Permits. Contact Pat Downing at KCFD for assistance at 816-784-9200.</li>'; }
                        if ( $traffic_permit  == 'Yes') { $output .= '<li>Your event may require Traffic Officer presence. Contact Kevin Gooch at KCPD Traffic division for assistance 816-329-0911.</li>'; }
                        if ( $admission == 'Yes' && $alcServ == 'Yes' && $dPermit == 'Yes' && $nPermit == 'Yes') { $output .= '<li>Your event may require Off-Duty Security presence. Contact Matt Masters, KCPD Off-duty coordinator for assistance 816-234-5388.</li>'; }


                        $output .= '<li>'.$enData['form_name'].'';
                        $output .='<form action="/'.$enData['slug'].'" method="post">
                            <button class="sticky-list-edit submit">Edit</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        $output .= '</li>';

                        } 
                    }
                    $output .= '</ul>';             
                }
                $output .= '</div>';
            }
 
            }
         
   $output .= '<p>To see a complete list of all city permits <a href="http://kceventhub.org/resources">click here</a>. Check our online FAQs for any questions you might have, or email <a href="mailto:mfisher@evenergy.com">mfisher@evenergy.com</a>. We are here to help make your event permitting process go smoothly!
                    <br>Thank you,
                    <br>Evenergy Outdoor Event Team</p>';
echo $output; //return it
}?>

<?php 

//now email the person
$to = $current_user->user_email;
$subject = 'Next steps for your event!';
$body = $output;
$headers = array('Content-Type: text/html; charset=UTF-8');

wp_mail( $to, $subject, $body, $headers );

?> 
    <?php endwhile; ?>

    </div>
    </div>
</div>




<?php get_template_part('templates/footer'); ?>