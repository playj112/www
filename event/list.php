<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	$table = "event";
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
    <link rel="stylesheet" href="css/event_list.css"> 
    
    <script src="../common/js/prefixfree.min.js"></script>
    
</head>
<?
	include "../lib/dbconn.php";

    
   if (!$scale)
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
            <div class="event_top">
                <form  name="board_form" method="post" action="list.php?mode=search"> 
                    <div id="list_search">
                        <div id="list_total">▷ 총 <?= $total_record ?> 개의 진행중인 이벤트가 있습니다.</div>
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
                </form>

                <select class="e_scale" name="scale" onchange="location.href='list.php?scale='+this.value">
                            <option value=''>보기</option>
                            <option value='5'>5</option>
                            <option value='10'>10</option>
                            <option value='15'>15</option>
                            <option value='20'>20</option>
                </select>
            </div>
            <div id="list_top_title">
                <ul class="hidden">
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
          
          $item_subject = mb_substr($row[subject], 0, 15, 'utf-8');
          $item_subject = $item_subject."...";
          $item_subject = str_replace(" ", "&nbsp;", $item_subject);

          if($row[file_copied_0]){ 
            $item_img = './data/'.$row[file_copied_0]; 

          }else{ 
            $item_img = './data/default.jpg';
          }

    ?>
                <div id="list_item">
                    <div id="list_item1" class="hidden"><?= $number ?></div>
                    <div id="list_item2">
                        <a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>">
                            <img src="<?=$item_img?>" alt="" class="e_list_image">
                            <p><?= $item_subject ?></p>
                        </a>
                    </div>
                    <div id="list_item3" class="hidden"><?= $item_nick ?></div>
                    <div id="list_item4"><i class="far fa-clock"></i><span>게시일 : </span><?= $item_date ?></div>
                    <div id="list_item5" class="hidden"><?= $item_hit ?></div>
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

              if($mode=="search"){
                 echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search'> $i </a>"; 
              }else{    

                  echo "<a href='list.php?page=$i&scale=$scale'> $i </a>";
               }


            }      
       }
    ?>			
                    </div>
                    <div id="button">
                        <a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>&nbsp;
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