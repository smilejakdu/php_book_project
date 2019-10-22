<?php
session_start();
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/common.css">
    <link rel="stylesheet" type="text/css" href="../css/member.css">
    <!--script 는 javascript 이다 -->
    <script>

        function check_id() { // 중복아이디
            window.open("check_id.php?id=" + document.member_form.id.value, "IDcheck", "left=200,top=200,width=200,height=60,scrollbars=no,resizable = yes");
        }

        function check_nick() { // 닉네임
            window.open("check_nick.php?nick=" + document.member_form.nick.value, "NICKcheck", "left=200,top=200,width=200,height=60, scrollbars=no,resizable = yes");
        }

        function check_input() {
            if (!document.member_form.hp2.value || !document.member_form.hp3.value) {
                alert("휴대폰 번호를 입력하세요");
                document.member_form.nick.focus();
                return;
            }

            //패스워드와 패스워드 확인란이 같지 않으면
            if (document.member_form.pass.value !=
                document.member_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
                document.member_form.pass.focus();
                document.member_form.pass.select();
                return;
            }
            document.member_form.submit();
        }

        //취소버튼을 눌렀을때 모든 입력란을 삭제해주는 부분
        function reset_form() {
            document.member_form.id.value = "";
            document.member_form.pass.value = "";
            document.member_form.pass_confirm.value = "";
            document.member_form.name.value = "";
            document.member_form.nick.value = "";
            document.member_form.hp2.value = "";
            document.member_form.hp3.value = "";
            document.member_form.email1.value = "";
            document.member_form.email2.value = "";
            document.member_form.id.focus();

            return;
        }
    </script>

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

<?php
$id = $_REQUEST["id"];

require_once("../lib/MYDB.php");
$pdo = db_connect();

try {
    $sql = "select * from phptest.member where id=?";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(1, $id, PDO::PARAM_STR);
    $stmh->execute();
    $count = $stmh->rowCount();

} catch (PDOException $Exception) {
    print "오류: " . $Exception->getMessage();
}

if ($count < 1){
    print "검색 결과가 없습니다.<br>";
}else {
while ($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
$hp = explode("-", $row["hp"]); // 구분문자 , 대상 문자열 == > 해당 핸드폰 번호를 쪼개준다. 배열 형태로 쪼개짐
$hp2 = $hp[1]; // 010 은 고정시켰기 때문에 index 1 부터 시작
$hp3 = $hp[2];

$email = explode("@", $row["email"]); // @ 를 기준으로 쪼개진다 .
$email1 = $email[0];
$email2 = $email[1];

?>
<body>
<div id="wrap">
    <div id="header">
        <?php include "../lib/top_login2.php"; ?>
    </div> <!-- end of header -->

    <div id="menu">
        <?php include "../lib/top_menu2.php"; ?>
    </div>

    <div id="content">
        <div id="col1"> <!-- 사이드 메뉴 부분 -->
            <div id="left_menu">
                <?php include "../lib/left_menu.php"; ?>
            </div>
        </div> <!-- end of col1 -->

        <div id="col2">
            <form name="member_form" method="post" action="updatePro.php?id=<?= $id ?>">
                <div id="title">
                    <img src="../img/title_member_modify.gif">
                </div>
                <div id="form_join">
                    <div id="join1">
                        <ul>
                            <li>*아이디</li>
                            <li>*비밀번호</li>
                            <li>*비밀번호 확인</li>
                            <li>*이름</li>
                            <li>*닉네임</li>
                            <li>*휴대폰</li>
                            <li>&nbsp; &nbsp; &nbsp; &nbsp; 이메일</li>
                        </ul>
                    </div> <!-- end of join -->

                    <div id="join2">
                        <ul>
                            <!-- 아이디는 수정할 수 없게 하겟다는 말 -->
                            <li><?= $row["id"] ?></li>
                            <!--value 로 값을 지정할 수 있음 .-->
                            <li><input type="password" name="pass" value="<?= $row["pass"] ?>" required></li>
                            <li><input type="password" name="pass_confirm" value="<?= $row["pass"] ?>" required></li>
                            <li><input type="text" name="name" value="<?= $row["name"] ?>" required></li>
                            <li>
                                <div id="nick1"><input type="text" name="nick" value="<?= $row["nick"] ?>" required>
                                </div>
                            </li>
                            <li><input type="text" class="hp" name="hp1" value="010">-<input type="text" class="hp"
                                                                                             name="hp2"
                                                                                             value="<?= $hp2 ?>">-<input
                                        type="text" class="hp" name="hp3" value="<?= $hp3 ?>"></li>
                            <li><input type="text" id="email1" name="email1" value="<?= $email1 ?>">@<input type="text"
                                                                                                            name="email2"
                                                                                                            value="<?= $email2 ?>">
                            </li>
                        </ul>
                    </div>
                    <?php }
                    } ?>
                    <div class="clear"></div>
                    <div id="must"> * 는 필수 입력 항목입니다.</div>
                </div>

                <div id="button"><a href="#"><img src="../img/button_save.gif" onclick="check_input()"></a>&nbsp; &nbsp;
                    <button href="#" onclick="reset_form()"> 리셋하기</button>
                    <button><a href="../index.php">취소하기</a></button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>




