<?php

/**
 * Don't give direct access to the template
 */ 
if(!class_exists("RGForms")){
    return;
}

/**
 * Load the form data to pass to our PDF generating function 
 */
$form = RGFormsModel::get_form_meta($form_id);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>  
    <link rel='stylesheet' href='<?php echo PDF_PLUGIN_URL .'initialisation/eventhub.css'; ?>' type='text/css' />
    <?php 
        /* 
         * Create your own stylesheet or use the <style></style> tags to add or modify styles  
         * The plugin stylesheet is overridden every update      
         */
    ?>
    <title>Gravity PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <?php 
        /*
         * Using the @page method we can set the headers and footers
         * This method is more reliable that the <sethtmlpageheaders> method
         * See mPDF documentation for more details
         * http://mpdf1.com/manual/index.php?tid=307&searchstring=@page
         */
    ?>
    <style>
        @page {
            header: html_myHTMLHeader1;
            footer: html_myFooter1;
        }
    </style>
</head>
    <body>
        <?php   

        foreach($lead_ids as $lead_id) {

            $lead = RGFormsModel::get_lead($lead_id);
            $form_data = GFPDFEntryDetail::lead_detail_grid_array($form, $lead);
            
            /*
             * Add &data=1 when viewing the PDF via the admin area to view the $form_data array
             */
            PDF_Common::view_data($form_data);              
                        
            /*
             * Store your form fields from the $form_data array into variables here
             * To see your entire $form_data array, view your PDF via the admin area and add &data=1 to the url
             * 
             * For an example of accessing $form_data fields see https://developer.gravitypdf.com/documentation/custom-templates-introduction/
             *
             * Alternatively, as of v3.4.0 you can use merge tags (except {allfields}) in your templates. 
             * Just add merge tags to your HTML and they'll be parsed before generating the PDF.    
             *       
             */                                 

            ?>                
           
            <!-- Defines the headers/footers -->
            <!-- Headers and footers set with CSS @page method above -->

            
                
                
            <?php 
if ($form_id == 2) {
    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Event Application <span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';

} 
                
if ( $form_id == '4' ) {
    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Animal Display Application <span > {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
    Neighborhood and Community Services<br>
    Animal Health and Public Safety Division<br>
    816-513-9808
    </p>';

}
if ( $form_id == '15' ) {

    echo '<style>
    #field-202, #field-18 {display:none;}
    .formlogo {width:70px; margin-top:10px; float:left; margin-right:100px;}
    .phlogo { margin-top:5px; width: 130px; float: right; margin-left:30px;} 
    .address {float:right; padding-top:30px; text-align: center;}
    </style>';
        echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Noise Permit Application<span > {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<img class="phlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/phlogo.png">';
    echo '<p class="address">
    KCMO Health Department<br>
    2400 Troost Ave., #3000, Kansas City, MO 64108<br>
    816-513-6315
    </p>';

}                            
if ( $form_id == '13' ) {
    echo '<style>
    #field-24, #field-203 {display:none;}
    </style>';
        echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Traffic Control Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
        KCMO Department of Public Works<br>
        414 E. 12th Street, 5th Floor, City Hall<br>
        Kansas City, MO 64106<br>
        816-513-2646
    </p>';

}                            
if ( $form_id == '25' ) {
    echo '<style>

    </style>';

    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Block Party Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
    KCMO Department of Public Works<br>
    414 E. 12th Street, 5th Floor, City Hall<br>
    Kansas City, MO 64106<br>
    816-513-2581
    </p>';

}                           
if ( $form_id == '18' ) {
    echo '<style>
    #field-49, #field-51 {display:none;}
    </style>';
    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Catering Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
    KCMO Neighborhoods and Housing Services Department <br>
    Regulated Industries Division <br>
    635 Woodland Ave., Suite 2101, Kansas City, MO 64106 <br>
    (816) 513-4561
    </p>';

}                           
if ( $form_id == '23' ) {
 echo '<style>
 #field-29, #field-30 {display:none;}
    </style>';

    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Dance Hall Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
        KCMO Neighborhoods and Housing Services Department <br>
        Regulated Industries Division <br>
        635 Woodland Ave., Suite 2101, Kansas City, MO 64106<br>
        (816) 513-4561
    </p>';


 

}                           
if ( $form_id == '29' ) {
     echo '<style>
    #field-33, #field-25, #field-199 {display:none;}
    </style>';
    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Festival Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
      KCMO Department of Public Works<br>
      414 E. 12th Street, 5th Floor, City Hall<br>
      Kansas City, MO 64106<br>
      816-513-2646 or 816-513-2574
    </p>';


}                          

if ( $form_id == '27' ) {
     echo '<style>
    #field-32, #field-33, #field-199 {display:none;}
    </style>';
       echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Fire EMS Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    // echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';


}                            
if ( $form_id == '28' ) {
     echo '<style>

    </style>';
       echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Fire Tents Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    // echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';


}                          
if ( $form_id == '24' ) {
     echo '<style>

    </style>';
        echo '<style>
    #field-32, #field-33, #field-199 {display:none;}
    </style>';
    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Non-Profit Special Events Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
      KCMO Department of Public Works<br>
      414 E. 12th Street, 5th Floor, City Hall<br>
      Kansas City, MO 64106<br>
      816-513-2646 or 816-513-2574
    </p>';

}                            
if ( $form_id == '16' ) {
     echo '<style>

    </style>';

        echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Parade Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<p class="address">
      KCMO Department of Public Works<br>
      414 E. 12th Street, 5th Floor, City Hall<br>
      Kansas City, MO 64106<br>
     816-513-2581
    </p>';


}                            
if ( $form_id == '30' ) {
     echo '<style>
    #field-32, #field-33, #field-199 {display:none;}
    </style>';
       echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Police Security Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    // echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';

}                           
if ( $form_id == '14' ) {
 echo '<style>
#field-54, #field-199, #field-206  {display:none;}
    </style>';
    echo '<style>
     .formlogo {width:70px; margin-top:10px; float:left; margin-right:100px;}
    .phlogo { margin-top:5px; width: 130px; float: right; margin-left:30px;} 
 .address {float:right; padding-top:30px; text-align: center;}
 </style>';
    echo '<htmlpageheader name="myHTMLHeader1">';
    echo '<table width="100%" style="border-bottom: 1px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt; color: #000088;"><tr>';
    echo'<td width="50%">Temporary Food Permit Application<span> {PAGENO}</span></td>';
    echo '<td width="50%" style="text-align: right;"><span style="font-weight: bold;">KCeventhub.org</span></td>';
    echo '</tr></table>';
    echo '</htmlpageheader>';
    echo '<img class="formlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/kcmo_big_logo.jpg">';
    echo '<img class="phlogo" src="'. PDF_PLUGIN_URL .'initialisation/images/phlogo.png">';
    echo '<p class="address">
    KCMO Health Department<br>
    2400 Troost Ave., #3000, Kansas City, MO 64108<br>
    816-513-6315
    </p>';

}
            ?>


            <htmlpagefooter name="myFooter1">
            <table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt;
                color: #000000; font-weight: bold; font-style: italic;"><tr>
                <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td>
                <td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right; ">My document</td>
                </tr></table>


            </htmlpagefooter>

                   
            <div>

                    
        <div class="no-style">
            <?php
                /*
                 * Loop through the entries
                 * There is usually only one but you can pass more IDs through the lid URL parameter
                 */ 
                foreach($lead_ids as $lead_id) {
                    /* load the lead information */
                    $lead = RGFormsModel::get_lead($lead_id);

                    /* generate the entry HTML */
                    GFPDFEntryDetail::do_lead_detail_grid($form, $lead, $config_data);
                }
            ?>

        </div>
  <?php 
if ($form_id == 2) {
} 
                
if ( $form_id == '4' ) {
    echo '<hr>';
    echo "CERTIFICATION BY APPLICANT: I agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.";
    
    echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['11.Applicant Contact Info']['first'];
    echo ' ';
    echo $form_data['field']['11.Applicant Contact Info']['last'];
    echo ' | ';
    echo $form_data['field']['18.Date'];
    echo '<br>';
    echo '<br>';

    echo 'Animal Display Application Fee is $100 due at the time of application. Prior to authorizing a permit, Animal Health and Public Safety will inspect the proposed show location to examine its suitability for the intended use. Permit Application will not be processed without payment.';
}
if ( $form_id == '15' ) {
    echo '<p class="cert">CERTIFICATION BY APPLICANT: I agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.</p>';
    echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['Name of Applicant/Contact Person']['first'];
    echo ' ';
    echo $form_data['field']['Name of Applicant/Contact Person']['last'];
    echo ' | ';
    echo $form_data['field']['8.Date of Event'];
    echo '<br>';
    echo '<br>';

    echo 'Noise Permit Fee – $50.00 per event. Permit Application will not be processed without payment.';
}                            
if ( $form_id == '13' ) {echo 'CERTIFICATION BY APPLICANT: I certify that I have read, have understood and will comply with the requirements of the Application for Traffic Control Permit on this form. I  agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.';

 echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['E-Signature'];
    echo ' | ';
    echo $form_data['field']['Date'];
    echo '<br>';
    echo '<br>';



}                            
if ( $form_id == '25' ) {
     echo 'CERTIFICATION BY APPLICANT: I hereby certify that I agree to the following conditions:<br>
1. I am required to block-off the street portion specified herein only during the hours specified herein. <br>
2. Access will be granted to authorized emergency vehicles and residents within the blocked-off area. <br>
3. All block party participants WILL comply with City Ordinance governing noise, liquor and fireworks. <br>
4. This Neighborhood Block Party will be conducted only between the hours of 7:00AM and 10:00PM. <br>
5. I am responsible for clean-up (removing all trash/litter from the street, sidewalks and public ways). <br>
7. I agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.';

    echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['9.E-signature'];
    echo ' | ';
    echo $form_data['field']['Date'];
    echo '<br>';
    echo '<br>';


echo'Block Party Permit Fee – There is no fee for this permit.';
}                           
if ( $form_id == '18' ) {
    echo 'CERTIFICATION BY APPLICANT: I agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.';
    
    echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['49.E-Signature'];
    echo ' | ';
    echo $form_data['field']['Date'];
    echo '<br>';
    echo '<br>';
    

    echo 'Catering Permit Fee – A check made payable to the City Treasurer in the amount of $15 per day of the event must be paid prior to receiving your approval letter that you to submit to the State. Bring your State Permit back to Regulated Industries and receive your final Catering Permit. Permit Application will not be processed without payment.';
}                           
if ( $form_id == '23' ) {
    echo'CERTIFICATION BY APPLICANT: I agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.';
 echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['Signature'];
    echo ' | ';
    echo $form_data['field']['Date'];
    echo '<br>';
    echo '<br>';

    echo 'Daily Dance Hall Permit Fee – A check may payable to the City Treasurer in the amount of $15 per day of the event must be paid prior to receiving your permit. Permit Application will not be processed without payment.';
}                           
if ( $form_id == '29' ) {
    echo 'CERTIFICATION BY APPLICANT: I certify that I am to act on behalf of the sponsoring organizations for the proposed event and that the information submitted in connection with this Application is accurate and complete to the best of my knowledge. I also certify that I have read, understood and comply with the requirements of the accompanying form entitled " Instructions for Application for Traffic Control Permit - Festival". I understand that failure to comply with any of the requirements, or any lie or omission of any material fact, will render my Traffic Control Permit void, if issued. The sponsoring organization and I will hold the City of Kansas City, Missouri harmless from any liability resulting from this event. I understand that the traffic control permit, if issued, does NOT entitle me to violate any noise, liquor, fireworks, or other City ordinance, regulation, or law. I will undertake to clean up the street and return it to use within the permitted time. I  agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.';
    echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['E-Signature'];
    echo ' | ';
    echo $form_data['field']['Date'];
    echo '<br>';
    echo '<br>';
    echo 'Festival Permit Fee – $75.00 non-refundable plus the traffic control fee. If requested, The Department of Public Works will prepare a plan and applicant shall pay the City a nonrefundable fee in the amount of the direct costs and overhead incurred by the Department of Public Works as determined by the Director. In no event shall the fee be less than $150. All fees are payable by check to the “City Treasurer”, or by credit card. Permit Application will not be processed without payment.';
}                          
if ( $form_id == '27' ) {
    echo 'Fire Permit Fees – $70 per permit paid at the time of application. Permit Application will not be processed without payment.';

}                            
if ( $form_id == '28' ) {
    echo 'Fire Permit Fees – $70 per permit paid at the time of application. Permit Application will not be processed without payment.';
}                          
if ( $form_id == '24' ) {
    echo 'CERTIFICATION BY APPLICANT: I agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.';
  echo 'CERTIFICATION BY APPLICANT: I certify that I am to act on behalf of the sponsoring organizations for the proposed event and that the information submitted in connection with this Application is accurate and complete to the best of my knowledge. I also certify that I have read, understood and comply with the requirements of the accompanying form entitled " Instructions for Application for Traffic Control Permit - Festival" on Page 1 of 3. I understand that failure to comply with any of the requirements, or any lie or omission of any material fact, will render my Traffic Control Permit void, if issued. The sponsoring organization and I will hold the City of Kansas City, Missouri harmless from any liability resulting from this event. I understand that the traffic control permit, if issued, does NOT entitle me to violate any noise, liquor, fireworks, or other City ordinance, regulation, or law. I will undertake to clean up the street and return it to use within the permitted time.';
    echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['E-Signature'];
    echo ' | ';
    echo $form_data['field']['Date'];
    echo '<br>';
    echo '<br>';
    echo 'Non-Profit Special Event Application Fee – $15.00 for each day on which the event is held. Permit Application will not be processed without payment.';
}                            
if ( $form_id == '16' ) {
    echo 'CERTIFICATION BY APPLICANT: I agree to adhere to the “General Requirements & Conditions” contained herein, and understand that failure to do so will render the parade permit, if issued, void. The City of Kansas City, Missouri shall be held harmless from any liability resulting from the conduct of this event. I  agree to permit entry to any officer or investigator who may have legal authority for the purpose of inspection or search. I further agree to comply with the ordinances of the City of Kansas City, Mo., and the laws of the State of Missouri. I do swear that the information given in this application is true and correct to the best of my knowledge and belief.';
  echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']['E-Signature'];
    echo ' | ';
    echo $form_data['field']['Date'];
    echo '<br>';
    echo '<br>';

    echo 'Parade Fee –  $100.00 <br>
Make checks payable to: City of Kansas City, Missouri. <br>
Permit Application will not be processed without payment.<br>
Fees are refundable if the permit is not issued.<br>
';
}                            
if ( $form_id == '30' ) {}                           
if ( $form_id == '14' ) {
    echo 'CERTIFICATION BY APPLICANT: I, as the applicant, am familiar with the Kansas City Food Code and understand that all requirements must be completed by my designated start time. I understand that failure to meet these requirements will result in either re-inspection fee or denial of permission to operate. I understand that this permit may be suspended or revoked by the KC Health Dept. for non-compliance.';
    echo '<br><br>';
    echo '<img class="checkbox" src="'. PDF_PLUGIN_URL .'initialisation/images/check_box.png">';
    echo 'I agree | E-Signature: ';
    echo $form_data['field']["206.E-Signature"];
    echo ' | ';
    echo $form_data['field']['Date'];

echo '<br><br>Temporary Food Permit Fees – All Applicants must complete a personal interview with a Health Inspector at the Health Department, 2400 Troost Ave., Kansas City, MO. Permit fees assessed and due at time of interview with your Health Inspector.';
echo '<br>
One day event: <br>
14 days out = $57 <br>
13-7 days out = $68 <br>
6-3 days out = $82 <br>
Less than 3 days out = $98 <br>
<br>
Two day event: <br>
14 days out = $85 <br>
13-7 days out = $102 <br>
6-3 days out = $123            <br>
Less than 3 days out = $148 <br>
<br>
3 day to 14 day event: <br>
14 days out = $172 <br>
13-7 days out = $206 <br>
6-3 days out = $247 <br>
Less than 3 days out = $297 <br>
<br>
Not-for-Profit event: <br>
14 days out = $28 <br>
13-7 days out = $34 <br>
6-3 days out = $41 <br>
Less than 3 days out = $48 <br>';
} 

    ?>

   


                <!-- <pagebreak /> -->
                

            </div>

        <?php } ?>
    </body>
</html>