<?php
/*
Template Name: Events
*/
?>

<?php get_template_part('templates/header'); ?>

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

   
                    $title = get_the_title();
                    echo '<h1>'. $title .'</h1>';
                    the_content(); 
                    echo '<div class="dept-sorting sorting">';
                        echo '<h6>Sorting:</h6>';
                        echo '<h5 class="ASC" value="event_type" name="ASC">Event Type <i></i></h5>';
                        echo '<h5 class="ASC" value="event_name" name="ASC">Name<i></i></h5>';
                        echo '<h5 class="ASC" value="event_date" name="ASC">Date<i></i></h5>';
                        echo '<h5 class="ASC" value="event_status" name="ASC">Status<i></i></h5>';
                        // echo '<br>';
                        echo "<select class='getPermit'>
                                <option value='2'>Permit type to view.</option>
                                <option value='2'>Main Applications</option>
                                <option value='25'>Block Party</option>
                                <option value='4'>Animal Show Permit</option>
                                <option value='29'>Festival Permit</option>
                                <option value='16'>Parade Permit</option>
                                <option value='13'>Traffic Control Permit</option>
                                <option value='14'>Temporary Food Permit</option>
                                <option value='15'>Noise Permit</option>
                                <option value='23'>Dance Hall Permit</option>
                                <option value='24'>KCMO Non-Profit Special Events (alcohol for city, 501C3 event)</option>
                                <option value='18'>KCMO Caterer's Permit (alcohol for city, for profit event)</option>
                                <option value='26'>Police Traffic</option>
                                <option value='30'>Police Security</option>
                                <option value='27'>Fire EMS</option>
                                <option value='28'>Fire Tents and Canopies</option>
                            </select>";

                    echo '</div>';
                 

                        

echo '<div class="dept-que">';
get_template_part('department-page-on-load'); 
echo '</div>';
echo '</div>';
                  
get_template_part('filter-sidebar');
                    
 } endwhile; ?>
    </div>
    </div>
</div>



<?php get_template_part('templates/footer'); ?>