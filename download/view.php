<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       

	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$file_name[0]   = $row[file_name_0];
	$file_name[1]   = $row[file_name_1];
	$file_name[2]   = $row[file_name_2];

	$file_type[0]   = $row[file_type_0]; 
	$file_type[1]   = $row[file_type_1];
	$file_type[2]   = $row[file_type_2];

	$file_copied[0] = $row[file_copied_0];
	$file_copied[1] = $row[file_copied_1];
	$file_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = str_replace(" ", "&nbsp;", $row[content]);
	$item_content = str_replace("\n", "<br>", $item_content);
	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";  
	mysql_query($sql, $connect);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Coreana-채용공고</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub6/common/css/sub6common.css">
    <link rel="stylesheet" href="css/down_view.css">
    
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
        <img src="../sub6/common/images/sub6_visual.jpg" alt="">
        <h3>인재채용</h3>
        <p>Recruitment</p>   
    </div>
    
    <!-- 서브네비영역 -->  
    <div class="sub_nav">
        <ul>
            <li><a id="nav1" href="../sub6/sub6_1.html">인재상</a></li>
            <li><a id="nav2" href="../sub6/sub6_2.html">채용안내</a></li>
            <li><a class="current" id="nav3" href="list.php">채용공고</a></li>
        </ul>
    </div>
    
    <!-- 본문콘텐츠영역 -->
    <article id="content">
        <div class="title_area">
            <div class="line_map">
                <span>Home </span>&gt;<span > 인재채용 </span>&gt;<strong> 채용공고</strong>
            </div>
            <h2>채용공고</h2>
            <p>Recruitment Notice</p>
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
<?
	for ($i=0; $i<3; $i++)
	{
		if ($userid && $file_copied[$i]) 
		{
			$show_name = $file_name[$i]; 
			$real_name = $file_copied[$i]; 
			$real_type = $file_type[$i]; 
			$file_path = "./data/".$real_name; 
			$file_size = filesize($file_path); 

			echo "<b>▷ 첨부파일 : </b>$show_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       <a href='download.php?table=$table&num=$num&real_name=$real_name&show_name=$show_name&file_type=$real_type'>[저장]</a><br>";
		} 
	}     
?>
		    <br>
			<?= $item_content ?>
		    </div>
       
            <div id="view_button">
                <a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
            
            <? 
                if($userid==$item_id || $userlevel==1 || $userid=="admin" || $userid=='aaa')
                {
            ?>
                <a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>
                <a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a>
            <?
                }
            ?>
            <? 
                if($userid=='admin' || $userid=='aaa'){      
            ?>
                <a href="write_form.php?table=<?=$table?>">글쓰기</a>
            <?
                }
            ?>
            </div>
       
        
        </div>
    
    
    </article>
    
    <? include "../common/sub_foot.html" ?>
    
</body>
</html>


