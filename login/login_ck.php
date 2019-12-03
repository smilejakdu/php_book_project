<?php

//기본 디폴트로 데이터 가져오기
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__ . "/lib/dbconfig.php");
require(__ROOT__ . "/lib/utill.php");
//include("security/filter.php");


//SQL 인젝션 방지 & XSS도 둘다같이확인
//echo "userid : ".$_POST['inputId'];

$userid = $db->real_escape_string($_POST['inputId']);
$userpw = $db->real_escape_string($_POST['inputPassword']);

//stripslashes 처리 추가
$userid = scriptExclusion($userid);
$userpw = scriptExclusion($userpw);

//패스워드 암호화를 진행해야하나, 디비데이터도 평문으로 접근함에 따라 평문으로 전송

$sql = "SELECT * FROM user where username =" . "'$userid'" . "and password=" . "'$userpw'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($result->num_rows === 0) {
    echo("<script>location.replace('../index.php?ck=1');</script>");
    exit;
}

//서비스단에서 데이트 가공 진행, 이후 뷰단에서 뿌려주도록
session_start();
$_SESSION['user_id'] = $userid;
$_SESSION['user_name'] = $row['username'];
$_SESSION['gm'] = $row['gm'];

//세션고유키 (사용자 인식 용도로 사용함 - 주의)
$_SESSION['id'] = $row['no'];

//만약에 Login 버튼을 눌렀을때 login 이 됬다면 main_page.php 로 이동
echo("<script>location.replace('../main_page.php');</script>");


#로그트래킹
#ip / 시간 / 접근 / 로그인 성공 실패 유무

?>

