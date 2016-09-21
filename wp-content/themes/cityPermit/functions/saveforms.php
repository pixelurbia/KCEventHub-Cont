<?php



add_action( 'gform_after_submission_25', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_4', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_29', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_16', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_13', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_14', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_15', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_23', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_24', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_18', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_26', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_30', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_27', 'save_form_four', 10, 2 );
add_action( 'gform_after_submission_28', 'save_form_four', 10, 2 );

// We need the event title and id and everything pulling to make this work correctly gonna take some work to pull off
//jk just the event id to pull the info over from form 2
function save_form_four( $entry, $form ) {

  global $wpdb;
  global $post;
  $event_type = $_GET['eventType'];
  $event_date = $_GET['eventDate'];
  $is_child = $_GET['child'];
  $event_name = $entry['199'];
  $user = wp_get_current_user();
  $email = $user->user_email;
  $user = $user->ID;
  $form_id = $entry['form_id'];
  $form = GFAPI::get_form($form_id);
  $form_name = $form['title'];
  $entry_id = $entry['id'];
  $event_id = $entry['201'];
  $slug = get_post( $post )->post_name;
  $date_submited = date('d-m-y');
  $event_status = $entry['200'];

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
  'is_child'=>$is_child,
  'form_name'=>$form_name,
  'entry_id'=>$entry_id,
  'event_id'=>$event_id,
  'event_type'=>$event_type,
  'event_status'=>$event_status,
  'event_name'=>$event_name,
  'event_date'=>$event_date,
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
