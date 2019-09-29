<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "root", "phone_db");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM sk7_db 
  WHERE machine_name LIKE '%".$search."%'
  OR model_name LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
  SELECT * FROM sk7_db ORDER BY machine_name
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
   <tr>  
        <th width="16%">단말기 명</th>  
        <th width="16%">모델 명</th>  
        <th width="16%">요금제</th>  
        <th width="16%">출고가</th>  
        <th width="16%">공시지원금</th>  
        <th width="16%">공시일자</th>  
  </tr>  
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
    <tr>  
        <td>'. $row["machine_name"] .'</td>  
        <td>'. $row["model_name"] .'</td>  
        <td>'. $row["plan_money"] .'</td>  
        <td>'. $row["shipment_money"] .'</td>  
        <td>'. $row["disclosure_money"] .'</td>  
        <td>'. $row["support_date"] .'</td>
    </tr>  
  ';
 }
 echo $output;
}
else
{
 echo '데이터가 없습니다.';
}

?>