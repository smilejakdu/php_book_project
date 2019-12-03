<?php
$host = "localhost";
$user_name = "jakdu";
$user_password = "##tkakrnl12";
$db_name = "userdb";

$conn = mysqli_connect($host, $user_name, $user_password, $db_name);

if ($conn->connect_error) {
    echo "연결에 오류가 발생했습니다.";
} else {
    echo "연결에 성공했습니다.";
}

?>