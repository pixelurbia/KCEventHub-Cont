///////////////////
// Master JS File
// by Andy 
///////////////////


$(document).ready(function() {

//fade out notification after 4 sec
setTimeout(function(){
$('.notification').addClass('fadeOut');
}, 4000);

//personal nav
     $( '.profile' ).hover(
  function() {
    $(this).css('height','auto');
  }, function() {
    $(this).css('height','28');
  }
);

     $('.resource-filter h5').click(function() { 
        var fil = $(this).attr('value');
            if ( $(this).hasClass('live') ) {

            } else { 
                $('.res-type').removeClass('show');
                $('.res-type').addClass('hide');
                $('.res-type.'+ fil +'').removeClass('hide');
                $('.res-type.'+ fil +'').addClass('show');
                $('.resource-filter h5').removeClass('live');
                $('.resource-filter h5').addClass('opaq');
                $(this).removeClass('opaq');
                $(this).addClass('live');

            }
            console.log('.res-type.'+ fil +'');

     });

//AJAX SCRIPTS
        //ajax approve status

jQuery(document).on('click', ".delete", function (e) {
    e.preventDefault();
    var id = $(this).attr('value');
    $.post( 
        ajaxurl,
        {action: 'delete_row', entry_id: id }, 
        function(response) { 
            // alert(id); 
            location.reload();

        }); });

jQuery(document).on('click', ".approved", function (e) {
    e.preventDefault();
    var id = $(this).attr('value');
    $.post( 
        ajaxurl,
        {action: 'approve_row', entry_id: id }, 
        function(response) { 
            // alert(id); 
            location.reload();

        }); });

jQuery(document).on('click', ".pendingCal", function (e) {
    e.preventDefault();
    var id = $(this).attr('value');
    $.post( 
        ajaxurl,
        {action: 'pending_row', entry_id: id }, 
        function(response) { 
            // alert(response); 
            location.reload();
        }); });


jQuery(document).on('click', ".denied", function (e) {
    e.preventDefault();
    var id = $(this).attr('value');
    $.post( 
        ajaxurl,
        {action: 'deny_row', entry_id: id }, 
        function(response) { 
            // alert(response); 
            location.reload();
        }); });

//ajax for events sorting
$("body").on('click', ".e-sorting h5", function (e) {
        // e.preventDefault();
        // $('.cal-c.calapply').addClass('loading');

        if ($(this).hasClass('ASC')){
            
            $('.e-sorting h5').removeClass('DESC');
            $('.e-sorting h5').addClass('ASC');
            $(this).removeClass('ASC');
            $(this).addClass('DESC');
            var sort = 'DESC';
            // alert(sort);
         } else { 
            $(this).removeClass('DESC');
            $(this).addClass('ASC');            
            var sort = 'ASC';
            // alert(sort);
        }

        var filter = $(this).attr('value');
        var permit = $( ".getPermit option:selected" ).attr('value');
    $.ajax({
          url: "/event-que?ordby=" + filter +"&sortby="+ sort ,
          success: function(data){ 
                // alert(data); 
                //is this even working?
                $('.events-que').html(data);
                eventPage();
                $('.filterstatus li').removeClass('live');
                $('.filterstatus li').removeClass('opaq');
                $('.filtertype li').removeClass('live');
                $('.filtertype li').removeClass('opaq');


            }
        }); // end ajax call
    });
//ajax for sorting on the department side

$('.getPermit').on('change', function() {

    var permit = $( ".getPermit option:selected" ).attr('value');

  console.log(permit); 
  var filter = $(this).attr('value');
    $.ajax({
            url: "/dept-que" + "?ordby=event_date&sortby=ASC+&permitGet="+ permit ,
          success: function(data){ 
                console.log(data); 
                //is this even working?
                $('.dept-que').html(data);
                eventPage();


            }
        }); // end ajax call
    });



//ajax for events sorting

$("body").on('click', ".dept-sorting h5", function (e) {
        // e.preventDefault();
        // $('.cal-c.calapply').addClass('loading');

        if ($(this).hasClass('ASC')){
            
            $('.dept-sorting h5').removeClass('DESC');
            $('.dept-sorting h5').addClass('ASC');
            $(this).removeClass('ASC');
            $(this).addClass('DESC');
            var sort = 'DESC';
            // alert(sort);
         } else { 
            $(this).removeClass('DESC');
            $(this).addClass('ASC');            
            var sort = 'ASC';
            // alert(sort);
        }

        var filter = $(this).attr('value');
         var permit = $( ".getPermit option:selected" ).attr('value');
    $.ajax({
          url: "/dept-que" + "?ordby=" + filter +"&sortby="+ sort +"+&permitGet="+ permit ,
          success: function(data){ 
                // alert(data); 
                //is this even working?
                $('.dept-que').html(data);
                eventPage();
                $('.filterstatus li').removeClass('live');
                $('.filterstatus li').removeClass('opaq');
                $('.filtertype li').removeClass('live');
                $('.filtertype li').removeClass('opaq');


            }
        }); // end ajax call
    });
//minor fix for something I can't remember so don't touch
if ($('#input_2_95').val() != ''){ 
    $('#field_2_89').hide(); 
    }

//calendar functions

//show events on sidebar
 $('.eventDays li').click(function (e) {
// alert(edata);
    var edata = $(this).html();
    $('.cal-sidebar .eArea').html(edata);

    });

var month = $( "#month-select option:selected" ).text();
var year = $( "#year-select option:selected" ).text();
$('#month-label').html(month +" "+ year);

$(".dateitem a").text(function(index, currentText) {
    return currentText.substr(0, 10);
});

//--- Calendar Month/Year drop down ---\\

    function change_month() {
        window.location = linkBuilder();
    }

    $('#month-select').change(change_month);
    $('#year-select').change(change_month);

    $(".calstring").click(function (e) {
        var month = document.getElementById('month-select').value;
        var year = document.getElementById('year-select').value;
        var url = $('.calstring').attr('href');
        e.preventDefault();
        window.location = url + "?calmonth=" + month + "&calyear=" + year;
    });

    $("#Next").click(function (e) {
        e.preventDefault();
        window.location = linkBuilder('next');
    });

    $("#Prev").click(function (e) {
        e.preventDefault();
        window.location = linkBuilder('prev');
    });

    function linkBuilder(direction) {
        var month = document.getElementById('month-select').value;
        var year = document.getElementById('year-select').value;
        
        if (direction == 'next') {
            month == 12 ? (month = 1, year++) : month++;
        }
        else if (direction == 'prev') {
            month == 1 ? (month = 12, year--) : month--;
        }

        return "?calmonth=" + month + "&calyear=" + year;
    }

    $('.cal-c .cal ul li ol').each(function () {
        var count = $(this).children().length;
        if ( count >= 1) {
        $(this).closest('li').addClass('scrolled');
        }
    });


function eventPage () { 


var epi = $("<div />").append($('.img-contain').clone()).html();
$('.img-contain').hide();
     $('.single-event').before(epi);

     $( '.map-contain img' ).hover(
  function() {
    $( this ).css('width','150%');
    $( this ).css('margin-left','-20%');

  }, function() {
    $( this ).css('width','100%');
    $( this ).css('margin-left','0px');
  }
);

//events page move stuff around
   $('.event').each(function () { 
        var topdata = $("<div />").append($(this).find('.top-data').clone()).html();
        $(this).find('.top-data').hide();
        $(this).find('.top-data').addClass('mobile');
        $(this).find('.top').after(topdata);    
    });
   //adding classes up the DOM
    $('.event').each(function () { 
        var val = $(this).find('.eventtype').attr('value');
        $(this).addClass('eventtype'+val+'');

        var val = $(this).find('.eventstatus').attr('value');
        $(this).addClass(val);
    });
    //IF there is a overall form remove the basic entry form
    $('.event ul').find('.top').each(function () { 
        if ($(this).hasClass('formID2')) {
            $(this).parent().find('.formID3').remove();
            // $(this).parent().find('div.formID3').hide();
        }
    });
     $('.event ul').find('.bottom').each(function () { 
        if ($(this).hasClass('formID2')) {
            $(this).parent().find('.formID3').remove();
            // $(this).parent().find('div.formID3').hide();
        }
    }); 
    //if an entry of the form exist hide the 'fill this out' link     
     $('.event ul .bottom li').each(function () { 
        var val = $(this).attr('value');
        // console.log(val);
        $('.event li.'+ val +'').hide();
    }); 
     //the slidetoggle box
    $('.eventdetails').click(function() {
            $(this).closest('.box').find('.bottom').slideToggle('fast');
            if ($(this).hasClass('live')){
                $(this).html('See Event Details &#187');
                $(this).removeClass('live');
            } else { 
                $(this).addClass('live'); 
                $(this).html('Collapse Event Details ^ ');
            }
    });
    //filters
    $('.filterstatus li').click(function() { 
   
    var val = $(this).attr('value');

      if ($(this).hasClass('live')){
            $('.filterstatus li').removeClass('live');
            $('.filterstatus li').removeClass('opaq');
            $('.event').fadeIn('slow');
         } else { 
            $('.filterstatus li').removeClass('live');
             $(this).addClass('live');
             $('.filterstatus li').addClass('opaq');
             $(this).removeClass('opaq');   
                $('.event').fadeOut();
                $('.event.'+ val +'').delay(300).fadeIn();
        }
    }); 
    //more filters
    $('.filtertype li').click(function() { 
       
        var val = $(this).attr('value');
        console.log(val);
    
        if ($(this).hasClass('live')){
                $('.filterstatus li').removeClass('live');
                $('.filterstatus li').removeClass('opaq');
                $('.filtertype li').removeClass('live');
                $('.filtertype li').removeClass('opaq');
                $('.event').show();
            } else { 
                $('.filterstatus li').removeClass('live');
                $('.filtertype li').removeClass('live');
                $('.filtertype li').addClass('opaq');
                $(this).addClass('live');
                $(this).removeClass('opaq');   
                $('.event').hide();
                $('.event.'+ val +'').show();
            }
    
    });
    $('.cal-filter li').click(function() { 
       
        var val = $(this).attr('value');
        console.log(val);
    
        if ($(this).hasClass('live')){

                $('.cal-filter li').removeClass('live');
                $('.cal-filter li').removeClass('opaq');
                $('.dateitem').show();
            } else { 

                $('.cal-filter li').removeClass('live');
                $('.cal-filter li').addClass('opaq');
                $(this).addClass('live');
                $(this).removeClass('opaq');   
                $('.dateitem').hide();
                $('.etype'+ val +'').show();
                var ety = '.etype'+ val +'';
                console.log(ety);

            }
    
    });
    //for the save events slidetoggle box
    $('.savedevents').click(function() {
            $(this).closest('.box').find('.bottom').slideToggle('fast');
            if ($(this).hasClass('live')){
                $(this).html('View Saved Items &#187');
                $(this).removeClass('live');
            } else { 
                $(this).addClass('live'); 
                $(this).html('Collapse Saved Items ^ ');
            }
    });
 }

//working things I may not need
    // //if event empty hide
    // $('.event').each(function(){
    //     var ul = $(this).find('ul').html();
    //     if (ul.length>0) {
    //     } else {
    //         $(this).hide();
    //     }
    // });
function overAll() { 
//mobile nav and form page nav and login
$(".lines-button.mobile").click(function(){
 if ($('.mobile-contain').hasClass('show')){ 
        $('.mobile-contain').removeClass('show '); 
        $('.mobile-contain').addClass('hide'); 
    } else { 
        $('.mobile-contain').removeClass('hide');
        $('.mobile-contain').addClass('show');
    }
});

$(".lines-button.form").click(function(){
    if ($('.header-container').hasClass('show')){ 
        $('.header-container').removeClass('show '); 
        $('.header-container').addClass('hide'); 
        $('.form-container ').addClass('show'); 
$('.form-container ').removeClass('hide'); 

    } else { 

$('.form-container ').addClass('hide'); 
$('.form-container ').removeClass('show');
        $('.header-container').removeClass('hide');
        $('.header-container').addClass('show');
    }

});
$('.login-header').click(function(){
    if ($('.login-form-box').hasClass('show')){ 
        $('.login-form-box').removeClass('show '); 
        $('.login-form-box').addClass('hide'); 
        $('.master-overlay').removeClass('show '); 
        $('.master-overlay').addClass('hide'); 
    } else { 
        $('.login-form-box').removeClass('hide');
        $('.login-form-box').addClass('show');
        $('.master-overlay').addClass('show '); 
        $('.master-overlay').removeClass('hide'); 
    }
});
    //login form placeholders
    $('.login-submit input').addClass('btn');
    $('.login-username input').each(function(){  
        $(this).attr( 'placeholder', 'Username' );
    });
    $('.login-password input').each(function(){  
        $(this).attr( 'placeholder', 'Password' );
    });
}

 $('.contentwrap li').each(function(){  
var str1 = $(this).text();
var str2 = "field_";
if(str1.indexOf(str2) != -1){
 $(this).text('');
}
    });




//Search box show/hide
$('.search-box').click(function() { 
    if ( $(this).hasClass('active') ) { 

        $(this).removeClass('active');
        $('#searchform').hide();
        $('.header').css('margin-left','0px');
    } else { 
        $('.header').css('margin-left','-218px');
        $(this).addClass('active');
        $('#searchform').show();
        $('#searchform input').focus();
    }
 
});

//FAQs

$('#faqSearch').keyup(function(){
    var query = $(this).val().toLowerCase();
    if(query === ''){
        $('.faq-box').removeClass('hide');
    } else {
        $('.faq-box').each(function(){
            var faqText = $(this).find('h3').text().toString().toLowerCase();
            if(!faqText.match(query)){
                $(this).addClass('hide');
            } else {
                $(this).removeClass('hide');
            }
        });
    }
});

    $('.faq-box').click(function() {
    $(this).find('.answer').slideToggle('fast');
   $(this).find('.question').toggleClass('background');
});



windowSizes();
$(window).on('resize', function(){ windowSizes(); });

function windowSizes () {
        var window_size = $(window).height(),
    heroSize = window_size - 45,
    sideBarSize = window_size / 2 - 20,
    innerSB = window_size + 100;
    // console.log(window_size);
    
    $('.hero').css('height',heroSize);
    $('.quick-guides').css('height',heroSize - 65);
    $('.faqs').css('height',sideBarSize);
}



function formScripts () { 
//quick fix for prepop forms
 $('.checkedselector').each(function(){ 
    if ( this.checked) { 
        $(this).parent().siblings().show();
         } 
     });
         
    
        //mobile steps
            var first = $('.gf_step_active .gf_step_number').text(),
                last = $('.gf_step_last .gf_step_number').text(),
                construct = '<div class="steps_progress">'+ first +' of '+ last +'</div>';
            $('.gf_page_steps').prepend(construct);
            //steps completed style icon
            $('.gform_wrapper .gf_step_active .gf_step_label').prepend('<i></i>');
            $('.form_saved_message_emailform input').attr('placeholder', 'Email');
            //tool tips
            $('.gfield').each(function(){  
               var desc = $(this).find('.gfield_description').html();
               // console.log(desc);
               $(this).find('.gfield_description').html('<i class="tool-tip">?</i><div class="the-tool-tip">'+ desc +'</div>');
            });
            $('.tool-tip').hover(
               function() {
                   $(this).parent().find('.the-tool-tip').fadeIn();
               }, function() {
                   $(this).parent().find('.the-tool-tip').fadeOut();
               }
            );

            $('.gfield_radio li').addClass('gfchoice'); //add some needed non unquie classes to elements

}
        //fix for multipageforms 
         var fieldone = $('#field_2_157').html();
            $('.save-area .formone').append(fieldone);
            $('.formone').addClass('saved');
        var fieldtwo = $('#field_2_143').html();
            $('.save-area .formtwo').append(fieldtwo);
            $('.formtwo').addClass('saved');
        var fieldthree = $('#field_2_90').html();
            $('.save-area .formthree').append(fieldthree);
            $('.formthree').addClass('saved');
        var fieldfour = $('#field_2_91').html();
            $('.save-area .formfour').append(fieldfour);
            $('.formfour').addClass('saved');
        
            
        // code to be trigger when next/previous page is loaded for gravity forms
    jQuery(document).bind('gform_page_loaded', function(event, form_id, current_page){

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $('.gf_page_steps').addClass('tablet');
            }

        $('.remove-entry').click( function(event){ event.preventDefault; $(this).parent().remove();});

        var fieldsaved = $('.formone.saved').html();
        $('#field_2_157').html(fieldsaved);
        var fieldtwosaved = $('.formtwo.saved').html();
        $('#field_2_143').html(fieldtwosaved);  
        var fieldthreesaved = $('.formthree.saved').html();
        $('#field_2_90').html(fieldthreesaved); 
        var fieldfoursaved = $('.formfour.saved').html();
        $('#field_2_91').html(fieldfoursaved);

     windowSizes();
     formScripts();

       var ueID = $('.updateEntry').attr('value');
        $('#input_2_95').attr('value', ueID);


if ($('#input_2_95').val() != ''){ 
    $('#field_2_89').hide(); 
    }
        //move steps down on mobile sinces this is silly
         
jQuery(document).bind('gform_post_render', function(){
   var theight = $('.gform_wrapper').height();
    $('.sidebar').css('height',theight + 100);

    
});
            //steps completed style icon
            $('.gform_wrapper .gf_step_completed .gf_step_label').prepend('<i></i>');
    
            
                  if ( !$('.gform_title').text() ) {
                var formTitle = $('.gform_title').text();
                var eventName = $('.event-name input').attr('value');
                // $('#field_2_129').append('<h3>Event: '+ eventName +'</h3>');
                $('.gform_title').hide();
                $('.formName').text(formTitle + ' for ' + eventName );
            } else {
                var formTitle = $('.gform_title').text();
                // $('.gform_title').hide();
                $('.formName').text(formTitle);
            }
   

            $('.gfield_radio li').addClass('gfchoice'); //add some needed non unquie classes to elements
            $('.gfield_checkbox li').addClass('gfchoice-check');

            $('.gf_step_active').append('<div class="arrow-right"></div>');

            $('.radio-type .gfchoice').each(function(){ 
                var input = $(this).find('input');
                var iVal = $(this).find('input').val();
                // console.log(i);
                $(input).addClass('checkedselector'); //need this so I can see what is a yes or no field
                $(input).addClass(iVal);
                 $(this).find('label').addClass(iVal);
                 $(this).addClass(iVal);
             });
            $('.checkedselector').click(function(){
    if ( $(this).hasClass('No') ){ 
        $(this).parent().hide() ;
        $(this).parent().siblings('.gfchoice.Yes').show(); //some dirty magic, hide one but the hidden one is the actual one activated. cool huh?
    } else {   
             $(this).parent().hide();
             $(this).parent().siblings('.gfchoice.No').show();   }
    });

    $('.checkedselector').on('change', function () {
            if (this.checked) {
        $('input[name="' + this.name + '"].checked').removeClass('checked');
            $(this).closest('.gfield_radio').find('label').removeClass('checked-label');
            $(this).addClass('checked');
            $(this).next('label:first').addClass('checked-label'); //some more magic to style the labels and hide the actual ugly circles
        } 
    });
    $('.checkedselector').parent().show(); 
    $('.checkedselector:checked').parent().hide();

        $('.address').find('input').each(function(){ 
        ph = $(this).attr('placeholder');
        $(this).parent().addClass(ph);

    });
}); //end page load functions

           if ( !$('.gform_title').text() ) {
                var formTitle = $('.gform_title').text();
                var eventName = $('.event-name input').attr('value');
                // $('#field_2_129').append('<h3>Event: '+ eventName +'</h3>');
                $('.gform_title').hide();
                $('.formName').text(formTitle + ' for ' + eventName );
            } else {
                var formTitle = $('.gform_title').text();
                // $('.gform_title').hide();
                $('.formName').text(formTitle);
            }
 
            $('.gfield_radio li').addClass('gfchoice'); //add some needed non unquie classes to elements
            $('.gfield_checkbox li').addClass('gfchoice');

            $('.gf_step_active').append('<div class="arrow-right"></div>');
            $('.radio-type .gfchoice').each(function(){ 
                var input = $(this).find('input');
                var iVal = $(this).find('input').val();
                // console.log(i);
                $(input).addClass('checkedselector'); //need this so I can see what is a yes or no field
                $(input).addClass(iVal);
                 $(this).find('label').addClass(iVal);
                 $(this).addClass(iVal);
             });

            $('.checkedselector').click(function(){
    if ( $(this).hasClass('No') ){ 
        $(this).parent().hide() ;
        $(this).parent().siblings('.gfchoice.Yes').show(); //some dirty magic, hide one but the hidden one is the actual one activated. cool huh?
    } else {   
             $(this).parent().hide();
             $(this).parent().siblings('.gfchoice.No').show();   }
    });





    $('.checkedselector').on('change', function () {
            if (this.checked) {
        $('input[name="' + this.name + '"].checked').removeClass('checked');
            $(this).closest('.gfield_radio').find('label').removeClass('checked-label');
            $(this).addClass('checked');
            $(this).next('label:first').addClass('checked-label'); //some more magic to style the labels and hide the actual ugly circles
        } 
    });
    $('.checkedselector').parent().show(); 
    $('.checkedselector:checked').parent().hide();
    $('.gfchoice.No').hide();
    $('.address').find('input').each(function(){ 
        ph = $(this).attr('placeholder');
        $(this).parent().addClass(ph);

    });


    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $('.gf_page_steps').css('top','60px');
        $('.gf_page_steps').addClass('tablet');
        } else {

        new WOW().init();
        }

 //FUCNTIONS TO RUN ON PAGE LOAD
    eventPage();
    overAll();
    formScripts();

    });

