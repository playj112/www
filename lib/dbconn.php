<?
    $connect=mysql_connect( "localhost", "playj112", "password") or  
        die( "SQL server에 연결할 수 없습니다."); 

    mysql_select_db("playj112",$connect);
?>
