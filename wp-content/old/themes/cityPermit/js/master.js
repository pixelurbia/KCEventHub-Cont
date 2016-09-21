///////////////////
// Master JS File
// by Andy 
///////////////////


$(document).ready(function() {

if ($('#input_2_95').val() != ''){ 
    $('#field_2_89').hide(); 
    }

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

    //if event empty hide
    $('.event').each(function(){
        var ul = $(this).find('ul').html();
        if (ul.length>0) {
        } else {
            $(this).hide();
        }
    });

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
    } else { 
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

//Search box show/hide
$('.search').click(function() { 
    if ( $(this).hasClass('active') ) { 
        $(this).removeClass('active');
        $('#searchform').hide();
    } else { 
        $(this).addClass('active');
        $('#searchform').show();
        $('#searchform input').focus();
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


        //mobile steps
            var first = $('.gf_step_active .gf_step_number').text(),
                last = $('.gf_step_last .gf_step_number').text(),
                construct = '<div class="steps_progress">'+ first +' of '+ last +'</div>';
            $('.gf_page_steps').prepend(construct);
    //steps completed style icon
    $('.gform_wrapper .gf_step_active .gf_step_label').prepend('<i></i>');
$('.form_saved_message_emailform input').attr('placeholder', 'Email');
    jQuery(document).bind('gform_page_loaded', function(event, form_id, current_page){
        // code to be trigger when next/previous page is loaded

 windowSizes();



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
            //tool tips
            $('.gfield').each(function(){  
                var desc = $(this).find('.gfield_description').html();
                // console.log(desc);
                $(this).find('.gfield_description').html('<i class="tool-tip">!</i><div class="the-tool-tip">'+ desc +'</div>');
            });

            $('.tool-tip').hover(
                function() {
                    $(this).parent().find('.the-tool-tip').fadeIn();
                }, function() {
                    $(this).parent().find('.the-tool-tip').delay(1000).fadeOut();
                }
            ); 
            //mobile steps
            var first = $('.gf_step_active .gf_step_number').text(),
                last = $('.gf_step_last .gf_step_number').text(),
                construct = '<div class="steps_progress">'+ first +' of '+ last +'</div>';
            $('.gf_page_steps').prepend(construct);

            if ( !$('.gform_title').text() ) {
                var formTitle = $('.gform_title').text();
                var eventName = $('.event-name input').attr('value');
                // $('#field_2_129').append('<h3>Event: '+ eventName +'</h3>');
                $('.gform_title').hide();
                $('.formName').text(formTitle + ' for ' + eventName );
            } 
   

            $('.gfield_radio li').addClass('gfchoice'); //add some needed non unquie classes to elements
            $('.gfield_checkbox li').addClass('gfchoice-check');

            $('.gf_step_active').append('<div class="arrow-right"></div>');

            $('.gfchoice').each(function(){ 
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
            $('.gfchoice').each(function(){ 
                var input = $(this).find('input');
                var iVal = $(this).find('input').val();
                // console.log(i);
                $(input).addClass('checkedselector'); //need this so I can see what is a yes or no field
                $(input).addClass(iVal);
                 $(this).find('label').addClass(iVal);
                 $(this).addClass(iVal);
             });
            $('.jq .checkedselector').click(function(){
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


    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
        $('.gf_page_steps').css('top','60px');
        } else {

        // new WOW().init();
        }

$('.faq-box').click(function() {
    $(this).find('.answer').slideToggle('fast');
   $(this).find('.question').toggleClass('background');
});

$('.box').click(function() {
    $(this).find('.bottom').slideToggle('fast');
   $(this).find('.top').toggleClass('active');
});


    });

