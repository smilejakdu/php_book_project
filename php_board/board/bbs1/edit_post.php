<?php
header("content-type:text/html; charset=UTF-8");
session_start();
ob_start();

include '../../lib/connect.php';
$connect = dbconn();
$member = member_info();


/////////////[받기]///////////////////////////////////
//////////////////////////////////
$ctg = $_POST['ctg'];
$b_ID = $_REQUEST['b_ID'];
///////////////////////////////////////////////////
//////////////////////////////////////////////////
/////////////////////////////////////////////////
$name = $_POST['name'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$editor1 = $_POST['editor1'];
$Tstory = $editor1;
$notice = $_POST['notice']; //공지
$secret = $_POST['secret']; //비밀

$file1 = $_FILES['file1']['name'];
$file2 = $_FILES['file2']['name'];
//////////////////////////////////////////////////
/////////////////////////////////////////////////


if (!$member['user_id']) Error('(Error) Please use after login.');


///// 오류 메세지//////;
if (!$subject) Error('제목을 입력하세요');


if (!$Tstory) Error('내용을 입력하세요');
if (!$b_ID) Error('게시물 번호가 지정되지 않았습니다.');


$query = "select * from bbs1 where b_ID='$b_ID' and user_id='$member[user_id]' ";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);


///// 오류 메세지//////;
if ($member['mID'] != $data['mID']) Error('자신의 글만 수정 가능합니다.');


///공지//
if ($notice == "1") {
    $top = "100";
} else {
    $top = "0";
}


///비밀//
if ($secret == "OK") {
    $secret = "OK";
} else {
    $secret = "";
}


$regdate = date("Ymd", time()); //날짜
$regdate_time = date("His", time());  //시간

$ip = getenv("REMOTE_ADDR");  //ip주소

//////////////접속환경 PC/모바일을 구분한다.//////////////////
if (preg_match('/(iPad|iPhone|Mobile|UP.Browser|Android|BlackBerry|Windows CE|Nokia|webOS|Opera Mini|SonyEricsson|opera mobi|Windows Phone|IEMobile|POLARIS)/i',
    $_SERVER['HTTP_USER_AGENT'])) {
    $modes = "Mobile"; //모바일;
} else {
    $modes = "PC"; //PC;
}

$subject = addslashes($subject); //제목에  홑/쌍따옴표,역슬래시를 허용
$Tstory = addslashes($Tstory); //본문에  홑/쌍따옴표,역슬래시를 허용


//DB전송 루틴
$query = "update bbs1 set
               $temp
                subject='$subject',
				name='$name',
				nickname='$nickname',
				email='$email',
				Tstory='$Tstory',
				top='$top',
				secret='$secret',
				modes='$modes',
				ip='$ip'
				where  b_ID='$b_ID' ";
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, $query);

unset($_SESSION['b_ID']);
?>

<script>
    location.href = 'view.php?b_ID=<?=$b_ID?>&ctg=<?=$ctg?>';
</script>