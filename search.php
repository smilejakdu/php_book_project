<?php
if(isset($_POST["search_text"])){
    $client_id = "SFezXsTn6ehQdzFHwwp7"; //발급받은 client id & secret key
    $client_secret = "KzKrnNFNu_";
   
    $encText = urlencode($_POST["search_text"]); //검색할 Text를 url인코딩
   
    $url = "https://openapi.naver.com/v1/search/book.json?query=".$encText;
   
    $is_post = false;
   
    $ch = curl_init(); //세션 초기화
   
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, $is_post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
    $headers = array();
    $headers[] = "X-Naver-Client-Id: ".$client_id;
    $headers[] = "X-Naver-Client-Secret: ".$client_secret;
   
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   
    $response = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    $result = json_decode($response, true);
    $data_array=array();
    $count = 1;
    while($count < 10){
        $data["title"] = $result['items'][$count]['title'];
        $data["image"] = $result['items'][$count]['image'];
        $data["author"] = $result['items'][$count]['author'];
        array_push($data_array , array($data["title"] ,$data["image"] , $data["author"] ));
        $count++;
    }
    echo json_encode($data_array);
}
?>