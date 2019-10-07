<?php header("content-type:text/html; charset=UTF-8");
error_reporting(E_ALL);
ini_set("display_errors", 1);
include '../lib/db_connect.php';
$connect = dbconn();

$id = $_POST['id'];
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$nick_name = $_POST['nick_name'];
$birth=$_POST['birth'];
$sex = $_POST['sex'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$pwㄴ = $_POST['pw'];
$addr_1 = $_POST['addr_1'];
$addr_2 = $_POST['addr_2'];

$pw = md5($pws); //비밀번호 암호화

$regdate = date("YmdHis",time()); // 날짜 시간
$ip = getenv("REMOTE_ADDR"); //ip 

$query =" insert into member(id , user_id,  name , nick_name , birth , sex , tel ,email , pw , addr_1 , addr_2 )
values('$id' , '$user_id ' , '$name' , '$nick_name' , '$birth' , '$sex' , '$tel' ,'$email' , '$pw' , '$addr_1' , '$addr_2')";
mysqli_query($connect , $query);
// mysqli_close(); //mysql 끝내기
?>

<script>
alert("회원가입이 완료 되었습니다.");
location.href='../index.php';
</script>