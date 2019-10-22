<meta charset="UTF-8">
<?php $id = $_REQUEST["id"];
if (!$id) {
    echo "아이디를 입력하세요.<p>";
} else {
    require_once("../lib/MYDB.php");
    $pdo = db_connect();
    try {
        $sql = "select * from phptest.member where id = ? ";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(1, $id, PDO::PARAM_STR);
        $stmh->execute();
        $count = $stmh->rowCount();
    } catch (PDOException $Exception) {
        print "오류: " . $Exception->getMessage();
    }
    if ($count < 1) {
        echo "사용가능한 아이디입니다.<p>";
    } else {
        echo "아이디가 중복됩니다.<br>다른 아이디를 사용해 주세요.<p>";
    }
}

//    쌍따옴표 안에 구분을 해줄때는 하나 따옴표로 구분을 한다 .
echo "<center><input type=button value=창닫기 onClick='self.close()'></center>";

?>