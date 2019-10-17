<? session_start();
ob_start(); ?>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->

    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>
    <style type="text/css">
        body {
            margin: 0 auto;
            background-color: #fff;
        }

        /* 화면 너비 1024픽셀 이상 */
        #auto_size {
            width: 100%;
            margin: 0 auto;
        }

        .box1 {
            margin: 0;
            width: 20%;
            height: 100%;
            float: left;
        }

        .box2 {
            margin: 0;
            width: 60%;
            height: 100%;
            float: left;
        }

        .box3 {
            clear: both;
        }


        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .box1 {
                margin: 0;
                width: 5%;
                height: 100%;
                float: left;
            }

            .box2 {
                margin: 0;
                width: 90%;
                height: 100%;
                float: left;
            }

            .box3 {
                clear: both;
            }
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {
            .box1 {
                margin: 0;
                width: 2%;
                height: 100%;
                float: left;
            }

            .box2 {
                margin: 0;
                width: 96%;
                height: 100%;
                text-align: left;
                float: left;
            }

            .box3 {
                clear: both;
            }
        }
    </style>

</head>

<?
///////////////////////////////
$user_id = $_SESSION['user_id'];
///////////////////////////////
$ctg = $_GET['ctg'];

include '../lib/connect.php';

    $connect = dbconn();
    $member = member_info();
    $cinfo = co_info(); //회사정보
    $query = "select * from member where user_id='$user_id' ";
    mysqli_query($connect, "set names utf8");
    $result = mysqli_query($connect, $query);
    $member = mysqli_fetch_array($result);

?>


<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0' TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">


<!---///////////////////////////////////[테이블 시작]//////////////////////////////////////////////////----->
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
    <TR>
        <!-------------[[상단 로고/카페고리1]]------------->
        <TD WIDTH='100%' HEIGHT='105' ALIGN='CENTER' VALIGN='TOP'>
            <iframe src="../sub_page/top.php" name='top' width='100%' HEIGHT='105' frameborder='0' marginwidth='0'
                    marginheight='0' scrolling='no'>
            </iframe>
        </TD>


        <!------------ 상단 카테고리 2----------->
    <TR>
        <TD WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
            <iframe src="../sub_page/top_category.php?ctg=<?= $ctg ?>" name='top_category' width='100%' HEIGHT='30'
                    frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
            </iframe>
        </TD>


    <TR>
        <!-------------[[중앙 내용]]------------->
        <TD WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>

            <DIV ID="auto_size">
                <div class="box1">&nbsp;</div>
                <div class="box2">
                    <table border='0' width='100%' height='100%' bgcolor='#EEEEEE'>
                        <tr>
                            <td align='center' height='30'><b><span color='blue'> [<?= $cinfo[co_title] ?>] 회원탈퇴</span></b>
                            </td>

                        <tr>
                            <td height='120' align='center'>
                                <br><br><br>
                                그동안 '<?= $cinfo['co_title'] ?>' 과 함께 하셨는데 아쉽네요.<br>
                                <b><span color="blue"><?= $member['name'] ?></span></b>님 언제든 제 가입이 가능합니다.<br>
                                '<b><?= $cinfo['co_title'] ?></b>' 사랑해주셔서 감사합니다.<br>
                            </td>


                            <form action='userIDdel_post.php' method=post>
                                <input type='hidden' name='mID' value="<?= $member[mID] ?>">
                                <input type='hidden' name='language' value="<?= $member[language] ?>">
                                <input type='hidden' name='id' value="<?= $member[id] ?>">
                                <input type='hidden' name='no' value="<?= $member[no] ?>">
                                <input type='hidden' name='name' value="<?= $member[name] ?>">
                                <input type='hidden' name='email' value="<?= $member[email] ?>">
                                <input type='hidden' name='sex' value="<?= $member[sex] ?>">
                                <input type='hidden' name='tel' value="<?= $member[tel] ?>">
                                <input type='hidden' name='mphone'
                                       value="<?= $member[mphone_1] . '-' . $member[mphone_2] . '-' . $member[mphone_3] ?>">
                                <input type='hidden' name='mphone_for' value="<?= $member[mphone_for] ?>">
                                <input type='hidden' name='addr'
                                       value="<?= $member[addr_1] . '&nbsp;' . $member[addr_2] ?>">
                                <input type='hidden' name='addr_for' value="<?= $member[addr_for] ?>">
                                <input type='hidden' name='first_regdate' value="<?= $member[regdate] ?>">
                        <tr>

                            <td height='100%' align='left' bgcolor='#CFCFCF'>
                                &nbsp; &nbsp; &nbsp;
                                <span color='red'>회원탈퇴를 위해 아래 정보가 필요 합니다. </span> <br><br>
                                &nbsp;
                                ⊙ 회원아이디: <b><?= $member['user_id'] ?></b>
                                <br><br>
                                &nbsp;
                                ⊙ 생년월일: <input type=text name=birth size=10>
                                <br> <span color=red>*회원가입 당시 입력했던 생년월일을 입력하세요.</span>
                                <br><br>
                                &nbsp;
                                ⊙ 회원비밀번호: <input type=password name=pw size=15>
                                <br><span color=red>*회원비밀번호를 정확히 입력해 주세요.</span>
                            </td>

                        <tr>
                            <td align='center' height='30' bgcolor="#FFF">
                                <span color=red>탈퇴하시면 7일 동안 같은 계정 ID로 재 가입이 불가능 합니다.</span>
                            </td>
                        </tr>


                        <tr>
                            <td align='center' height='30'>
                                <input type='submit' value='완료'>
                                </form>
                            </td>
                        </tr>

                        <tr>
                            <td align=center height=100%>
                                &nbsp;
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="box1">&nbsp;</div>
                <div class="box3">&nbsp;</div>

            </DIV>


        </TD>  <!-------------[[중앙 내용 (끝)]]------------->
    </TR>  <!---- 본문내용 테이블_1(/TR)----->


    <TR>
        <!------------  하단 마커 --------------------->
        <TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?= $setup[marker_c] ?>' VALIGN='BOTTOM'>
            <iframe src="../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </TD>
    </TR>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->