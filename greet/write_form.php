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
    <title>Coreana-공지사항</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&family=Nanum+Myeongjo:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/febc580729.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../common/css/common.css">
    <link rel="stylesheet" href="../sub3/common/css/sub3common.css">
    <link rel="stylesheet" href="css/greet_write.css">
    
    <script src="../common/js/prefixfree.min.js"></script>
    
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
            <form  name="board_form" method="post" action="insert.php"> 
                <div id="write_form">
                    <div id="write_row1">
                        <div class="col1">닉네임</div>
                        <div class="col2"><?=$usernick?></div>
                        <div class="col3">
                            <label for="html_ok">HTML 쓰기</label>
                            <input type="checkbox" id="html_ok" name="html_ok" value="y">
                        </div>
                    </div>
                    <div id="write_row2">
                        <label for="subject" class="col1">제목</label>
                        <input type="text" name="subject" class="col2">
                    </div>
                    <div id="write_row3">
                        <label for="content" class="col1">내용</label>
                        <textarea rows="15" cols="79" id="content" name="content" class="col2"></textarea>
                    </div>
                </div>
                <div id="write_button">
                    <label for="w_submit" class="hidden">등록버튼</label>
                    <input type="submit" id="w_submit" value="등록">
                    <a href="list.php?page=<?=$page?>">목록</a>
                </div>
            </form>
        </div>
    </article>
    
    <? include "../common/sub_foot.html" ?>
    
</body>
</html>