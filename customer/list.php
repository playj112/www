<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	$table = "customer";
	$ripple = "customer_ripple";
    // 2개의 테이블 이름을 계속 넘겨줌
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
    <link rel="stylesheet" href="css/cus_list.css">
    
    <script src="../common/js/prefixfree.min.js"></script>
    
</head>
<?
	include "../lib/dbconn.php";
	$scale=10;			

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}
		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result);

	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)               
		$page = 1;           
  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>
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
            
           <div class="email_box">
               <i class="fas fa-envelope-open-text"></i>
               <p>'고객의 소리' 게시판은 고객님들의 편의를 위해 공개 게시판으로 운영됩니다.<br>1:1 문의를 원하시는 경우 아래의 이메일 문의를 이용해주세요.</p>
               <a href="../mail/mail.html">이메일 문의하기</a>
           </div>
            
           <form  name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search"> 
                <div id="list_search">
                    <div id="list_search1">
                        <select name="find">
                            <option value='subject'>제목</option>
                            <option value='content'>내용</option>
                            <option value='nick'>별명</option>
                            <option value='name'>이름</option>
                        </select>
                    </div>
                    <div id="list_search2">
                        <label for="search" class="hidden">검색</label>
                        <input type="text" id="search" name="search">
                    </div>
                    <div id="list_search3">
                        <label for="search_button" class="hidden">검색버튼</label>
                        <input type="submit" id="search_button" value="검색">
                    </div>
                </div>
                <div id="list_total">▷ 총 <?= $total_record ?> 개의 문의글이 있습니다.</div>
            </form>

            <div id="list_top_title">
                <ul>
                    <li id="list_title1">번호</li>
                    <li id="list_title2">제목</li>
                    <li id="list_title3">글쓴이</li>
                    <li id="list_title4">등록일</li>
                    <li id="list_title5">조회</li>
                </ul>		
		    </div>

            <div id="list_content">
    <?		
       for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
       {
          mysql_data_seek($result, $i);           
          $row = mysql_fetch_array($result);	      

          $item_num     = $row[num];
          $item_id      = $row[id];
          $item_name    = $row[name];
          $item_nick    = $row[nick];
          $item_hit     = $row[hit];
          $item_date    = $row[regist_day];
          $item_date = substr($item_date, 0, 10);  
          $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

           
          $sql = "select * from customer_ripple where parent=$item_num";
          $result2 = mysql_query($sql, $connect); 
          $num_ripple = mysql_num_rows($result2); 
    ?>
                <div id="list_item">
                    <div id="list_item1"><?= $number ?></div>
                    <div id="list_item2"><a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a>
    <?              
            if ($num_ripple) 
                    echo " <span>[$num_ripple]</span>";
    ?>
                    </div>
                    <div id="list_item3"><?= $item_nick ?></div>
                    <div id="list_item4"><?= $item_date ?></div>
                    <div id="list_item5"><?= $item_hit ?></div>
                </div>
    <?
           $number--;
       }
    ?>
                <div id="page_button">
                    <div id="page_num">
    <?
       for ($i=1; $i<=$total_page; $i++)
       {
            if ($page == $i)
            {
                echo "<b> $i </b>";
            }
            else
            { 
                echo "<a href='list.php?table=$table&page=$i'> $i </a>";
            }      
       }
    ?>			

                    </div>
                    <div id="button">
                        <a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
    <? 
        if($userid)
        {
    ?>
            <a href="write_form.php?table=<?=$table?>">글쓰기</a>
    <?
        }
    ?>
                    </div>
                </div> <!-- end of page_button -->		
            </div> <!-- end of list content -->
        </div>
    </article>
    
    <? include "../common/sub_foot.html" ?>
    
</body>
</html>