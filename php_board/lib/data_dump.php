<?
///////////////////////  [[[[[ 회원탈퇴 데이터 정리 /////////////////////////

////////////////////  (( 7일이 지난 탈퇴회원데이터 삭제 ))//////////////////
 $now_time=time(); //현재시간을 서버데이터로
 $u_regdate=$now_time+strtotime($now_time)-60*60*24*7;  //오늘 날짜로 부터 7일 전을 계산한다.
 $del_times=date("Ymd-his",$u_regdate);   //구한 값을 시간데이터로 변경

/// DB에서 탈퇴한지 7일 전 데이터를 찾아 온다.
 $query = "select * from member_out where end_regdate<='$del_times' "; 
  mysqli_query($connect, "SET NAMES utf8");
  $result = mysqli_query($connect, $query); 
///반복문을 이용하여 7일전 테이터를 지운다. //
 while($out_member = mysqli_fetch_array($result)){

/// 탈퇴회원 지우는 쿼리문 ///
 if($out_member['mID']){
$u_query = "update member_out set
				user_id='-'
				where  mID='$out_member[mID]' ";
 $u_result = mysqli_query($connect, $u_query); 
   if(!$u_result) die(mysqli_error());  
   }  //IF문닫기
 }   //while 닫기
////////////////////  (( 7일이 지난 탈퇴회원데이터 삭제 =여기까지= ))//////////////////
?>