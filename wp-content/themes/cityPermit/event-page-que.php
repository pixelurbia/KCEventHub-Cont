<?php
/*
Template Name: Events QUe
*/
?>
<?php
//the que

global $wpdb;
                        $curuser = wp_get_current_user();
                        $curuser = $curuser->ID;
                        $num_of_entries = 30;
                        $ordby = $_GET['ordby'];
                        $a_or_d = $_GET['sortby'];
                        
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
                            $events[$eventID][$eventName][$entryID]['event_date'] = $event_date;
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
                    }
                      $allEvents = array($events);

            foreach ($events as $eID => $eValue){
                echo '<div class="box event '.$eID.'">';
                // var_dump($eValue);
                foreach ($eValue as $eName => $eKey){
                    // print current($eKey);
                    echo '<ul>';

                    echo '<h5 class="top formID'. $eid .'">'.$eName.'</h5>';
                    echo '<a class="eventdetails">See Event Details &#187; </a>';

                    foreach ($eKey as $enID => $enData)
                    {

                        // echo $enID;
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
// $address = $enData['address'];
// $addresstwo = $enData['addresstwo'];
// $state = $enData['state'];


                        echo '<div class="eventtype" value="'.$eventType.'"></div>';
                        echo '<div class="bottom formID'. $id .' ">';

                        
                        if ( $id == '3' ) {
                
                    
                            echo  '<div class="continue">To continue the permiting processes please fill out the form above. Or check your email, for a saved form. If you need your link again';
                            echo  '<br><a href="/faqs#what-steps-do-i-need-to-take-to-get-alcohol-permits-for-my-event">Here are the permits and steps to follow.</a></li></div>';

                        } 
                        if ( $id == '2' ) { 
                            echo '<div class="top-data">';
                            echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
                            echo '<h6 class="part eventdate">Event Date: '.$dates .'</h6>'; 
                            echo '<h6 class="part eventstatus '.$es.'" value="'.$es.'">'.$es .' Event <i></i></h6>'; 
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
                            echo '<div class="part entry-options">';
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Event &#187;</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>
                        <form action="/'.$enData['slug'].'/?duplicate=Yes" method="post">
                            <button class="sticky-list-duplicate submit">Duplicate Event &#187;</button>
                            <input type="hidden" name="mode" value="duplicate">
                            <input type="hidden" name="duplicate_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                            echo '</div>';
                            echo '</div>';

                             // echo '<li>'.$enData['form_name'].'';
            
                     
                        
                        echo '</li>';

                            //Let's build out that link so I don't have to retype it all every single time plz kthx
                            $link = '&eventType='. $eventType .'&uniKey='. $eID .'&eventName='.$enData['event_name'].'&address='.$enData['address'].'&addresstwo='.$enData['addresstwo'].'&city='.$enData['city'].'&state='.$enData['state'].'&zip='.$enData['zip'].'&first_name='.$enData['first_name'].'&last_name='.$enData['last_name'].'&phone='.$enData['phone'].'&email='.$enData['email'].'';

                            //endlink stuff
                            if ( $fPermit == 'Yes') { 
                                echo '<li class="child '.$eID.'formID14">
                                <span>Temporary Food Permit</span>
                                <a href="/temporary-food-permit/?child=Yes'.$link.'">Fill out Temporary Food Permit</a>
                                </li>'; 
                                }
                            if ( $dPermit == 'Yes') {
                             echo '<li class="child '.$eID.'formID23">
                             <span>Daily Dance Hall Permit </span>
                             <a href="/dance-application/?child=Yes'.$link.'">Fill out Daily Dance Hall Permit</a>
                             </li>'; }
                            if ( $nPermit == 'Yes') { echo '<li class="child '.$eID.'formID15">
                            <span>Noise Permit  </span>
                            <a href="/noise-permit/?child=Yes'.$link.'">Fill out Noise Permit</a>
                            </li>'; }
                            if ( $aPermit == 'Yes') { echo '<li class="child '.$eID.'formID4">
                            <span>Animal Show Permit  </span>
                            <a href="/animal-permit/?child=Yes'.$link.'">Fill out Animal Permit</a>
                            </li>'; }
                            //follow the above formula for all  permits
                            if ( $alch == '2') { 
                                echo '<li class="child '.$eID.'formID18">
                                <span>KCMO Catering Permit (Alcohol)   <a href="/catering-permit-application/?child=Yes'.$link.'">Fill Out The KCMO Catering Permit Form</a><'; 
                                echo  '<br><br>Please advise the company servering the alcohol that they will need to submit the permits to the city and the state.</span>';
                                echo  '<br><a href="/faqs#what-steps-do-i-need-to-take-to-get-alcohol-permits-for-my-event">Here are the permits and steps to follow.</a></li>';
                            }
                            if ( $nonp == 'Yes') {echo '<li class="child '.$eID.'formID24">
                                <span>KCMO Non-Profit Special Event Permit  </span>
                                <a href="/non-profit-event-permit-application/?child=Yes'.$link.'">Fill Out Non-Profit Form</a></li>'; 
                            } 
                            if ( $alch == '1' && $nonp == 'No') {echo '<li class="child '.$eID.'formID18">
                            <span>KCMO Catering Permit (Alcohol)</span>
                            <a href="/catering-permit-application/?child=Yes'.$link.'">Fill Out The KCMO Catering Permit Form</a></li>';}

                            if ( $liq == 'Yes') { echo '<li class="child">
                                <span>State of MO Temporary Caterers Permit </span><a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0024.pdf"><i></i></a></li>'; }
                            if ( $liq == 'No') { echo '<li class="child">
                                <span>State of MO Picnic License </span>
                            <a href="http://atc.dps.mo.gov/documents/forms/MO_829-A0027.pdf"><i></i></a></li>'; }
                            if ( $eventType == '3') { echo '<li class="child '.$eID.'formID25">
                                <span>Block Party Permit
                                <br>Remember to download and fill out the signatures page.
                                <a class="dl" href="/wp-content/uploads/2015/07/block-party-signature-page.pdf">Click here.</a>
                                 </span>
                                <a href="/block-party/?child=Yes&eventType='. $eventType .'&uniKey='. $eID .'&eventName='.$enData['event_name'].'">Fill Out Form</a></li>'; }
                            if ( $eventType == '5') { echo '<li class="child '.$eID.'formID29">
                                <span>Festival Permit
                                 <br>Remember to download and fill out the signatures page.
                                <a class="dl" href="/wp-content/uploads/2015/07/festival-signature-page.pdf">Click here.</a></span>
                                <a href="/festival-permit/?child=Yes&eventType='. $eventType .'&uniKey='. $eID .'&eventName='.$enData['event_name'].'">Fill Out Form</a></li>'; }
                            if ( $eventType == '7') { echo '<li class="child '.$eID.'formID16">
                                <span>Parade Permit</span>
                                 <a href="/parade-application/?child=Yes&eventType='. $eventType .'&uniKey='. $eID .'&eventName='.$enData['event_name'].'">Fill Out Form</a></li>'; }
                            if ( $eventType == '9') { echo '<li class="child">
                                <span>Please visit 
                            <a class="dl" href="http://kcraceday.org" target="blank">KC Race Day</a> to finish your Race permit! If you are coming from KCraceDay then you are all set!</span></li>'; }
                            if ( $park_permit == 'Yes') { 
                                echo '<li class="child">
                                <span>Your event requires a Use and Concession Agreement from the Parks Department. Contact Parks Department for assistance 816-513-7500 </span>
                                </li>'; }   
                            if ( $ems_permit  >= '1000') { echo '<li class="child '.$eID.'formID27">
                                <span>Fire EMS Permit</span>
                                <a href="/fire-ems/?child=Yes'.$link.'&peopleCount='.$ems_permit.'&overOne=Yes">Review and Submit for Fire EMS Planning</a></li>'; }
                            if ( $fire_permit == 'Yes') { echo '<li class="child '.$eID.'formID28">
                                <span>Fire Tent Permit</span>
                                <a href="/fire-tents-application/?child=Yes'.$link.'&gas='.$fire_permit.'&rides='.$fire_permit.'&firework='.$fire_permit.'">Review & Submit for fire tent and canopies</a></li>'; }
                            if ( $traffic_permit  == 'Yes') { echo '<li class="child '.$eID.'formID13"> 
                                <span>Traffic Control Permit</span>
                            <a href="/traffic-control/?child=Yes'.$link.'">Fill Out The Traffic Control Permit</a></li>'; }
                            if ( $police_traffic  == 'Yes') { echo '<li class="child '.$eID.'formID26"> 
                                <span>Police Traffic</span>
                            <a href="/police-traffic-permit/?child=Yes'.$link.'">Review and submit for Police Traffic Planning</a></li>'; }
                            if ( $admission == 'Yes' || $alcServ == 'Yes' || $dPermit == 'Yes' || $nPermit == 'Yes') { echo '<li class="child '.$eID.'formID30">
                                <span>Police Security Permit</span>
                            <a href="/police-security-permit/?child=Yes'.$link.'&admission='.$admission.'&alcohol='.$alcServ.'&dance='.$dPermit.'&noise='.$nPermit.'">Review & Submit for KCPD Security Planning</a></li>'; }
                        } 
                        if ( $id == '4' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '15' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '13' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '25' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '18' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '23' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '29' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '27' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=default-template.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '28' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=default-template.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '24' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '16' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=default-template.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '30' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=default-template.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';

                        }  if ( $id == '26' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=default-template.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }
                          if ( $id == '14' ) {
                            if ( $is_child == 'Yes' ) {
                                echo '<li class="child" value="'.$eID.'formID'.$enData['form_id'].'">'.$enData['form_name'].'';                             
                            } else { 
                                echo '<li>'.$enData['form_name'].''; } 
                                echo '<h6 class="eventstatus '.$es.'">'.$es .' Permit <i></i></h6>'; 
            
                        echo'<form action="/'.$enData['slug'].'/?update_entry_id='.$enID.'" method="post">
                            <button class="sticky-list-edit submit">Edit Entry</button>
                            <input type="hidden" name="mode" value="edit">
                            <input type="hidden" name="edit_id" value="'.$enID.'">
                        </form>';
                        echo '<a class="pdfLink" href="/?gf_pdf=1&fid='.$enData['form_id'].'&lid='.$enID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';
                        echo '</li>';
                        }



        
                  
                 
                       
                        echo '</div>';
                        
                    }
                    echo '</ul>';             
                }
                echo '</div>';
            }
echo '</div>';
?>