<?session_start(); ob_start();?>
<HTML>
<HEAD>
<meta content="text/html; charset=utf-8" http-equiv=Content-Type>
<link rel='stylesheet' type='text/css' href='../lib/style.css' />
  <style type="text/css">
    .bott_f1{font-size:9pt; font-family:Tahoma; color:#929292}
    .bott_f2{font-size:9pt; font-family:Tahoma; color:#7A7979}

	.tbox5{width:100%; height:50px; border-top:1px solid #CECECE; border-bottom:1px solid #CECECE; text-align:center;}
  </style> 
</HEAD>
<BODY>
<?
  include "../lib/connect.php";
  $connect = dbconn(); 
  $member =  member_info();
  $_co= co_info(); //회사정보  

?>
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

</body>