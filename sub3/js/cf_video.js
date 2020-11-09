$(document).ready(function(){
            $('.mediaList a').on('click', function(event){
                
                $('#mediaBox video').attr('src', $(this).parent().find('.titleDate p.video').text());
                $('#mediaBox video').attr('poster', $(this).parent().find('.titleDate p.poster').text());                
                
                $('#mediaBox .titleDate .title').text($(this).parent().find('.titleDate h3.title').text());                
                $('#mediaBox .titleDate .sub_title').text($(this).parent().find('.titleDate p.sub_title').text());                
                $('#mediaBox .titleDate .sub_text').text($(this).parent().find('.titleDate p.sub_text').text());                    
                
                var offset = $("#mediaBox").offset();
                $('html, body').animate({scrollTop : offset.top - 180}, 400);
            });
        });
