<?php

function dbconn(){

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phone_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
if($conn->connect_errno){
    echo "<span color='red'>연결에 실패 하였습니다.</span>".$conn->connect_error.'<br>';
       }
    return $conn; 
}

?>