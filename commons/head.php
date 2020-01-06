<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__ . "/lib/dbconfig.php");
require(__ROOT__ . "/lib/utill.php");

session_start();

//사용자 URL 추출 작업 . http , https분기
$base_URL = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
$base_URL .= ($_SERVER['SERVER_PORT'] != '80') ? $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'] : $_SERVER['HTTP_HOST'];
$web_path = $base_URL;


//세션 체크
if (empty($_SESSION['id'])) {
    echo("<script>location.replace('" . $web_path . "/index.php');</script>");
    exit;
}
if (is_numeric($_SESSION['id']) == false) {
    echo("<script>location.replace('" . $web_path . "/index.php');</script>");
    exit;
}

if ($_SESSION['id'] == null || $_SESSION['id'] == "") {
    echo("<script>location.replace('" . $web_path . "/index.php');</script>");
    exit;
}


//유저 데이터 받아오기
$sql = "SELECT * FROM user where no = " . $_SESSION['id'];
$result = mysqli_query($db, $sql);
$user_data = mysqli_fetch_assoc($result);

?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>게시판</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= $web_path ?>/css/bootstrap.css" rel="stylesheet">

    <!-- 알림창 추가 -->

    <!--파비콘 추가-->
    <link rel="shortcut icon" href="<?= $web_path ?>/img/shield.ico">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- <link href="css/screen.css" rel="stylesheet"> -->
    <!-- Custom styles for this template -->


    <!-- Bootstrap core JavaScript ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
            integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
            crossorigin="anonymous"></script>

    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
        @import url(https://fonts.googleapis.com/css?family=Lato:400,700);

        body {
            font-size: 14px;
            font-family: 'Lato', sans-serif !important;
        }

        @media (min-width: 992px) {
            .mainset {
                padding-left: 0px;
            }
        }

        .container {
            width: 1180px !important;
            max-width: none !important;
        }

        .jeju {
            font-family: 'Jeju Gothic', serif;
            font-size: 15px;
        }

        .comment {
            background-color: #e9ecef;
            padding-bottom: 5px;
            padding-top: 5px;
            margin-bottom: 5px;
            margin-top: 25px;
        }
    </style>
    <!-- 모바일 고려 x -->
    <!-- container / meta -->
</head>

<script>

    function navi_open() {
        document.getElementById("mySidebar").style.display = "block";
    }

    function navi_close() {
        document.getElementById("mySidebar").style.display = "none";
    }
</script>
<style>
    .navigation_open {
        border : 1px solid black;
        padding : 20px;
        background:black;
        color:white;
        border-radius:20px;
    }
    .navigation_open:active {
    }
    
    .input {
        font-size:16px;
        width:300px;
        padding:10px;
        border:0px;
        outline:none;
        float:left;
        margin:10px;
    }
    .search_button {
        width:70px;
        height:45px;;
        border:0px;
        outline:none;
        float:left;
        background:white;
        color:black;
        border-radius:10px;
        margin:10px;
        border:1px solid black;
    }
    .search_button:hover{
      background:black;
      color:white;
    }

    .navbar_style{
        width:16%;
    }

</style>

<body style="background-color: #f4f4f4;">

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-border-right bg-warning" style="display:none; width:16%;" id="mySidebar">
    <button onclick="navi_close()" class="w3-bar-item w3-large bg-warning">Close &times;</button>
    <a href="../intro.php" class="w3-bar-item w3-large bg-warning">introduction</a>
    <a href="../php_mysql_study/index.php" class="w3-bar-item w3-large bg-warning">php mysql 공부</a>
    <a href="../book/index.php" class="w3-bar-item w3-large bg-warning">베스트셀러</a>
    <a class="w3-bar-item w3-large bg-warning" href="<?= $web_path ?>/board.php">board</a>
</div>

<nav class="navbar navbar-expand-lg bg-warning" style="border-radius:30px;">
    <div class="container">
        <button class="navigation_open" onclick="navi_open()" style="transition:.4s;">☰</button>&nbsp;&nbsp;
        <a class="navbar-brand" href="../main_page.php" style="font-family: 'Jeju Gothic', serif;">main page</a>
        <form action="../main_page.php" method="post">
            <input type="text" name="search_text" class="input" id="search_text" placeholder="도서 검색">
            <input type="submit" class="search_button" value="검색">
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if ($title == "community") { ?>active <?php } ?>">
                </li>
            </ul>

            <div class="form-inline my-2 my-lg-0" style="color:black; font-weight:bold;">
                <?= $user_data['username']; ?>님
                <a class="nav-link jeju" style="color:black;" href="<?= $web_path ?>/logout.php">로그아웃</a>
            </div>

        </div>
    </div>
</nav>
