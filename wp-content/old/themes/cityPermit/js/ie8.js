///////////////////
// Master JS File
// by Andy 
///////////////////

 $(document).ready(function() {

    

    //get the correct URL for the interior show pages only
    var url = $('.ticketsurl').attr('href');
    $('.ticketsbtn').attr('href', url);

    //animations
    $('.ticketsbtn').hover(function(){     
        $(this).addClass('animated shake'); },     
    function(){  
        $('.ticketsbtn').removeClass('animated shake');     
    });

    //mobilenav
    $('.mobile-nav').click(function(){
    $(this).removeClass('show');
    $('.mobile-close').addClass('show');
    $(this).addClass('hide');
    $('.header').css('margin-left','0px');
    });
    $('.mobile-close').click(function(){
    $(this).removeClass('show');
    $('.mobile-nav').addClass('show');
    $(this).addClass('hide');
    $('.header').css('margin-left','-740px');
    });

    //Hover Menu
    $('.menu li').each(function(){ 
        $(this).hover(
          function () {
             $(this).find('.sub-menu').stop(true,true).delay(200).slideDown('medium');
          }, 
          function () {
             $(this).find('.sub-menu').stop(true,true).delay(800).slideUp('slow');
          });
      });


//--- Calendar Month/Year drop down ---\\

// function currentdate() {

//     //ajax calendar month changer
//         //get the values of month and year
//     var startyear = $('.startyear').attr('value'),
//         startmo = $('.startmo').attr('value');


//             //ajax get send calulated month and year to be processed by php app cal

//     $.ajax({
//           url: "/calendar" + "?calmonth=" + startmo + "&calyear=" + startyear,
//           success: function(data){ 
//                 alert('ajax going');
//                 //is this even working?
//                 $('.calendarpart').html(data);
//                 //get the new calendar and display it <3
//                 console.log("?calmonth=" + themonum + "&calyear=" + theynum);
//                 //$(calendar).load("/wp-content/themes/kcrace/calendar-apply.php" ); 
//             }
//         }); // end ajax call


// }

// currentdate();


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

    $("#fNext").click(function (e) {
        e.preventDefault();
        window.location = linkBuilder('next');
    });

    $("#fPrev").click(function (e) {
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
    //-- end Cal --\\

        function change_moyname() {
         var moname = $('#month-select option:selected').text();
         var yname = $('#year-select option:selected').text();
         $('.monthname').text(moname);
         $('.yearname').text(yname);
    }
        change_moyname();

// //headings to have all caps and the first letter be bigger
// $('h1').each(function(){
//     var $this = $(this);
//     var words = $this.text().split(' ');
//     var newHtml = '';
//     for (var i = 0; i < words.length; i++) {
//          newHtml += '<i style="font-size:135%; margin-right:1px;">' + words[i].substring(0, 1) + '</i>' + words[i].substring(1) + ' ';
//     }
//     $this.html(newHtml);
// });

// $('h2').each(function(){
//     var $this = $(this);
//     var words = $this.text().split(' ');
//     var newHtml = '';
//     for (var i = 0; i < words.length; i++) {
//          newHtml += '<i style="font-size:135%;  margin-right:1px;">' + words[i].substring(0, 1) + '</i>' + words[i].substring(1) + ' ';
//     }
//     $this.html(newHtml);
// });

// $('h3').each(function(){
//     var $this = $(this);
//     var words = $this.text().split(' ');
//     var newHtml = '';
//     for (var i = 0; i < words.length; i++) {
//          newHtml += '<i style="font-size:135%;  margin-right:1px;">' + words[i].substring(0, 1) + '</i>' + words[i].substring(1) + ' ';
//     }
//     $this.html(newHtml);
// });

// $('h4').each(function(){
//     var $this = $(this);
//     var words = $this.text().split(' ');
//     var newHtml = '';
//     for (var i = 0; i < words.length; i++) {
//          newHtml += '<i style="font-size:135%;  margin-right:1px;">' + words[i].substring(0, 1) + '</i>' + words[i].substring(1) + ' ';
//     }
//     $this.html(newHtml);
// });


//faqs page
$('.faq-item').click(function(e){
    if($(e.target).hasClass('faq-title')){
        $(this).toggleClass('active');
        $(this).children('.faq-title').toggleClass('active');
        $(this).children('.faq-content').slideToggle();
        return false;
    }
});

	//desktop//vrs//mobile scrips
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {



        //adjust things for mobile only wide version for mobile devices at 745px wide
        if ($(window).width() < 745) {
        $('.header').addClass('phone');
        $('.content-wrap').addClass('phone');
        $('.mobile-nav').addClass('phone');
        }
		} else {

			//wow
// new WOW().init();
		}
homepage(); 


        //if for specific pages
        function homepage() { 

        var slug = $('.page-slug').text(),
        home = "home";
        console.log(slug);
        
        if ( slug === home) { 

        //fix the header area for mobile
        var height = $('.hero-contain').height(),
         calc = height + 100,
         fin = calc + 'px';
        $('.page-hero').css('height', fin);


        }
        
        };  
    homepage();



$(function(){
    /* Hide form input values on focus*/ 
    $('input:text, textarea').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });
});

$(function(){
    /* Hide form input values on focus*/ 
    $('input.text').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });
});

 $(function(){
    /* Hide form input values on focus*/ 
    $('input:textarea').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });
});
 $(function(){
    /* Hide form input values on focus*/ 
    $('input:email').each(function(){
        var txtval = $(this).val();
        $(this).focus(function(){
            if($(this).val() == txtval){
                $(this).val('')
            }
        });
        $(this).blur(function(){
            if($(this).val() == ""){
                $(this).val(txtval);
            }
        });
    });
});




	});
