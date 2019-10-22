<?php
// 설정
	//ini_set('display_errors', '0');
	define('__ROOT__', dirname(dirname(__FILE__)));

	include(__ROOT__."/lib/dbconfig.php");
	include(__ROOT__."/lib/utill.php");

	session_start();
error_reporting(0);

header('Content-Type: application/json');

if($_POST['no'] == null){
	$member = array("code" => "400", "retrun" => "false");
	$output =  json_encode($member);
	
	echo  urldecode($output);

	exit;
}

//댓글번호 받아오기
$no = $db->real_escape_string($_POST['no']);
//stripslashes 처리 추가
$no = scriptExclusion($no);


//게시글 조회 쿼리
$sql = 'select * from comment where no = ' . $no;
$textdata = mysqli_query($db , $sql);
$text = mysqli_fetch_assoc($textdata);



if ($text['id'] == $_SESSION['user_name'] || $_SESSION['gm'] == '2'){
	$sql = "update comment set del_yn='Y'";
	$sql = $sql . " where no = '". $no . "'";
	$sql = $sql . " and id = '". $_SESSION['user_name'] . "' ";

	$result = $db->query($sql);
	$member = array("code" => "200", "retrun" => "true");
}

else{
	$member = array("code" => "300", "retrun" => "false");
}

$output =  json_encode($member);
echo  urldecode($output);




?>