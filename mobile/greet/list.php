<? 
	 session_start(); 
     @extract($_POST);
     @extract($_GET);
     @extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta name = "format-detection" content = "telephone=no">
    
    <title>Coreana-공지사항</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    
    <link rel="apple-touch-icon-precomposed" href="app_icon.png">
    <link rel="apple-touch-startup-image" href="startup.png">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/sub3_1.css">
    <link rel="stylesheet" href="css/greet_list.css">
    
    <script src="../js/prefixfree.min.js"></script>
    <script>
      // <![CDATA[
      try {
       window.addEventListener('load', function(){
        setTimeout(scrollTo, 0, 0, 1); 
       }, false);
      } 
      catch(e) {}
      // ]]>
    </script>
 <!--[if lt IE 9]> 
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
    
</head>
<?
	include "../../lib/dbconn.php";

	
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

		$sql = "select * from greet where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from greet order by num desc";
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
      <div id="skipNav">
         <a href="#content">본문바로가기</a>
         <a href="#gnb">네비게이션바로가기</a>
      </div>
      <div id="wrap">
          <div class="back_box"></div>
          <header id="headerArea">
              <div class="headerInner">
                  <div class="wrapHeader">
                      <h1><a href="../index.html">코리아나로고</a></h1>
                      <a href="#" class="nav_btn"><i class="fa fa-bars" aria-hidden="true"></i></a>
                  </div>    

                  <nav id="gnb">
                      <h2 class="hidden">글로벌네비게이션영역</h2>
                      <div class="gnb_top">
                          <img src="../images/gnb_logo_x2.png" alt="">
                      <a href="javascript:void(0);" class="mclose"><i class="fas fa-times"></i></a>
                      </div>
                      <div class="gnb_bottom">              
                          <ul>
                              <li class="depth1">
                                  <h3><a href="javascript:void(0);">기업소개<i class="fas fa-chevron-down"></i></a></h3>
                                  <ul>
                                      <li><a href="../sub1_1.html">CEO인사말</a></li>
                                      <li><a href="../sub1_2.html">경영이념</a></li>
                                      <li><a href="../sub1_3.html">문화경영</a></li>
                                  </ul>
                              </li>
                              <li class="depth1">
                                  <h3><a href="javascript:void(0);">브랜드소개<i class="fas fa-chevron-down"></i></a></h3>
                                  <ul>
                                      <li><a href="../sub2_1.html">LAVIDA</a></li>
                                      <li><a href="../sub2_2.html">AMPLE:N</a></li>
                                  </ul>
                              </li>
                              <li class="depth1">
                                  <h3><a href="javascript:void(0);">고객센터<i class="fas fa-chevron-down"></i></a></h3>
                                  <ul>
                                      <li><a href="list.php">공지사항</a></li>
                                      <li><a href="../sub3_2.html">FAQ</a></li>
                                  </ul>
                              </li>
                              <li class="depth1">
                                  <h3><a href="javascript:void(0);">뷰티가이드<i class="fas fa-chevron-down"></i></a></h3>
                                  <ul>
                                      <li><a href="../sub4_1.html">피부기초지식</a></li>
                                      <li><a href="../sub4_2.html">메이크업팁</a></li>
                                  </ul>
                              </li>
                          </ul>
                       </div>            
                  </nav>
              </div>           
          </header>
    <div class="main">
        <img src="../images/m_sub3_visual.jpg" alt="">
        <p>고객센터</p>
        <p>Customer Service Center</p>
    </div>
    <article id="content">
        <div class="title_area">
            <h2>공지사항</h2>
            <p>NOTICE</p>
        </div>  
        <div class="content_area">
            <form  name="board_form" method="post" action="list.php?mode=search"> 
                <div id="list_search">
                    <div id="list_search1">
                        <select name="find">
                            <option value='subject'>제목 ▼</option>
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
                <div id="list_total">▷ 총 <?= $total_record ?> 개의 공지사항이 있습니다.</div>
            </form>
		
		<select class="scale" name="scale" onchange="location.href='list.php?scale='+this.value">
                    <option value=''>보기 ▼</option>
                    <option value='5'>5</option>
                    <option value='10'>10</option>
                    <option value='15'>15</option>
                    <option value='20'>20</option>
        </select>

		<div id="list_top_title">
			<ul>
				<li id="list_title1">번호</li>
				<li id="list_title2">제목</li>
				<li id="list_title4">등록일</li>
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
				<div id="list_item2"><a href="view.php?num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a></div>
				<div id="list_item4"><?= $item_date ?></div>
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
					<a href="list.php?page=<?=$page?>">목록</a>&nbsp;
				</div>
			</div> <!-- end of page_button -->
		
        </div> <!-- end of list content -->
        </div>
       
       
    </article>
    <footer id="footerArea">
        <div class="footer_top">
              <ul>
                  <li><a href="#">이용약관</a></li>
                  <li><a href="#">개인정보</a></li>
                  <li><a href="http://playj112.cafe24.com">PC버전</a></li>
                  <li><a class="topMove" href="javascript:void(0);">T O P</a></li>
              </ul>
              <address>(주) 코리아나 화장품│312-81-07545│유학수<br>
                우 31041 충청남도 천안시 서북구 성거읍 삼곡2길 6<br>대표전화 : 031-722-7000<br>월-금(09:00 - 18:00) , 주말 및 공휴일 제외</address>
                <p>고객센터 080-022-5013</p>
          </div>
          <div class="footer_bottom">
              <p>COPYRIGHT &copy; 2018 COREANA. ALL RIGHTS RESERVED.</p>
          </div>
    </footer>
  </div>
    
    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-migrate-1.4.1.min.js"></script>
    <script src="../js/gnb.js"></script>

    <script>  
        $(document).ready(function () {
                $('.topMove').click(function(){
                $("html,body").stop().animate({"scrollTop":0},800); 
                  });
           });    
    </script>

</body>
</html>