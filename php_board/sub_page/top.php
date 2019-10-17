<? session_start();
include '../lib/connect.php';
$connect = dbconn();
$member = member_info();

?>

<!DOCTYPE HTML>
<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--한글로 구성:UTF-8-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>

    <LINK REL="StyleSheet" HREF="../lib/style.css" type="text/css">  <!---(글자스타일 변경)--->

    <style type="text/css">
        body {
            margin: 0 auto;
            background-color: #fff;
        }


        /* 화면 너비 960픽셀 이상 */
        #ex-wrap {
            width: 100%;
            margin: 0 auto;
        }

        .td0 {
            float: left;
            display: none;
        }

        /*상단여백 (모바일)*/
        .td1 {
            width: 100%;
            height: 105px;
            margin: 0;
            float: left;
        }

        /* 로그인 (PC)*/
        .td2 {
            display: none;
        }

        /*로고 (모바일)*/


        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .td0 {
                margin: 0;
                width: 100%;
                height: 5px;
                background-color: #3d3930;
                display: block;
            }

            /*상단여백 (모바일)*/
            .td1 {
                display: none;
            }

            /* 로그인 (PC)*/
            .td2 {
                margin: 0;
                width: 100%;
                height: 100px;
                display: block;
            }

            /*로고 (PC)*/
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {
            .td0 {
                margin: 0;
                width: 100%;
                height: 5px;
                background-color: #3d3930;
                display: block;
            }

            /*상단여백 (모바일)*/
            .td1 {
                display: none;
            }

            /* 로그인 (PC)*/
            .td2 {
                margin: 0;
                width: 100%;
                height: 100px;
                display: block;
            }

            /*로고 (PC)*/

        }


        .log_1 {
            height: 30px;
            background: #B2AFAD;
            text-align: center;
            vertical-align: middle;
            -webkit-border-radius: 10px 0px 0px 10px; /* for Firefox */
            -moz-border-radius: 10px 0px 0px 10px; /* for Safari and chrome */
            border-radius: 10px 0px 0px 10px; /* CSS3 */
        }

        .log_2 {
            width: 95%;
            height: 30px;
            padding-right: 5px;
            background: #B2AFAD;
            text-align: right;
            vertical-align: middle;
            border-radius: 0px 10px 10px 0px;
        }


        .login_font a {
            font-family: 굴림, Tahoma;
            font-size: 9pt;
            color: #787878;
        }

        /*로그인*/
        #join_font {
            font-size: 9pt;
            font-family: 굴림, Tahoma;
            font-weight: bold;
            color: #DB7BFF
        }
    </style>


</HEAD>
<body oncontextmenu="return false">
<!---/////////////////////////[[상단 TOP 시작]]/////////////////////////--->

<DIV ID="ex-wrap">

    <div class="td0">&nbsp;<!--모바일--></div>

    <div class="td1"><!--PC-->
        <table border='0' cellspacing='0' cellpadding='0' width='100%' height='30' align="center" valign="top">
            <tr>
                <td width='70%' height="30" align="right" bgcolor='#121031'>
                    <a href='../member/my_page_view.php?ctg=members' OnFocus="this.blur()" target='_top'>
                        <span style='font-size:9pt; font-family:Tahoma; color:#8A8989'>마이페이지</span></a>
                    &nbsp; &nbsp;

                    <? if (!$member['user_id']) { //////로그인이 되지 않았다면 회원가입/아이디,비번찾기실행..?>
                        <a href="../member/login_page.php" OnFocus="this.blur()" target='_top'>
                            <span style='font-size:9pt; font-family:Tahoma; color:#FFFFFF'>로그인</span></a>
                        &nbsp; &nbsp;
                        <a href="../member/join.php?ctg=members" OnFocus="this.blur()" target='_top'>
                            <FONT style="COLOR:#FFFFFF; font-size:9pt; font-family:굴림,Arial">회원가입</font></a>
                        &nbsp; &nbsp;
                        <a href="../member/search_myuser.php?ctg=members" OnFocus="this.blur()" target='_top'>
                            <FONT style="COLOR:#F21443; font-size:9pt; font-family:굴림,Arial">ID&nbsp;비밀번호 찾기</font></a>
                        &nbsp; &nbsp;
                    <? } ?>
                </td>
                <td width='25%' height="30" align="left" bgcolor='#121031'>
                    <? if ($member['user_id']) {
                        include "../member/profile_box.php";
                    } ?>
                </td>
                <td width='5%' height="30" align="right" bgcolor='#121031'>&nbsp</td>
            </tr>


            <tr>
                <td width='100%' height="75" colspan="3" align="center" valign='middle' bgcolor='#D8C494'>
                    <a href="../main.php" target='_top' OnFocus="this.blur()">
                        <img src="../image/xeronote.jpg" width='213' height='52' border='0' alt='HOM'></a>
                </td>
            </tr>
        </table>
    </div>


    <div class='td2'>
        <table border='0' style="width:100%; height:100px" cellspacing='0' cellpadding='0' align="center" valign='top'
               bgcolor='#D8C494'>
            <tr>
                <td style="width:100%; height:60px" colspan="4" align="center" valign="middle" bgcolor='#D8C494'>
                    <a href="../main.php" target='_top' OnFocus="this.blur()"><img src="../image/xeronote.jpg"
                                                                                   width='213' height='52' border='0'
                                                                                   alt='HOM'></a>
                </td>

            <tr>
                <td style="width:2%; height:35px">&nbsp;</td>
                <td style="width:4%; height:35px" align='cneter' class='log_1'>
                    <img src='../image/_air.png' height='18'></td>

                <td style="width:88%; height:35px" align='left' class='log_2'>
                    <? if ($member['user_id']){ ?>
                        <iframe src="../member/_profile_box.php" target="_top" name='top' width='100%' HEIGHT='35'
                                frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
                        </iframe>
                    <? }else{ ?>
                    <font class='login_font'>
                        <a href="../member/login_page.php" target='_top' OnFocus="this.blur()">
                            <font class='login_font'>로그인</font></a>
                        &nbsp; &nbsp;
                        <a href="../member/join.php?ctg=members" target='_top' OnFocus="this.blur()">회원가입</a>
                        &nbsp; &nbsp;
                        <? } ?>
                </td>
                <td style="width:6%; height:35px">&nbsp;</td>

            <tr>
                <td style="width:100%; height:5px" colspan="4">&nbsp;</td>
            </tr>
        </table>

    </div>

</DIV>