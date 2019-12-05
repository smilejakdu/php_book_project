<?php
    extract($_POST);

    $passwd = "baealex";

    if($memo == $passwd) {
        session_start();
        $_SESSION['auth'] = "auth-success";
        echo "<script>alert('안녕하세요. 관리자님 :)')</script>"; 
    }

    else if($memo == "logout" || $memo == "lock") {
        session_start();
        unset($_SESSION['auth']);
        session_destroy();
        echo "<script>alert('잘가요. 관리자님 ;)')</script>"; 
    }

    else {
        session_start();
        if(!isset($_SESSION['auth'])) {
            echo "<script>alert('패스워드가 틀렸습니다 :(')</script>";
        }
        else {
            echo "<script>alert('이곳엔 메모를 작성할 수 없어요 :(')</script>";
        }
    }
    echo "<script>document.location.href='./';</script>"; 
?>
