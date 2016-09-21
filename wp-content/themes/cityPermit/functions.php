<?php

require_once('functions/theme.php');
require_once('functions/script.php');
require_once('functions/menu.php');
require_once('functions/widget.php');
require_once('functions/taxonomies.php');
require_once('functions/post-types.php');
require_once('functions/calendar.php');
require_once('functions/saveforms.php');

add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}


add_action('wp_head','ajaxurl');
function ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}

//delet shittt
add_action('wp_ajax_delete_row', 'deleteRow');
add_action('wp_ajax_nopriv_delete_row', 'deleteRow');
function deleteRow( $entry ) {
    $id = $_POST['entry_id'];
    // $eventId = $_POST['event_id'];
    // GFAPI::delete_entry( $id );
    global $wpdb;
    $wpdb->delete('event_key' , array( 'entry_id' => $id ));
    exit();
}

add_action('wp_ajax_approve_row', 'approveRow');
add_action('wp_ajax_nopriv_approve_row', 'approveRow');
function approveRow() {
    $id = $_POST['entry_id'];
    global $wpdb;
    $wpdb->query($wpdb->prepare("UPDATE event_key SET event_status='Approved' WHERE entry_id=$id"));     
    $wpdb->query($wpdb->prepare("UPDATE wp_rg_lead_detail SET value='Approved' WHERE lead_id=$id AND field_number='200'"));     
    $wpdb->query($wpdb->prepare("UPDATE wp_rg_lead_detail SET value='Approved' WHERE lead_id=$id AND field_number='153'"));     
    exit();
}
add_action('wp_ajax_deny_row', 'denyRow');
add_action('wp_ajax_nopriv_deny_row', 'denyRow');
function denyRow() {
    $id = $_POST['entry_id'];
    global $wpdb;
    $wpdb->query($wpdb->prepare("UPDATE event_key SET event_status='Denied' WHERE entry_id=$id"));   
    $wpdb->query($wpdb->prepare("UPDATE wp_rg_lead_detail SET value='Denied' WHERE lead_id=$id AND field_number='200'"));     
    $wpdb->query($wpdb->prepare("UPDATE wp_rg_lead_detail SET value='Denied' WHERE lead_id=$id AND field_number='153'"));   
    exit();
}
add_action('wp_ajax_pending_row', 'pendingRow');
add_action('wp_ajax_nopriv_pending_row', 'pendingRow');
function pendingRow() {
    $id = $_POST['entry_id'];
    global $wpdb;
    $wpdb->query($wpdb->prepare("UPDATE event_key SET event_status='Pending' WHERE entry_id=$id"));   
    $wpdb->query($wpdb->prepare("UPDATE wp_rg_lead_detail SET value='Pending' WHERE lead_id=$id AND field_number='200'"));     
    $wpdb->query($wpdb->prepare("UPDATE wp_rg_lead_detail SET value='Pending' WHERE lead_id=$id AND field_number='153'"));   
    exit();
}



add_filter('login_errors',create_function('$a', "return null;"));
add_filter('show_admin_bar', '__return_false');

add_filter('gform_field_value_userid', 'pop_user_id');
function pop_user_id($value){
    $user = wp_get_current_user();
    $user = $user->id;
    return $user;
}
add_filter('gform_field_value_update_entry_id', 'update_entry_id');
function update_entry_id($value){

  $eIDe = $_GET['update_entry_id'];

    return $eIDe;
}

// add_filter( 'gform_entry_id_pre_save_lead', 'my_update_entry_on_form_submission', 10, 2 );
// function my_update_entry_on_form_submission( $entry_id, $form, $entry ) {
// $update_entry_id = rgpost( 'update_entry_id' );

// if(isset($update_entry_id)) {
//   echo 'set';
//     $update_entry_id = rgpost( 'update_entry_id' );
//     return $update_entry_id ? $update_entry_id : $entry_id;
//   } else { echo 'not set';}
// }

add_filter( 'gform_entry_id_pre_save_lead', 'my_update_entry_on_form_submission', 10, 2 );
function my_update_entry_on_form_submission( $entry_id, $form ) {
    $update_entry_id = rgget( 'update_entry_id' );
    return $update_entry_id ? $update_entry_id : $entry_id;
}

