<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

    $item_date    = $row[regist_day];

	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}

    if ($is_html=="y")
	{
        $item_content = str_replace("&lt;", "<", $item_content);
        $item_content = str_replace("&gt;", ">", $item_content);
    }

	$new_hit = $item_hit + 1;

	$sql = "update greet set hit=$new_hit where num=$num";
	mysql_query($sql, $connect);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Coreana-공지사항</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub3/common/css/sub3common.css">
    <link rel="stylesheet" href="css/greet_view.css">
    
    <script src="../common/js/prefixfree.min.js"></script>
    
    <script>
    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
    </script>
    
</head>
<body>
   
   <? include "../common/sub_head.html" ?>

    <div class="visual">  
        <img src="../sub3/common/images/sub3_visual.jpg" alt="">
        <h3>홍보센터</h3>
        <p>Promotion Center</p>   
    </div>
    
    <!-- 서브네비영역 -->  
    <div class="sub_nav">
        <ul>
            <li><a class="current" id="nav1" href="list.php">공지사항</a></li>
            <li><a id="nav2" href="../sub3/sub3_2.html">CF갤러리</a></li>
            <li><a id="nav3" href="../event/list.php">EVENT</a></li>
        </ul>
    </div>
   
    <!-- 본문영역 -->
    <article id="content">

        <div class="title_area">
            <div class="line_map">
                <span>Home </span>&gt;<span > 홍보센터 </span>&gt;<strong> 공지사항</strong>
            </div>
            <h2>공지사항</h2>
            <p>NOTICE</p>
        </div>

        <div class="content_area">
            <div id="view_title">
                <div id="view_title1"><?= $item_subject ?></div>
                <ul id="view_title2">
                   <li><i class="fas fa-user"></i><?= $item_nick ?></li>
                   <li>|  <?= $item_date ?></li>
                   <li><i class="fas fa-eye"></i>조회수 : <?= $item_hit ?></li>
                </ul>	
            </div>

            <div id="view_content">
                <?= $item_content ?>
            </div>

            <div id="view_button">
                <a href="list.php?page=<?=$page?>">목록</a>
        <? 
            if($userid==$item_id || $userlevel==1 || $userid=="admin" || $userid=='aaa')
            {
        ?>
                <a href="modify_form.php?num=<?=$num?>&page=<?=$page?>">수정</a>
                <a href="javascript:del('delete.php?num=<?=$num?>')">삭제</a>
        <?
            }
        ?>
        <? 
            if($userid=='admin' || $userid=='aaa')
            {
        ?>
                <a href="write_form.php">글쓰기</a>
        <?
            }
        ?>
            </div>

        </div>
        
    </article>
    
     <? include "../common/sub_foot.html" ?>
    
</body>
</html>