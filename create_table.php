<?php header("content-type: text/html; charset=UTF-8");
    include("./lib/db_connect.php");
    $connect = dbconn();

    $sql = "create table member
            (no int not null auto_increment ,
            primary key(no) ,
            id char(15) ,
            name char(15) ,
            nick_name char(15) ,
            birth char(8) ,
            sex char(6) ,
            tel char(12) ,
            email char(30) ,
            pw char(30))";
    mysqli_query($connect , $sql );
    if(!$sql)die("테이블 생성에 실패 하였습니다.".mysqli_error());
?>