<? session_start();
ob_start(); ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta http-equiv="imagetoolbar" CONTENT="no"> <!--====이미지 저장하는 툴바 없애기==-->
    <title> 글삭제하기</title>
    <link rel=styleSheet HREF=style.css type=text/css>
</head>

<?
/////////////[받기]///////////////////////////////////
/////////////////////////////////////
$user_id = $_SESSION['user_id'];
//////////////////////////////////
$b_ID = $_POST['b_ID'];
//////////////////////////////////////////////////////////

include '../../lib/connect.php';
$connect = dbconn();
$member = member_info();


$query = "select * from member where user_id='$user_id' ";
mysqli_query($connect, "SET NAMES utf8");
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);


$query = "select * from bbs1 where b_ID='$b_ID'  ";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);


//삭제 권한 방식 입니다.;
if ($member['mID'] != $data['mID']) Error('자신의 글만 삭제 가능합니다.');


//////////////  [[ 파일/데이터 삭제 ]]  //////////////////
if ($data['file1']) { //파일이 있다면....
    $_file1 = explode("#", $data['file1']); // '*'기준으로 문자 배열
// 반복문 //
    for ($ips = 0; $ips < count($_file1); $ips++) {


        //////////////파일삭제 루틴///////////////
        $del_file1 = "../../dataset/bbs1/" . $_file1[$ips];
        if ($_file1[$ips] && is_file($del_file1)) unlink($del_file1);
    }
}

////////// 본문글 삭제루틴 //////////// 
$query = "delete  from bbs1 where b_ID='$b_ID' ";
$result = mysqli_query($connect, $query);
if (!$result) die(mysqli_error());
//////////////  [[ 파일/데이터 삭제 (끝) ]]  //////////////////


// 짧은답글 삭제루틴
$query = "delete from bbs1_comments where b_ID='$b_ID' ";
$result = mysqli_query($connect, $query);


unset($_SESSION['b_ID']);
?>


<script>
    window.alert(decodeURIComponent("해당글이 삭제 되었습니다."));

    location.href = 'list.php?ctg=<?=$data['ctg']?>&ctgs=<?=$data['ctgs']?>';
</script>
