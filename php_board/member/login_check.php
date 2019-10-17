<?php 
session_start();
 ob_start();
header("content-type:text/html; charset=utf-8");
///////////////////////////////////////////
$user_id=$_POST['user_id'];
$pw=$_POST['pw'];
$autologin=$_POST['autologin'];  //회원 아이디 쿠키저장 
$login_locate=$_POST['login_locate'];  //로그인 위치 (메인:main / 일반:normal)
/////////////////////////////////////////// 

include '../lib/connect.php';
$connect = dbconn(); 


// 폼에서 작성했던 내용을 암호화로 변경
 $result = mysqli_query($connect, "select password('$pw')");
 $pws = mysqli_fetch_row ($result);
 $pws=$pws[0];

  // DB쿼리 가지고 오기
  $query = "select  user_id, pw from member where user_id='$user_id' and pw='$pws' ";
  $result = mysqli_query($connect, $query); 
  $member = mysqli_fetch_array($result); 


  if(!$member['user_id']) Error('회원 정보가 일치하지 않습니다.'); 
  if($member['pw']!=$pws) Error('회원정보가 일치하지 않습니다.'); 



///// 쿠키, 세션 저장 /////
 if($member['user_id']){  //아이디와 비밀번호가 맞으면 쿠키에 저장하라 
 $tmp = $member['user_id'];  //쿠키를 저장하기 위 

   if($autologin){                                                    //아이디 저장이 있으면 쿠키저장
  setcookie("members",$tmp,time()+60*60*24*7, "/");  //쿠키저장  7일동안 보관
}
$_SESSION['user_id'] = $member['user_id'];  //일반로그인시 세션저장
} //쿠키, 세션 저장 끝
	

if($login_locate=="main"){  ?>
 <script language="javascript">
   location.href='../main.php';
   </script>
<?}else if($login_locate=="normal"){?>
 <script language="javascript">
  top.document.location.reload();
   </script>
<?}?>
