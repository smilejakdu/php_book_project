<?php
header("content-type:text/html; charset=UTF-8");

include '../../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();


   $b_ID=$_POST['b_ID'];
   $file2=$_FILES['file2']['name'];
 
 if(!$file2){
echo "
 <script>  
  window.alert('(Error) 파일이 없습니다.');  
 self.close();
 </script> 
 ";	    
 exit; }
 
 
 $regdate=date("Ymd",time()); //날짜
 $regdate_time=date("His",time());  //시간
 


  $query = "select * from bbs1 where b_ID='$b_ID' "; 
  mysqli_query($connect, "SET NAMES utf8");
  $result = mysqli_query($connect, $query); 
  $data = mysqli_fetch_array($result); 




/////////////////[[[[파일 업로드 실행]]]]/////////////////
/////////// 확장자 검사 //////////////////////////////////////
/////////////////////((1번파일 업로드))//////////////////////
if($file2){     

$file2 =  $_FILES['file2'];//업로드된파일
$img_ext = array('jpg', 'jpge','jpeg', 'gif', 'png', 'text','php','js','css');//파일확장자 종류
$file2_name = strtolower($file2['name']);
$file2_split = explode(".", $file2_name);
$file2_type = $file2_split[count($file2_split)-1];//맨마지막 .위치에 있는 것이 확장자명

//파일 확장자 체크
if ( array_search($file2_type, $img_ext) === false ) {  //이미지파일이 아닙니다
Error('이미지 파일이 아닙니다');
}
//////////////////아래는 허용되는 확장자 일때  //////////////////


/////////////////////////////[파 일 용 량 제 한]////////////////////////////////
$size_1=$_FILES['file2']['size'];
if($size_1>5242880)Error('파일용량: 5MB로 제한 합니다.');
// 사이즈 값은 바이트(B)로 넣는다. 10485760B는 10MB를 의미
////////////////////////////////////////////////////////////////////////////////  


//////////////1번파일 업로드///////////////////
$dir="../../dataset/bbs1/";  // 업로드폴더 지정
$times=time();
$dates=date("mdh_i" ,$times);
if($_FILES['file2']['tmp_name']) {   // 임시파일이 있다면..

 $extvalue = explode(".",$_FILES['file2']['name']);   // . 을 기준으로 분리
 $extexplode=count($extvalue)-1;  // 확장자배열값
 $ext_result = $extvalue[$extexplode];  // 확장자 변수로 지정
 $newname_file2=chr(rand(97,122)).chr(rand(97,122)).$dates.rand(1,9).rand(1,9).".".$ext_result;  // 새 파일명 생성
 move_uploaded_file($_FILES['file2']['tmp_name'],$dir.$newname_file2);   // 업로드
 chmod($dir.$newname_file2,0777);  // 업로드된 파일 퍼미션 변경
}

}


if($b_ID!=$data['b_ID']){  //b_ID 서로 다르면 쿼리를 전송

// DB전송 루틴
  $query_A1 = "insert into bbs1";
  $query_B =   "(b_ID, file2, file2_name, regdate, regdate_time)
                values('$b_ID','#$newname_file2','#$file2[name]','$regdate','$regdate_time')";
  mysqli_query($connect, "SET NAMES utf8");
  mysqli_query($connect, $query_A1.$query_B);
}


if($b_ID==$data['b_ID']){  //b_ID 서로 같다면 아래 쿼리전송
	 if($data['file2']){
		 $new_file2=$data['file2']."#".$newname_file2;
         $new_file2_name=$data['file2_name']."#".$file2['name'];
   }else if(!$data['file2']){
	        $new_file2="#".$newname_file2;
			$new_file2_name="#".$file2['name'];
			}
$query_ss = "update bbs1 set
				file2='$new_file2',
				file2_name='$new_file2_name'
				where b_ID='$b_ID' ";
				mysqli_query($connect, "SET NAMES utf8");
                mysqli_query($connect, $query_ss);
}

?>
 

<script language="JavaScript">   
self.close();
</script> 
