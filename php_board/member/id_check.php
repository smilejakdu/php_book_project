<? session_start();
ob_start(); ?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>
    </head>
<body>
<?
////////////[받음]////////////////
$user_id = $_GET['user_id'];
//////////////////////////////////


if (!preg_match("/^[a-z0-9_]{4,12}$/", $user_id)) { //허용문자;
    ?>
    <script language=javascript>
        opener.document.form_1.user_id_s.value = 'NO';
        opener.document.getElementById('user_id_ms1').innerHTML = '다시작성 하세요.';
        opener.document.getElementById('user_id_ms1').style.color = 'red';
        opener.document.form_1.sm2.value = "0";
        window.close();
    </script>
    <?
    exit;
}


include '../lib/connect.php';
$connect = dbconn();

$where = "user_id='$user_id' ";
$query = "SELECT user_id FROM member where $where UNION SELECT user_id FROM member_out  where $where";
mysqli_query($connect, "set names utf8");
$result = mysqli_query($connect, $query);
$mem = mysqli_fetch_array($result);


if (!$mem[user_id]) {
    ?>
    <script language=javascript>
        opener.document.form_1.user_id_s.value = "OK";
        opener.document.getElementById('user_id_ms1').innerHTML = '확인완료';
        opener.document.getElementById('user_id_ms1').style.color = 'green';
        opener.document.getElementById('sm2').value = "1";
        window.close();
    </script>
<? }
if ($mem[user_id]) {
    ?>
    <script language=javascript>
        opener.document.form_1.user_id_s.value = "NO";
        opener.document.getElementById('user_id_ms1').innerHTML = '사용중인 아이디입니다..';
        opener.document.getElementById('user_id_ms1').style.color = 'red';
        opener.document.getElementById('sm2').value = "0";
        window.close();
    </script>

<? } ?>

<script language=javascript>
    setTimeout("window.close()", 5000);
</script>