<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
    @extract($_SESSION);  
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="css/login_form.css">
    
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    <script>       
        function join_cancel(){
            history.go(-1);
        }
    </script>
</head>
<body>
   
   <article id="content">
       <div class="login_top">
           <h2>Login</h2>
           <a href="../index.html" class="form_logo">코리아나로고</a>
       </div>
       <form  name="member_form" method="post" action="login.php">     
           <div id="login_form">
                <div class="id_pw_input">
                    <ul>
                        <li>
                        <label for="id" class="hidden">ID</label>
                        <input type="text" name="id" class="login_input" placeholder="아이디를 입력해주세요. (영문/숫자만 가능)">
                        </li>
                        <li>
                        <label for="pass" class="hidden">PASSWORD</label>
                        <input type="password" name="pass" class="login_input" placeholder="비밀번호를 입력해주세요.">
                        </li>
                    </ul>						
                </div>
                <div class="login_button">
                    <input type="submit" value="login">
                    <a href="#" onclick="join_cancel()">취소</a>
                </div>
                <div class="join_button">
                    <span>JOIN US</span>
                    <p>아직 코리아나 회원이 아니신가요?<br>회원가입을 통해 다양한 정보를 확인하세요.</p>
                    <a href="../member/join.html">회원가입</a>
                </div>
                <a href="../sub2/sub2_1.html" title="라비다 페이지로 이동" class="login_banner"></a>
           </div>
       </form>
       
   </article>
    
</body>
</html>


