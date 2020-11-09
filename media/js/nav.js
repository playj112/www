// 네비 변신 코드

$(document).ready(function() {
   $(".menuOpen").toggle(function() {
	 $("#gnb").slideDown('slow');
     $(this).find('i').removeClass('fa fa-bars').addClass('fas fa-times');
   }, function() {
	 $("#gnb").slideUp('fast');
     $(this).find('i').removeClass('fas fa-times').addClass('fa fa-bars');
   });
   

    var current=0; //모바일 해상도는 0이다.
   $(window).resize(function(){ 
      var screenSize = $(window).width(); 
      if( screenSize > 1024){
        $("#gnb").show();
		 current=1; //모바일 이상의 해상도가 되면 1이다.
      }
      if(current==1 && screenSize <= 1024){
      // 모바일 이상의 해상도였다가 모바일 밑으로 줄어들었을 때 그 한번
        $("#gnb").hide();
        $('i').removeClass('fas fa-times').addClass('fa fa-bars');  
      }
    }); 
 
  });
