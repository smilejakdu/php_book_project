<? header("content-type:text/html; charset=UTF-8");
session_start();
ob_start();

include '../../lib/connect.php';
$connect = dbconn();
$member = member_info();


///////////////////////////////////////////
$user_id = $_SESSION['user_id'];


$no = $_GET['no'];
$file1 = $_GET['file1'];
$file1_name = $_GET['file1_name'];
$b_ID = $_GET['b_ID'];
///////////////////////////////////////////


$query = "select * from member where user_id='$user_id' ";
mysqli_query($connect, "SET NAMES utf8");
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);


$query = "select * from bbs1 where b_ID='$b_ID' ";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);


if (!$member['user_id']) {
    echo
    "<script> 
alert('로그인후 이용하세요.'); 
opener.location.reload(); 
window.close(); 
</script> 
";
    exit;
}


echo "(" . $file1 . ") 파일이 삭제 되었습니다.";


if ($file1) {

    ////////////////////  1번 파일 루틴 //////////////////
    // 파일삭제루틴
    $del_file1 = "../../dataset/bbs1/" . $file1;
    if ($data['file1'] && is_file($del_file1)) unlink($del_file1);

}


$edit_file1 = str_replace("#" . $file1, "", $data[file1]);
$edit_file1_name = str_replace("#" . $file1_name, "", $data[file1_name]);
if ($file1) {

    ////////////////////  1번 데이터 수정 //////////////////
    // DB파일명 삭제루틴
    $qy = "update  bbs1 set 
	  file1='$edit_file1',
	  file1_name='$edit_file1_name'
	  where  b_ID='$b_ID' ";
    mysqli_query($connect, $qy);
}

unset($_SESSION['b_ID']);  // b_ID세션삭제
?>


<script language="JavaScript">
    alert("파일이 삭제되었습니다.");
    opener.location.reload(); //부모창 (프레임)새로고침
    window.close();
</script> 