<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <!--다국어 언어: UTF-8-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
<meta http-equiv="imagetoolbar" CONTENT="no"> 
 <title><? echo $top_title=$ctgs_name;?></title> 

<style type="text/css"> 
   .image_box {margin:0; padding:0; position:relative;}
 .image_box img {margin:0 auto; width:50px; height:50px;}
   .imeg_del {position:absolute; top:5px; left:35px;}
   .imeg_del_g {font-family:굴림,돋움,Arial; font-size:10pt; color:#ff0000; background:#FFFFFF; font-weight: bold; }

   .img_up_button {
        height:50px; width:50px;
        border:0px;
   }
   </style> 

<script> 
  function image_up(){ 
	 aa = document.getElementById('b_ID').value; 
     window.open('image_up.php?b_ID='+aa,'idc','width=450, height=300');  
      } 

</script>

<?
include '../../lib/connect.php';
$connect = dbconn(); 
$member =  member_info();


 $b_ID=$_GET[b_ID];
 ?>
</head> 

<table border='0' width='98%' height='90' cellspacing='0' cellpadding='0' align='left' bgcolor='#FFFFFF'>
<form name='img_up'>
<input type='hidden' id='b_ID' name='b_ID' value='<?=$_GET['b_ID']?>'>
<tr>
<td colspan='2' align='center' bgcolor='#FFFFFF' style="height:15px; width:100%;">
<span style='font-size:8pt; font-family:돋움,Tahoma; color:#8C8C8C'>이미지 리스트</span>
</td>

<tr>
<td align='center' style="width:20%; height:50px;">
<input type='button' title="이미지" class='img_up_button' onclick="image_up();" /> 
</td>

<td colspan='2' align='center' style="width:80%;">
이미지up 박스를 누르세요.</td>
</form>

<tr>
<td  colspan='2' style="width:100%; height:20px;"><hr size='0.1' width='95%' color='e8e1a7' /></td>

<tr>
<td colspan='2'  style="width:100%; height:75px;">
<?
$query = "select * from bbs1 where b_ID='$b_ID' "; 
  mysqli_query($connect, "SET NAMES utf8");
  $result = mysqli_query($connect, $query); 
  $data = mysqli_fetch_array($result);

if($data['file1']){
 $_file1 = explode("#",$data['file1']);   # . 을 기준으로 분리
 $_file1_name = explode("#",$data['file1_name']);   # . 을 기준으로 분리
 for($i=1; $i<count($_file1); $i++){
?>	
<table border='0' width='100%' height='75' cellspacing='0' cellpadding='0' align='left'>
<tr>
<td width='20%' height='50' align='center' valign='top' class='image_box'>
<img src='../../dataset/bbs1/<?=$_file1[$i]?>'>
</td>

<form name='image_del'>
<input type='hidden' name='b_ID' value='<?=$b_ID?>'>
<input type='hidden' name='file1' value='<?=$_file1[$i]?>'>

<td width='30%'>
<input type='button' value="선택" style="height:30px" onclick="img_put('<?=$_file1[$i]?>');" > 
</td>

<td width='50%' align="left" class='imeg_de'>
<a href="#" title='삭제' onclick="window.open('./image_del.php?b_ID=<?=$b_ID?>&file1=<?=$_file1[$i]?>&file1_name=<?=$_file1_name[$i]?>','','width=500,height=auto')">
<font class='imeg_del_g'>X</font></a>
</td>
</tr>

<tr>
<td colspan="3" width='100%' height='10' bgcolor="#EEE">&nbsp;</td>
</tr>
</table>
<?} //FOR문 여기까지?>
</form>
<?} //파일이 있으면 여기까지?>

</td>

<tr>
<td colspan='2' align='center' bgcolor='#FFFFFF' style="height:15px; width:100%;">
<input type="button" value="창닫기" onclick="Sclose()" />
</td>



</tr>
</table>

<Script>
	function  img_put(ee){
	var ee;     
var sHTML = "<img src=http://<?=$_SERVER['SERVER_NAME']?>/dataset/bbs1/"+ee+" class='img_rsizes'>";
opener.document.getElementById("mmm").value=sHTML;
window.close();
}

function  Sclose(){
   window.close();
}
</Script>

