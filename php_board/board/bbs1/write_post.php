<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
ob_start();

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->

    <style type="text/css">
        BODY, TD, SELECT, input, DIV, form, TEXTAREA, center, option, pre
        blockquote {
            font-size: 9pt;
            font-family: 굴림, 돋움, Arial;
            color: #2E2D2D;
            line-height: 120%
        }

        A:link {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }

        A:visited {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }

        A:active {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }

        A:hover {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }
    </style>

</head>

<?php


///////////////////////////////////////////////
$user_id = $_SESSION['user_id'] ?? null;
//////////////////////////////////////////////////////////////////
$groups = $_POST['groups'] ?? null;;
$b_ID = $_POST['b_ID'] ?? null;
$subject = $_POST['subject'] ?? null;
$notice = $_POST['notice'] ?? null;
$Tstory = $_POST['Tstory'] ?? null;
$name = $_POST['name'] ?? null;
$nickname = $_POST['nickname'] ?? null;
$email = $_POST['email'] ?? null;
$ctg = $_POST['ctg'] ?? null;
$ctgs = $_POST['ctgs'] ?? null;
$secret = $_POST['secret'] ?? null;
$file2 = $_FILES['file2']['name'] ?? null;
//////////////////////////////////////////////////////////////////


include '../../lib/connect.php';
$connect = dbconn();
$member = member_info();
$c_o = co_info(); //회사정보


if (!$member['user_id']) Error('(Error) Please use after login.');

///// 오류 메세지//////;
if (!$subject) Error('제목을 입력하세요.');

if (!$member['user_id']) {  //만일 아이디가 있으면 이름과 비밀번호 입력생략
    if (!$name) Error('이름을 입력하세요');
    if (!$pw) Error('비밀번호를 입력하세요');
}


// 폼에서 작성했던 내용을 암호화로 변경
if (!$member['pw']) {
    $rt = mysqli_query("select password('$pw')");

    $pw = mysqli_result($rt, 0, 0);
}

////공지글;;///
// 글 순서를 top이라는 필드로 변경하는부분
$top = "";
if (!$top) {
    $top = $data[0] + 1;
// 글 순서를 top이라는 필드로 변경하는부분  끝
}

if ($notice == "1") {
    $top = "100";
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


$subject = addslashes($subject); //제목에 홑/쌍따옴표,역슬래시를 허용
$Tstory = addslashes($Tstory); //본문에 홑/쌍따옴표,역슬래시를 허용


$query_1 = "select * from bbs1 where b_ID='$b_ID' ";
mysqli_query($connect, "SET NAMES utf8");
$result_1 = mysqli_query($connect, $query_1);
$datas = mysqli_fetch_array($result_1);


$mID = $member['mID'];

if ($datas['b_ID'] != $b_ID) {
    // DB전송 루틴
    $query_A1 = "insert into bbs1";
    $query_B = " (groups, b_ID, ctg, ctgs, subject, mID, name, nickname, email, pw, Tstory, regdate, regdate_time,file2, top, level,  user_id, secret, modes, ip)
                               values('$groups','$b_ID','$ctg','$ctgs','$subject','$mID','$name','$nickname','$email','$pw','$Tstory','$regdate','$regdate_time','$file2','$top','$level','$user_id','$secret','$modes','$ip')";
    mysqli_query($connect, "SET NAMES utf8");
    mysqli_query($connect, $query_A1 . $query_B);

} else if ($b_ID == $datas['b_ID']) {

    $query_ss = "update bbs1 set
				groups='$groups', ctg='$ctg', ctgs='$ctgs', subject='$subject', mID='$mID', name='$name', 
				nickname='$nickname', email='$email', pw='$pw', Tstory='$Tstory', regdate='$regdate', 
				regdate_time='$regdate_time', top='$top', level='$level', user_id='$member[user_id]', secret='$secret', modes='$modes', ip='$ip'
				where b_ID='$b_ID' ";
    mysqli_query($connect, "SET NAMES utf8");
    mysqli_query($connect, $query_ss);
}

if (preg_match("/a02|a03/", $ctgs)) { //최고관리자가 보내는 글이 아니라면 관리자에게 이메일을 보낸다.
    // include ("./email_write.php");
}
unset($_SESSION['b_ID']);
?>

<script>
    window.alert("입력하였습니다.");
    //  location.href="list.php?ctg=<?=$ctg?>&ctgs=<?=$ctgs?>";
    location.href = "view.php?b_ID=<?=$b_ID?>&ctg=<?=$ctg?>&ctgs=<?=$ctgs?>";
</script>
