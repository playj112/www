// JavaScript Document

 $(document).ready(function () {
	var article = $('.faq .article'); 
     // 계속 불러주기 귀찮으니까 변수에 담아, 이제 article=모든 li들
	article.find('.a').slideUp(100); //li안에 모든 답변 닫아
	
	$('.faq .article .trigger').click(function(){  
        // 각각의 질문을 클릭하면
	var myArticle = $(this).parents('.article'); 
        // 클릭한 질문의 리스트
	
	if(myArticle.hasClass('hide')){ 
        // 클래스 hide 갖고있어? = 클릭한 리스트 답변이 닫혀있어?
        
        article.find('.a').slideUp(100); //모든 답변 다 닫아 그게누구든
        article.removeClass('show').addClass('hide'); //전부클래스바꿔
        article.find('i').removeClass('fas fa-chevron-up').addClass('fas fa-chevron-down');
        
	    myArticle.removeClass('hide').addClass('show');  
	    myArticle.find('.a').slideDown(100);
        myArticle.find('i').removeClass('fas fa-chevron-down').addClass('fas fa-chevron-up');
        
        
	 } else {  // 클릭한 리스트 답변이 닫혀있어? show
	   myArticle.removeClass('show').addClass('hide');  
	   myArticle.find('.a').slideUp(100);
       myArticle.find('i').removeClass('fas fa-chevron-up').addClass('fas fa-chevron-down');
	}  
  });   
});  