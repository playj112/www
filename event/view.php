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

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];

	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

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
	
	for ($i=0; $i<3; $i++) 
	{
		if ($image_copied[$i])
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);

            
			$image_width[$i] = $imageinfo[0];  
			$image_height[$i] = $imageinfo[1]; 
			$image_type[$i]  = $imageinfo[2];  
            
        if ($image_width[$i] > 900) // 삽입된 이미지의 최대너비를 지정
				$image_width[$i] = 900; // 활용할 때 이 숫자만 체크
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		} 
	}

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";
	mysql_query($sql, $connect);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Coreana-EVENT</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub3/common/css/sub3common.css">
    <link rel="stylesheet" href="css/event_view.css">
    
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
            <li><a id="nav1" href="../greet/list.php">공지사항</a></li>
            <li><a id="nav2" href="../sub3/sub3_2.html">CF갤러리</a></li>
            <li><a class="current" id="nav3" href="list.php">EVENT</a></li>
        </ul>
    </div>
   
    <!-- 본문영역 -->
    <article id="content">
        <div class="title_area">
            <div class="line_map">
                <span>Home </span>&gt;<span > 홍보센터 </span>&gt;<strong> EVENT</strong>
            </div>
            <h2>EVENT</h2>
            <p>코리아나의 이벤트 소식</p>
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
                        if ($image_copied[$i]) 
                        {
                            $img_name = $image_copied[$i]; 
                            $img_name = "./data/".$img_name; 

                            $img_width = $image_width[$i]; 

                            echo "<img src='$img_name' width='$img_width'>"."<br><br>";

                        }
                    }
                ?>
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