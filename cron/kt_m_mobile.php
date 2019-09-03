<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
ini_set("memory_limit","-1");

include_once("./simple_html_dom.php");


function get_html($url){
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   $html = curl_exec($ch);
   curl_close($ch);
   return $html;
}

$spage=1;
//$epage=147; //최대 페이지 수
$epage=2;
$model_type="5G";
$sale_month = 24;
$prodNm = "5GX+플래티넘";

for($i=$spage; $i<=$epage; $i++){
   $html=get_html("https://shop.tworld.co.kr/notice?modelNwType=5G&saleMonth=24&prodId=NA00006402&prodNm=슬림&saleYn=Y&order=DISCOUNT");
   $html=trim($html);
   $html=str_get_html($html); # string change
   echo $html;
   print_r($html);
   // $data=$html->find('tbody[id="notice"] tr');
   // echo "$data";

   // $t=0;
   // foreach($data as $item){

   //    $t ++; //처음 tr 두개는 항목이므로 패스

   //    if($t<=1) continue;

   //    echo "휴대폰명 : ".$item->find('td',0)->plaintext;
   //    echo "<br />";

   //    echo "모델명 : ".$item->find('td',1)->plaintext;
   //    echo "<br />";

   //    echo "요금제 : ".$item->find('td',2)->plaintext;
   //    echo "<br />";

   //    echo "출고가 : ".$item->find('td',3)->plaintext;
   //    echo "<br />";

   //    echo "공시지원금 : ".$item->find('td',4)->plaintext;
   //    echo "<br />";

   //    echo "판매가 : ".$item->find('td',5)->plaintext;
   //    echo "<br />";
   //    echo "<br />";
   // }
}
?>
