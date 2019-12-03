<?php

session_start();

//파라미터에 ck 데이터가 같이 날라오면 표시해준다.
$login_ck = $_GET['ck'];

//세션에 값이 들어있는상태라면 자동으로 리프레쉬 진행

//세션 체크
//만약에 localhost 라고 입력은 했는데 세션이 있다면 main_page.php 로 이동
if ($_SESSION['id'] > 0) {
    echo("<script>location.replace('./main_page.php');</script>");
    exit;
}
?>

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/index.css">
    <title>로그인</title>
    <link href="./css/bootstrap.css" rel="stylesheet">
</head>
<style>
    body {
        background-image:url('kakao.png');
    }

    input {
        margin:10px;
    }
</style>
<body>

<div class="container">

    <form class="form-signin" action="./login/login_ck.php" method="post" enctype="multipart/form-data">
        <h2 class="form-signin-heading" style="text-align:center; font-size:50px;">LOGIN</h2>
        <input type="text" name="inputId" id="inputId" class="form-control" required="required" placeholder="아이디"
                 autofocus>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password"
                 required>
        <div class="checkbox">
            <?php if ($login_ck == "1") { ?> <a href="#" class="more" style="color: red; text-decoration: none;">없는계정이거나,
                아이디나 패스워드가 틀렸습니다.</a><?php } ?>
            <?php if ($login_ck == "2") { ?> <a href="#" class="more" style="color: red; text-decoration: none;">이미 사용된
                계정입니다.</a><?php } ?>
            <?php if ($login_ck == "3") { ?> <a href="#" class="more" style="color: #4caf50; text-decoration: none;">정상적으로
                계정이 생성되었습니다!</a><?php } ?>
            <?php if ($login_ck == "4") { ?> <a href="#" class="more" style="color: red; text-decoration: none;">계정인증 후
                로그인이 가능합니다.</a><?php } ?>
            <?php if ($login_ck == "5") { ?> <a href="#" class="more" style="color: red; text-decoration: none;">(가입)
                성별을 선택해주세요.</a><?php } ?>
        </div>
        <center>
            <button class="btn btn-outline-lg btn-dark" type="submit">로그인</button>
            <a class="btn btn-outline-lg btn-dark" href="./join.php">가입</a>
        </center>
    </form>

</div> <!-- /container -->

</body>
</html>