<?
   function latest_article($table, $loop, $char_limit) 
   {
		include "dbconn.php";

		$sql = "select * from $table order by num desc limit $loop";
		$result = mysql_query($sql, $connect);

		while ($row = mysql_fetch_array($result))
		{
			$num = $row[num];
			$len_subject = mb_strlen($row[subject], 'utf-8');
			$subject = $row[subject];

			if ($len_subject > $char_limit)
			{
				$subject = str_replace( "&#039;", "'", $subject);               
                $subject = mb_substr($subject, 0, $char_limit, 'utf-8');
				$subject = $subject."...";
			}

			$regist_day = substr($row[regist_day], 0, 10);
            
            
            if($table=='event'){

            
			$img_name = $row[file_copied_0];
			if($img_name){ 
				$img_name = "./$table/data/".$img_name;
			}else{
				$img_name = "./$table/data/default.jpg"; 
			}
            
            }
            
                
            
            if($table=='greet'){

			echo "      
				<li class='notice_slide'><a href='./$table/view.php?table=$table&num=$num'><p>
				$subject</p><span>$regist_day</span></a></li>
			";
                
             
            }else if($table=='event'){
                
                echo " 
                
                <li><img src='$img_name' alt='' class='index_e_image'><a href='./$table/view.php?table=$table&num=$num'><div class='event_hover'><p>$subject</p><span>Click!</span></div></a></li>
                
			";
                
            }   
             
		}
		mysql_close();
   }
?>