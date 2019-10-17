<?session_start(); ob_start();?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--다국어 언어: UTF-8-->
<link type='text/css' href='../lib/style.css' rel='stylesheet' />
</head>


<?
///////////////////////////////
$pw_1=$_POST[pw_1];
$pw=$_POST[pw];
$pw_2=$_POST[pw_2];;
$no=$_POST[no];

$user_id=$_SESSION[user_id];
///////////////////////////////

include '../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();

   
 

 if(!$pw_1) Error('현재 사용중인 비밀번호를 입력하세요.');    
  

 
  if(!$pw) Error('변경하실 비밀번호를 입력하세요.');  
   

 if(!$pw_2)Error('변경하실 비밀번호를 한번더 입력하세요.'); 
 



 //변경할 비밀번호 대조//
 if($pw!=$pw_2) Error('변경하실 비밀번호가 서로 같지 않습니다.'); 



 //현재 사용중인 비밀번호 일치대조//
if($pw_1==$pw) Error('현재 사용중인 비밀번호와 일치합니다.'); 
 


  $query = "select * from member where user_id='$user_id' "; 
  $result = mysqli_query($connect, $query); 
  $data = mysqli_fetch_array($result);  

 

// 폼에서 작성했던 내용을 암호화로 변경
 $result1 = mysqli_query($connect, "select password('$pw_1')");
 $pws1 = mysqli_fetch_row ($result1);
 $pw_1=$pws1[0];



 //DB의 비밀번호와  입력한 비밀번호를 대조//
  if($data[pw]!=$pw_1) Error('현재 사용중인 비밀번호가 다릅니다.');
 
	   

// 폼에서 작성했던 내용을 암호화로 변경
 $rrt = mysqli_query($connect, "select password('$pw')");
 $pws = mysqli_fetch_row ($rrt);
 $pws=$pws[0];


$query = "update member set
               $temp
                pw='$pws'
				where no='$no' ";

			
////////////////////////////////////////////////
$_SESSION[user_id]=$member[user_id];
//////////////////////////////////////////////

   mysqli_query($connect, $query);
?>



 <!---//현재 사용중인 비밀번호 대조//--->
<script>
        window.alert('<?=$name?>비밀번호가 수정되었습니다..');  
		opener.location.reload('../main.php')
        self.close()
 </script>
