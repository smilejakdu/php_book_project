<? session_start();
ob_start(); ?>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta http-equiv="imagetoolbar" CONTENT="no"> <!--====이미지 저장하는 툴바 없애기==-->
    <?
    include '../../lib/connect.php';
    $connect = dbconn();
    $member = member_info();
    $_co = co_info(); //회사정보
    ?>

    <title><? echo $top_title = $ctgs_name . '- Del'; ?></title>
    <link rel='stylesheet' type='text/css' href='../../lib/style.css'/>


    <style type="text/css">
        /* 화면 너비 960픽셀 이상 */
        #ex-wrap {
            width: 100%;
            margin: 0 auto;
        }

        .mode1 {
            margin: 0;
            width: 100%;
            float: left;
            display: block;
        }

        .mode2 {
            margin: 0;
            width: 100%;
            display: none;
        }


        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .mode1 {
                margin: 0;
                float: left;
                display: none;
            }

            .mode2 {
                margin: 0;
                width: 100%;
                float: left;
                display: block;
            }
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {
            .mode1 {
                margin: 0;
                float: left;
                display: none;
            }

            .mode2 {
                margin: 0;
                width: 100%;
                float: left;
                display: block;
            }
        }
    </style>

</head>

<?
/////////////[받기]///////////////////////////////////
/////////////////////////////////////
$user_id = $_SESSION['user_id'];
//////////////////////////////////
//////////////////////////////////
$ctg = $_GET['ctg'];
$ctgs = $_GET['ctgs'];
$b_ID = $_GET['b_ID'];
///////////////////////////////////////////////////


$query = "select * from member where user_id='$user_id' ";
mysqli_query($connect, "SET NAMES utf8");
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);


$query = "select * from bbs1 where b_ID='$b_ID' ";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

$ctg = $data['ctg'];
$ctgs = $data['ctgs'];


if (!$data[no]) Error('존재하지 않는 게시물입니다.');
if ($member['mID'] != $data['mID']) Error('자신의 글만 삭제 가능합니다.');

?>
<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0' TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">


<!---///////////////////////////////////[테이블 시작]//////////////////////////////////////////////////----->
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
    <TR>
        <!-------------[[상단 로고/카페고리1]]------------->
        <TD WIDTH='100%' HEIGHT='105' ALIGN='CENTER' VALIGN='TOP'>
            <? include("../../sub_page/top2.php"); ?>
        </TD>


        <!------------ 상단 카테고리 2----------->
    <TR>
        <TD WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
            <? include("../../sub_page/top_category2.php"); ?>
        </TD>


    <TR>
        <!-------------[[중앙 내용]]------------->
        <TD WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>


            <P>&nbsp;</P>
            <P>&nbsp;</P>

            <table border='0' width='70%' align='center' cellspacing='0' cellpadding='0'>
                <form action='del_post.php' method=post>
                    <input type='hidden' name='b_ID' value='<?= $data['b_ID'] ?>'>
                    <input type='hidden' name='pw' value='<?= $member['pw'] ?>'>


                    <tr>
                        <td height='120' align='center' bgcolor='#EEEEEE'>
                            해당글을 삭제 하시겠습니까?<br><br>
                            삭제하면 복구는 되지 않습니다.
                        </td>


                    <tr>
                        <td height="50" bgcolor='#FFFFFF'>&nbsp;</td>


                    <tr>
                        <td align=center>
                            <input type='image' src='./image/del_s.gif' onclick="Submit();">
                </form>
                &nbsp; &nbsp;
                <img src='./image/cancel_s.gif' onclick="history.back(-1)">
                </td>

                <tr>
                    <td height='100' align='right'>
                        <br>
                        &nbsp;
                    </td>
                </tr>
            </table>

            <?
            // foot();
            ?>

        </TD>  <!-------------[[중앙 내용 (끝)]]------------->
    </TR>  <!---- 본문내용 테이블_1(/TR)----->


    <TR>
        <!------------  하단 마커 --------------------->
        <TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?= $setup['marker_c'] ?>' VALIGN='BOTTOM'>
            <iframe src="../../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </TD>
    </TR>
</TABLE>
<!---- 본문내용 테이블_1(/TABLE)----->