add_filter( 'login_redirect', create_function( '$url,$query,$user', 'return home_url();' ), 10, 3 );

//Unqiue and random event key generation to group the forms up properly. 
add_filter('gform_field_value_uniKeyGen', 'uni_key_gen');
function uni_key_gen($value){
    $user = wp_get_current_user();
    $user = $user->user_nicename;
    // $shuffled = str_shuffle($user);
for ($i = -1; $i <= 4; $i++) {
    $bytes = openssl_random_pseudo_bytes($i, $cstrong);
    $hex   = bin2hex($bytes);
}
$hex = $user .'-'. $hex;
   return  $hex; 
}






add_action( 'gform_after_submission_3', 'save_event_key', 10, 2 );
function save_event_key( $entry, $form ) {


  global $wpdb;
  global $post;
  $user = wp_get_current_user();
  $email = $user->user_email;
  $user = $user->ID;
  $form_id = $entry['form_id'];
  $form = GFAPI::get_form($form_id);
  $form_name = $form['title'];
  $entry_id = $entry['id'];
  $event_type = $entry['1'];
  $event_id = $entry['2'];
  $event_name = $entry['3'];
  $slug = get_post( $post )->post_name;
  $date_submited = date('d-m-y');

  $first_name = get_user_meta( $user, 'first_name', true );
  $last_name = get_user_meta( $user, 'last_name', true );
  $address = get_user_meta( $user, 'address line 1', true );
  $addresstwo = get_user_meta( $user, 'address line 2', true );
  $city = get_user_meta( $user, 'address city', true );
  $zip = get_user_meta( $user, 'address zip', true );
  $state = get_user_meta( $user, 'address state', true );
  $phone = get_user_meta( $user, 'phone', true );
  

$wpdb->insert('event_key',array(
  'user_id'=>$user,
  'form_id'=>$form_id,
  'form_name'=>$form_name,
  'entry_id'=>$entry_id,
  'event_id'=>$event_id,
  'event_type'=>$event_type,
  'event_name'=>$event_name,
  'form_page'=>$slug,
  'date_submited'=>$date_submited,
  'first_name'=>$first_name,
  'last_name'=>$last_name,
  'address'=>$address,
  'addresstwo'=>$addresstwo,
  'city'=>$city,
  'zip'=>$zip,
  'state'=>$state,
  'phone'=>$phone,
  'email'=>$email
)
    );

  } 


