$(document).ready(function() {
        
            $('ul.dropdownmenu').hover(
                function() { 
                    $('ul.dropdownmenu li.menu ul').stop().fadeIn('fast',function(){$(this).stop();});
                    
               var height = 0;
               if ($('#headerArea').hasClass('thin')) {    
                    height = 335;
                 } else {
                    height = 455;
                 }
                    
                $('#headerArea').stop().animate({
                height: height
            }, 'fast').clearQueue();
        },
        function () {
            $('.dropdownmenu .menu ul').stop().fadeOut('fast', function () {
                $(this).stop();
            });    
                    
                 
            var height = 0;
            if ($('#headerArea').hasClass('thin')) {
                height = 125;
            } else {
                height = 245;
            }

            $('#headerArea').stop().animate({
                height: height
            }, 'fast').clearQueue();
        });

 
          //tab키처리
  
       $('.dropdownmenu .menu .depth1').on('focus', function () {
        $('.dropdownmenu .menu ul').slideDown('fast');
        var height = $('#headerArea').height();

        var height = 0;
        if ($('#headerArea').hasClass('thin')) {
            height = 335;
        } else {
            height = 455;
        }

        $('#headerArea').animate({
            height: height
        }, 'fast').clearQueue();
    });

    $('.dropdownmenu .m6 li:last').find('a').on('blur', function () {
        var height = $('#headerArea').height();
        $('ul.dropdownmenu li.menu ul').slideUp('fast');

        var height = 0;
        if ($('#headerArea').hasClass('thin')) {
            height = 125;
        } else {
            height = 245;
        }

        $('#headerArea').animate({
            height: height
        }, 'fast').clearQueue();
    });
   
    
    //스크롤처리
    
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
    
    
    if (scroll > 600) {

            $('#headerArea').addClass('thin').removeClass('fat');
            $('#headerArea').height(125);
    
    } else {
            $('#headerArea').addClass('fat').removeClass('thin');
            $('#headerArea').height(245);  
    }
        
        
    $('.dropdownmenu .menu ul').stop().fadeOut('fast', function () {
                $(this).stop();
            });
    });
       
});