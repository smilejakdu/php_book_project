<?
session_start();
ob_start();
include '../lib/connect.php'; 
$connect = dbconn();
$_co = co_info();
?>
<head> 
   
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--다국어 언어: UTF-8-->
   <LINK REL="StyleSheet" HREF="../lib/style.css" type="text/css">  <!---(글자스타일 변경)--->
     
   <style type="text/css"> 
body {margin:0 auto; background-color:#fff; }


/* 화면 너비 960픽셀 이상 */
#ex-wrap {width:100%; margin:0 auto;}

.table1_1{width:100%; 
	height:150px; 
	margin:0; 
	float:left; 
  }


  .table1_2{float:left; 
	display:none;
   }


/* 화면 너비 0픽셀 ~ 600픽셀 */
@media screen and (max-width:768px) {

  .table1_1{display:none;}

   .table1_2{width:100%; 
	height:5px; 
	margin:0; 
	background-color:#3d3930;
	float:left; 
	display:block;
   }
}

/* 화면 너비 0픽셀 ~ 400픽셀 */
@media screen and (max-width:480px) {
 
  .table1_1{display:none;}

   .table1_2{width:100%; 
	height:5px; 
	margin:0; 
	background-color:#3d3930;
	float:left; 
	display:block;
   }
}


    .bott_f1{font-size:9pt; font-family:Tahoma; color:#929292}
    .bott_f2{font-size:9pt; font-family:Tahoma; color:#7A7979}

	.tbox5{width:100%; height:50px; border-top:1px solid #CECECE; border-bottom:1px solid #CECECE; text-align:center;}


.mss_1{font-size:10pt; font-family:Tahoma;  color:#929292;}
.mss_2{font-size:9pt; font-family:Tahoma;  color:#929292;}
.co_text_1{font-size:9pt; font-family:Tahoma;  color:#A6A7A8;} /* 회사정보 텍스트 색상 */
</style> 
</head>


<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0'  TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">

   <?
// 현재 쿼리한 게시물의 총 개수를 구함
  $query = "select * from A_manager ";
   mysqli_query($connect, "SET NAMES utf8");
   $result = mysqli_query($connect, $query);
   $data = mysqli_fetch_array($result);
?> 


<DIV ID="ex-wrap">



<div class="table1_1">

<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='150' ALIGN='CENTER'>
<TR>
<TD WIDTH='100%'  HEIGHT='10'  ALIGN='right' BGCOLOR='#FFFFFF'>
<hr size='0.1' width='98%' color='#DBE5ED' /></TD>

<TR>
<TD WIDTH='100%'  HEIGHT='50'  ALIGN='right' BGCOLOR='#FFFFFF'>
<table border='0' width='100%' height='50' align='center' bgcolor='#FFFFFF' cellspacing='0' cellpadding='0'>
<tr>
<td width='20%' height='20' align='center' valign='middle'>&nbsp;</td>

<td width='60%' height='50' align='center' valign='middle' class='mss_1'>
&nbsp; &nbsp; &nbsp;
<a href="../infor/infor.php?ctg=infor&ctgs=1" target='_top' OnFocus="this.blur()">[회사소개]</a></div>
&nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp;
<a href="../infor/terms.php?terms=privacy_policy" target='_top' OnFocus="this.blur()">[개인정보취급방침]</div></a>
&nbsp; &nbsp; &nbsp;
<a href="../infor/terms.php?terms=terms" target='_top' OnFocus="this.blur()">[이용약관]</a></div>
</td>


<td width='20%' height='20' align='center' valign='middle'>
<img src="../image/uuss112147.jpg" width='220' height='30'>
</td>

</tr>
</table>
</TD>

<TR>
<TD WIDTH='100%'  HEIGHT='10'  ALIGN='right' BGCOLOR='#FFFFFF'>
<hr size='0.1' width='1280' color='#DBE5ED' /></TD>

<TR>
<!---/////////////////////////[[하단홈페이지 정보]]/////////////////////////--->
<TD WIDTH='90%'  HEIGHT='80'  COLSPAN='2' ALIGN='CENTER' BGCOLOR='#FFFFFF' VALIGN='TOP'>
<!-- 하단홈페이지 정보--------->
<table border='0' cellspacing='0' cellpadding='0' width='1028' height='80' align='center' valign='top'>
<tr>
<td width='30%' align='center' valign='middle'>
<img src="../image/xeronote.jpg" width='45' height='45'>
</td>

<td width='70%' align='left' valign='middle'>
<div class='co_text_1'>
<?
/* 
(변수 '$site_criterion')는 사이트 운영 목적을 말한다. 
사업(변수값:business)이나 판매(변수값:paid) 목적은 사업자와 통신판매,주소/연락처가 명확하게 노출 되어야 한다.
사업이 아닌 일반/개인 또는 모임을 목적으로 운영한다면  변수값을 'public' 사용한다.  노출하고 싶은 정보만 노출 할 수 있다.
*/
 $site_criterion="public";  //////[사이트 기준]  사업목적: business,  판매목적: paid , 개인/모임:public  //////

$co_text_2="<font color='#8F9091'>";
if($site_criterion=="paid"){ ///사업 / 판매목적///?>
회사명 :<?=$co_text_2?><?=$_co['co_title']?></font> | 사업자등록번호 :<?=$co_text_2?><?=$_co['co_number']?></font>  | 주소 :<?=$co_text_2?><?=$_co['co_addr_1']?></font><br>
통신판매업 신고 :<?=$co_text_2?><?=$_co['co_wapnumber']?></font> | 개인정보관리 책임자 대표 :<?=$co_text_2?><?=$_co['ceo_name']?></font> <br>
판매처: <?=$co_text_2?><?=$_co['co_addr_2']?></font>  | 연락처 :<?=$co_text_2?><?=$_co['co_tel']?></font> | Email:<?=$co_text_2?><?=$_co['co_email']?></font> <br>
copyright '<?=$co_text_2?><?=$_co['copyright']?></font>', all rights Reserved. | designed by:<?=$co_text_2?><?=$_co['designed_name']?> <?=$_co['designed_email']?></font> 


<?}else if($site_criterion=="public"){ ///개인 / 모임 목적///?>
사이트명 :<?=$co_text_2?><?=$_co['co_title']?></font>  | Email:<?=$co_text_2?><?=$_co['co_email']?></font> <br>
copyright '<?=$co_text_2?><?=$_co['copyright']?></font>', all rights Reserved. | designed by:<?=$co_text_2?><?=$_co['designed_name']?> <?=$_co['designed_email']?></font> 
<?}?>
</div>
</td>
</tr>
</table>

</TD>
</TR>
</TABLE>
</div>


<div class="table1_2">
<TABLE BORDER='0' WIDTH='100%' HEIGHT='170' ALIGN='CENTER' CELLSPACING='0' CELLPADDING='0' bgcolor='#FFFFFF'>
<TR>
<TD  WIDTH='100%' HEIGHT='50'  ALIGN='CENTER' VALIGN='MIDDLE' CLASS='tbox5'>
&nbsp; &nbsp;  &nbsp;
<a href="../infor/infor.php?ctg=infor&ctgs=1" target='_top' OnFocus="this.blur()">회사소개</a>  
&nbsp; &nbsp;  &nbsp; 
<a href="../infor/terms.php?terms=terms" target='_top' OnFocus="this.blur()">이용약관</a>
</TD>


<TR>
<TD  WIDTH='100%' HEIGHT='120'  ALIGN='CENTER' VALIGN='TOP'>
<table border='0' width='100%' height='120' align='center' valign='top' bgcolor='#FFFFFF' cellspacing='0' cellpadding='0' > 
<tr>
<?
 /* 
(변수 '$site_criterion')는 사이트 운영 목적을 말한다. 
사업(변수값:business)이나 판매(변수값:paid) 목적은 사업자와 통신판매,주소/연락처가 명확하게 노출 되어야 한다.
사업이 아닌 일반/개인 또는 모임을 목적으로 운영한다면  변수값을 'public' 사용한다.  노출하고 싶은 정보만 노출 할 수 있다.
*/
 $site_criterion="public";  //////[사이트 기준]  사업목적: business,  판매목적: paid , 개인/모임:public  //////
 ?>
<td width='5%' height='120' align='center' bgcolor='#FFFFFF'>&nbsp;</td>
<td width='90%' height='120' align='center' valign='middle' bgcolor='#FFFFFF'>
<font class='bott_f1'>

<?if($site_criterion=="paid"){ ///사업 / 판매목적///?>
회사명 :<font class='bott_f2'><?=$_co['co_title']?></font> | 
사업자등록번호 :<font class='bott_f2'><?=$_co['co_number']?></font> <br> 
통신판매업 신고 :<font class='bott_f2'><?=$_co['co_wapnumber']?></font> <br> 
주소 :<font class='bott_f2'><?=$_co['co_addr_1']?></font> <br> 
개인정보관리 대표 :<font class='bott_f2'><?=$_co['ceo_name']?></font> | 
연락처 :<font class='bott_f2'><?=$_co['co_tel']?></font>  <br>
Email:<font class='bott_f2'><?=$_co['co_email']?></font> <br>
copyright '<font class='bott_f2'><?=$_co['copyright']?></font>', all rights Reserved. <br> 
designed by:<font class='bott_f2'><?=$_co['designed_name']?> <?=$_co['designed_email']?></font> 

<?}else if($site_criterion=="public"){ ///개인 / 모임 목적///?>
사이트명 :<font class='bott_f2'><?=$_co['co_title']?></font>  <br> 
Email:<font class='bott_f2'><?=$_co['co_email']?></font> <br>
copyright '<font class='bott_f2'><?=$_co['copyright']?></font>', all rights Reserved. <br> 
designed by:<font class='bott_f2'><?=$_co['designed_name']?> <?=$_co['designed_email']?></font> 
<?}?>
</font>
</td>
<td width='5%' align='center' bgcolor='#FFFFFF'>&nbsp;</td>
</tr>
</table>

</TD>
</TR>
</TABLE>
</div>



</DIV>

</BODY> 
</HTML>