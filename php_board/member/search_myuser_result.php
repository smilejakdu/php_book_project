<?session_start(); ob_start();?>
<head> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--다국어 언어: UTF-8-->
<link type='text/css' href='../lib/style.css' rel='stylesheet' /> 

<style type="text/css">
body {margin:0 auto; background-color:#fff; }
/* 화면 너비 1024픽셀 이상 */
#auto_size {width:100%; margin:0 auto;}
.box1{margin:0; width:20%; height:100%; float:left;}    
.box2{margin:0; width:60%; height:100%; float:left;} 
.box3{clear:both;} 


/* 화면 너비 801픽셀 ~ 1024픽셀 */
@media screen and (max-width:1024px) {
.box1{margin:0; width:15%; height:100%; float:left;}    
.box2{margin:0; width:70%; height:100%; float:left;} 
.box3{clear:both;} 
}


/* 화면 너비 481픽셀 ~ 800픽셀 */
@media screen and (max-width:960px) {
.box1{margin:0; width:10%; height:100%; float:left;}    
.box2{margin:0; width:80%; height:100%; float:left;} 
.box3{clear:both;} 
}


/* 화면 너비 0픽셀 ~ 600픽셀 */
@media screen and (max-width:768px) {
.box1{margin:0; width:8%; height:100%; float:left;}    
.box2{margin:0; width:84%; height:100%; float:left;} 
.box3{clear:both;} 
}



/* 화면 너비 0픽셀 ~ 400픽셀 */
@media screen and (max-width:480px) {
.box1{margin:0; width:2%; height:100%; float:left;}    
.box2{margin:0; width:96%; height:100%; float:left;} 
.box3{clear:both;} 
}
</style>

</head> 

<? 
include '../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();
	$c_o= co_info(); //회사정보

	$ctg=$_GET[ctg];

 ///////////////////////////////////////////
 $name=$_POST['name'];
 $email=$_POST['email']; 
 $birth=$_POST['birth']; 
 $user_id=$_POST['user_id'];
 $wheres=$_POST['wheres'];  //search_id // search_pw ;
///////////////////////////////////////////
  ?>


<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0'  TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">







<!---///////////////////////////////////[테이블 시작]//////////////////////////////////////////////////----->
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
<TR>
<!-------------[[상단 로고/카페고리1]]------------->
<TD WIDTH='100%'  HEIGHT='105'  ALIGN='CENTER'  VALIGN='TOP'>
<iframe src="../sub_page/top.php" name='top' width='100%' HEIGHT='105'  frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
</iframe>
</TD>



<!------------ 상단 카테고리 2----------->
<TR>
<TD WIDTH='100%'  HEIGHT='30'  ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
<iframe src="../sub_page/top_category.php?ctg=<?=$ctg?>" name='top_category' width='100%' HEIGHT='30'  frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
</iframe>
</TD>


<TR>
<!-------------[[중앙 내용]]------------->
<TD WIDTH='100%' HEIGHT='100%'  ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>



<!----------------- 아이디 찾기 결과 --------------->
 <?
 if($wheres=='search_id'){ //아이디 찾기로 검색했을시....;
 
 // DB쿼리 가지고 오기
  $query = "select * from member where name='$name' and email='$email'  "; 
  mysqli_query($connect, "set names utf8");
  $result = mysqli_query($connect, $query); 
  $data = mysqli_fetch_array($result); 

// 오류 메세지
    if($data[name]!==$name) Error('정보가 일치하지 않습니다.'); 
    if($data[email]!==$email) Error('정보가 일치하지 않습니다.'); 
    if($data[birth]!==$birth) Error('정보가 일치하지 않습니다.');
 ?>

<DIV ID="auto_size">
<div class="box1">&nbsp;</div>
<div class="box2">
<table border='0' bgcolor='#DAF9A8' width='100%' align='center' valign='top' cellspacing='0' cellpadding='0'>
<tr>
<td width='100%' height='10' align='center' >&nbsp;</td>

<tr>
<td width='100%' height='300' align='center' >
<b><?=$data[name]?></b> 회원님의 아이디는:<br><br>
<b><?=$data[user_id]?></b> &nbsp; &nbsp; 입니다.<br><br><br>
<a href="../main.php">[확인]</a>
</td>
</tr>
</table>
<?
	}  //search_id 아이디 찾기 결과 끝;
?>





<!----------------- 비밀번호 찾기 결과 --------------->
<?
 if($wheres=='search_pw'){ //비밀번호 찾기로 검색했을시....;
 
 
if(!$user_id) Error('아이디를 입력하세요.');
if(!$email) Error('이메일을 입력하세요'); 
if(!$birth) Error('생년월일을 입력하세요'); 

// DB쿼리 가지고 오기
  $query = "select * from member where user_id='$user_id'  "; 
  mysqli_query($connect, "set names utf8");
  $result = mysqli_query($connect, $query); 
  $data = mysqli_fetch_array($result); 


// 아이디비교;
     if($data[user_id]!==$user_id) Error('정보가 일치하지 않습니다.'); 
     if($data[email]!==$email) Error('이메일 정보가 일치하지 않습니다.'); 
     if($data[birth]!==$birth) Error('생년월일 정보가 일치하지 않습니다.'); 
 ?>
<table border='0' width='95%' align='center' valign='top' cellspacing='0' cellpadding='0'>
<tr>
<td width='100%' height='50' align='center' bgcolor='#FFFFFF'>&nbsp;</td>

<tr>
<?
///////////////////////////////임시비밀번호 구현////////////////////////////////////////
$times=time();
 $times_s=date("md-s",$times);
$pw_test="M".chr(rand(65,90))."-".rand(1,9).$times_s.rand(1,9).chr(rand(97,122)).chr(rand(97,122));// 임시비밀번호
/////////////////////////////////////////////////////////////////////////////////////
 ?>
<td height='300' align='center' bgcolor='#C7C7FE'>
<b><?=$data[name]?></b> 회원님의 임시 비밀번호를<br>
이메일: <b><?=$data[email]?></b>로 발송 하였습니다.<br>
임시비밀번호로 로그인후 비밀번호를 변경해주세요.<br><br>
-비밀번호 변경: [마이페이지]-[회원정보수정]-[비밀번호수정]
</td>

<tr>
<td height='30' align='center' valign='middle' bgcolor='#FFFFFF'> 
<a href="../main.php"><b>[확인]</b></a>
</td>
</tr>
</table>
</div>
<div class="box1">&nbsp;</div>
<div class="box3">&nbsp;</div>
</DIV>

<?

// 폼에서 작성했던 내용을 암호화로 변경
 $result = mysqli_query($connect, "select password('$pw_test')");
 $pws = mysqli_fetch_row ($result);
 $pws=$pws[0];




$query = "update member set
                $temp
                pw='$pws'
				where user_id='$user_id' ";







//비밀번호 메일 보내기,,,,,,,,,,,,,,,,,,,,,,,   ;

 $mail_content  = "    <style type='text/css'> 
			         body,DIV, TD {font-size:9pt; font-family:Arial,Tahoma;}
				    </STYLE>

                     <table border='0' width='50%' align='center' cellspacing='0' cellpadding='0'>
                      <tr>
                        <td width='100%'  height='85' align='center' bgcolor='#FFFFFF'> 
						        <a href='http://$_SERVER[SERVER_NAME]' target='_blank'>
						        <img src='http://$_SERVER[SERVER_NAME]/image/xeronote.jpg' width='210'  height='75' border='0'></a>
						<tr>
						<td bgcolor='#C5FBC1' align='center'> 
						<br><br> 
						  ● <b>$data[name] </b>회원님의 임시 비밀번호는<br>
						  <font color=red><b>$pw_test</font></b> <br>
						   <input type=text name=pw_test value='$pw_test' style='width:160px; height:20px;' readonly>
						  &nbsp; &nbsp; 입니다.
						  <P>&nbsp;</P> <P>&nbsp;</P>
						  </td>
						  </tr>
						  </table>
						\n";

$email_titles="$c_o[site_name] 임시 비밀번호 부여."; ////메일제목
$email_title = "=?UTF-8?B?".base64_encode($email_titles)."?="; ////메일제목 인코딩



  //[보내는이 정보]//
 $from_name = $c_o[site_name];  //보내는이 이름  
 $from_email = $c_o[server_mail]; //서버메일  
              /*(서버메일을 사용하는 경우 서버메일에서 메일이 보내집니다.
			  보내는 메일 주소와  일치하지 않으면 스팸으로 의심받을 수 있습니다.) */

 //[받는이 정보]//
 $to_name = $data[name]; //받는이 이름
 $to_email = $data[email]; //받는이 메일


 $headers = "Return-Path: <".$from_email.">\n";              //보내는 사람 메일
 $headers .= "From: ".$from_name." <".$from_email.">\n";     //발송자 / 메일
 $headers .= "Reply-To: ".$from_name." <".$from_email.">\n";  //에러시 반송될 주소
 $headers .= "X-Sender: <".$from_email.">\n"; //발송 메일주소
 $headers .= "X-Mailer: PHP\n";    // mailer
 $headers .= "Content-Type: text/html;charset=utf-8\n";  //메일 인코딩
 $headers .= "MIME-Version: 1.0\n";



$rs = @mail("$to_name <$to_email>",$email_title,$mail_content,$headers); //메일전송

if(!$rs)echo("<font color=red>ERROR : 전송실패</font>");
 /////////////이메일 안내[[끝]]////////////

}  //search_pw 비밀번호 찾기 결과 끝
 mysqli_query($connect, $query); 
 ?>






</TD>  <!-------------[[중앙 내용 (끝)]]------------->
</TR>  <!---- 본문내용 테이블_1(/TR)----->



<TR>
<!------------  하단 마커 --------------------->
<TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?=$setup[marker_c]?>' VALIGN='BOTTOM'>
<iframe src="../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0" marginwidth='0'/>
</TD>
</TR>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->