<? 
	session_start(); 
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>회원가입</title>
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="css/member_form.css">
	
	<script src="../common/js/jquery-1.12.4.min.js"></script>
	<script src="../common/js/jquery-migrate-1.4.1.min.js"></script>
	
	
	<script>
    
    function check_input2(){
      tvalue = document.member_form.id;
      onvalue = tvalue.value;

      count=0;
      for (i=0;i<onvalue.length;i++){
        ls_one_char = onvalue.charAt(i); 

        if(ls_one_char.search(/[0-9|a-z|A-Z|]/) == -1) { 
           count++;
        }
      }
      if(count!=0) { 
        alert("아이디에는 영문과 숫자만 사용가능합니다.\n다시 입력해주세요.") ;
        tvalue.value = "";
        tvalue.focus();
        return false;
      }
     }    
        
    </script>
	
	<script>
	 $(document).ready(function() {
  
     //id 중복검사
     $("#id").keyup(function() {
        var id = $('#id').val();

        $.ajax({
            type: "POST",
            url: "check_id.php",
            data: "id="+ id,  
            cache: false,
            success: function(data)

            {
                 $("#loadtext").html(data);
            }
        });
    });

    //nick 중복검사		 
    $("#nick").keyup(function() {
        var nick = $('#nick').val();

        $.ajax({
            type: "POST",
            url: "check_nick.php",
            data: "nick="+ nick,  
            cache: false, 
            success: function(data)
            {
                 $("#loadtext2").html(data);
            }
        });
    });		 
    });

	</script>
	
	<script>
  
   function check_input()
   {
      if (!document.member_form.id.value)
      {
          alert("아이디를 입력하세요");    
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pass.value)
      {
          alert("비밀번호를 입력하세요");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value)
      {
          alert("비밀번호확인을 입력하세요");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");    
          document.member_form.nick.focus();
          return;
      }


      if (!document.member_form.hp2.value || !document.member_form.hp3.value )
      {
          alert("휴대폰 번호를 입력하세요");    
          document.member_form.nick.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");    
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit(); 
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.hp1.value = "010";
      document.member_form.hp2.value = "";
      document.member_form.hp3.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
	  
      document.member_form.id.focus();

      return;
   }
    </script>
    
</head>
<body>
	 
	<article id="content">
	   <div class="login_top">
           <h2>JOIN US</h2>
           <a href="../index.html" class="form_logo">코리아나로고</a>
       </div>
         <ul class="join_notice">
             <li>* 가입시 설정한 아이디와 이름은 변경이 불가능합니다.</li>
             <li>* 모든 항목은 <span>필수항목</span>입니다.</li>
         </ul>
          <form  name="member_form" method="post" action="insert.php"> 

             <ul>
                <li>
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" placeholder="아이디를 입력해주세요. (영문/숫자만 사용가능)" required onkeyup="check_input2()">
                    <span id="loadtext"></span>
                </li>
                <li>
                    <label for="pass">PASSWORD</label>
                    <input type="password" name="pass" id="pass" placeholder="비밀번호를 입력해주세요." required>
                </li>
                <li>
                    <label for="pass_confirm">PW Confirm</label>
                    <input type="password" name="pass_confirm" id="pass_confirm" placeholder="비밀번호 확인" required>
                </li>
                <li>
                    <label for="name">NAME</label>
                    <input type="text" name="name" id="name" placeholder="이름" required> 
                </li>
                <li>
                    <label for="nick">Nickname</label>
                    <input type="text" name="nick" id="nick" placeholder="닉네임" required>
                     <span id="loadtext2"></span>
                </li>
                <li>
                    <label>H.P.</label>
                    <label class="hidden" for="hp1">전화번호앞3자리</label>
                    <select class="hp" name="hp1" id="hp1"> 
                      <option value='010'>010</option>
                      <option value='011'>011</option>
                      <option value='016'>016</option>
                      <option value='017'>017</option>
                      <option value='018'>018</option>
                      <option value='019'>019</option>
                  </select>  - 
                  <label class="hidden" for="hp2">전화번호중간4자리</label><input type="text" class="hp" name="hp2" id="hp2"  required> - <label class="hidden" for="hp3">전화번호끝4자리</label><input type="text" class="hp" name="hp3" id="hp3"  required>
                </li>
                <li>
                    <label>E-Mail</label>
                      <label class="hidden" for="email1">이메일아이디</label>
                      <input type="text" id="email1" name="email1"  required> @ 
                      <label class="hidden" for="email2">이메일주소</label>
                      <input type="text" name="email2" id="email2"  required>
                </li>
                <li>
                   <ul>
                       <li><a href="#" class="join_end" onclick="check_input()">가입완료</a></li>
                       <li><a href="#" class="join_again" onclick="reset_form()">다시작성</a></li>
                       <li><a href="../index.html" class="join_c">취소</a></li>
                   </ul>  
                </li>
             </ul>

         </form>
	  
	</article>
</body>
</html>


