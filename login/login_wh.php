<?php
//기본 디폴트로 데이터 가져오기
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__ . "/lib/dbconfig.php");
require(__ROOT__ . "/lib/utill.php");
//include("security/filter.php");


//SQL 인젝션 방지 & XSS도 둘다같이확인
//echo "userid : ".$_POST['inputId'];
//echo "test";


$userid = $db->real_escape_string($_POST['userid']);
$userpw = $db->real_escape_string($_POST['password']);
$username = $db->real_escape_string($_POST['name']);
$usernick_name = $db->real_escape_string($_POST['nick_name']);

//stripslashes 처리 추가
$userid = scriptExclusion($userid);
$userpw = scriptExclusion($userpw);
$username = scriptExclusion($username);
$usernick_name = scriptExclusion($usernick_name);


//사용한 아이디인지 먼저 검사
$sql = "SELECT * FROM user where username =" . "'$userid'";
// php 에서 화살표 뜻은 속성이나 메소드에 접근할때(사용하려고할때)사용한다.
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

if ($result->num_rows != 0) {
    echo("<script>location.replace('../join.php?ck=2');</script>");
    exit;
}


//패스워드 암호화를 진행해야하나, 디비데이터도 평문으로 접근함에 따라 평문으로 전송
//$sql = "SELECT * FROM user where username ="."'$userid'"."and password="."'$userpw'";

$sql = "insert into user (username, password, gm)";
$sql = $sql . "values('" . $userid . "','" . $userpw . "','0')";
$result = $db->query($sql);

echo("<script>location.replace('../index.php?ck=3');</script>");


?>

