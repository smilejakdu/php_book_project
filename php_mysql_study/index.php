<?php
    include "../commons/head.php";
?>
<script>

</script>
<style>
    body {
        background-image:url('/kakao.png');
    }
    table {
        margin-top:20px;
        text-align:center;
        border : 1px solid black;
        width: 60%;
    }

    tr th {
        padding:20px;
        font-weight:bold;
        border : 1px solid black;
        font-size:15px;
        background: black;
        color : white;
    }
    tr td {
        padding:40px;
        border : 1px solid black;
        font-size: 20px;
        background:white;
    }
</style>
<center>
    <table>
        <tr>
            <th width="30%">공부한 사이트 , 책</th>
            <th width="70%">공부한 내용</th>
        </tr>
        <tr>
            <td><a href="https://opentutorials.org/course/1" class="btn btn-dark">생활코딩</a></td>
            <td>생활코딩에서 기본적인 웹에 대한 지식과 php mysql 를 공부했습니다.</td>
        </tr>
        <tr>
            <td><a href="http://https://www.w3schools.com/" class="btn btn-warning">w3schools</a></td>
            <td>w3schools 에서 html css을 공부했고 , php mysql 부분을 공부했습니다.</td>
        </tr>
        <tr>
            <td><a href="https://developer.mozilla.org/ko/docs/Web/HTML/Element" class="btn btn-danger">MDN web docs</a></td>
            <td>MDN 을 보면서 , 웹에 대한 지식을 공부했습니다.</td>
        </tr>
    </table>
</center>
</body>
</html>
    