<?php
	//기본 디폴트로 데이터 가져오기
	define('__ROOT__', dirname(dirname(__FILE__)));

	require_once(__ROOT__."/lib/dbconfig.php");
	require(__ROOT__."/lib/utill.php");
	//include("security/filter.php");


	//SQL 인젝션 방지 & XSS도 둘다같이확인
	//echo "userid : ".$_POST['inputId'];
	//echo "test";


	$userid = $db->real_escape_string($_POST['userid']);
	$userpw = $db->real_escape_string($_POST['password']);

	//stripslashes 처리 추가
	$userid = scriptExclusion($userid);
	$userpw = scriptExclusion($userpw);

	
	//사용한 아이디인지 먼저 검사 
	$sql = "SELECT * FROM user where username ="."'$userid'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	if ($result->num_rows != 0){
    	echo("<script>location.replace('../join.php?ck=2');</script>"); 
		exit;
	}


	//패스워드 암호화를 진행해야하나, 디비데이터도 평문으로 접근함에 따라 평문으로 전송
	//$sql = "SELECT * FROM user where username ="."'$userid'"."and password="."'$userpw'";

	$sql = "insert into user (username, password, gm)";
	$sql = $sql . "values('". $userid ."','" . $userpw . "','0')";
	$result = $db->query($sql);

	echo("<script>location.replace('../index.php?ck=3');</script>"); 


?>

