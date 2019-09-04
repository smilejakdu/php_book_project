<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
ini_set("memory_limit","-1");
@set_time_limit(0);
include_once("./simple_html_dom.php");


function get_html($url){
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HEADER, false);
   // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
   curl_setopt($ch, CURLOPT_USERAGENT, "Chrome"); 
   // aws 에서 crontab 돌릴때 안되서 "Chrome" 하니깐 동작함 
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   // windows 에서 크롤링 할려니깐 에러가 나서 밑에 두줄을 넣으니 오류가 사라짐
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   $html = curl_exec($ch);
   curl_close($ch);

   return $html;
}

// 처음 페이지 
$spage=1;
 //최대 페이지 수 154 
$epage=154; 

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phone_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "truncate table sk_db;";
mysqli_query($conn,$sql);

for($i=$spage; $i<=$epage; $i++){
   $html=get_html("https://www.sk7mobile.com/util/support/publicFundLte.do?orderCheck=&pageIndex={$i}&searchCondition=0&searchKeyword=");
   $html=trim($html);
   $html=str_get_html($html);
   $data=$html->find('table[class="tbl-base"] tr');

   $t=0;
   foreach($data as $item){

      $t ++; //처음 tr 두개는 항목이므로 패스

      if($t<=2) continue;

      // echo "휴대폰명 : ".$item->find('td',0)->plaintext;
      $plaintext0 = $item ->find('td',0)->plaintext;

      // echo "모델명 : ".$item->find('td',1)->plaintext;
      $plaintext1 = $item ->find('td',1)->plaintext;

      // echo "요금제 : ".$item->find('td',2)->plaintext;
      $plaintext2 = $item ->find('td',2)->plaintext;

      // echo "출고가 : ".$item->find('td',3)->plaintext;
      $plaintext3 = $item ->find('td',3)->plaintext;
      $plaintext3 = str_replace("원", "", $plaintext3);

      // echo "약정 12개월 지원금 : ".$item->find('td',4)->plaintext;
      $plaintext4 = $item ->find('td',4)->plaintext;
      $plaintext4 = str_replace("원", "", $plaintext4);

      // echo "약정 12개월 판매가 : ".$item->find('td',5)->plaintext;
      $plaintext5 = $item ->find('td',5)->plaintext;
      $plaintext5 = str_replace("원", "", $plaintext5);
        // echo "약정 24개월 지원금 : ".$item->find('td',6)->plaintext;
      $plaintext6 = $item ->find('td',6)->plaintext;
      $plaintext6 = str_replace("원", "", $plaintext6);

      // echo "약정 24개월 판매가 : ".$item->find('td',7)->plaintext;
      $plaintext7 = $item ->find('td',7)->plaintext;

      // echo "공시일자 : ".$item->find('td',8)->plaintext;
      $plaintext8 = $item ->find('td',8)->plaintext;
      echo $plaintext0 ,$plaintext1 , $plaintext2 , $plaintext3 , $plaintext6 , $plaintext8 ;
      echo "<br/>";
      $sql = "INSERT INTO sk_db (machine_name, model_name, plan_money,shipment_money,disclosure_money,support_date)
        VALUES ('$plaintext0', '$plaintext1', '$plaintext2','$plaintext3','$plaintext6','$plaintext8')";

        if ($conn->query($sql) === TRUE) {
             echo "레코드 insert 성공";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
   }
}

?>