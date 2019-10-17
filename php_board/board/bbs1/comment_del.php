<?php 
session_start();
ob_start();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--다국어 언어: UTF-8-->
<meta http-equiv="imagetoolbar" CONTENT="no"> <!--====이미지 저장하는 툴바 없애기==-->
	 <title><? echo $top_title=$ctgs_name.'- Comment Del';?></title> 
</head>

<? 
$no_s=$_GET['no_s'];  //게시물  번호
$d_no=$_GET['d_no'];  //댓글 순번
$b_ID=$_GET['b_ID']; //게시판 글 ID
$r_replys_no=$_GET['r_replys_no']; //리 코맨트 (코맨트의 no가 들어감)
$replys_all=$_GET['replys_all']; //코맨트 삭제
$reply_rr=$_GET['reply_rr']; //  대 댓글 삭제
//////////////////////////////////////

include '../../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();


  $query = "select * from bbs1_comments where user_id='$member[user_id]' and b_ID='$b_ID' "; 
  mysqli_query($connect, "SET NAMES utf8");
  $result= mysqli_query($connect, $query); 
  $data = mysqli_fetch_array($result); 


if($member['user_id']!=$data['user_id'])Error('자신의 글만 삭제 가능합니다.'); 
if(!$no_s)Error('해당 게시물이 없습니다.'); 





  $q_count = "select count(*) from bbs1_comments where b_ID='$b_ID' and no='$d_no'  or r_replys_no='$d_no'  ";  
  $r_count = mysqli_query($connect, $q_count);  
  $count = mysqli_fetch_array($r_count);  
  $total_comments = $count[0]; // 현재 쿼리한 게시물의 총 개수를 구함  
 
 ?>



<?
    // 코멘트 삭제 + 대 대글 삭제
	if($replys_all=="all"){
  $query_1 = "delete from  bbs1_comments where no='$d_no' and b_ID='$no_s' "; 
  $result_1 = mysqli_query($connect, $query_1); 

  $query_2 = "delete from  bbs1_comments where b_ID='$no_s' and r_replys_no='$d_no' "; 
  $result_2 = mysqli_query($connect, $query_2); 



 $query = "update bbs1 set  comments=comments-$total_comments where b_ID='$b_ID' "; 
 $result = mysqli_query($connect, $query); 
}




    // 대 댓글만 삭제
if($reply_rr=='rr'){
  $query = "delete from  bbs1_comments where no='$d_no' and b_ID='$b_ID' and r_replys_no='$r_replys_no' "; 
  $result = mysqli_query($connect, $query); 

 $query = "update bbs1 set  comments=comments-1 where b_ID='$b_ID' "; 
 $result = mysqli_query($connect, $query); 
}

?> 

<script>
          window.alert(decodeURIComponent("댓글이 삭제 되었습니다."));
          location.href='view.php?b_ID=<?=$no_s?>&ctg=<?=$data['ctg']?>&ctgs=<?=$data['ctgs']?>&lo_reply_1=#lo_reply_1';
</script>