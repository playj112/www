// JavaScript Document

$(document).ready(function(){
  var cnt= 2;  //탭메뉴개수를 잡아줘***
   
  
  $('.tabs .contlist:eq(0)').show();//첫번째 내용만 보여라
  $('.tabs .tab1').addClass('on');
  
  $('.tabs .tab').each(function (index) {  // index=> 0 1 2
    $(this).click(function(){   //각각의 탭메뉴를 클릭하면 
	  $('.tabs .contlist').hide(); // 모든 탭내용을 안보이게 한다
	  $('.tabs .contlist:eq('+index+')').show();
	  for(var i=1;i<=cnt;i++){
           $('.tab'+i).removeClass('on');
      }
      $(this).addClass('on'); 
   });
  });
});
