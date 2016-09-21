<?php
/*
Template Name: Department Que page
*/
?>
<?php
//the que

				global $wpdb;
						$formidtoget = $_GET['permitGet'];
                        $ordby = $_GET['ordby'];
                        $a_or_d = $_GET['sortby'];
                        
                        $entries = $wpdb->get_results("SELECT * FROM event_key WHERE form_id = $formidtoget ORDER BY $ordby $a_or_d");

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
                            $dates = $entry->event_date;
                    
                echo '<div class="box event '.$eventID.'">';
                echo '<h5 class="top formID'. $formID .'">'.$eventName.'</h5>';
                echo '<div class="top-data">';
                            echo '<h6 class="part location">Event Location: '.$location .'</h6>'; 
                            echo '<h6 class="part eventdate">Event Date: '.$dates .'</h6>'; 
                            echo '<h6 class="part eventstatus '.$event_status.'" value="'.$event_status.'">'.$event_status .' Event <i></i></h6>'; 
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
                            echo '<div class="statusbar">';
                    echo '<a class="approved dl"  value='.$entryID.'>Approve &#187;</a>';
                    echo '<a  class="pendingCal dl" value='.$entryID.'>Pending &#187;</a>';
                    echo '<a class="denied dl"  value='.$entryID.'>Deny &#187;</a>';
                    echo '<a class="delete dl"  value='.$entryID.'>Delete &#187;</a>';
                    echo '</div>';
                    echo '<a href="/?gf_pdf=1&fid='.$formID.'&lid='.$entryID.'&template=example-header-and-footer_06.php">Download Full Application PDF &#187;</a>';

                        echo '<div class="eventtype" value="'.$eventType.'"></div>';
                            echo '</div>';

                                                        
                    }
                

                       
                   
                   ?>