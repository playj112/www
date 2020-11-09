<?
           session_start();
?>
<meta charset="utf-8">
<?
  @extract($_GET); 
  @extract($_POST); 
  @extract($_SESSION);


   if(!$id) {
     echo("
           <script>
             window.alert('아이디를 입력하세요.');
             history.go(-1);
           </script>
         ");
         exit;
   }

   if(!$pass) {
     echo("
           <script>
             window.alert('비밀번호를 입력하세요.');
             history.go(-1);
           </script>
         ");
         exit;
   }

 

   include "../lib/dbconn.php";

   $sql = "select * from member where id='$id'";
   $result = mysql_query($sql, $connect);

   $num_match = mysql_num_rows($result);

   if(!$num_match) // 검색 레코드가 없으면 
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다.');
             history.go(-1);
           </script>
         ");
    }
    else    // 해당 아이디가 검색되었으면 (검색 레코드가 있으면)
    {
		 $row = mysql_fetch_array($result); // result안에서 검색 결과 빼오기
          //$row[id] ,.... $row[level]
        
         $sql ="select * from member where id='$id' and pass=password('$pass')";
        
         // 암호화된 비밀번호를 암호를 다시 풀어내는 함수는 없어
         // 입력된 변수값을 다시 함수로 암호화해서 db에 저장된 암호와 대조하기 방식
         // select 문으로 바로 비교하기
        
         $result = mysql_query($sql, $connect);
         $num_match = mysql_num_rows($result); // 1 or null
     
  
        if(!$num_match)  //적은 패스워드와 디비 패스워드가 같지않을때
        {
           echo("
              <script>
                window.alert('비밀번호를 다시 확인해주세요.');
                history.go(-1);
              </script>
           ");

           exit;
        }
        else    // 입력 pass 와 테이블에 저장된 pass 일치한다. (이제 id와 pass 모두 일치)
        { // 내가 상단에 표시하기 위해 필요한 값을 담아둔다. 여기서는 일반변수상태
           $userid = $row[id];
		   $username = $row[name];
		   $usernick = $row[nick];
		   $userlevel = $row[level];
  
            
           //필요한 id~level 값을 저장하여 세션변수를 생성한다 (가장중요! 로그인상태 만들기)
           $_SESSION['userid'] = $userid; //$_SESSION['userid'] = $row[id];
           $_SESSION['username'] = $username; //$_SESSION['username'] = $row[name];
           $_SESSION['usernick'] = $usernick; //$_SESSION['usernick'] = $row[nick];
           $_SESSION['userlevel'] = $userlevel; //$_SESSION['userlevel'] = $row[level];

           echo("
              <script>
			    alert('LOGIN, HELLO!');
                location.href = '../index.html';
              </script>
           ");
        }
   }          
?>
