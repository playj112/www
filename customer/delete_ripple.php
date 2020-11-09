<?
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
/*

table=$table
num=$item_num (게시판 글번호) -> view 페이지니까 계속 넘어와
ripple_num=$ripple_num(리플 글번호)

*/

      include "../lib/dbconn.php";

      $sql = "delete from customer_ripple where num=$ripple_num";
      mysql_query($sql, $connect);
      mysql_close();

      echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num';
	   </script>
	  ";
?>
