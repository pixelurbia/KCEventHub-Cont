<?php
/*
Template Name: Redirect Page
*/
?>

<?php 
    get_template_part('templates/header'); 
    $url = $_GET['url'];
    echo '<div class="url" value="'. $url .'"></div>';
?>
<script type="text/javascript">
$(document).ready(function() {
  var url = $('.url').attr('value');
    $('.theUrl').text(url);
    $('.theUrl').attr('href', url);
});

function timer(time,update,complete) {
    var start = new Date().getTime();
    var interval = setInterval(function() {
        var now = time-(new Date().getTime()-start);
        if( now <= 0) {
            clearInterval(interval);
            complete();
        }
        else update(Math.floor(now/1000));
    },100); // the smaller this number, the more accurate the timer will be
}
timer(
    10000, // milliseconds
    function(timeleft) { // called every step to update the visible countdown
        document.getElementById('timer').innerHTML = timeleft+" second(s)";
    },
    function() { // what to do after
          var url = $('.url').attr('value');
          window.open(url, "_blank");
          setTimeout(function(){ window.location = '/events'; });
    }
);
</script>
<div class="single wow fadeInLeft">
  <div class="row">             
    <div class="contentwrap">

      <h1>Congratulations!</h1>
       <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <blockquote>You will be redirected to <a class="theUrl" href=""></a> in <strong><span id="timer"></span><strong></blockquote>
      <?php endwhile; ?>
    </div><!--contentwrap-->

  </div>
</div>
<?php get_template_part('templates/footer'); ?>