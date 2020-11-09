<meta charset="utf-8">
<?
   
   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);
  
    if(!$id) 
   {
      echo("아이디를 입력하세요.");
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where id='$id' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);


     
      if ($num_record)
      {
       // 색변화를 주려고 span 태그를 또 잡아뒀어
         echo "<span style='color:red'>다른 아이디를 사용하세요.</span>";
      } // 리턴값을 따로 잡아주지 않아도, echo문을 사용하면 자동으로 (member_form문서의 function 변수)data에 값이 담긴다.
      else
      {
         echo "<span style='color:green'>사용가능한 아이디입니다.</span>";
      }
    
 
      mysql_close();
   }

?>

