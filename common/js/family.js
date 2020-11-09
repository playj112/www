
$(document).ready(function() {
	$('.select .arrow').click(function(){
		$('.select .aList').show();			  
	});
	$('.select .aList').mouseleave(function(){
		$(this).hide();			  
	});
	//tab키 처리
	  $('.select .arrow').bind('focus', function () {        
              $('.select .aList').show();	
       });
       $('.select .aList li:last').find('a').bind('blur', function () {        
              $('.select .aList').hide(); //li까지만 잡는게 아니라 a까지 잡아주기
       });  
});

