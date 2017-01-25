<style>

</style>
<script src="/jquery-1.11.0.min.js"></script>
 <div style="height:2000px;width:200px;background:red;">
 </div>
<div id="cahead">Campus Ambassador</div>
 <div style="height:2000px;width:200px;background:red;">
 </div>
 
 <script>
$(window).bind('scroll', function () {
if ($(window).scrollTop() > 500) {
    $('#cahead').hide();
}
else
{
    $('#cahead').show();
}
});
/*
$(function(){
var lastScrollTop = 0, delta = 5;
$(window).scroll(function(event){
   var st = $(this).scrollTop();

   if(Math.abs(lastScrollTop - st) <= delta)
      return;

   if (st > lastScrollTop){
       // downscroll code
       $("#cahead").css('visibility','hidden').hover ()
   } else {
      // upscroll code
      $("#cahead").css('visibility','visible');
   }
   lastScrollTop = st;
});
});
*/
 </script>
 <div style="height:2000px;width:200px;background:red;">
 </div>