<?php
include "lib/dbconfig.php";
include "./commons/head.php";
error_reporting(0);
?>

<?php
if (isset($_POST['search_text'])) {
  $search_data = $_POST['search_text'];
} else {
  $search_data = "php";
}
?>
    <script src="//code.jquery.com/jquery.min.js"></script>
<style>
    body {
        padding-bottom: 40px;
        background-color: #eee;
        background-image:url('kakao.png');
    }
    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }

    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .table_css {
      margin-top:30px;
      width:80%;
      text-align:center;
      margin-left:auto;
      margin-right:auto;
    }

</style>
    <table class="table table-striped table-dark table_css" id="purchase_order">
        <tr>
                <th width="10%">순위</th>
                <th width="50%" style="text-align:center;">제목</th>
                <th width="20%">이미지</th>
                <th width="10%">저자</th>
        </tr>
        <?php
  $client_id = "SFezXsTn6ehQdzFHwwp7"; //발급받은 client id & secret key
  $client_secret = "KzKrnNFNu_";
 
  $encText = urlencode($search_data); //검색할 Text를 url인코딩
 
  /*요청 변수(query, display, start, sort... 네이버 참고)
    json ver: https://openapi.naver.com/v1/search/book.json?...
    xml ver : https://openapi,naver.com/v1/search/book.xml?...
  */
  $url = "https://openapi.naver.com/v1/search/book.json?query=".$encText;
 
  $is_post = false;
 
  /*
  curl = 원하는 url에 값을 넣고 리턴되는 값을 받아오는 함수
  */
  $ch = curl_init(); //세션 초기화
 
  /*curl_setopt : curl옵션 세팅
    CURLOPT_URL : 접속할 url
    CURLOPT_POST : 전송 메소드 Post
    CURLOPT_RETURNTRANSFER : 리턴 값을 받음
  */
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
 
  /*
    CURLOPT_HTTPHEADER : 헤더 지정 (네이버 api를 사용하려면 필요하다)
    CURLOPT_SSL_VERIFYPEER : 인증서 검사x
    https 접속시 필요
  */
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
/*
  curl_exec : 실행
  curl_getinfo : 전송에 대한 정보
  CURLINFO_HTTP_CODE : 마지막 HTTP 코드 수신
*/
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//   echo "status code: ".$status_code."";
 
  curl_close ($ch);
  ?>

<?php
 $result = json_decode($response, true); // $result 배열에 담게된다.
 ?>
<?php
        $count = 1;
        while($count < 10){
          $title = $result['items'][$count]['title'];
          $image = $result['items'][$count]['image'];
          $url="https://book.naver.com/search/search.nhn?sm=sta_hty.book&sug=&where=nexearch&query=".$title;
          $author = $result['items'][$count]['author'];
?>              
            <tr>
                <td style="font-weight:bold; font-size:15px; vertical-align:middle;"><?= $count ?></td>
                <td style="vertical-align:middle;"><a style="text-decoration:none;" href=<?=$url?>><?= $title; ?></a></td>
                <td id="image"><img src="<?= $image;?>"></td>
                <td style="vertical-align:middle;" id="author"><?= $author; ?></td>
            </tr>

<?php
        $count++;
        }
?>

</table>
</body>

</html>

