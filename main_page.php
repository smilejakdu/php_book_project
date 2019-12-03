<?php
include "lib/dbconfig.php";
include "./commons/head.php";
?>
<script>
      $(document).on("click", "#click_url", function () {
            var click_book_name = $(this).text();
              alert(click_book_name);
        });
</script>
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


    input {
        font-size:16px;
        width:300px;
        padding:10px;
        border:0px;
        outline:none;
        float:left;
        margin:10px;
    }
    .search_button {
        width:70px;
        height:45px;;
        border:0px;
        outline:none;
        float:left;
        background:white;
        color:black;
        border-radius:10px;
        margin:10px;
        border:1px solid black;
    }

</style>
<?php
  $client_id = "SFezXsTn6ehQdzFHwwp7"; //발급받은 client id & secret key
  $client_secret = "KzKrnNFNu_";
 
  $encText = urlencode("php"); //검색할 Text를 url인코딩
 
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
  if($status_code == 200) { //정상
  }
  
  else {
    echo "Error 내용: ".$response;
  }
  ?>
<?php
 $result = json_decode($response, true);
 ?>
  <div>
    <input type="text" placeholder="검색어 입력">
    <button class="search_button">검색</button>
  </div>
        <table class="table table-striped table-dark">
        <tr>
                <th>번호</th>
                <th>제목</th>
                <th width=200>이미지</th>
                <th>저자</th>
        </tr>
<?php
        $count = 0;
        while($count < 10){
        $img_src = $result['items'][$count]['image'];
?>      
            <tr>
                    <td><?php echo $count+1 ?></td>
                    <td id="click_url"><?php echo $result['items'][$count]['title'];?></td>
                    <td><img src="<?php echo $img_src?>"></td>
                    <td><?php echo $result['items'][$count]['author'];?></td>
            </tr>

<?php
        $count++;
        }
?>
</table>
</body>

</html>

