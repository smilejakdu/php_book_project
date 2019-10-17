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

$query1 = "select * from member_out where user_id='$user_id'";
mysqli_query($connect, "set names utf8");
$result1 = mysqli_query($connect, $query1);
$mem1 = mysqli_fetch_array($result1);

$query2 = "select * from member where user_id='$user_id' ";
mysqli_query($connect, "set names utf8");
$result2 = mysqli_query($connect, $query2);
$mem2 = mysqli_fetch_array($result2);

$query = "SELECT * from member as a inner join member_out as b on a.user_id=b.user_id where user_id='$user_id'";
$res = mysqli_query($query, $connect);


if (!$mem1['user_id'] and !$mem2['user_id']) {
    ?>
    <script language=javascript>
        opener.document.form_1.user_id_s.value = "OK";
        opener.document.getElementById('user_id_ms1').innerHTML = '확인완료';
        opener.document.getElementById('user_id_ms1').style.color = 'green';
        opener.document.getElementById('sm2').value = "1";
        window.close();
    </script>
<? }
if ($mem1[user_id] == $user_id or $mem2[user_id] == $user_id) {
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