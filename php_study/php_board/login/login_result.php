<?php
    session_start();

$id = $_REQUEST['id'];
$pw = $_REQUEST['pass'];

require_once("../lib/MYDB.php");
$pdo = db_connect();

try {
    $sql = "select * from phptest.member where id=?"; // 해당하는 아이디가 있다면 가져와
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(1, $id, PDO::PARAM_STR);
    $stmh->execute();

    $count = $stmh->rowCount(); // 몇개의 행을 가져왔는지

} catch (PDOException $exception) {
    print "오류 :" . $exception->getMessage();
}
$row = $stmh->fetch(PDO::FETCH_ASSOC);

if ($count < 1) { // 일치하는 아이디가 없는 경우
    ?>
    <script>
        alert("아이디가 틀립니다.");
        history.back(); // 이전페이지로 이동
    </script>
    <?php
} else if ($pw != $row["pass"]) { // 비밀번호가 같지 않을때
    ?>

    <script>
        alert("비밀번호가 틀립니다.");
        history.back();
    </script>

    <?php
} else { // 아이디와 비밀번호가 일치하는 경우
    $_SESSION["userid"] = $row["id"];
    $_SESSION["name"] = $row["name"];
    $_SESSION["nick"] = $row["nick"];
    $_SESSION["level"] = $row["level"];

    header("Location:http://localhost/index.php");
    exit;
}
?>