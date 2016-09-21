

            <?php  
                //get uniKey that passed by the end of the app to show only that one
                $uniKey = $_GET['uniKey'];

                        $output .= '<h1>Congratulations!</h1>';
                        $output .= '<p>Thank you for submitting your application for your Outdoor Event Permit! Below 
                         is a list of the additional permits you will need to hold your event. Each permit has its own deadlines and fees. 
                         <br><br>Please review the guidelines and instructions for each permit carefully. You will receive a Tentative
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
                        
                        $entries = $wpdb->get_results("SELECT * FROM event_key WHERE user_id = $curuser AND form_id = 2 ORDER BY $ordby $a_or_d");
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
                            $event_date_end = $entry->event_date_end;
                            $event_time_start = $entry->event_time_start;
                            $event_time_end = $entry->event_time_end;
                            $sponsor_name = $entry->sponsor_name;
                            $sponsor_address = $entry->sponsor_address;
                            $sponsor_two = $entry->sponsor_two;
                            $sponsor_city = $entry->sponsor_city;
                            $sponsor_state = $entry->sponsor_state;
                            $sponsor_zip = $entry->sponsor_zip;
                            $sponsor_phone = $entry->sponsor_phone;
                            $sponsor_email = $entry->sponsor_email;
                            $day_phone = $entry->day_phone;
                            $day_contact = $entry->day_contact;
                            $location_des = $entry->location_des;

                                                        
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
                            $events[$eventID][$eventName][$entryID]['animal_permit'] = $aPermit;
                            $events[$eventID][$eventName][$entryID]['park_permit'] = $park_permit;
                            $events[$eventID][$eventName][$entryID]['fire_permit'] = $fire_permit;
                            $events[$eventID][$eventName][$entryID]['ems_permit'] = $ems_permit;
                            $events[$eventID][$eventName][$entryID]['traffic_permit'] = $traffic_permit;
                            $events[$eventID][$eventName][$entryID]['admission'] = $admission;
                            $events[$eventID][$eventName][$entryID]['date_submited'] = $dateSub;
                            $events[$eventID][$eventName][$entryID]['event_status'] = $event_status;
                            $events[$eventID][$eventName][$entryID]['location'] = $location;
                            $events[$eventID][$eventName][$entryID]['is_child'] = $is_child;
                            $events[$eventID][$eventName][$entryID]['address'] = $address;
                            $events[$eventID][$eventName][$entryID]['addresstwo'] = $addresstwo;
                            $events[$eventID][$eventName][$entryID]['state'] = $state;
                            $events[$eventID][$eventName][$entryID]['city'] = $city;
                            $events[$eventID][$eventName][$entryID]['zip'] = $zip;
                            $events[$eventID][$eventName][$entryID]['first_name'] = $first_name;
                            $events[$eventID][$eventName][$entryID]['last_name'] = $last_name;
                            $events[$eventID][$eventName][$entryID]['email'] = $email;
                            $events[$eventID][$eventName][$entryID]['phone'] = $phone;
                            $events[$eventID][$eventName][$entryID]['event_date'] = $event_date;
                            $events[$eventID][$eventName][$entryID]['event_date_end'] = $event_date_end;
                            $events[$eventID][$eventName][$entryID]['event_time_start'] = $event_time_start;
                            $events[$eventID][$eventName][$entryID]['event_time_end'] = $event_time_end;
                            $events[$eventID][$eventName][$entryID]['sponsor_name'] = $sponsor_name;
                            $events[$eventID][$eventName][$entryID]['sponsor_address'] = $sponsor_address;
                            $events[$eventID][$eventName][$entryID]['sponsor_two'] = $sponsor_two;
                            $events[$eventID][$eventName][$entryID]['sponsor_city'] = $sponsor_city;
                            $events[$eventID][$eventName][$entryID]['sponsor_state'] = $sponsor_state;
                            $events[$eventID][$eventName][$entryID]['sponsor_zip'] = $sponsor_zip;
                            $events[$eventID][$eventName][$entryID]['sponsor_phone'] = $sponsor_phone;
                            $events[$eventID][$eventName][$entryID]['sponsor_email'] = $sponsor_email;
                            $events[$eventID][$eventName][$entryID]['day_phone '] = $day_phone ;
                            $events[$eventID][$eventName][$entryID]['day_contact'] = $day_contact;
                            $events[$eventID][$eventName][$entryID]['location_des'] = $location_des;
                    }
                      $allEvents = array($events);
            //spit it back out
            foreach ($events as $eID => $eValue){
                if ( $eID == $uniKey ) {
                $output .= '<div class="over-box '.$eID.'">';
                foreach ($eValue as $eName => $eKey){
                    $output .= '<ul>';
                    $output .= '<h2 class="top formID'. $eid .'">'.$eName.'</h2>';
                    foreach ($eKey as $enID => $enData)
                    {
                        $id = $enData['form_id'];
                        $eventType = $enData['event_type'];
                        $eventType = intval($eventType);
                        $fPermit = $enData['food_permit'];
                        $dPermit = $enData['dance_permit'];
                        $nPermit = $enData['noise_permit'];
                        $aPermit = $enData['animal_permit'];
                        $is_child = $enData['is_child'];
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
                        $es = $enData['event_status'];
                        $dates = $enData['event_date'];
                        $location = $enData['location'];
                        $id = intval($id);
                        $date_end = $enData['event_date_end'];
                        $time_start = $enData['event_time_start'];
                        $time_end = $enData['event_time_end'];
                        $spon_name = $enData['sponsor_name'];
                        $spon_address =$enData['sponsor_address'];
                        $spon_address_two = $enData['sponsor_two'];
                        $spon_city = $enData['sponsor_city'];
                        $spon_state = $enData['sponsor_state'];
                        $spon_zip = $enData['sponsor_zip'];
                        $spon_phone = $enData['sponsor_phone'];
                        $spon_email = $enData['sponsor_email'];
                        $day_phone = $enData['day_phone'];
                        $day_contact = $enData['day_contact'];
                        $location_des = $enData['location_des'];
                        $homelink = 'http://kceventhub.org';

$output .= 'View all of my events details here at: <a href="'. $homelink .'/event-type">My Events</a><br><br>';
$output .= '<a href="'. $homelink .'/wp-content/uploads/2015/07/KCMO-dept-permit-fees.pdf">List of all Permit Deadlines and Fees</a><br><br>'; 


                if ( $id = '2' ) {  //only the main app

                    $link = '&eventType='. $eventType .'&uniKey='. $eID .'&eventName='.$enData['event_name'].'&eventDate='.$event_date.'&address='.$enData['address'].'&addresstwo='.$enData['addresstwo'].'&city='.$enData['city'].'&state='.$enData['state'].'&zip='.$enData['zip'].'&first_name='.$enData['first_name'].'&last_name='.$enData['last_name'].'&phone='.$enData['phone'].'&email='.$enData['email'].'&date_end='.$date_end.'&time_start='.$time_start.'&time_end='.$time_end.'&spon_name='.$spon_name.'&spon_address='.$spon_address.'&spon_address_two='.$spon_address_two.'&spon_city='.$spon_city.'&spon_state='.$spon_state.'&spon_zip='.$spon_zip.'&spon_phone='.$spon_phone.'&spon_email='.$spon_email.'&day_phone='.$day_phone.'&day_contact='.$day_contact.'&location_des='.$location_des.'&location='.$location.'';

                        if ( $fPermit == 'Yes') { $output .= '<li>
                            Temporary Food Permit <br>
                            <a href="'. $homelink .'/wp-content/uploads/2015/07/Temporary-Food-Permit-Instructions2.docx">Instructions</a> | Deadline: 14-30 days prior 
                            <br>
                            Please print out your permit application, take it to the Health Department at 2400 Troost Ave., KCMO where you will pay your permit fees and conduct your interview with a Health Inspector. Final permits are issued after applicant passes an onsite inspection.
                            <br>
                            <a href="'. $homelink .'/temporary-food-permit/?child=Yes'.$link.'">Fill out Temporary Food Permit</a>
                            </li>'; }
                        if ( $dPermit == 'Yes') { $output .= '<li>
                            Daily Dance Hall Permit  <br>
                            <a href="'. $homelink .'/wp-content/uploads/2015/07/Daily-Dance-Hall-Permit-Instructions1.pdf">Instructions</a> | Deadline: 10 days prior 
                            <br>
                            <a href="'. $homelink .'/dance-application/?child=Yes'.$link.'">Fill out Daily Dance Hall Permit</a>
                            </li>'; }
                        if ( $nPermit == 'Yes') { $output .= '<li>
                            Noise Permit <br>
                            <a href="'. $homelink .'/wp-content/uploads/2015/07/Noise-Permit-Guidelines1.pdf">Instructions</a> | Deadline: 14-30 days prior
                            <br>
                            <a href="'. $homelink .'/noise-permit/?child=Yes'.$link.'">Fill out Noise Permit</a>
                        </li>'; }
                        if ( $aPermit == 'Yes') { $output .= '<li>
                            Animal Show Permit <br>
                            <a href="'. $homelink .'/wp-content/uploads/2015/07/Animal-Show-Permit-Instructions1.pdf">Instructions</a> | Deadline: 14 days prior  
                            <br>
                            <a href="'. $homelink .'/animal-permit/?child=Yes'.$link.'">Fill out Animal Permit</a>
                        </li>'; }
                        if ( $alch == '2') { 
                            $output .= '<li>
                            KCMO Catering Permit (Alcohol) <br>
                            <a href="'. $homelink .'/wp-content/uploads/2015/07/Catering-Permit-Instructions1.pdf">Instructions</a> | Deadline: 30 days prior
                            <br>
                            <a href="'. $homelink .'/catering-permit-application/?child=Yes'.$link.'">Fill Out The KCMO Catering Permit Form</a>';
                            $output .=  '<br>Please advise the company serving the alcohol that they will need to submit the permits to the city and the state.<br>';
                            $output .=  '<br><a href="http://kceventhub.org/faqs#what-steps-do-i-need-to-take-to-get-alcohol-permits-for-my-event">Instructions</a></li>';
                        }
                        if ( $nonp == 'Yes') { $output .= '<li>
                            KCMO Non-Profit Special Event Permit <br>
                        <a href="'. $homelink .'/wp-content/uploads/2015/07/Non-Profit-Special-Event-Permit-Instructions1.pdf">Instructions</a> | Deadline: 30 days prior </li>'; } 
                        if ( $alch == '1' && $nonp == 'No') {$output .= '<li>
                            KCMO Catering Permit (Alcohol)   <br>
                        <a href="'. $homelink .'/wp-content/uploads/2015/07/Catering-Permit-Instructions1.pdf">Instructions</a> | Deadline: 30 days prior
                        <br>
                        <a href="'. $homelink .'/catering-permit-application/?child=Yes'.$link.'">Fill Out The KCMO Catering Permit Form</a>
                        </li>';}
                        if ( $liq == 'Yes') { $output .= '<li>
                            <a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0024.pdf">State of MO Temporary Caterers Permit</a> <br>
                         Deadline: 30 days prior
                        </li>'; }
                        if ( $liq == 'No') { $output .= '<li>
                            <a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0027.pdf">State of MO Picnic License</a> <br>
                            Deadline: 30 days prior </li>'; }
                        if ( $eventType == '3') { $output .= '<li> Block Party <br>
                            <a href="'. $homelink .'/wp-content/uploads/2015/07/Block-Party-Instructions1.docx">Instructions</a> | Deadline: 30 days prior
                                 <br>Remember to download and fill out the signatures page.
                                <a class="dl" href="/wp-content/uploads/2015/07/block-party-signature-page.pdf">Click here.</a>
                                 </span>
                                <a href="'. $homelink .'/block-party/?child=Yes'.$link.'">Fill Out Form</a><
                                    </li>'; } 
                        if ( $eventType == '5') { $output .= '<li>Festival Permit <br>
                            <a href="'. $homelink .'/wp-content/uploads/2015/07/Festival-Permit-Instructions1.pdf">Instructions</a> | Deadline: 60 days prior
                              <br>Remember to download and fill out the signatures page.
                                <a class="dl" href="/wp-content/uploads/2015/07/festival-signature-page.pdf">Click here.</a>
                                </li>'; }
                        if ( $eventType == '7') { $output .= '<li>
                            Parade Permit <br>
                        <a href="'. $homelink .'/wp-content/uploads/2015/07/Parade-Permit-Instructions1.pdf">Instructions</a> | Deadline: 60 days prior 
                        <br>
                        <a href="'. $homelink .'/parade-application/?child=Yes'.$link.'">Fill Out Form</a></li>'; }
                        if ( $eventType == '9') { $output .= '<li>
                            Please visit <a class="dl" href="http://kcraceday.org" target="blank">KC Race Day</a> to finish your Race permit!
                            <br>Deadline: 90 days prior</li>'; }
                        if ( $park_permit == 'Yes') { $output .= '<li>
                            KC Parks Dept <br>
                            Dealine: 60 days prior <br>Your event requires a Parks Agreement from the Parks Department. Contact Parks Department for assistance 816-513-7500 or visit www.kcparks.org</li>'; }
                        if ( $ems_permit  >= '1000') { $output .= '<li>
                            KC Fire Dept EMS<br>
                        <a href="'. $homelink .'/wp-content/uploads/2015/07/Fire-EMS-Guidelines1.pdf">Instructions</a> | Dealine: 60 days prior <br>Your event may require EMS presence. Contact Brian Trickey at KCFD for assistance at <a href="mailto:BRIAN.TRICKEY@KCMO.ORG">BRIAN.TRICKEY@KCMO.ORG</a>.
                        <br>
                        <a href="'. $homelink .'/fire-ems/?child=Yes'.$link.'&peopleCount='.$ems_permit.'&overOne=Yes">Fill Out the Fire EMS Permit</a><</li>'; }
                        if ( $fire_permit == 'Yes') { $output .= '<li>
                            KC Fire Dept Tents and Canopies<br>
                        <a href="'. $homelink .'/wp-content/uploads/2015/07/Tents-Canopies-and-Concessions-Guideline-Fire1.pdf">Instructions</a> | Dealine: 60 days prior <br>Your event may require Fire Department Permits. Contact Pat Downing at KCFD for assistance at 816-784-9200.
                        <br>
                        <a href="'. $homelink .'/fire-tents-application/?child=Yes'.$link.'&gas='.$fire_permit.'&rides='.$fire_permit.'&firework='.$fire_permit.'">Fill Out Fire Tent Application</a></li>'; }
                        if ( $traffic_permit  == 'Yes') { $output .= '<li>
                            Police Traffic <br>
                            Deadline: 30 days prior <br>Your event may require Traffic Officer presence. Contact Kevin Gooch at KCPD Traffic division for assistance 816-329-0911.
                            <br>
                            <a href="'. $homelink .'/traffic-control/?child=Yes'.$link.'">Fill Out The Traffic Control Permit</a><</li>'; }
                        if ( $admission == 'Yes' || $alcServ == 'Yes' || $dPermit == 'Yes' || $nPermit == 'Yes') { $output .= '<li>
                            Police Security and off duty staffing<br>
                        <a href="'. $homelink .'/wp-content/uploads/2015/07/Police-and-Security-Guidelines1.pdf">Instructions</a> | Deadline: 30 days <br> prior Your event may require Off-Duty Security presence. Contact Matt Masters, KCPD Off-duty coordinator for assistance 816-234-5388.
                        <br>
                        <a href="'. $homelink .'/police-security-permit/?child=Yes'.$link.'&admission='.$admission.'&alcohol='.$alcServ.'&dance='.$dPermit.'&noise='.$nPermit.'">Fill Out the Police Security Permit</a></li>'; }


                        } 
                    }
                    $output .= '</ul>';             
                }
                $output .= '</div>';
            }
 
            }
         
   $output .= '<p>To see a complete list of all city permits <a href="http://kceventhub.org/resources">click here</a>. Check our online FAQs for any questions you might have, or email <a href="mailto:mfisher@evenergy.com">mfisher@evenergy.com</a>. We are here to help make your event permitting process go smoothly!
                    <br>
                    <br>Thank you,
                    <br>Evenergy Outdoor Event Team</p>';
echo $output; //return it

//now email the person
$to = $current_user->user_email;
$subject = 'Next steps for your event!';
$body = $output;
$headers = array('Content-Type: text/html; charset=UTF-8');

wp_mail( $to, $subject, $body, $headers );

?> 
