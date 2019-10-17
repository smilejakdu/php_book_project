<?php
header("content-type:text/html; charset=UTF-8");

include '../../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();


   $b_ID=$_GET['b_ID'];

   echo $b_ID."<br>";
?>
 



   <form name='image'  action='image_up_post.php' method='post' enctype='multipart/form-data' > 
   <input type='file' name='file1' />
   <input type='hidden' name='b_ID' value='<?=$b_ID?>' /> 
<br><br>
    <input type='submit' value='완료' /> 
	&nbsp; &nbsp; 
	<input type='button' value='취소' onclick='window.close();' /> 