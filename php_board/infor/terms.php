<?session_start(); ob_start();
   include '../lib/connect.php';
   $connect=dbconn();
   $member =  member_info();
   $setup=setup();
   $cinfo= co_info(); //회사정보
   $device_mode=device_mode();  //기기 접속모드 


   $terms=$_GET['terms'];  //이용약관  & 개인정보취급 방침
 ?>

 <head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--한글로 구성:UTF-8-->
<meta http-equiv="imagetoolbar" CONTENT="no"> 
<link rel=StyleSheet HREF=style.css type=text/css >  
<title><? echo $top_title="Information";?></title>
   
<style type="text/css"> 
BODY,TD,SELECT,input,DIV,form,TEXTAREA,center,option,pre,
blockquote {font-size:9pt; font-family:굴림,돋움; color:#5B5959; line-height:120%}
A:link {font-family:굴림,돋움; font-size:9pt; color:#5B5959; text-decoration:none;} 
A:visited {font-family:굴림,돋움; font-size:9pt; color:#5B5959; text-decoration:none;} 
A:active {font-family:굴림,돋움; font-size:9pt; color:#5B5959; text-decoration:none;} 
A:hover {font-family:굴림,돋움; font-size:9pt; color:#5B5959; text-decoration:none;} 

body {margin:0 auto; background-color:#fff; }


/* 화면 너비 960픽셀 이상 */
#ex-wrap {width:100%; margin:0 auto;}
.box1{width:20%; height:100%; margin:0; float:left; display:block;}
.box2{width:60%; height:100%; margin:0; float:left; display:block;}
.box3{display:none;}

.contents_end{clear:both;}

/* 화면 너비 0픽셀 ~ 600픽셀 */
@media screen and (max-width:768px) {
.box1{width:10%; height:100%; margin:0; float:left; display:block;}
.box2{width:80%; height:100%; margin:0; float:left; display:block;}
.box3{display:none;}
}


/* 화면 너비 0픽셀 ~ 400픽셀 */
@media screen and (max-width:480px) {
.box1{width:3%; height:100%; margin:0; float:left; display:block;}
.box2{width:94%; height:100%; margin:0; float:left; display:block;}
.box3{display:none;}
}
</style> 

</head>


<body oncontextmenu="return false">




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


<?
if($terms=="terms")($terms_title="이용약관");
if($terms=="privacy_policy")($terms_title="개인정보 취급 방침");
?>


<DIV ID="ex-wrap">
<div class="box1">&nbsp;</div>

<div class="box2">
<table border='0' cellspacing='0' cellpadding='0' width='100%' height='100%' align='center'>
<tr>
<td width='100%' height='50' align='center' valign='middle'>
<span style='font-size:12pt; font-family:Tahoma; color:#494848'> <?=$terms_title?> </span> 
</td>

<?if($terms=="terms"){  //이용약관//?>
<tr>
<td  height='100%' align='center' valign='top'>
 <textarea  style="width:98%; height:500px; overlow-x:scroll;" readonly='readonly'>
<?include ('../member/member_terms.php');?>
 </textarea>
 </td>
 </tr>

<?}else if($terms=="privacy_policy"){  //개인정보정책//?>
 <tr>
 <td width='95%' height='auto' align='left' valign='top'>
<?include ('../member/privacy_policy.php');?>
<p>&nbsp;</p>
</td>
<?}?>
</tr>

<tr>
<td height="100%">&nbsp;</td>
</tr>
</table>
</div>

<div class="box1">&nbsp;</div>
<div class="contents_end">&nbsp;</div>
</DIV>
 </TD>  <!-------------[[중앙 내용 (끝)]]------------->
</TR>  <!---- 본문내용 테이블_1(/TR)----->


<TR>
<!------------  하단 마커 --------------------->
<TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?=$setup['marker_c']?>' VALIGN='BOTTOM'>
<iframe src="../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0" marginwidth='0'/>
</TD>
</TR>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->