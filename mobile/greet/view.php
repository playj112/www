<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../../lib/dbconn.php";

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
    <meta name="viewport" content="width=device-width">
    <meta name = "format-detection" content = "telephone=no">
    
    <title>Coreana-공지사항</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    
    <link rel="apple-touch-icon-precomposed" href="app_icon.png">
    <link rel="apple-touch-startup-image" href="startup.png">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/sub3_1.css">
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