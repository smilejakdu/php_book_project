<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
function dbconn(){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "board";
    $connect = mysqli_connect($servername, $username, $password, $dbname);
    if(!$connect)die("데이터 연결에 문제가 생겼습니다.".mysqli_error());
        return $connect;
}

//에러메세지 출력
function Error($msg){
    echo "
        <script>
            alert('$msg');
            history.back(1);
        </script>
    ";
    exit; //위에 에러 메세지만 뛰운다.
}

function member(){
    global $connect;
    $temps=$_COOKIE['COOKIES'];
    $cookise = explode("//",$temps); // explode 함수는 기존 문자를 분할 해준다. 

    //아이디 $cookise[0];
    //비밀번호 $cookise[1];
////////회원정보//////////
    $query="select * from member where user_id='$cookise[0]'";
    $result=mysqli_query($connect , $query);
    $memeber = mysqli_fetch_array($result);
    return $memeber;
}
?>