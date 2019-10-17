<?php
    session_start();
    ob_start();
    $b_ID=$_GET['b_ID'];
	$ctg=$_GET['ctg'];
    $ctgs=$_GET['ctgs'];
	$page=$_GET['page']; //목록으로 넘기기 위한 페이지 번호

   $d_no=$_GET['d_no'];  ////
   $r_replys_w=$_GET['r_replys_w'];  //대 댓글 사용//
    $lo_reply_1=$_GET['lo_reply_1'];//페이지 로케이션
///////////////////////////////////////////////////
?>

<HTML>
<HEAD>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--다국어 언어: UTF-8-->
<meta http-equiv="imagetoolbar" CONTENT="no"> <!--====이미지 저장하는 툴바 없애기==-->
<link rel='stylesheet' type='text/css' href='../../lib/style.css' />

<script type="text/javascript">
 function no_login_like(){
	  window.alert('로그인후 이용가능 합니다.');
 }
</script>


<?
include '../../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();
$_co= co_info(); //회사정보 
 $device_mode=device_mode();  //기기 접속모드 



/////////////////   좋아요 클릭!! ///////////////////
$b_ID=$_GET['b_ID'];  
$mID=$_GET['mID'];  
$likes=$_GET['likes'];
$likes_ct=$_GET['likes_ct'];
  if($member['mID'] and $_likes[0]<'1' and $_GET['likes']=='like_up'){ 
   $_query = "update bbs1 set likes=likes+1  where b_ID='$b_ID' " ;   //percent:Double
    mysqli_query($connect, $_query);
 
  $q_e = "insert into likes(b_ID, user_id, mID)
   values('$b_ID','$member[user_id]','$member[mID]')";
   mysqli_query($connect, "SET NAMES utf8");
   mysqli_query($connect, $q_e);
  }



  $query = "select * from bbs1 where b_ID='$b_ID' " ;
  $result = mysqli_query($connect, $query);
  $data = mysqli_fetch_array($result);


if(!$data[b_ID])Hom_go("삭제되었거나 존재 하지 않는 글입니다.");


//////비밀글은 자신의 글만 볼수 있다////////
if($data['secret']){
	if($member['user_id']!=$data['user_id'])list_go("비밀글은 자신만 볼수 있습니다.",$ctg,$ctgs);
}


//////////  조회수 올리기 (하루한번 적용) //////// 
$bbs1=$b_ID;
if($b_ID!=$_COOKIE['hit_bbs1_'.$b_ID]){  //strstr //mb_ereg //
 //아래 히트값과 퍼선트 값을 올린다.;
  $query = "update bbs1 set hit=hit+1  where b_ID='$b_ID' " ;   //percent
  $result = mysqli_query($connect, $query);

  setcookie("hit_bbs1_".$b_ID,$bbs1,time()+60*60*24,"/");   //하루: 60*60*24 
 } 



$ctg=$data['ctg'];
$ctgs=$data['ctgs'];



///// 일반 게시판은 이것을 아래를 실행;/////
if(preg_match('/a|c/',$ctg)) {
	//상단 라인선/ TD색상 색상;
if($ctgs=='a01') $tdcolor="#DCC9C3"; 
if($ctgs=='a02') $tdcolor="#81A4C8";
if($ctgs=='a03' ) $tdcolor="#A1B99B";
if($ctgs=='c01') $tdcolor="#dda3e7"; 
}

////// 웹진형 게시판 컬러;//////
if(preg_match('/d/',$ctg)){
if($ctgs=='d01') $tdcolor="#CAC4AB"; 
if($ctgs=='d02') $tdcolor="#CAC4AB"; 
}


////// PHP 게시판 컬러;//////
if($ctg=="e"){
if($ctgs=='e01') $tdcolor="#BA90DB";
}

////// 영상게시판;///////
if($ctg=="v"){
if($ctgs=='v01') $tdcolor="#7BB7AA"; //(1);
if($ctgs=='v02') $tdcolor="#7BB7AA"; //(2);
if($ctgs=='v03') $tdcolor="#7BB7AA"; //(2);
}


     if($ctg=='a'){$ctgs_name="Information<br>";}
     if($ctgs=='a01'){$ctgs_name="공지사항";}
	 if($ctgs=='a02' ){$ctgs_name="문의";}
	  if($ctgs=='a03'){$ctgs_name="자유게시판";}

	 if($ctg=='d'){$ctgs_name="<br>";}
	 if($ctgs=='d01'){$ctgs_name="이벤트";}
	 ?>

	 <title><? echo $top_title=$ctgs_name.'- view';?></title>

