<?php
ini_set("memory_limit","-1");
error_reporting(E_ALL);
ini_set("display_errors",1);
@set_time_limit(0); 
include_once("./simple_html_dom.php");

function get_html($url){
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HEADER, false);
   // curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
   curl_setopt($ch, CURLOPT_USERAGENT, "Chrome"); 
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   $html = curl_exec($ch);
   curl_close($ch);
   return $html;

}

$spage=1;
//$epage=5; //최대 페이지 수
$epage=5;

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
$sql = "truncate table lg_db";
mysqli_query($conn,$sql);


$sub_url =array("LPZ0000201","LPZ0015024","LPZ0001993","LPZ0015285",
                "LPZ0015284","LPZ0015282","LPZ0015588","LPZ0015585",
                "LPZ0015586","LPZ0015584","LPZ0015032","LPZ0015027",
                "LPZ0015034","LPZ0002255","LPZ0001833","LPZ0001832",
                "LPZ0001789");

$date_list = array("데이터·통화 마음껏" , "데이터넉넉히(15GB+/100분)" , "통화기본·데이터6.6GB", "통화많이(4.5GB/3,000분)" ,
                      "통화많이(2.5GB/3,000분)" , "통화많이(1.5GB/3,000분)","최강 가성비(10GB/180분)" , "최강 가성비(6GB/200분)" ,
                       "최강 가성비(3.5GB/200분)","최강 가성비(1.5GB/120분)" , "알뜰한(2GB/200분)" , "알뜰한(1GB/120분)",
                     "알뜰한(300MB/90분)","청소년 맘편히" , "청소년 34000링" , "청소년 28000링" ,
                      "복지 LTE 28");


for($url_start=0; $url_start<count($sub_url); $url_start++){
   echo $sub_url[$url_start];
   echo "<br>";
   
   for($i=$spage; $i<=$epage; $i++){
      echo "$i 페이지" ;
      echo "<br>";
      // https://www.uplussave.com/dev/lawList.mhp?svcCd=LPZ0002240&pageIndex=2
      $html = get_html("https://www.uplussave.com/dev/lawList.mhp?svcCd={$sub_url[$url_start]}&pageIndex={$i}");
      $html=trim($html);
      $html=str_get_html($html);
      $data=$html->find('table[class="tbl_list"] tr');
   
      $t=0;
      foreach($data as $item){
   
         $t ++; //처음 tr 한개는 항목이므로 패스
   
         if($t<=1) continue;
   
         // echo "단말기명 : ".$item->find('td',0)->plaintext;
         $plaintext0 = $item ->find('td',0)->plaintext;
   
         // echo "모델명 : ".$item->find('td',1)->plaintext;
         $plaintext1 = $item ->find('td',1)->plaintext;
   
         // echo "출고가(A) : ".$item->find('td',2)->plaintext;
         // $plaintext2 = $item ->find('td',2)->plaintext;
         // $plaintext2 = str_replace("원", "", $plaintext2);
   
         // echo "공시지원금(B) : ".$item->find('td',3)->plaintext;
         $plaintext3 = $item ->find('td',3)->plaintext;
         $plaintext3 = str_replace("원", "", $plaintext3);
   
         // echo "판매가(A-B) : ".$item->find('td',4)->plaintext;
         $plaintext4 = $item ->find('td',4)->plaintext;
         $plaintext4 = str_replace("원", "", $plaintext4);
   
         // echo "공시일자 : ".$item->find('td',5)->plaintext;
         $plaintext5 = $item ->find('td',5)->plaintext;
         $plaintext5 = trim($plaintext5);
         $plaintext5 = str_replace(".", "-", $plaintext5);
   
         echo "$plaintext0 , $plaintext1 , $date_list[$url_start] , $plaintext3 , $plaintext4 , $plaintext5 ";
   
         $sql = "INSERT INTO lg_db (machine_name , model_name, plan_money  ,shipment_money, disclosure_money,support_date)
                           VALUES ('$plaintext0', '$plaintext1', '$date_list[$url_start]','$plaintext3','$plaintext4','$plaintext5')";
   
           if ($conn->query($sql) === TRUE) {
               echo "레코드 insert 성공<br>";
           } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
           }
      }
   }
}
?>
