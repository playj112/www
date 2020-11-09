<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	$table = "download";
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
    <link rel="stylesheet" href="css/down_list.css">
    
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
                <div id="list_total">▷ 총 <?= $total_record ?> 개의 공고가 있습니다.</div>
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
    ?>
                <div id="list_item">
                    <div id="list_item1"><?= $number ?></div>
                    <div id="list_item2"><a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a></div>
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
        if($userid=='admin' || $userid=='aaa')
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