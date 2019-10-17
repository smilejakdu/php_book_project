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


        .font_1 {
            font-size: 11pt;
            font-family: 굴림, Tahoma;
            color: #A6A49F;
        }

        .tds {
            border: 1px solid #C7C8C8;
        }
    </style>
</head>

<?
include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$cinfo = co_info(); //회사정보

$ctg = $_GET['ctg'];
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

                    <p>&nbsp;</p>

                    <!----- [[아이디 찾기]] -------------->
                    <table border='0' width='100%' height='100%' align='center' cellspacing='0' cellpadding='0'
                           class='tds'>
                        <tr>
                            <td align='center' bgcolor='FFFFFF' height='30' colspan='2'>&nbsp;</td>

                        <tr>
                            <form action='./search_myuser_result.php' name='search_id' method='post'>
                                <input type='hidden' name='wheres' value='search_id'>
                                <td height='30' align='center' colspan='2'>
                                    <div class='font_1'><strong>아이디 찾기</strong>

                        <tr>
                            <td height='20' align='center' colspan='2'>
                                *조건이 맞으면 아이디를 찾을수 있습니다.

                        <tr>
                            <!---------  이름------->
                            <td height='30' width='20%' align='center'>이름</td>

                            <td width='80%'>
                                <input type='text' name='name' size=15>
                            </td>


                        <tr>
                            <!---------이메일------->
                            <td height='30' align='center'>Email</td>

                            <td>
                                <input type=text name=email size=22>
                            </td>

                        <tr>
                            <!---------  생년월일------->
                            <td height='30' align='center'>생년월일</td>
                            <td>
                                <input type=text name=birth size=10 maxlength=8> &nbsp; &nbsp; 예> 8자리 <b>20130101</b>
                            </td>

                        <tr>
                            <td height='40' align='center' colspan='2'>
                                <input type='submit' value='아이디 찾기'>
                                &nbsp; &nbsp;
                                <input type='button' value='취소' onclick="history.back(1); return false">
                            </td>
                            </form>
                        </tr>
                    </table>

                    <div style="height:30px">&nbsp;</div>


                    <table border='0' width='100%' height='100%' align='center' cellspacing='0' cellpadding='0'
                           class='tds'>
                        <tr>
                            <td align='center' bgcolor='FFFFFF' height='30' colspan='2'>&nbsp;</td>
                            <!------------------------ [[비밀번호 찾기 찾기]] ----------------------------------->
                        </tr>
                            <td height='20' align='center' colspan='2'>&nbsp;</td>

                        <tr>
                            <form action='./search_myuser_result.php' name='search_pw' method='post'>
                                <input type='hidden' name='wheres' value='search_pw'>
                                <td height='30' align='center' colspan='2'>
                                    <span class='font_1'><strong>비밀번호 찾기</strong></span>
                                </td>
                        </tr>
                            <td height='20' align='center' colspan='2'>
                                <!----------  비밀번호 찾기--------->
                                * 조건이 맞으면 새로운 비밀번호를 부여 받으실수 있습니다.
                            </td>
                        <tr>
                            <!----------  아이디--------->
                            <td height='30' width='20%' align='center'>아이디</td>

                            <td width='80%'><input type='text' name='user_id' size='15'></td>
                        </tr>
                            <!----------  이메일--------->
                            <td height='40' align='center'>Email</td>
                            <td height='40'>
                                이메일로 임시 비번번호가 전송이 됩니다.<br>
                                <input type='text' name='email' size='22'>
                            </td>
                        <tr>
                            <!----------  생년월일 --------->
                            <td height='30' align='center'>생년월일</td>
                            <td>
                                <input type='text' name='birth' size='10' maxlength='8'> &nbsp; &nbsp; 예) 8자리 <b>20130101</b>
                            </td>


                        </tr>
                            <!----------  찾기--------->
                            <td height='40' align='center' colspan='2'>
                                <input type='submit' value='비밀번호 찾기'>
                                &nbsp; &nbsp;
                                <input type='button' value='취소' onclick="history.back(1); return false">
                            </td>
                            </form>
                        <tr>
                            <td align='right' height='100%' colspan='2'>&nbsp;</td>
                        </tr>
                    </table>
                    <div class="box1">&nbsp;</div>
                    <div class="box3">&nbsp;</div>


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