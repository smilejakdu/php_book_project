<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
ini_set("memory_limit","-1");

include_once("simple_html_dom.php");

function get_html($url){
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $html = curl_exec($ch);
   curl_close($ch);

   return $html;
}

$spage=1;
//$epage=147; //최대 페이지 수
$epage=2;

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

      // echo "약정 24개월 판매가 : ".$item->find('td',7)->plaintext;
      $plaintext7 = $item ->find('td',7)->plaintext;

      // echo "공시일자 : ".$item->find('td',8)->plaintext;
      $plaintext8 = $item ->find('td',8)->plaintext;
      echo $plaintext0 ,$plaintext1 , $plaintext2 , $plaintext3 , $plaintext4 , $plaintext8 ;
      echo "<br/>";
      $sql = "INSERT INTO sk_db (machine_name, model_name, plan_money,shipment_money,disclosure_money,support_date)
        VALUES ('$plaintext0', '$plaintext1', '$plaintext2','$plaintext3','$plaintext6','$plaintext8')";

        if ($conn->query($sql) === TRUE) {
            // echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
   }
}
?>
