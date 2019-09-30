<?php
	//DB 셋팅 부분
	$db = new mysqli('localhost', 'root', 'root', 'calendar'); //아이피,아이디,비밀번호,DB명
	if ($db->connect_error) {
		die('데이터베이스 연결에 문제가 있습니다. 관리자에게 문의 바랍니다.');
		exit;
	}
	$db->set_charset('utf8');
	//디비 셋팅 종료
?>