<script language='javascript'>
function like_submit(){
document.form_like.submit();
}
</script>


<style type="text/css"> 
body {margin:0 auto; background-color:#fff; }

.logen1{width:50%; height:50px; margin:10px; text-align:center;}
.logen1 p{font-family:굴림,돋움,arial; font-size:9pt; color:#f15f5f;}


/* 화면 너비 960픽셀 이상 */
#ex-wrap {width:100%; margin:0 auto;}

.table1_1{width:100%; height:100%; margin:0; float:left; display:block;}
.table1_2{float:left; display:none;}

.comment{width:100%; height:100%; margin:0; float:left; display:block;}
.comment_m{float:left; display:none;}

.mode1{margin:0; width:100%; float:left; display:block;}
.mode2{margin:0; width:100%; display:none;}


/* 화면 너비 0픽셀 ~ 600픽셀 */
@media screen and (max-width:768px) {

  .table1_1{display:none;}
  .table1_2{width:100%; height:100%; margin:0; float:left;  display:block;}

.comment{display:none;}
.comment_m{width:100%; height:100%; margin:0; float:left; display:block;}

.mode1{margin:0; float:left; display:none;}
.mode2{margin:0; width:100%;float:left;  display:block;}

.youtubeWrap {
	float:none;
	clear:both;
  position: relative;
  padding-bottom: 56.25% !important;
  width: 100%;
  height: 0;
  overflow:hidden;
}

.youtubeWrap iframe, .youtubeWrap object, .youtubeWrap embed{
 position: absolute;
  top:0; text-align:center; width: 90%; height: 90%; 
  }

}



/* 화면 너비 0픽셀 ~ 400픽셀 */
@media screen and (max-width:480px) {
 
  .table1_1{display:none;}
  .table1_2{width:100%; height:100%; margin:0; float:left;  display:block;}

.comment{display:none;}
.comment_m{width:100%; height:100%; margin:0; float:left; display:block;}

.mode1{margin:0; float:left; display:none;}
.mode2{margin:0; width:100%;float:left;  display:block;}

.youtubeWrap {
	float:none;
	clear:both;
  position: relative;
  padding-bottom: 56.25% !important;
  width: 100%;
  height: 0;
  overflow:hidden;
}

.youtubeWrap iframe, .youtubeWrap object, .youtubeWrap embed{
	 position: absolute;
  top:0;  left:0; width: 98%; height: 98%; 
  }

}








.word_1{  /* 자동 줄바꾸기 */
table-layout:fixed; 
word-break:break-word; /*특수문자 포함*/
word-break:break-all; /*특수문자 빼고*/
 }


/* 모바일/테블리PC전용  */
.tstory img{ display: inline-block; 
     width: 98%\9 !important; /* ie8 */ 
	 width: 98% !important; 
	 max-width: 98%; 
	 height: auto !important; }



.view_box_1 {margin:0; padding:0; position:relative;}
  #text_a1 {font-family:굴림,돋움,Arial; font-size:9pt; color:#BDBBBD;}

.view_box_1 {margin:0; padding:0; position:relative;}
  #subject {position:absolute; top:3px; left:80px;}

.view_box_2 {margin:0; padding:0; position:relative;}
  #name {position:absolute; top:3px; left:80px;}

.view_box_3 {margin:0; padding:0; position:relative;}
  #email {position:absolute; top:3px; left:80px;}

/** 코맨트 **/
.comment {margin:0; border-bottom:1px solid #989898;}
.comment_memo {padding-left:10px;  font-size:9pt; color:#5b5b5b;}



/** 답글 **/
  .r_replys{margin:0; border-bottom:1px solid #989898;}
  .r_replys_1 {padding-top:5px; font-size:9pt; color:#737373;}
  .r_replys_memo (padding-left:10px; font-size:9pt; color:#939393;}



.like_ct {font-family:Arial; font-size:8pt; color:#8064c7;} /* like 개수 */

.prne a{font-family:굴림,돋움,Arial; font-size:9pt; color:#9E9FA1;} /*이전글 다음글*/

.file2_mem_1{font-family:굴림,돋움,Arial; font-size:8pt; color:#1C5274;}  /*로그인 후 파일 다운로드 [파일첨부]*/
.file2_mem_2 {font-family:굴림,돋움,Arial; font-size:8pt; color:#EA6ADD;}  /*로그인 후 파일 다운로드 알림말*/
</style> 
</HEAD>

 <!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0'  TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">





<!---///////////////////////////////////[테이블 시작]//////////////////////////////////////////////////----->
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
<TR>
<!-------------[[상단 로고/카페고리1]]------------->
<TD WIDTH='100%'  HEIGHT='105'  ALIGN='CENTER'  VALIGN='TOP'>
<? include("../../sub_page/top2.php"); ?>
</TD>



<!------------ 상단 카테고리 2----------->
<TR>
<TD WIDTH='100%'  HEIGHT='30'  ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
<? include("../../sub_page/top_category2.php"); ?>
</TD>


<TR>
<!-------------[[중앙 내용]]------------->
<TD WIDTH='100%' HEIGHT='100%'  ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>

<? /////////// 회원아이디가 없다면 로그인 /////////// 
	if(!$member['user_id'] and $ctg=="e" and $ctgs=="e02"){ ?>
<div class="logen1">
<P>=본 게시글은 <b>회원전용 게시판</b>입니다.=</P>
<P>- <b>로그인</b> 후 이용해주세요. -</P>
</div>
<iframe name='top' src="../../member/login_box.php" name='top' width='100%' HEIGHT='430'  frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
</iframe>
<? exit; }?>


<div class="table1_1">
<!--################ PC 모드 #####################-->
		 <!-- 파일 내용 보기--->
<!--------  상단 -------------->
<table border='0'  width='1024' height='57' align='center' valign='top' cellspacing='0' cellpadding='0' bgcolor='FFFFFF'>
 <tr>
 <td width='100%' height='10' colspan='2'>&nbsp;</td> 


 <tr>
<td style="width:858px; height:33px;" align='right'>&nbsp;</td>

<td style="width:166px; height:33px;" align='right' bgcolor="<?=$tdcolor;?>">
<!--///////게시판 이름 /////////////-->
<?if(preg_match('/a|d|e/',$ctg)){ //일반 //?>
<img src="./image/logo_<?=$ctgs?>.gif" border='0'>
<?}else if(preg_match('/v|p/',$ctg)){ ///////영상 /////////////;?>
<img src="./image/logo_<?=$ctg?>.gif" border='0'>
<?}?>
</td>

<tr>
<td colspan='2' height='10'  valign='middle'>
<hr size='0.1' width='100%' color='<?=$tdcolor?>'/>
</td>
</tr>
</table>
	


<table border='0' width='1024' valign='top' cellspacing='0' cellpadding='0' align='center'>
<tbody>
	<tr>
	<td width='100%'  height='15' align='right' colspan='2'>
	<font color=9C9A9A>date: 
<?
  echo $data_Y = substr($data['regdate'], 0, 4) ."-"; 
  echo$data_m = substr($data['regdate'], 4, 2)."-";
  echo $data_d = substr($data['regdate'], 6, 2)."&nbsp;";
  echo $data_h = substr($data['regdate_time'], 0, 2).":";
  echo $data_i = substr($data['regdate_time'], 2, 2);
?></font>
	</td>
   
   <tr>
	<td height='30' class='view_box_1'> 
	  <font id='text_a1'>제 목</font>  <div id='subject'><?=$data['subject']?></div>
	  </td>

	<tr>
	<td height='30' class='view_box_2'>
    <? if($data['nickname']) { //데이터에 닉네임이 있으면 닉네임을 보이고 없으면 이름을 출력 ?>
	<span id='text_a1'>닉네임</span> <div id='name'><?=$data['nickname']?></div>
  <?}else{?>
   <span id='text_a1'>이름</span> <div id='name'><? echo $data['name']; }?></div>
	</td>
	
	

<tr>
    <td height="10"  align='center'  bgcolor='#FFFFFF'> 
    </td>
	</tr>


	<tr>
	 <td  align='left' valign='top'>
	 <?
echo ('<br>');
 ?>

 
<br>
<div class='word_1'><?=$data['Tstory']?></div>
	

	
	 <P>&nbsp;</P>
  <!-------  관리자만 해당글 IP볼수 있는 권한 부여---->
	 <? if ($member['level']==1) echo "<br><center><font color='FF00C6'>[관리자만 보입니다.] &nbsp; &nbsp; 본문 게시글IP주소:<b>".$data['ip'] . "</center></font></b>" ; ?>
	</td>

</tr>
</tbody>
</table>


<table border=0 width='1000' cellspacing="0"bgcolor=#FFFFFF>

    <? if($data['url']){ // 링크가 있으면 링크를 출력; ?>
	  <tr>
	 <td width=100> <b>링크</b></td>
	 <td> <?=$data['url']?></td>
     <? } ?>


	  <tr>
	  <td width=100  height=10>&nbsp;</td>  <!---- 공백----->
	 <td height=10> &nbsp;</td>    <!---- 공백----->


	<tr>
<td width='100%' height='10' colspan='2' align='right'>
<?if($data['file2'] and $member['user_id']){
	$_file2=explode("#",$data['file2']);
    $_file2_name=explode("#",$data['file2_name']);
	for($ff=1; $ff<count($_file2) or $ff<count($_file2_name); $ff++){	
	?>
파일다운: <a href="#" title='다운로드' onclick="window.open('./download.php?file2=<?=$_file2[$ff]?>&file2_name=<?=$_file2_name[$ff]?>')">
<font color='blue'><?=$_file2_name[$ff]?></font></a>
<?}
	}else if($data['file2'] and !$member['user_id']){?>
	<font style="font-family:굴림,돋움,Arial; font-size:9pt; color:#fff; background-color:#111">[파일첨부]</font> &nbsp; &nbsp; 
	<font class='file2_mem_2'>로그인 후 파일을 다운받으실 수 있습니다.</font>
	<?}?>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
</td>

	 
	  </tr>
	  </table>


<!--################ PC 모드 여기까지 #####################-->
</div>




<div class="table1_2">
<!--################ 모바일/테블릿pc 모드 #####################-->
<table border='0' width='95%' height='250' cellspacing='0' cellpadding='0' align='center'>
	<tr>
	<td width='100%'  height='15' align='right' colspan='2'>
	<font color=9C9A9A>date: 
	<?
  echo $data_Y = substr($data['regdate'], 0, 4) ."-"; 
  echo$data_m = substr($data['regdate'], 4, 2)."-";
  echo $data_d = substr($data['regdate'], 6, 2)."&nbsp;";
  echo $data_h = substr($data['regdate_time'], 0, 2).":";
  echo $data_i = substr($data['regdate_time'], 2, 2)."&nbsp;&nbsp;";
	?></font>
	</td>
   
   <tr>
	<td width='100' height='30'> <b>Subject</b></td>
	 <td width='500'> <?=$data['subject']?></td>

	 <?if($data['nickname']) { //데이터에 닉네임이 있으면 닉네임을 보이고 없으면 이름을 출력?>
	 	 <tr>
	<td width='100'> <b>Nickname</b></td>
    <td> <?=$data['nickname']?></td>
  <?}else{?>
    <tr>
	<td width='100' height='30'> <b>name</b></td>
    <td> <?=$data['name']?></td>
  <?}?>
	

<tr>
    <td colspan='2' align='center' height="3" bgcolor='FFFFFF'>
     <hr size='0.1' color='<?=$tdcolor?>' width='100%' height='2' />
    </td>
	</tr>


	<tr>
<!------====================== [[[[본문내용]]]]]==============================-------->
<td width='100%' height='100%' colspan='2' align='left'  class='word_1'>
	  <P>&nbsp;</P>

	<div class='tstory'>
	 <!-- 본 문-->
	 <?
     echo $data['Tstory'];
	 ?>
 <P>&nbsp;</P>
</div>
</td>

<? if($data[file2]){?>
<tr>
<td width='100%' height='20' colspan='2' align='right'>
<font class='file2_mem_1'>[파일첨부]<font class='file2_mem_1'> 
<font class='file2_mem_2'>해당글에 파일첨부가 있습니다. <br>
다운로드 하실려면 PC를 이용해 주세요.</font>
&nbsp; &nbsp;
</td>
<?}?>	

<tr>
<td width='100%' height='20' colspan='2' align='right'>
<hr size='0.1' width='90%' color='#787878' />
</td>

<?if ($member['level']==1){?>
<tr>
<td width='100%' height='20' colspan='2' align='center'>
  <!-------  관리자만 해당글 IP볼수 있는 권한 부여---->
	 <?  echo "<br><center><font color='FF00C6'>[관리자만 보입니다.] &nbsp; &nbsp; 본문 게시글IP주소:<b>".$data['ip'] . "</center></font></b>" ; ?>
	</td>
</tr>
<?}?>
</tr>
</table>
<!--################ 모바일/테블릿 PC 모드 여기까지 #####################-->
</div>


</DIV>



</TD>
<TR>
<TD WIDTH='100%' HEIGHT='100%'  ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>

 <table border='0' width='80%' height='130' align='center' valign='top' cellspacing='0' cellpadding='0'>
 	 <tr>
	 <form name="form_like" action="<?=$PHP_SELF?>#form_like">
	   <td colspan='2' width='100%' height='30' align='right' valign='middle' bgcolor='#EEEEEE' > 
	      <?
  $qy = "select count(*) from likes where b_ID='$b_ID' and mID='$member[mID]'  " ;
  $rt= mysqli_query($connect, $qy);
  $_likes = mysqli_fetch_array($rt); 


   if(!$member['user_id'] and !$member['mID']){ // 로그인을 안했을때... ?>
        <img src='./image/like_3.gif' border='0' onclick="no_login_like();">
<? }
   if($member['mID'] and $_likes[0]>='1'){  //이미 좋아요를 눌렀을때...?>
        <img src='./image/like_2.gif' border='0'  title="Done already">
<?
   }
   //좋아요
   if($member['mID'] and $_likes[0]<'1'){ ?>
<input type="hidden" name="b_ID" value="<?=$b_ID?>">
<input type="hidden" name="mID" value="<?=$member['mID']?>">
<input type="hidden" name="likes" value="like_up" >
<input type="hidden" name="likes_ct" value="<?=$_likes[0]?>" >
<img src='./image/like_1.gif' border='0' onclick="like_submit();">  <!-- 좋아요 클릭할수있는 상태 --->
<?
   }?>
&nbsp; 
 <font class="like_ct"><?=$data['likes'];?></font>
 <br>
</td>
</form>
<a name="form_like"/><!---  로케이션 위치-->

	 <tr>
	   <td colspan='2' width='100%'  height='50' align='center' valign='middle' > 
	   <a href="list.php?page=<?=$page?>&Search_mode=<?=$Search_mode?>&Search_text=<?=$Search_text?>&ctg=<?=$data['ctg'];?>&ctgs=<?=$data['ctgs'];?>"  OnFocus="this.blur()">
	   <img src='./image/list_s.gif' width='63' height='25' border='0' title='list'></a>
		


       <?if($member['mID']!=$data['mID']){?>
	 &nbsp;
	   <?}else{?>
	    &nbsp;
		<a href="edit.php?b_ID=<?=$data['b_ID']?>&ctg=<?=$ctg?>&ctgs=<?=$ctgs?>" OnFocus="this.blur()"><img src='./image/edit_s.gif' width='63' height='25' border='0'  title='Edit'></a> 
		&nbsp; 
		<a href="del.php?b_ID=<?=$data['b_ID']?>&ctg=<?=$ctg?>&ctgs=<?=$ctgs?>"  OnFocus="this.blur()"><img src='./image/del_s.gif' width='63' height='25' border='0'  title='DEL'></a>
	 <?}?>
	   </td>
<?
 	$sql_1="select*from bbs1 where no>'$data[no]' and ctg='$ctg' and ctgs='$ctgs' and secret!='OK' order by no asc";
	$res_pre=mysqli_query($connect, $sql_1);
	$pre=mysqli_fetch_array($res_pre);//이전게시물 

	//다음 게시물 조회 질의
	$sql_2="select*from bbs1 where no<'$data[no]' and ctg='$ctg' and ctgs='$ctgs' and secret!='OK' order by no desc";
	$res_next=mysqli_query($connect, $sql_2);
	$next=mysqli_fetch_array($res_next);//다음 게시물

?>
	    <tr>
	   <td width='50%'  height='50' align='left' valign='middle' class='prne'>
     <?if($pre['subject']){?>
<a href="<?=$PHP_SELF?>?b_ID=<?=$pre['b_ID']?>&ctg=<?=$pre['ctg']?>&ctgs=<?=$pre['ctgs']?>">다음글</a>
<?}?>
	   </td>

	  <td width='50%'  height='50' align='right' valign='middle'  class='next'>
	  <?if($next['subject']){?>
  <a href="<?=$PHP_SELF?>?b_ID=<?=$next['b_ID']?>&ctg=<?=$next['ctg']?>&ctgs=<?=$next['ctgs']?>">이전글</a>
<?}?>
	   </td>
	   </tr>
	 </table>


<div class="comment">
<?include("./comment.php");?>
</div>

<div class="comment_m">
<?include("./comment_m.php");?>
</div>


</TD>  <!-------------[[중앙 내용 (끝)]]------------->
</TR>  <!---- 본문내용 테이블_1(/TR)----->


<TR>
<TD HEIGHT='50'  BGCOLOR='#FFFFFF'>&nbsp;</TD>


<TR>
<!------------  하단 마커 --------------------->
<TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?=$setup['marker_c']?>' VALIGN='BOTTOM'>
<iframe src="../../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0" marginwidth='0'/>
</TD>
</TR>
</TABLE> 
<!---- 본문내용 테이블_1(/TABLE)----->