<?php
include "../lib/dbconfig.php";
include "../commons/head.php";
?>

<script>
    function move_coding() {
        location.href = "https://opentutorials.org/course/1"
    }

    function move_w3schools() {
        location.href = "https://www.w3schools.com"
    }

    function move_mdn() {
        location.href = "https://developer.mozilla.org/ko/docs/Web/HTTP"
    }

    function move_everdevel() {
        location.href = "http://mybook.everdevel.com/playExampleSource/#";
    }

</script>

<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
</head>
    <style>
        body {
        padding-bottom: 40px;
        background-color: #eee;
        background-image:url('/kakao.png');
    }
    </style>
<body>
<div class="container">
    <br>
    <h2 style="color:white; font-weight:bold; text-align:center; margin-bottom:30px;">내가 공부한 사이트</h2>

    <button type="button" style="font-size: large" onclick="move_coding()" class="btn btn-info">생활코딩</button>&nbsp;
    <button type="button" style="font-size: large" onclick="move_w3schools()" class="btn btn-info">w3schools.com
    </button>&nbsp;
    <button type="button" style="font-size: large" onclick="move_mdn()" class="btn btn-info">MDN web docs</button>&nbsp;
    <!-- <button type="button" style="font-size: large" onclick="move_everdevel()" class="btn btn-info">everdevel</button>&nbsp; -->

</div>
</body>
</html>
