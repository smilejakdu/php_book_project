<?php
session_start();

require_once("../lib/MYDB.php");

$pdo = db_connect();

try {
    $sql = "select * from phptest.memo order  by num desc";
    $stmh = $pdo->query($sql);
} catch (PDOException $Exception) {
    print "오류 :" . $Exception->getMessage();
}
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/common.css">
    <link rel="stylesheet" type="text/css" href="../css/member.css">
    <title>낙서장</title>
</head>
<style>
    #wrap {
        width: 1000px;
        margin-right: auto;
        margin-left: auto;
        min-height: 600px;
        border: solid 1px #00ff00;
    }

    #header {
        height: 62px;
        border: solid 1px #c85102;
        /*위에 16 px 띄우라는 얘기*/
        margin-top: 16px;
    }
</style>
<body>

<div id="wrap">
    <div id="header"
    <?php include "../lib/top_login2.php"; ?>
</div>
<div id="menu">
    <?php include "../lib/top_menu2.php"; ?>
</div>

<div id="content">
    <div id="col1">
        <div id="left_menu">
            <?php include "../lib/left_menu.php"; ?>
        </div>
    </div>

    <div id="col2">
        <div id="title">
            <img src="../img/title_memo.gif">
        </div>

        <?php
        if (isset($_SESSION["user_id"])){
        ?>
        <div id="memo_row1">
            <form name="memo_form" method="post" action="insert.php">
                <div id="memo_writer"><span> ▶ <?= $_SESSION["nick"] ?></span></div>
                <div id="memo1"><textarea rows="6" cols="86" name="content" required></textarea></div>
                <div id="memo2"><input type="image" src="../img/memo_button.gif"></div>
            </form>

            <?php
            }
            while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                $memo_id = $row["id"];
                $memo_num = $row["num"];
                $memo_date = $row["regist_day"];
                $memo_nick = $row["nick"];
//                str_replace 는 문자열을 교체
                $memo_content = str_replace("\n", "<br>", $row["content"]);
                $memo_content = str_replace(" ", "&nbsp;", $memo_content);
            }
            ?>
            <div id="memo_writer_title">
                <ul>
                    <li id="writer_title1"><?= $memo_num ?></li>
                    <li id="writer_title2"><?= $memo_nick ?></li>
                    <li id="writer_title3"><?= $memo_date ?></li>
                    <li id="writer_title4">

                        <?php
                        if (isset($_SESSION["userid"])) {
                            if ($_SESSION["userid"] == "admin" || $_SESSION["userid"] == $memo_id)
                                print "<a href='delete.php?num$memo_num'>[삭제]</a>'";
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <div id="memo_content"><?= $memo_content ?>
            </div>

            <div id="ripple">
                <div id="ripple1">덧글</div>
                <div id="ripple2">

                    <?php
                    try {
                        $sql = "select * from phptest.memo_ripple where parent='$memo_num'";
                        $stmh1 = $pdo->query($sql); // ripple PDOStatement 변수명을 다르게

                    } catch (PDOException $Exception) {
                        print "오류 :" . $Exception->getMessage();
                    }
                    while ($row_ripple = $stmh1->fetch(PDO::FETCH_ASSOC)) {
                        $ripple_num = $row_ripple["num"];
                        $ripple_id = $row_ripple["id"];
                        $ripple_nick = $row_ripple["nick"];
                        $ripple_content = str_replace("\n", "<hr>", $row_ripple["content"]);
                        $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
                        $ripple_date = $row_ripple["regist_day"];
                        ?>
                        <div id="ripple_title">
                            <ul>
                                <li><?= $ripple_nick ?> &nbsp;&nbsp;&nbsp; <?= $ripple_date ?></li>
                                <li id="mdi_del">
                                    <?php
                                    if (isset($_SESSION["userid"])) {
                                        if ($_SESSION["userid"] == "admin" || $_SESSION["userid"] == $ripple_id)
                                            print "<a href=delete_ripple.php?num=$ripple_num>[삭제]</a>";
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <div id="ripple_content"><?= $ripple_content ?></div>
                        <?php
                    }
                    if (isset($_SESSION["userid"])) {
                        ?>
                        <form name="ripple_form" method="post" action="insert_ripple.php">
                            <input type="hidden" name="num" value="<?= $memo_num ?>">
                            <div id="ripple_insert">
                                <div id="ripple_textarea">
                                    <textarea rows="3" cols="80" name="ripple_content" required></textarea>
                                </div>
                                <div id="ripple_button">
                                    <input type="image" src="../img/memo_ripple_button.png"></div>
                            </div>
                        </form>
                    <?php } ?>
                </div> <!-- end of ripple2 -->
                <div class="clear"></div>
                <div class="linespace_10"></div>
            </div> <!-- end of ripple -->
        </div> <!-- end of col2 -->
    </div> <!-- end of content -->
</div> <!-- end of wrap -->

<p>&nbsp;</p>
<p>&nbsp;</p>


</body>
</html>
