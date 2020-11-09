$(document).ready(function () {
   
    
    $('.n_product #openBtn1, #openBtn2').each(function (index) {
        $(this).click(function(){ 
           $('.content_area #back_box').show();
           $('#npopbox'+ (index+1)).fadeIn('fast'); 
            
       });
        
    $('.content_area #back_box, .closeBtn').click(function(){ 
        $('.content_area #back_box').hide();  
        $('#npopbox'+ (index+1)).hide();
    });
        
    });
    
});