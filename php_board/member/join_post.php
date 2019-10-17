<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
ob_start();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>


</head>

<?
////////////////////////////////////////////////
$mID = $_POST['mID'] ?? null;  //회원번호
$user_id = $_POST['user_id'] ?? null;
$pw = $_POST['pw'] ?? null;
$pw_2 = $_POST['pw_2'] ?? null;
$name = $_POST['name'] ?? null;
$nickname = $_POST['nickname'] ?? null;
$tel = $_POST['tel'] ?? null;
$mphone_1 = $_POST['mphone_1'] ?? null;
$mphone_2 = $_POST['mphone_2'] ?? null;
$mphone_3 = $_POST['mphone_3'] ?? null;
$sex = $_POST['sex'] ?? null;
$birth = $_POST['birth'] ?? null;
$email = $_POST['email'] ?? null;
////////////////////////////////////////////////

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$c_o = co_info(); //회사정보

$where1 = "user_id='$user_id' ";
$query = "SELECT user_id FROM member where $where1 UNION SELECT user_id FROM member_out  where $where1";
mysqli_query($connect, "set names utf8");
$result = mysqli_query($connect, $query);
$mem = mysqli_fetch_array($result);

if ($mem['user_id']) Error('아이디를 다시 작성 하세요.');


$name_1 = $name;
$name_2 = $name;

//이름입력시 최소길이 (한국어)2자부터;
if (!$name_1 = substr($name, '4')) {
    Error("이름은 한글2자~5자 까지입력하세요.");
}
//이름입력시 최대길이(한국어)5자까지;
if ($name_2 = substr($name, '15')) {
    Error("이름은 한글2자~5자 까지입력하세요.");
}


//닉네임 최대길이(한국어)5자까지;
if ($nickname) {
    if ($nickname = substr($nickname, '15')) {
        Error("닉네임은 한글 5자 까지입력하세요.");
    }
}


// 연락처 타당성 검사 (한국어);
if ($tel) {
    if (!preg_match("([0-9-]{7,15})", $tel)) {
        Error("연락처는 바르게 입력하세요");
    }
}


// 휴대폰(가운데번호)
if (!preg_match("([0-9-]{3,4})", $mphone_2)) {
    Error("휴대번호를 바르게 입력하세요");
}

//휴대폰(끝에번호) 
if (!preg_match("([0-9-]{4})", $mphone_3)) {
    Error("휴대번호를  바르게 입력하세요");
}


// 생년월일 최초/최대길이값
if (!preg_match("([0-9-]{8})", $birth)) {
    Error("생년월일은 8자로 입력하세요.");
}


//이메일 타당성 검사
if ($email && !preg_match("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)", $email)) {
    Error("이메일주소가 잘못되었습니다.");
}


if (!$pw) Error('비밀번호를 입력하세요');
if (!$pw_2) Error('비밀번호를 한번더 입력하세요');

if ($pw != $pw_2) {
    Error("비밀번호가 서로 같지않습니다.");
}


// 비밀번호 최초/최대길이값 (영문 숫자 허용)////
if (!preg_match('/^[A-Za-z0-9_]{6,16}$/', $pw)) {
    Error("비밀번호는 6~16자 이상가능합니다.");
}

//비밀번호를  암호화 하여 데이터 베이스에 저장;
$qqq = "select password('$pw') ";
$rrr = mysqli_query($connect, $qqq);
$pw = mysqli_fetch_array($rrr);


$point = $c_o['point'];  //회원가입시 지급될 포인트

$groups = "jm1";  // jm1 : JMBand //  가입위치


$regdate = date("Ymd", time()); //날짜
$times = date("His", time());  //시간


$ip = getenv("REMOTE_ADDR");    //$REMOTE_ADDR 환경변수 (아이피주소);
$level = 5;
$language = "kor";


//////////////접속환경 PC/모바일을 구분한다.//////////////////
if (preg_match('/(iPad|iPhone|Mobile|UP.Browser|Android|BlackBerry|Windows CE|Nokia|webOS|Opera Mini|SonyEricsson|opera mobi|Windows Phone|IEMobile|POLARIS)/i',
    $_SERVER['HTTP_USER_AGENT'])) {
    $modes = "Mobile"; //모바일;
} else {
    $modes = "PC"; //PC;
}


// 버퍼/ 딜레이 되면서 글이 두번 등록된것을 방지 하기 위해 //
$query7 = "select mID from member where mID='$mID' ";

mysqli_query($connect, "SET NAMES utf8");
$result7 = mysqli_query($connect, $query7);
$mIDs = mysqli_fetch_array($result7);
if ($mID != $mIDs['mID']) {  // 같은글 중북 방지 ( 앞에서 보낸 글이 서버에 존재 하지 않다면....)

// 쿼리 전송;
    $query = "insert into member set groups='$groups', mID='$mID', user_id='$user_id', language='$language', name='$name', nickname='$nickname',
                                        pw='$pw[0]', email='$email', tel='$tel', mphone_1='$mphone_1', mphone_2='$mphone_2', mphone_3='$mphone_3',
                                          regdate='$regdate', times='$times', ip='$ip', level='$level', birth='$birth', sex='$sex', modes='$modes'";
    mysqli_query($connect, "SET NAMES utf8");
    $result_query = mysqli_query($connect, $query);
    if ($result_query == false) {
        echo "실패했는것 같은데...?";
    } else {
        echo "잘 되구만 뭘.";
    }

    /* //////////////////////////  이메일 전송 ///////////////////////////// */
    include('./join_email.php'); //가입 이메일 보내기
    /* //////////////////////////  이메일 전송 (끝) ///////////////////////////// */

/////////////////////  메세지 보내기 ///////////////////////

/// 메세지 내용 ///
    $subject = $name . "님 " . $c_o['site_name'] . "의 회원가입을 축하 드립니다.";
    $content = "<strong>" . $name . "</strong> 님 " . $c_o['site_name'] . "의 회원가입을 축하 드립니다. <br>";
    $content .= "문의사항이 있으시면 게시판에 남겨주세요.<br>";


    $regdate_time = date("His", time());  //메세지 전송시간

    $from_user_id = $c_o['post_user_id']; //보낸이 user_id
    $from_name = $c_o['post_name'];  //보낸이
    $from_mID = $c_o['post_mid'];  //보낸이 mID

    $query_2 = "insert into message(to_mID, to_user_id, to_name, to_nickname, subject, content,
                     from_user_id, from_name, from_mID, regdate, regdate_time)
                       values('$member[to_mID]','$user_id','$name','$nickname','$subject','$content',
					               '$from_user_id','$from_name','$from_mID','$regdate','$regdate_time')";
    mysqli_query($connect, "SET NAMES utf8");
    mysqli_query($connect, $query_2);


}  //같은글 중북 방지 if문 닫기 


/////////////////////[세션입력]/////////////////////////////
$_SESSION['user_id'] = $user_id;
?>

<script>
    window.alert('<?=$name?>님 회원가입 축하 드립니다..');
    location.href = '../main.php';
</script>
