    $(document).ready(function () {
            
              var th= $('#headerArea').height() + $('.visual').height();
              //여기 태그명 수정해서 사용
        
              $('.topMove').hide();

             $(window).on('scroll',function(){ //스크롤의 거리가 발생되면 
                  var scroll = $(window).scrollTop();
                 //스크롤이 움직이면 그 해당 스크롤탑의 값이 저장된다
                 
                  if(scroll>th){ // 값은 내가 원하는대로 = 비주얼까지 ***
                      $('.topMove').fadeIn('slow');
                  }else{
                      $('.topMove').fadeOut('fast');
                  }
             }); 
           
              $('.topMove').click(function(){
                  //상단으로 스르륵 이동합니다.
                 $("html,body").stop().animate({"scrollTop":0},800); 
              });
        
                //요기까지는 모든 서브페이지에 탑버튼 적용
            
       });