<?session_start(); ob_start();?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--다국어 언어: UTF-8-->
<link type='text/css' href='../lib/style.css' rel='stylesheet' />
</head>

<?
///////////////////////////////
$user_id=$_SESSION[user_id];
///////////////////////////////
   
   
include '../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();
	$cinfo= co_info(); //회사정보


  $query = "select * from member where user_id='$user_id' ";
  mysqli_query($connect, "set names utf8");
   $result = mysqli_query($connect, $query);
   $member = mysqli_fetch_array($result);
?>
<head>  
   <link rel=StyleSheet HREF=style.css type=text/css >  
<style type="text/css"> 
.td_1{margin:0 auto; border-top:solid 1px;}
</style>

<script type="text/javascript">
//<![CDATA[
function winClose()

{ self.close(); }  //]]>
</script>

</head>





<table border='0' width='95%' align='center' valign="top"> 
<tr>
<td width='95%' height="50" align='center' colspan='2'>
<img src="../image/xeronote.jpg">
</td>
</tr>

<form action='pw_edit_post.php' method='post'> 
<input type='hidden' name='id' value='<?=$member[id]?>'> 
<input type='hidden' name='no' value='<?=$member[no]?>'> 
<tr>
<td colspan=2 align=center class="td_1"><b>
<?=$member[name]?> &nbsp; 님 비밀번호 수정</b> 
</td>


	 	 <tr>
	<td >현재비밀번호</td>


	 <td> 
	 <input type='password' name=pw_1 size='15'><br>
	 <font color=#0030FF>*현재 자신 비밀번호를 넣으세요.</font>
	 </td>

	  <tr>
	<td colspan=2>&nbsp; <br></td>


          <tr>
	 <td height="50">변경할 비밀번호</td>

	 <td> <input type='password' name='pw'  size='15'><br>
	 <font color=#0030FF>*변경하실 비밀번호를 입력해주세요.</font>
	
	<div style="height:5px;">&nbsp;</div>
	 
	      <input type='password' name='pw_2'  size='15'><br>
		  <font color=#0030FF>*변경하실 비밀번호 재입력.
		  </font>
	 </td>

      
	  <tr>
     <td height="50" colspan='2' align=center> 
	 <input type='submit' value='수정하기'>
	 &nbsp; &nbsp;
	 <input type='button' value='취소하기' onclick='winClose()'>
	  </td>
	  </form>
       </tr>
	  </table>
<?
///////////////////////////////
$_POST[pw_1]=$pw_1;
$_POST[pw]=$pw;
$_POST[pw_2]=$pw_2;
$_POST[id]=$member[id];
$_POST[no]=$member[no];

$_SESSION[user_id]=$member[user_id];
///////////////////////////////
?>