add_action( 'gform_after_submission_2', 'save_main_app', 10, 2 );
  function save_main_app( $entry, $form ) {

  global $wpdb;
  global $post;

  $update_entry_id = $entry['95'];

  $user = wp_get_current_user();
  $email = $user->user_email;
  $user = $user->ID;  
  
  $form_id = $entry['form_id'];
  $form = GFAPI::get_form($form_id);
  $form_name = $form['title'];
  $entry_id = $entry['id'];
  $event_id = $entry['22'];
  $event_name = $entry['1'];
  $event_type = $entry['127'];
  $food = $entry['69'];
  $noise = $entry['70'];
  $dance = $entry['71'];
  $animal = $entry['72'];
  $alc_served = $entry['65'];
  $alc_who_serv = $entry['128'];
  $park_permit = $entry['134'];
  $fire_permit = $entry['83'];
  $ems_permit = $entry['135'];
  $traffic_permit = $entry['75'];
  $police_traffic = $entry['76'];
  $admission = $entry['63'];
  $non_profit = $entry['67'];
  $liquor_licence = $entry['68'];
  $slug = get_post( $post )->post_name;
  $date_submited = date('d-m-y');
  
  
  $event_status = $entry['153'];
  $location = $entry['155'];
  $description = $entry['3'];
  $event_image = $entry['157'];
  
//dates and time
  $event_date = $entry['9'];
  $event_date_end = $entry['12'];
  $event_time_start = $entry['118'];
  $event_time_end = $entry['119'];

  $sponsor_name = $entry['36'];
  $sponsor_address = $entry['38.1'];
  $sponsor_two = $entry['38.2'];
  $sponsor_city = $entry['38.3'];
  $sponsor_state = $entry['38.4'];
  $sponsor_zip = $entry['38.5'];
  $sponsor_phone = $entry['42'];
  $sponsor_email = $entry['40'];

  $day_phone  = $entry['61'];
  $day_contact = $entry['60'];
  $location_des = $entry['62'];


  $first_name = get_user_meta( $user, 'first_name', true );
  $last_name = get_user_meta( $user, 'last_name', true );
  $address = get_user_meta( $user, 'address line 1', true );
  $addresstwo = get_user_meta( $user, 'address line 2', true );
  $city = get_user_meta( $user, 'address city', true );
  $zip = get_user_meta( $user, 'address zip', true );
  $state = get_user_meta( $user, 'address state', true );
  $phone = get_user_meta( $user, 'phone', true );
  


if(!empty($update_entry_id)) {
  // echo 'not empty';


$wpdb->update( 
  'event_key', 
  array( 
  'user_id' => $user,
  'description' => $description,
  'event_image'=>$event_image,
  'form_id' => $form_id,
  'form_name' => $form_name,
  'event_id' => $event_id,
  'event_type' => $event_type,
  'event_name' => $event_name,
  'event_date' => $event_date,
  'event_date_end' => $event_date_end,
  'event_time_start' => $event_time_start,
  'event_time_end' => $event_time_end,
  'sponsor_name' => $sponsor_name,
  'sponsor_address' => $sponsor_address,
  'sponsor_two' => $sponsor_two,
  'sponsor_city' => $sponsor_city,
  'sponsor_state' => $sponsor_state,
  'sponsor_zip' => $sponsor_zip,
  'sponsor_phone' => $sponsor_phone,
  'sponsor_email' => $sponsor_email,
  'day_phone'  => $day_phone,
  'day_contact' => $day_contact,
  'location_des' => $location_des,
  'food_permit' => $food,
  'dance_permit' => $dance,
  'noise_permit' => $noise,
  'animal_permit' => $animal,
  'alc_served' => $alc_served,
  'alc_who_serv' => $alc_who_serv,
  'park_permit' => $park_permit,
  'fire_permit' => $fire_permit,
  'ems_permit' => $ems_permit,
  'traffic_permit' => $traffic_permit,
  'admission' => $admission,
  'non_profit' => $non_profit,
  'liquor_licence' => $liquor_licence,
  'form_page' => $slug,
  'date_submited' => $date_submited,
  'location' => $location,
  'event_status' => $event_status,
  'police_traffic' => $police_traffic
  ), 
  array( 'entry_id' => $update_entry_id )
);


} else {
    // echo 'empty';


$wpdb->insert('event_key',array(
  'user_id'=>$user,
  'description' => $description,
  'event_image'=>$event_image,
  'form_id'=>$form_id,
  'form_name'=>$form_name,
  'entry_id'=>$entry_id,
  'event_id'=>$event_id,
  'event_type'=>$event_type,
  'event_name'=>$event_name,
  'event_date' => $event_date,
  'event_date_end' => $event_date_end,
  'event_time_start' => $event_time_start,
  'event_time_end' => $event_time_end,
  'sponsor_name' => $sponsor_name,
  'sponsor_address' => $sponsor_address,
  'sponsor_two' => $sponsor_two,
  'sponsor_city' => $sponsor_city,
  'sponsor_state' => $sponsor_state,
  'sponsor_zip' => $sponsor_zip,
  'sponsor_phone' => $sponsor_phone,
  'sponsor_email' => $sponsor_email,
  'day_phone'  => $day_phone,
  'day_contact' => $day_contact,
  'location_des' => $location_des,
  'food_permit'=>$food,
  'dance_permit'=>$dance,
  'noise_permit'=>$noise,
  'animal_permit'=>$animal,
  'alc_served'=>$alc_served,
  'alc_who_serv'=>$alc_who_serv,
  'park_permit' =>$park_permit,
  'fire_permit' =>$fire_permit,
  'ems_permit' =>$ems_permit,
  'traffic_permit' =>$traffic_permit,
  'admission' =>$admission,
  'non_profit'=>$non_profit,
  'liquor_licence'=>$liquor_licence,
  'form_page'=>$slug,
  'date_submited'=>$date_submited,
  'location'=>$location,
  'first_name'=>$first_name,
  'last_name'=>$last_name,
  'address'=>$address,
  'city'=>$city,
  'zip'=>$zip,
  'state'=>$state,
  'phone'=>$phone,
  'email'=>$email,
  'police_traffic' => $police_traffic,
  'event_status'=>'Received'
)
    );
  
}
  } 


