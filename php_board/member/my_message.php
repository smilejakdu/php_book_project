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
        #ex-wrap {
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


        /* 화면 너비 801픽셀 ~ 1024픽셀 */
        @media screen and (max-width: 1024px) {
            .box1 {
                margin: 0;
                width: 15%;
                height: 100%;
                float: left;
            }

            .box2 {
                margin: 0;
                width: 70%;
                height: 100%;
                float: left;
            }

            .box3 {
                clear: both;
            }
        }


        /* 화면 너비 481픽셀 ~ 800픽셀 */
        @media screen and (max-width: 960px) {
            .box1 {
                margin: 0;
                width: 10%;
                height: 100%;
                float: left;
            }

            .box2 {
                margin: 0;
                width: 80%;
                height: 100%;
                float: left;
            }

            .box3 {
                clear: both;
            }
        }


        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .box1 {
                margin: 0;
                width: 8%;
                height: 100%;
                float: left;
            }

            .box2 {
                margin: 0;
                width: 84%;
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
                float: left;
            }

            .box3 {
                clear: both;
            }
        }


        .text_1 {
            font-family: 굴림, 돋움;
            font-size: 10pt;
            color: #565656;
            text-decoration: none;
        }

        .text_2 {
            font-family: 굴림, 돋움;
            font-size: 9pt;
            color: #9F9C9C;
            text-decoration: none;
        }

        .new {
            font-family: 굴림, 돋움;
            font-size: 8pt;
            color: #FF00FF;
            text-decoration: none;
        }

        .del {
            font-family: 굴림, 돋움;
            font-size: 8pt;
            color: #714E09;
            text-decoration: none;
        }


        a {
            selector-dummy: expression(this.hideFocus=true); /*링크선 안보이기*/
        }
    </style>


    <script>
        function message_submit() {
            document.message_del.submit();
        }
    </script>

</head>

<?
///////////////////////////////
$user_id = $_SESSION['user_id'];
///////////////////////////////
$ctg = $_GET['ctg'];

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();

$user_id = $member['user_id'];
$mID = $member['mID'];


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
            <hr size='0.1' width='95%' color='#E4E4E4'/>
            <br>

            <? if (!$user_id) {  //회원아이디가 없다면 로그인 (끝) /////?>
                <iframe name='top' src="./login_box.php" name='top' width='100%' HEIGHT='430' frameborder='0'
                        marginwidth='0' marginheight='0' scrolling='no'>
                </iframe>
                <? exit;
            } ?>

            <DIV ID="ex-wrap">
                <div class="box1">&nbsp;</div>
                <div class="box2">
                    <table border='0' cellspacing='0' cellpadding='0' width='100%' height='40' align='center'
                           valign='top'>
                        <tr>
                            <td colspan='4' width='100%' height='20' align='center' valign='middle' bgcolor='#FFFFFF'>
                                &nbsp;
                            </td>

                        <tr>
                            <td colspan='4' width='100%' height='30' align='center' valign='middle' bgcolor='#FFFFFF'>
<span style='font-size:10pt; font-family:돋움; color:#6E9086;'>
<strong>MY MESSAGE LIST</strong></span>
                            </td>


                        <tr>
                            <td width='10%' height='20' align='center' valign='middle' bgcolor='#6E9086' class='text_1'>
                                &nbsp;
                            </td>
                            <td width='10%' height='20' align='center' valign='middle' bgcolor='#6E9086' class='text_1'>
                                no
                            </td>
                            <td width='60%' height='20' align='center' valign='middle' bgcolor='#6E9086' class='text_1'>
                                내용
                            </td>
                            <td width='20%' height='20' align='center' valign='middle' bgcolor='#6E9086' class='text_1'>
                                DATE
                            </td>
                            <? /// 자신의 메세지를 가지고 온다. //
                            $query = "select * from message where to_mID='$mID' order by no asc  ";  ///  보내는 사람이 자신에게 메시지를 보냈을때
                            mysqli_query($connect, "SET NAMES utf8");
                            $result = mysqli_query($connect, $query);
                            $cnt = '1';
                            while ($message = mysqli_fetch_array($result)){
                            $regdate_y = substr($message['regdate'], 2, 2);
                            $regdate_m = substr($message['regdate'], 4, 2);
                            $regdate_d = substr($message['regdate'], 6, 2);

                            $regdate_h = substr($message['regdate_time'], 0, 2);
                            $regdate_i = substr($message['regdate_time'], 2, 2);
                            ?>
                        <tr>
                            <form name="message_del" action="./my_message_del.php" method="post">
                                <input type="hidden" name="bbs[]" value="<?= $message['bbs'] ?>">


                                <td height='50' align='center' valign='middle' bgcolor='#FFFFFF'>
                                    <input type="checkbox" name="no[]" id="no" value="<?= $message[no] ?>">
                                </td>

                                <td height='50' align='center' valign='middle' bgcolor='#FFFFFF'
                                    class='text_2'><?= $cnt ?></td>
                                <td height='50' align='left' valign='middle' bgcolor='#FFFFFF' class='text_2'>
                                    <?
                                    if ($message['checks'] != "OK") {
                                        echo "<font class='new'>new</font> &nbsp;";
                                    }
                                    ?>

                                    <a href='./my_message_view.php?no=<?= $message['no'] ?>&bbs=<?= $message['bbs'] ?>&ctg=members'
                                       onfocus="this.blur()">
                                        <? echo "[";
                                        if ($message['from_nickname']) {
                                            echo $message['from_nickname'];
                                        } else {
                                            echo $message['from_name'];
                                        }

                                        echo "님의 댓글] " . $message['subject'] ?></a>
                                </td>

                                <td height='50' align='center' valign='middle' bgcolor='#FFFFFF'
                                    class='text_2'><? echo $regdate_y . "." . $regdate_m . "." . $regdate_d . "&nbsp;" . $regdate_h . ":" . $regdate_i; ?></td>

                        <tr>
                            <td colspan='4' height='10' align='center' valign='middle' bgcolor='#FFFFFF'>
                                <hr size='0.1' color='#C4D3CF' width='98%'/>
                            </td>

                            <? $cnt++;
                            } ?>
                        <tr>
                            <td colspan='4' height='40' align='center' valign='middle' bgcolor='#FFFFFF'>
                                <input type='button' value='선택삭제' onclick="message_submit();">
                            </td>
                            </form>
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
        <TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?= $setup['marker_c'] ?>' VALIGN='BOTTOM'>
            <iframe src="../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </TD>
    </TR>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->