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

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
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
    <title>Coreana-고객의소리</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub4/common/css/sub4common.css">
    <link rel="stylesheet" href="css/cus_view.css">
    
    <script src="../common/js/prefixfree.min.js"></script>
    
    <script>
	function check_input()
	{
		if (!document.ripple_form.ripple_content.value)
		{
			alert("내용을 입력해주세요.");   
			document.ripple_form.ripple_content.focus();
			return;
		}
		document.ripple_form.submit();
    }

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
   
    <!-- 메인비주얼영역 -->
    <div class="visual">  
        <img src="../sub4/common/images/sub4_visual.jpg" alt="">
        <h3>고객센터</h3>
        <p>Customer Service Center</p>   
    </div>
    
    <!-- 서브네비영역 -->  
    <div class="sub_nav">
        <ul>
            <li><a id="nav1" href="sub4_1.html">FAQ</a></li>
            <li><a class="current" id="nav2" href="list.php">고객의소리</a></li>
        </ul>
    </div>
   
    <article id="content">
        <div class="title_area">
            <div class="line_map">
                <span>Home </span>&gt;<span > 고객센터 </span>&gt;<strong> 고객의소리</strong>
            </div>
            <h2>고객의 소리</h2>
            <p>Voice of the Customer</p>
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
            <div id="ripple">
    <?
        $sql = "select * from customer_ripple where parent=$item_num";
        $result2 = mysql_query($sql, $connect); 
        $num_ripple = mysql_num_rows($result2); 
    
    ?>
                <p><i class="far fa-comment-dots"></i>&nbsp;&nbsp;댓글
    <?            
        if ($num_ripple) 
                    echo " [<span>$num_ripple</span>]";        
    ?>          
                </p>
    <?
            $sql = "select * from customer_ripple where parent='$item_num'";
            $ripple_result = mysql_query($sql);

            while ($row_ripple = mysql_fetch_array($ripple_result))
            { 
                $ripple_num     = $row_ripple[num];
                $ripple_id      = $row_ripple[id];
                $ripple_nick    = $row_ripple[nick];
                $ripple_content = str_replace("\n", "<br>", $row_ripple[content]); 
                $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
                $ripple_date    = $row_ripple[regist_day];
    ?>
                     <ul id=ripple_check>
                        <li class="ripple_writer"><?=$ripple_nick?></li>
                        <li class="ripple_content"><?=$ripple_content?></li>
                        <li>
                            <span><?=$ripple_date?></span>
                            <span>
                          <? 
                                if($userid=="admin" || $userid=="aaa" || $userid==$ripple_id)
                                  echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'> 삭제하기</a>";
                          ?>
                            </span>
                        </li>
                     </ul>
    <?
            }
    ?>			<!-- 리플작성하는 부분 시작 -->
                <form name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>"> 
                <!--
                insert php로 넘기는 변수 3개
                get : $table(메인테이블), $num(메인글번호)
                post : $ripple_content(덧글내용)
                -->
                    <div id="ripple_box">
                       <label for="ripple_content" class="hidden">댓글내용</label>
                       <textarea rows="5" cols="65" id="ripple_content" name="ripple_content" placeholder="댓글을 입력해주세요."></textarea>
                       <a href="#" onclick="check_input()">댓글등록</a>
                    </div>
                </form>
            </div> <!-- end of ripple -->

            <div id="view_button">
                    <a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
    <? 
        if($userid=="admin" || $userid=="aaa" || ($userid && ($userid==$item_id)))
        {
    ?>
                    <a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>
                    <a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a>
    <?
        }
    ?>
    <? 
        if($userid)
        {
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