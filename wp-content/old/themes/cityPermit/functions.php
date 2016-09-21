<?php

require_once('functions/theme.php');
require_once('functions/script.php');
require_once('functions/menu.php');
require_once('functions/widget.php');
require_once('functions/taxonomies.php');
require_once('functions/post-types.php');
require_once('functions/calendar.php');

add_filter('login_errors',create_function('$a', "return null;"));

add_filter('show_admin_bar', '__return_false');

add_filter('gform_field_value_userid', 'pop_user_id');
function pop_user_id($value){
    $user = wp_get_current_user();
    $user = $user->id;
    return $user;
}

add_filter( 'gform_entry_id_pre_save_lead', 'my_update_entry_on_form_submission', 10, 2 );
function my_update_entry_on_form_submission( $entry_id, $form ) {
    $update_entry_id = rgget( 'update_entry_id' );
    return $update_entry_id ? $update_entry_id : $entry_id;
}


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

$wpdb->insert('event_key',array(
  'user_id'=>$user,
  'form_id'=>$form_id,
  'form_name'=>$form_name,
  'entry_id'=>$entry_id,
  'event_id'=>$event_id,
  'event_type'=>$event_type,
  'event_name'=>$event_name,
  'form_page'=>$slug,
  'date_submited'=>$date_submited
)
    );

  } 

  add_action( 'gform_after_submission_2', 'save_main_app', 10, 2 );
function save_main_app( $entry, $form ) {

  global $wpdb;
  global $post;
  
  $update_entry_id = $entry['95'];
  $user = wp_get_current_user();
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
  $admission = $entry['63'];
  $non_profit = $entry['67'];
  $liquor_licence = $entry['68'];
  $slug = get_post( $post )->post_name;
  $date_submited = date('d-m-y');


if(!empty($update_entry_id)) {

  $wpdb->update( 
  'event_key', 
  array( 
   'user_id'=>$user,
  'form_id'=>$form_id,
  'form_name'=>$form_name,
  'entry_id'=>$entry_id,
  'event_id'=>$event_id,
  'event_type'=>$event_type,
  'event_name'=>$event_name,
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
  'date_submited'=>$date_submited

  ), 
  array( 'entry_id' => $update_entry_id )
);

} else {

$wpdb->insert('event_key',array(
  'user_id'=>$user,
  'form_id'=>$form_id,
  'form_name'=>$form_name,
  'entry_id'=>$entry_id,
  'event_id'=>$event_id,
  'event_type'=>$event_type,
  'event_name'=>$event_name,
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
  'date_submited'=>$date_submited
)
    );
  
}
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