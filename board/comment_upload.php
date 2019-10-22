<?php
// 설정
	//ini_set('display_errors', '0');
	define('__ROOT__', dirname(dirname(__FILE__)));

	include(__ROOT__."/lib/dbconfig.php");
	include(__ROOT__."/lib/utill.php");

	session_start();
//error_reporting(0);

header('Content-Type: application/json');

if($_POST['no'] == null || $_POST['comment'] == null){
	$member = array("code" => "400", "retrun" => "false");
	$output =  json_encode($member);
	
	echo  urldecode($output);
	exit;
}

//게시글 번호 받아오기
$no = $db->real_escape_string($_POST['no']);
$comment = $db->real_escape_string($_POST['comment']);

//stripslashes 처리 추가
$no = scriptExclusion($no);
$comment = scriptExclusion($comment);


//댓글코드조회
$sql = 'select * from comment where no = ' . $no;
$textdata = $db->query($sql);
$text = $textdata->fetch_assoc();



if ($text['id'] == $_SESSION['user_name'] || $_SESSION['gm'] == '2'){
	$sql = "update comment set comment='". $comment ."'";
	$sql = $sql . " where no = '". $no . "'";
	$sql = $sql . " and id = '". $_SESSION['user_name'] . "' ";

	$result = $db->query($sql);
	//$row2 = $result->fetch_assoc();
	$member = array("code" => "200", "retrun" => "true");
}

else{
	$member = array("code" => "300", "retrun" => "false");
}

$output =  json_encode($member);
echo  urldecode($output);





?>