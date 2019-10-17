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

        .message {
            padding: 10px 10px;
            width: 95%;
            height: 90%;
            border: 1px solid #CDCDCD;
            text-align: left;
        }

        .subject {
            padding: 10px 30px;
            font-family: 굴림, 돋움;
            font-size: 15px;
            color: #c2b161;
            font-weight: bold;
        }

        .content {
            font-family: 굴림, 돋움;
            font-size: 9pt;
            color: #565656;
        }
    </style>

    <!-- 링크시 테두리선 안보이게-->
    <style>
        a {
            selector-dummy: expression(this.hideFocus=true);
        }  </style>
    <!-- 링크시 ,,,,  End-->
</head>

<?
///////////////////////////////
$user_id = $_SESSION['user_id'];
///////////////////////////////
$ctg = $_GET['ctg'];
$no = $_GET['no'];

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
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
            <hr size='0.1' width='100%' color='#E4E4E4'/>
            <br>

            <? if (!$member['user_id']) {  //회원아이디가 없다면 로그인 (끝) /////?>
                <iframe name='top' src="./login_box.php" name='top' width='100%' HEIGHT='430' frameborder='0'
                        marginwidth='0' marginheight='0' scrolling='no'>
                </iframe>
                <? exit;
            } ?>

            <DIV ID="ex-wrap">
                <div class="box1">&nbsp;</div>
                <div class="box2">
                    <table border='0' cellspacing='0' cellpadding='0' width='100%' height='100%' align='center'
                           valign='top'>
                        <tr>
                            <td width='100%' height='10' align='center' valign='middle' bgcolor='#FFFFFF'>&nbsp;</td>

                        <tr>
                            <td width='100%' height='40' align='center' valign='middle' bgcolor='#6E9086'>
<span style='font-size:10pt; font-family:돋움; color:#FFFFFF;'>
<strong>MY MESSAGE LIST</strong></span>
                            </td>


                        <tr>
                            <?
                            // 메세지 확인 채크하기 //
                            $query_2 = "update message set 
			    checks='OK'
				where no='$no' ";
                            mysqli_query($connect, "SET NAMES utf8");
                            mysqli_query($connect, $query_2);


                            // 자신의 메세지 글 불러 오기
                            $query = "select * from message where to_mID='$member[mID]' and  no='$no' order by no asc  ";
                            mysqli_query($connect, "SET NAMES utf8");
                            $result = mysqli_query($connect, $query);
                            $message = mysqli_fetch_array($result);
                            ?>
                            <td width='100%' height='100%' align='center' valign='top' bgcolor='#FFFFFF'
                                class="message">
                                <div class="subject"><?= $message['subject']; ?></div>
                                <br>
                                <font class="content"><?= $message['content']; ?></font>
                            </td>

                        <tr>
                            <td width='100%' height='40' align='center' valign='middle' bgcolor='#FFFFFF'>
                                <a href="./my_message.php?ctg=members" onfocus="this.blur()">목록</a>
                                &nbsp; &nbsp;| &nbsp; &nbsp;
                                <a href="./my_message_del.php?no[]=<?= $message[no] ?>&bbs[]=<?= $message['bbs'] ?>"
                                   onfocus="this.blur()" onclick="return confirm('해당 메시지를 정말로 삭제 하겠습니까?\n');">삭제</a>
                            </td>

                        <tr>
                            <td width='100%' height='100%' align='center' valign='middle' bgcolor='#FFFFFF'>&nbsp;</td>
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