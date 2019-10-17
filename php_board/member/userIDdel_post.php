<? session_start();
ob_start(); ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->


    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>
</head>

<?
///////////////////////////////
$user_id = $_SESSION[user_id];
///////////////////////////////


$no = $_POST['no'];
$mID = $_POST['mID'];
$language = $_POST['language'];
$name = $_POST['name'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$tel = $_POST['tel'];
$mphone = $_POST['mphone'];
$mphone_for = $_POST['mphone_for'];
$birth = $_POST['birth'];
$addr = $_POST['addr'];
$addr_for = $_POST['addr_for'];
$pw = $_POST['pw'];
$first_regdate = $_POST['first_regdate'];
//////////////////////////////////////////

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$cinfo = co_info(); //회사정보


$query = "select * from member where mID='$mID' and user_id='$user_id' ";
mysqli_query($connect, "set names utf8");
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);


// 폼에서 작성했던 내용을 암호화로 변경
$result = mysqli_query($connect, "select password('$pw')");
$pws = mysqli_fetch_row($result);
$pw = $pws[0];


if (!$pw) {
    Error('비밀번호를 입력하세요');
}

if (!$birth) {
    Error('생년월일을 입력하세요');
}


if ($member[birth] != $birth) Error('생년월일이 틀립니다.');


if ($member[pw] != $pw) Error('비밀번호가 같지 않습니다.');

// 탈퇴리스트 시간;
$end_regdate = date("Ymd-His", time()); //날짜


// 탈퇴데이터 리스트 쿼리 전송;
$q2 = "insert into member_out 
                                                (mID, name, user_id, sex, email, birth, addr, tel, mphone, mphone_for, first_regdate, end_regdate) 
                                     values ('$mID','$name','$user_id','$sex','$email','$birth','$addr','$tel','$mphone','$mphone_for','$first_regdate','$end_regdate') ";
mysqli_query($connect, $q2);


//데이터 베이스 회원삭제;
$query = "delete  from member where  mID='$mID'  ";
$result = mysqli_query($connect, $query);
if (!$result) die(mysqli_error());


//회원이미지 삭제부분 테스트 루틴 1번
$del_file = "../dataset/member/" . $member[file01];
if ($member[file01] && is_file($del_file)) unlink($del_file);


setcookie("members", "");
?>

<script>
    window.alert("그동안 '<?=$cinfo['site_name'];?>'을 이용해 주셔서 감사합니다.");
    location.href = './logout.php';
</script> 