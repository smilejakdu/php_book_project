<?php
error_reporting(0);
session_start();

//파라미터에 ck 데이터가 같이 날라오면 표시해준다.
$login_ck = $_GET['ck'] ?? null;

//세션에 값이 들어있는상태라면 자동으로 리프레쉬 진행

//세션 체크
if ($_SESSION['id'] > 0) {
    echo("<script>location.replace('./home.php');</script>");
    exit;
}
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/join.css">
</head>
<style>
    body {
        background-image:url('kakao.png');
    }
</style>
<body>

<div class="container">

    <form class="form-signin" name="member_form" action="./login/login_wh.php" method="post"
          enctype="multipart/form-data">
        <h2 class="form-signin-heading" style="text-align:center;">회원가입</h2>
        <label for="userid" class="sr-only">ID</label>
        ID<input type="text" name="userid" id="userid" class="form-control" required="required" placeholder="아이디"
                 autofocus>
        <label for="password" class="sr-only">Password</label>
        PW<input type="password" id="password" name="password" class="form-control" placeholder="패스워드" required>

        <label for="password" class="sr-only">name</label>
        NAME<input type="password" id="name" name="password" class="form-control" placeholder="이름" required>

        <label for="password" class="sr-only">nick_name</label>
        NICK_Name<input type="password" id="nick_name" name="password" class="form-control" placeholder="별명" required>
        
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
            <button class="btn btn-primary" type="submit">가입</button>
            <button onclick="move_index()" type="button" class="btn btn-danger cancel">취소</button>
        </center>
        <script>
            function move_index() {
                window.location.href = "../index.php"
                return false
            }
        </script>
    </form>
</div> <!-- /container -->


</body>
</html>