//admin edit entry save to db
add_action("gform_after_update_entry","update_entry", 10, 2);
function update_entry($form, $entry_id)
{

  global $wpdb;
  $entry = GFAPI::get_entry( $entry_id );

  $form_id = $entry['form_id'];
  $form = GFAPI::get_form($form_id);
  $form_name = $form['title'];
  $entry_id = $entry['id'];
  $event_id = $entry['22'];
  $event_name = $entry['1'];
  $event_type = $entry['127'];
  $food = $entry['69'];
  $noise = $entry['70'];
  $dance = $entry['71'];
  $animal = $entry['72'];
  $alc_served = $entry['65'];
  $alc_who_serv = $entry['128'];
  $park_permit = $entry['134'];
  $fire_permit = $entry['83'];
  $ems_permit = $entry['135'];
  $traffic_permit = $entry['75'];
  $admission = $entry['63'];
  $non_profit = $entry['67'];
  $liquor_licence = $entry['68'];
  $slug = get_post( $post )->post_name;
  $date_submited = date('d-m-y');
  $event_date = $entry['9'];
  $event_status = $entry['153'];
  $location = $entry['155'];
  $desc = $entry['3'];
  $image = $entry['157'];
  $wpdb->update( 
  'event_key', 
  array( 

  'user_id'=>$user,
  'description' => $description,
  'event_image'=>$event_image,
  'form_id'=>$form_id,
  'form_name'=>$form_name,
  'entry_id'=>$entry_id,
  'event_id'=>$event_id,
  'event_type'=>$event_type,
  'event_name'=>$event_name,
  'event_date'=>$event_date,
  'food_permit'=>$food,
  'dance_permit'=>$dance,
  'noise_permit'=>$noise,
  'animal_permit'=>$animal,
  'alc_served'=>$alc_served,
  'alc_who_serv'=>$alc_who_serv,
  'park_permit' =>$park_permit,
  'fire_permit' =>$fire_permit,
  'ems_permit' =>$ems_permit,
  'traffic_permit' =>$traffic_permit,
  'admission' =>$admission,
  'non_profit'=>$non_profit,
  'liquor_licence'=>$liquor_licence,
  'form_page'=>$slug,
  'date_submited'=>$date_submited,
  'location'=>$location,
  'first_name'=>$first_name,
  'last_name'=>$last_name,
  'address'=>$address,
  'city'=>$city,
  'zip'=>$zip,
  'state'=>$state,
  'phone'=>$phone,
  'email'=>$email,
  'event_status'=>$event_status



  ), 
  array( 'entry_id' => $entry_id )
);
}






/**
 * Multi-page Navigation
 * http://gravitywiz.com/
 */
 
class GWMultipageNavigation {
 
    private $script_displayed;
 
    function __construct( $args = array() ) {
 
        $form_ids = false;
        if( isset( $args['form_id'] ) ) {
            $form_ids = is_array( $args['form_id'] ) ? $args['form_id'] : array( $args['form_id'] );
        }
 
        if( !empty($form_ids) ) {
            foreach( $form_ids as $form_id ) {
                add_filter("gform_pre_render_{$form_id}", array( &$this, 'output_navigation_script' ), 10, 2 );
                //add_filter('gform_register_init_scripts', array( &$this, 'register_script') );
            }
        } else {
            add_filter('gform_pre_render', array( &$this, 'output_navigation_script' ), 10, 2 );
        }
 
    }
 
