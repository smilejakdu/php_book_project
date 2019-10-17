<?php 
header("content-type:text/html; charset=UTF-8");

include '../../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();
$_co= co_info(); //회사정보 

   $b_ID=$_POST['b_ID'];
   $file1=$_FILES['file1']['name'];
 
 
if(!$file1){
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




/////////////////[[[[이미지 업로드 실행]]]]/////////////////
/////////// 확장자 검사 //////////////////////////////////////
/////////////////////((1번파일 업로드))//////////////////////
if($file1){     

$file1 =  $_FILES['file1'];//업로드된파일
$img_ext = array('jpg', 'jpge','jpeg', 'gif', 'png');//파일확장자 종류
$file1_name = strtolower($file1['name']);
$file1_split = explode(".", $file1_name);
$file1_type = $file1_split[count($file1_split)-1];//맨마지막 .위치에 있는 것이 확장자명

//파일 확장자 체크
if ( array_search($file1_type, $img_ext) === false ) {  //이미지파일이 아닙니다
Error('이미지 파일이 아닙니다');
}
//////////////////아래는 허용되는 확장자 일때  //////////////////


/////////////////////////////[이미지 용량 제한]////////////////////////////////
$size_1=$_FILES['file1']['size'];
if($size_1>2097152)Error('파일용량: 2MB로 사이즈를 제한합니다. ');
////////////////////////////////////////////////////////////////////////////////  


//////////////1번파일 업로드///////////////////
$dir="../../dataset/bbs1/";  // 업로드폴더 지정
$times=time();
$dates=date("mdh_i" ,$times);
if($_FILES['file1']['tmp_name']) {   // 임시파일이 있다면..

 $extvalue = explode(".",$_FILES['file1']['name']);   // . 을 기준으로 분리
 $extexplode=count($extvalue)-1;  // 확장자배열값
 $ext_result = $extvalue[$extexplode];  // 확장자 변수로 지정
 $newname_file1=chr(rand(97,122)).chr(rand(97,122)).$dates.rand(1,9).rand(1,9).".".$ext_result;  // 새 파일명 생성
 move_uploaded_file($_FILES['file1']['tmp_name'],$dir.$newname_file1);   // 업로드
 chmod($dir.$newname_file1,0777);  // 업로드된 파일 퍼미션 변경
}

}


if($b_ID!=$data['b_ID']){  //b_ID 서로 다르면 쿼리를 전송

// DB전송 루틴
  $query_A1 = "insert into bbs1";
  $query_B =   "(b_ID, file1, file1_name, regdate, regdate_time)
                values('$b_ID','#$newname_file1','#$file1[name]','$regdate','$regdate_time')";
  mysqli_query($connect, "SET NAMES utf8");
  mysqli_query($connect, $query_A1.$query_B);
}


if($b_ID==$data['b_ID']){  //b_ID 서로 같다면 아래 쿼리전송
	 if($data['file1']){
		 $new_file1=$data['file1']."#".$newname_file1;
         $new_file1_name=$data['file1_name']."#".$file1['name'];
   }else if(!$data['file1']){
	        $new_file1="#".$newname_file1;
			$new_file1_name="#".$file1['name'];
			}
$query_ss = "update bbs1 set
				file1='$new_file1',
				file1_name='$new_file1_name'
				where b_ID='$b_ID' ";
				mysqli_query($connect, "SET NAMES utf8");
                mysqli_query($connect, $query_ss);
}

?>
 

<script language="JavaScript">  
opener.location.reload(); //부모창 (프레임)새로고침  //parent
self.close();
</script> 
