<? 
	session_start(); 
      @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}
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
    <link rel="stylesheet" href="css/down_write.css">
    
    <script src="../common/js/prefixfree.min.js"></script>

<script>
  function check_input()
   {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요1");    
          document.board_form.subject.focus();
          return;
      }

      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
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
           
        <?
            if($mode=="modify")
            {

        ?>
                <form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
        <?
            }
            else
            {
        ?>
                <form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
        <?
            }
        ?>
                <div id="write_form">
                    
                    <div id="write_row1">
                        <div class="col1">닉네임</div>
                        <div class="col2"><?=$usernick?></div>					
			        </div>        
                    <div id="write_row2">
                         <label for="subject" class="col1">제목</label>
                         <input type="text" id="subject" name="subject" value="<?=$item_subject?>" class="col2">
			        </div>
                    <div id="write_row3">
                         <label for="content" class="col1">내용</label>
                         <textarea rows="15" cols="79" id="content" name="content" class="col2"><?=$item_content?></textarea>
			        </div>
                   
                   
                    <div id="write_row4">
                         <label for="file1" class="col1">첨부파일1</label>
                         <input type="file" id="file1" name="upfile[]" class="col2">
                         <span>- 5MB까지 업로드 가능</span>
			        </div>        
                    
        <? 	if ($mode=="modify" && $item_file_0)
            {
        ?>
                    <div class="delete_ok">
			            <?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" id="i_delete1" name="del_file[]" value="0"><label for="i_delete1">삭제</label>
                    </div>
        <?
            }
        ?>
                   <div id="write_row5">
                        <label for="file2" class="col1">첨부파일2</label>
                        <input type="file" id="file2" name="upfile[]" class="col2">
                        <span>- 5MB까지 업로드 가능</span>
			        </div>
        <? 	if ($mode=="modify" && $item_file_1)
            {
        ?>
                    <div class="delete_ok">
                        <?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" id="i_delete2" name="del_file[]" value="1"><label for="i_delete2">삭제</label>
                    </div>
	
        <?
            }
        ?>


                    <div id="write_row6">
                        <label for="file3" class="col1">첨부파일3</label>
                        <input type="file" id="file3" name="upfile[]" class="col2">
                        <span>- 5MB까지 업로드 가능</span>
                    </div>
        <? 	if ($mode=="modify" && $item_file_2)
            {
        ?>
                    <div class="delete_ok">
                        <?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" id="i_delete3" name="del_file[]" value="2"><label for="i_delete3">삭제</label>
                    </div>
        <?
            }
        ?>
                   
                </div>

                <div id="write_button">
                    <a href="#" onclick="check_input()">등록</a>
                    <a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
                </div>

            </form>
        </div>
    </article>
    
    <? include "../common/sub_foot.html" ?>
    
</body>
</html>