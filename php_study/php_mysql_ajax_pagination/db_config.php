<?php
$conn = mysqli_connect('localhost', 'root', 'root', 'test');

if ($conn->connect_error) {
    die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');
}else{
    echo "db연결함";
}

$conn->set_charset('utf8');
?>