<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    require_once 'connect.php';
    $sql = "insert into users_table(name , email , password) values ('$name' , '$email' , '$password')";

    if (mysqli_query($conn, $sql)) {

        $result['success'] = "2";
        $result['message'] = "success";

        echo json_encode($result);
        mysqli_close();
    }
}
?>
