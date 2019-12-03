<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "users";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    echo "Connect failed: %s\n" . mysqli_connect_error();
    exit();
} else {
    echo "정상적으로 연동이 되었습니다.";
}
?>
