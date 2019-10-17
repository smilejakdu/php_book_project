<?php
session_start();
ob_start();
$LastModified = gmdate("D d M Y H:i:s", filemtime($HTTP_SERVER_VARS['SCRIPT_FILENAME']));
header("Last-Modified: $LastModified GMT");
header("ETag: \"$LastModified\"");

include './lib/connect.php';
$connect = dbconn();
$member = member_info();
$_co = co_info(); //회사정보
$device_mode = device_mode();  //기기 접속모드
?>


<html>
<head>
    <title><?= $_co['site_name']; ?> unsoft</title>

    <meta content="text/javascript" http-equiv="Content-Script-Type"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--한글로 구성:UTF-8-->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <link rel="canonical" href="http://www.jwband.kr/"> <!--대표URL-->

    <meta name="naver-site-verification" content="naver1fc3354a74e4aac7df7bebbc6bd8954f"/>

    <!--Open Graph  // 소셜미디어로 공유될 때  활용된 정보-->
    <meta property="og:type" content="website"> <!--파일 형식: website -->

    <meta property="og:image" content="http://<?= $_SERVER['HTTP_HOST'] ?>/image/xeronote.jpg">
    <meta property="og:url" content="http://<?= $_SERVER['HTTP_HOST'] ?>"> <!--페이지 URL-->

    <meta name="robots" content="index"> <!-- 검색로봇   -->
    <!-- 명령어에 noindex 사용하면 검색결과에서 제외되며 nofollow를 사용하면 검색로봇이 해당 페이지 내의
           링크를 따라가지 않도록 설정할 수 있습니다-
           사이트의 페이지가 검색 결과에서 제외되지 않도록 해당 태그를 삭제하거나 기본 설정인 index, follow로 설정하시는 것을 추천합니다-->


    <!-- 파비콘 size 256px/256px 확장자 ico -->

    <?
    /////////////////////  [홈페이지 작동 유무 선택] /////////////////////////
    $Hompage = "Run"; //  "Run"=홈페이지 정상 작동 //  "Edit"= 홈페이지 공사중
    ///////////////////////////////////////////////////////////////////////////
    ?>
</head>

<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0' TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">

<?php
if ($Hompage == "Run") {
    echo "<script>
	location.href='./main.php';	</script>";
}

if ($Hompage == "Edit") {
    ?>

    <div align='center'>
        <P>&nbsp;</P>
        <P>&nbsp;</P>
        <span style='font-size:15pt; font-family:돋움,Arial; color:#EF0606'>여러분께 불편을 끼쳐 드려 죄송합니다.</span>
        <P>&nbsp;</P>
        <img src='./image/edit.jpg'><br><br>
        <b>'<?= $cinfo['site_name']; ?>'</b>은 더 나은 홈페이지를 위해 <b><u>업그레이드</u></b> 중입니다.<br>


        회사: <?= $cinfo['co_title']; ?><br>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?= $cinfo['co_tel']; ?><br>
    </div>

    <?php
}
?>

</BODY>
</html>