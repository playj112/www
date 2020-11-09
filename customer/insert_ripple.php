<?
   session_start();
?>
<meta charset="utf-8">
<?
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
    /*
    세션변수 4마리
    
    $table=부모테이블명 (free)
    $num=부모테이블글번호 (1)
    
    $ripple_content=리플콘텐츠
    */

   if(!$userid) {
     echo("
	   <script>
	     window.alert('로그인 후 이용이 가능합니다.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }   
   include "../lib/dbconn.php";

   $regist_day = date("Y-m-d (H:i)");  

   
   $sql = "insert into customer_ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$username', '$usernick', '$ripple_content', '$regist_day')";    
   
   mysql_query($sql, $connect);  
   mysql_close();             

   echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num';
	   </script>
	"; 
?>

   
