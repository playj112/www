$(document).ready(function () {


     $(".nav_btn").click(function () { 

         var documentHeight = $(document).height();
   
         $(".back_box").css('height', documentHeight);
         $("#gnb").css('height', documentHeight);
        

         $("#gnb").animate({
             right: 0,
             opacity: 1
         }, 'slow');
         $(".back_box").show();
     });

     $(".back_box,.mclose").click(function () { 
         $("#gnb").animate({
             right: '-100%',
             opacity: 0
         }, 'fast');

         $(".back_box").hide();
         
         $('#gnb .depth1 ul').slideUp('fast');
         
         $('#gnb .depth1 h3>a i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
              $('#gnb .depth1 h3').removeClass('on');
     });

     //2depth
     $('#gnb .depth1 h3>a').click(function () {
         
         $(this).parent().next('ul').slideToggle('fast');
         if ($(this).find('i').hasClass('fa-chevron-up')) {
             $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
             $(this).parent().addClass('on');
         } else if ($(this).find('i').hasClass('fa-chevron-down')) {
             $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
             $(this).parent().removeClass('on');
         } else {}
         
     });

 });