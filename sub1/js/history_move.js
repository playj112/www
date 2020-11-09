//연혁스크롤효과

$(document).ready(function() {

        $('.slideMenu a').click(function(){
                  
        var value=0;
        
        if($(this).hasClass('link1')){
                     
                     value= $('#history_1988').offset().top;
                      
                  }else if($(this).hasClass('link2')){
                      
                     value= $('#history_2000').offset().top; 
                  }else if($(this).hasClass('link3')){
                     
                     value= $('#history_2011').offset().top; 
                  }
            
                $("html,body").stop().animate({"scrollTop":value},1000);
              });
        });

