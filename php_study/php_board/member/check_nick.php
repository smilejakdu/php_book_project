<meta charset="UTF-8">
<?php $nick = $_REQUEST["nick"];
if (!$nick) {
    echo "닉네임을 입력하세요.<p>";
} else {
    require_once("../lib/MYDB.php");
    $pdo = db_connect();
    try {
        $sql = "select * from phptest.member where nick = ? ";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(1, $nick, PDO::PARAM_STR);
        $stmh->execute();
        $count = $stmh->rowCount();
    } catch (PDOException $Exception) {
        print "오류: " . $Exception->getMessage();
    }
    if ($count < 1) {
        echo "사용가능한 닉네임입니다.<p>";
    } else {
        echo "닉네임가 중복됩니다.<br>다른 닉네임을 사용해 주세요.<p>";
    }
}

//    쌍따옴표 안에 구분을 해줄때는 하나 따옴표로 구분을 한다 .
echo "<center><input type=button value=창닫기 onClick='self.close()'></center>";

?>