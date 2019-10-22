<?php
	$db = new mysqli('아이피', '아이디', '패스워드', '테이블명');

	if ($db->connect_error) {
		die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');
	}

	$db->set_charset('utf8');
?>