<? session_start();
header("content-type:text/html; charset=UTF-8");

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();


if ($_GET['no']) {
    $no = $_GET['no'];
} else if ($_POST['no']) {
    $no = $_POST['no'];
}


if ($_GET['bbs']) {
    $bbs = $_GET['bbs'];
} else if ($_POST['bbs']) {
    $bbs = $_POST['bbs'];
}


if (!$member['user_id']) Error('회원정보가 없습니다.');
if (!$no) Error('삭제할 글을 선택해주세요');


for ($i = 0; $i < count($no); $i++) {
    //메세지 삭제;
    $query = "delete  from message where to_user_id='$member[user_id]' and to_mID='$member[mID]' and no='$no[$i]'  ";
    $result = mysqli_query($connect, $query);
    if (!$result) die(mysqli_error());

}


?>

<script>
    window.alert(decodeURIComponent("삭제 되었습니다."));
    location.href = './my_message.php?ctg=members';
</script>