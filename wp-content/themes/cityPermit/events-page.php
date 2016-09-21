<?php
/*
Template Name: Events
*/
?>

<?php get_template_part('templates/header'); 
$thanks = $_GET['thanks'];
if ($thanks == 'Yes') {

    echo '<div class="notification wow fadeInDown" style="padding: 3%; background: #498fe1; float: left; width: 75%; position: absolute; font-size: 23px; text-align: center; border-radius: 5px; left: 0; right: 0; margin: 4% auto; color: white; opacity: 0.9;"> Thank you for your submission! <br> You can view the progress of your applications below. </div>';
}
?>

<div class="single events-page ">
    <div class="row bo">
        <div class="contentwrap">
        
            <?php while ( have_posts() ) : the_post(); ?>
            <?php  
                if(!is_user_logged_in()) {
                    echo '<h5 class="login-notice">Hey there! You need to login before you can see this content!</h5>';
                    wp_login_form(); 
                    echo '<a class="register" href="/register/">Need an Account? Register Today!</a> ';
                } else {

                    echo '<div class="events-col">';

        //         echo '<h1>Test</h1>';

        //         $sEntries = GFFormsModel::get_leads(2);
                      
        //    foreach($sEntries as $entry ){
        //     // $form = GFFormsModel::get_form_meta( $entry['form_id'] );
        //     // var_dump($form);
        //     // var_dump($entry);
        //     // echo $entry['153'] .'<br>';
        //     echo $entry['3'];
        //     echo $entry['id'].'<br>';


        //     $id = $entry['id'];
        //     $id = intval($id);
        //     global $wpdb; 
        //     $ges = $wpdb->get_results("SELECT * FROM wp_rg_lead_detail WHERE lead_id = $id AND field_number = '153'");
        //     // $umd = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE user_id = $curuser");
        //    foreach($ges as $status){
        //         echo '<span class="'. $status->value .'">'. $status->value .'<span>';
        //     }
        // }
                    $title = get_the_title();
                    echo '<h1>'. $title .'</h1>';
                    the_content(); 
                    echo '<div class="sorting e-sorting">';
                        echo '<h6>Sorting:</h6>';
                        echo '<a class="sort"><h5 class="ASC" value="event_type" name="ASC">Event Type <i></i></h5></a>';
                        echo '<a class="sort"><h5 class="ASC" value="event_name" name="ASC">Name<i></i></h5></a>';
                        echo '<a class="sort"><h5 class="ASC" value="event_date" name="ASC">Date<i></i></h5></a>';
                        echo '<a class="sort"><h5 class="ASC" value="event_status" name="ASC">Status<i></i></h5></a>';
                        echo '<a href="/event-type" class="btn right">New Event</a>';
                    echo '</div>';

                    //db call and Sorting
                    global $wpdb;
                        $curuser = wp_get_current_user();
                        $curuser = $curuser->ID;
                        $ordby = 'date_created';
                        $a_or_d = 'DESC';
                            
                        $ice = $wpdb->get_results("SELECT * FROM wp_rg_incomplete_submissions WHERE user_id = $curuser ORDER BY $ordby $a_or_d");
                        echo '<div class="box event saved">';
                            echo '<ul class="'. $cube->event_title .'">';
                                echo '<h3 class="top formID">Saved Events</h3>';
                                echo '<a class="savedevents">View Saved Items &#187; </a>';
                                 echo '<div class="bottom formID">';
                        foreach($ice as $cube ){          
                                        echo '<li>Continue your application/permit for '. $cube->event_title .'! <a href="'. $cube->source_url .'"><i></i></a>'; 
                        }
                                    echo '</div>';
                                echo '</ul>';  
                            echo '</div>';

                        

echo '<div class="events-que">';
get_template_part('events-page-on-load'); 
 
echo '</div>';
                  
get_template_part('filter-sidebar');


                    
?>


    
    <?php } endwhile; ?>
    </div>
    </div>
</div>



<?php

 get_template_part('templates/footer'); 




?>