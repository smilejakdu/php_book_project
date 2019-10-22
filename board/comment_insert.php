<?php
// 설정
	//ini_set('display_errors', '0');
	define('__ROOT__', dirname(dirname(__FILE__)));

	include(__ROOT__."/lib/dbconfig.php");
	include(__ROOT__."/lib/utill.php");

	session_start();
	error_reporting(0);

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
	$depth = $db->real_escape_string($_POST['depth']); //댓글인지 대댓글인지 확인합니다 -> 0을 가져오는 경우 최초 댓글이라 판단.

	//stripslashes 처리 추가
	$no = scriptExclusion($no);
	$comment = scriptExclusion($comment);
	$depth = scriptExclusion($depth);

	//0은 최초 댓글임에 따라 고유값을 하나 확인하여 가져옵니다 (no 값 가져오기)
	if($depth == "0"){
		$sql = "SELECT no FROM COMMENT WHERE del_yn = 'n' ORDER BY NO DESC LIMIT 1";
		$result = $db->query($sql);
		$noSet = $result->fetch_assoc();
		$depth = $noSet['no'] + 1; //마지막 고유값에서 하나를 더한값을 만들어준다.
	}





	$sql = 'insert into comment (boardid, depthid, id, comment, DATE) values("' . $no . '", "' . $depth . '", "' . $_SESSION['user_name']  . '", "' . $comment .'", SYSDATE())';
	$result = $db->query($sql);

	$member = array("code" => "200", "retrun" => "true"); //정상 결과값 확인
	$output =  json_encode($member);
	echo  urldecode($output);




?>