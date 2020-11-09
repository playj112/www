// 쥬얼리 나타나기

$(document).ready(function () {
    
    var h1= $('#content .bzero_all').offset().top-500 ;
    
    $(window).on('scroll',function(){
            var scroll = $(window).scrollTop();
    
        if(scroll>=h1){
                
                $('#content .right_b').addClass('on');
                $('#content .left_b').addClass('on');

            }
});
});




// 쥬얼리 색변하기


$(document).ready(function () {
    
    var h2= $('#his_neck').offset().top-50;
    
    $(window).on('scroll',function(){
            var scroll = $(window).scrollTop();
    
        if(scroll>=h2){
                
                $('#content #his_neck').attr('src','images/connect_03.png');

            }else{
                $('#content #his_neck').attr('src','images/connect_03_0.png');
            }
         });
});



// 박스 높이 맞추기


$(document).ready(function() {
    
        var d_width = $(window).width();
    
        if(d_width>640){
        
		var boxHeight2 =  $('#outer_tbox li:eq(0) div').outerHeight();

		for(var i=0; i<3; i++){
					$("#outer_tbox li:eq("+ i +") div").css('height',boxHeight2);
       }
            }else{
        $('#outer_tbox li:eq(0) div').css('height','auto');
        $("#outer_tbox li:eq(1) div").css('height','auto');
            }

           
    
	$(window).resize(function(){
        
        var d_width2 = $(window).width();
        
        if(d_width2>640){
        
		$('#outer_tbox li:eq(0) div').css('height','auto');
        
        boxHeight2 =  $('#outer_tbox li:eq(0) div').outerHeight();

		for(var i=0; i<3; i++){
					$("#outer_tbox li:eq("+ i +") div").css('height',boxHeight2);
		}
            
        }else{
            
            $('#outer_tbox li:eq(0) div').css('height','auto');
            $("#outer_tbox li:eq(1) div").css('height','auto'); 
        }
    });   
    
    
    
    
    
    
 });



// 모바일 이미지 바꾸기


$(document).ready(function () {
    
        var h_width = $(window).width();
    
    
        if(h_width<=640){
                
                $('.hisimg01').attr('src','images/m_his_01.jpg');
                $('.hisimg02').attr('src','images/m_his_02.jpg');

            }else{
                $('.hisimg01').attr('src','images/history_01.jpg');
                $('.hisimg02').attr('src','images/history_02.jpg');
            }
    
    $(window).resize(function(){ 
        
        var h_width2 = $(window).width();
		
        if(h_width2<=640){
                
                $('.hisimg01').attr('src','images/m_his_01.jpg');
                $('.hisimg02').attr('src','images/m_his_02.jpg');

            }else{
                $('.hisimg01').attr('src','images/history_01.jpg');
                $('.hisimg02').attr('src','images/history_02.jpg');
            }

	});
    
});







