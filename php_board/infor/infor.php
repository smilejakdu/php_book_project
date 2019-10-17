<? session_start();
ob_start();

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$setup = setup();
$cinfo = co_info(); //회사정보
$device_mode = device_mode();  //기기 접속모드

$ctg = $_GET['ctg'];
$ctgs = $_GET['ctgs'];

$query = "select * from member where no='$no' ";
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);

?>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--한글로 구성:UTF-8-->
    <meta http-equiv="imagetoolbar" CONTENT="no">
    <link type='text/css' HREF='../lib/style.css' rel='stylesheet'/>
    <title><? echo $top_title = "Introduce"; ?></title>

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

        .box1 {
            width: 20%;
            height: 100%;
            margin: 0;
            float: left;
            display: block;
        }

        .box2 {
            width: 60%;
            height: 100%;
            margin: 0;
            float: left;
            display: block;
        }

        .box3 {
            display: none;
        }

        .contents_end {
            clear: both;
        }

        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .box1 {
                width: 10%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

            .box2 {
                width: 80%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

            .box3 {
                display: none;
            }
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {
            .box1 {
                width: 3%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

            .box2 {
                width: 94%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

            .box3 {
                display: none;
            }
        }


        .td_1 {
            padding: 0px;
            width: 100%;
            height: 40pt;
        }

        .page_title {
            padding-top: 1px;
            width: 150px;
            height: 15px;
            font-size: 9pt;
            font-family: 돋움;
            color: #8f8e8e;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #c3c2c1;
        }

        .text_box {
            padding-left: 10px;
            border: 1px solid #A9A9A9;
        }

        .text1 {
            text-align: center;
            font-size: 11pt;
            font-family: 돋움;
            color: #DD8080;
        }
    </style>

</head>


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


            <?
            if ($ctg == 'infor' and $ctgs == '1') {
                $title = "회사소개";
            }  //회사소개
            ?>


            <DIV ID="ex-wrap">
                <div class="box1">&nbsp;</div>
                <div class="box2">
                    <table border='0' width="100%" height="100%" align='center' cellspacing='0' cellpadding='0'
                           border='0'>
                        <tr>
                            <td align='right' class='td_1'>
                                <!--회사소개 -->
                                <div style="page_title"><?= $title; ?></div>
                        </tr>

                        <tr>
                            <td width="100%" class="text_box">
                                <?php
                                ////////// 회사소개 /////////////
                                if ($ctg == "infor" and $ctgs == '1'){
                                ?>
                                <div class='text1'>UN soft & xeronote</div>
                                <br>
                                <li> 울산
                                <li> 최대할인
                                <li> 호갱만들지 않기
                                <li> 소비를 해야한다면
                                <li> 똑똑하게 소비하자
                                    <br><br>
                                    항상 고객을 생각하는 <strong>unsoft ( 대표 : 김상윤 )</strong>가 되겠습니다.
                                    <br><br><br>
                                    - 번호 : 010-1004-8282 <br>
                                    - 카카오톡: 1004 <br>
                                    - 회사위치: 서울시 좋은 아파트 1004호
                                    <?php } ?>
                        </tr>

                        <tr>
                            <td width="100%" height="100%">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="box1">&nbsp;</div>
                <div class="contents_end">&nbsp;</div>
            </DIV>
            <!-------------((본문끝))------------->


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