    function output_navigation_script( $form, $is_ajax ) {
 
        // only apply this to multi-page forms
        if( count($form['pagination']['pages']) <= 1 )
            return $form;
 
        $this->register_script( $form );
 
        if( $this->is_last_page( $form ) || $this->is_last_page_reached() ) {
            $input = '<input id="gw_last_page_reached" name="gw_last_page_reached" value="1" type="hidden" />';
            add_filter( "gform_form_tag_{$form['id']}", create_function('$a', 'return $a . \'' . $input . '\';' ) );
        }
 
        // only output the gwmpn object once regardless of how many forms are being displayed
        // also do not output again on ajax submissions
        if( $this->script_displayed || ( $is_ajax && rgpost('gform_submit') ))
            return $form;
 
        ?>
 
        <script type="text/javascript">
 
            (function($){
 
                window.gwmpnObj = function( args ) {
 
                    this.formId = args.formId;
                    this.formElem = jQuery('form#gform_' + this.formId);
                    this.currentPage = args.currentPage;
                    this.lastPage = args.lastPage;
                    this.labels = args.labels;
 
                    this.init = function() {
 
                        // if this form is ajax-enabled, we'll need to get the current page via JS
                        if( this.isAjax() )
                            this.currentPage = this.getCurrentPage();
 
                        if( !this.isLastPage() && !this.isLastPageReached() )
                            return;
 
                        var gwmpn = this;
                        var steps = $('form#gform_' + this.formId + ' .gf_step');
 
                        steps.each(function(){
 
                            var stepNumber = parseInt( $(this).find('span.gf_step_number').text() );
 
                            if( stepNumber != gwmpn.currentPage ) {
                                $(this).html( gwmpn.createPageLink( stepNumber, $(this).html() ) )
                                    .addClass('gw-step-linked');
                            } else {
                                $(this).addClass('gw-step-current');
                            }
 
                        });
 
                        if( !this.isLastPage() )
                            this.addBackToLastPageButton();
 
                        $(document).on('click', '#gform_' + this.formId + ' a.gwmpn-page-link', function(event){
                            event.preventDefault();
 
                            var hrefArray = $(this).attr('href').split('#');
                            if( hrefArray.length >= 2 ) {
                                var pageNumber = hrefArray.pop();
                                gwmpn.postToPage( pageNumber );
                            }
 
                        });
 
                    }
 
                    this.createPageLink = function( stepNumber, HTML ) {
                        return '<a href="#' + stepNumber + '" class="gwmpn-page-link">' + HTML + '</a>';
                    }
 
                    this.postToPage = function(page) {
                        this.formElem.append('<input type="hidden" name="gw_page_change" value="1" />');
                        this.formElem.find('input[name="gform_target_page_number_' + this.formId + '"]').val(page);
                        this.formElem.submit();
                    }
 
                    this.addBackToLastPageButton = function() {
                        this.formElem.find('#gform_page_' + this.formId + '_' + this.currentPage + ' .gform_page_footer')
                            .append('<input type="button" onclick="gwmpn.postToPage(' + this.lastPage + ')" value="' + this.labels.lastPageButton + '" class="button gform_last_page_button">');
                    }
 
                    this.getCurrentPage = function() {
                        return this.formElem.find( 'input#gform_source_page_number_' + this.formId ).val();
                    }
 
                    this.isLastPage = function() {
                        return this.currentPage >= this.lastPage;
                    }
 
                    this.isLastPageReached = function() {
                        return this.formElem.find('input[name="gw_last_page_reached"]').val() == true;
                    }
 
                    this.isAjax = function() {
                        return this.formElem.attr('target') == 'gform_ajax_frame_' + this.formId;
                    }
 
                    this.init();
 
                }
 
            })(jQuery);
 
        </script>
 
        <?php
        $this->script_displayed = true;
        return $form;
    }
 
    function register_script( $form ) {
 
        $page_number = GFFormDisplay::get_current_page($form['id']);
        $last_page = count($form['pagination']['pages']);
 
        $args = array(
            'formId' => $form['id'],
            'currentPage' => $page_number,
            'lastPage' => $last_page,
            'labels' => array(
                'lastPageButton' => __('Back to Last Page')
                )
            );
 
        $script = "window.gwmpn = new gwmpnObj(" . json_encode( $args ) . ");";
        GFFormDisplay::add_init_script( $form['id'], 'gwmpn', GFFormDisplay::ON_PAGE_RENDER, $script );
 
    }
 
    function is_last_page( $form ) {
 
        $page_number = GFFormDisplay::get_current_page($form['id']);
        $last_page = count($form['pagination']['pages']);
 
        return $page_number >= $last_page;
    }
 
    function is_last_page_reached() {
        return rgpost('gw_last_page_reached');
    }
 
}
 
$gw_multipage_navigation = new GWMultipageNavigation();


function get_the_slug() {
global $post;
return $post->post_name;
}