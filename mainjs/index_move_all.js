// 인트로 움직임    


$(document).ready(function () {
    

    var h1= $('#content .intro_vision').offset().top-500 ;
    var h2= $('#content .intro_rules').offset().top-500 ;
    
    $(window).on('scroll',function(){
            var scroll = $(window).scrollTop();
    
        if(scroll>=600 && scroll<h1){
                
                $('#content .intro_idea').addClass('boxMove');

            }else if(scroll>=h1 && scroll<h2){

                 $('#content .intro_vision').addClass('boxMove');
            }else if(scroll>=h2){

                 $('#content .intro_rules').addClass('boxMove');
            }
});
});



// 이벤트
/*
$(document).ready(function () {
         var pcnt=1;
		 
	 $('.RightBtn').click(function () {
		 pcnt++;
		 if(pcnt>2){
		    pcnt=1;
		 }
         $('.gallery_box ul').first().appendTo('.gallery_box .gallery_box_container');
         });


         $('.leftBtn').click(function () {
		   pcnt--;	
		   if(pcnt<1){
		    pcnt=2;
		   }
           $('.gallery_box ul').last().prependTo('.gallery_box .gallery_box_container'); 
         });
   });
*/



// 뷰티가이드 갤러리


$(document).ready(function(){
          $('.eventSlideMenu ul li span').mouseenter(function(event){
             var $target=$(event.target); //$(this). 그리고 위에 event 안써주면 결과가 같다
	  
	 if($target.is('.buttonMenu01')){
	       $('.eventSlideMenu .img02').animate({left:700},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img03').animate({left:800},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img04').animate({left:900},450,'easeOutQuad').clearQueue();
	 }else if($target.is('.buttonMenu02')){
	       $('.eventSlideMenu .img02').animate({left:100},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img03').animate({left:800},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img04').animate({left:900},450,'easeOutQuad').clearQueue();
	 }else if($target.is('.buttonMenu03')){
	       $('.eventSlideMenu .img02').animate({left:100},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img03').animate({left:200},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img04').animate({left:900},450,'easeOutQuad').clearQueue();
	 }else if($target.is('.buttonMenu04')){
	       $('.eventSlideMenu .img02').animate({left:100},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img03').animate({left:200},450,'easeOutQuad').clearQueue();
	       $('.eventSlideMenu .img04').animate({left:300},450,'easeOutQuad').clearQueue();
	 }
          });
       });


//product 갤러리

$(document).ready(function(){
    
       var  product_position=0; 
       $('.right_go').hide();
     
    
     $('.product_arrow').click(function(e){
         e.preventDefault();  //a href값을 처리안되게 한다
   
     	  
	 if($(this).is('.left_go')){
         product_position-=1200;
         
         $('.right_go').show();
         if(product_position==-2400)$(this).hide();
           
     }else if($(this).is('.right_go')){
         product_position+=1200;
         
         $('.left_go').show();
         if(product_position==0)$(this).hide();
     }
       $('.product_move').animate({left:product_position},500).clearQueue();
         
  });
});




// 공지사항 돌아가기


$(document).ready(function() {
   var greet_position=0;  
   var greet_movesize=63; 
   var greet_timeonoff;

   function moveNotice(){
	    greet_position-=greet_movesize;
    	$('.greet_box ul').stop().animate({top:greet_position}, 'slow',
	         function(){							
		    if(greet_position==-315){
			   $('.greet_box ul').css('top',0);
			   greet_position=0;
		    }
	 });
   }
   
  
     greet_timeonoff= setInterval(moveNotice, 2500);  
    $('.greet_box ul').after($('.greet_box ul').clone());
    $('.notice_slide').hover(function(){clearInterval(greet_timeonoff);},function(){greet_timeonoff= setInterval(moveNotice, 2500); });
 });
 















