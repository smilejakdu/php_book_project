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
<body>
<div id="wrap">
    <div id="header">
        <?php include "../lib/top_login2.php"; ?>
    </div> <!-- end of header -->

    <div id="menu">
        <?php include "../lib/top_menu2.php"; ?>
    </div> <!-- end of menu -->

    <div id="content">
        <div id="col1">
            <div id="left_menu">
                <?php include "../lib/left_menu.php"; ?>
            </div>
        </div> <!-- end of col1 -->

        <div id="col2">
            <form name="member_form" method="post" action="insertPro.php">
                <div id="title">
                    <img src="../img/title_join.gif">
                </div> <!-- end of title -->
                <div id="form_join">
                    <div id="join1">
                        <ul>
                            <li>* 아이디</li>
                            <li>* 비밀번호</li>
                            <li>* 비밀번호 확인</li>
                            <li>* 이름</li>
                            <li>* 닉네임</li>
                            <li>* 휴대폰</li>
                            <li>&nbsp;&nbsp;&nbsp;이메일</li>
                        </ul>
                    </div>
                    <div id="join2">
                        <ul>
                            <li>
                                <div id="id1"><input type="text" name="id" required></div>
                                <!-- 아이디 중복확인 -->
                                <div id="id2"><a href="#"><img src="../img/check_id.gif" onclick="check_id()"</a></div>

                                <div id="id3">4~12자의 영문 소문자,
                                    숫자와 특수기호(_)만 사용할 수 있습니다.
                                </div>
                            </li>
                            <li><input type="password" name="pass" required></li>
                            <li><input type="password" name="pass_confirm" required></li>
                            <li><input type="text" name="name" required></li>
                            <li>
                                <div id="nick1"><input type="text" name="nick" required></div>
                                <div id="nick2"><a href="#"><img src="../img/check_id.gif" onclick="check_nick()"></a>
                                </div>
                            </li>
                            <li><input type="text" class="hp" name="hp1" value="010">
                                - <input type="text" class="hp" name="hp2"> -
                                <input type="text" class="hp" name="hp3"></li>
                            <li><input type="text" id="email1" name="email1"> @
                                <input type="text" name="email2"></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <div id="must"> * 는 필수 입력항목입니다.^^</div>
                </div>
                <!-- 저장하기 버튼과 취소하기 버튼 -->
                <div id="button"><a href="#">
                        <button onclick="check_input()">가입하기</button>
                    </a>&nbsp;&nbsp;
                    <a href="#"><img src="../img/button_reset.gif" onclick="reset_form()"></a>
                </div>
            </form>
        </div> <!-- end of col2 -->
    </div> <!-- end of content -->
</div> <!-- end of wrap -->
</body>
</html>