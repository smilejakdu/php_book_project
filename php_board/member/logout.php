<? session_start();
ob_start();
include '../lib/connect.php';
$connect = dbconn();
$member = member_info();

setcookie("members", "0", -1, "/");
//setcookie("members", "", time() -10000);


session_destroy();    ////// 세션 끝내기

?>


<script language="javascript">
    window.top.location.href = "../main.php";
</script>
