<?php
session_start();
ob_start();
?>
<!DOCTYPE HTML>
<html lang="ko">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <script type="text/javascript" src="../../SmartEditor/js/HuskyEZCreator.js" charset="utf-8"></script>
    <link rel='stylesheet' type='text/css' href='../../lib/style.css'/>

    <?

    /////////////[받기]///////////////////////////////////
    $user_id = $_SESSION['user_id'] ?? null;
    $ctg = $_GET['ctg'] ?? null;
    $ctgs = $_GET['ctgs'] ?? null;
    $b_ID = $_GET['b_ID'] ?? null;
    ///////////////////////////////////////////////////

    if (preg_match('/a/', $ctg)) {
        $ctgs_name = "Information<br>";
    }
    if ($ctgs == 'a01') {
        $ctgs_name = "공지사항";
    }
    if ($ctgs == 'a02') {
        $ctgs_name = "문의";
    }
    if ($ctgs == 'a03') {
        $ctgs_name = "자유게시판";
    }


    if ($ctg == 'e') {
        $ctgs_name = "<br>";
    }
    if ($ctgs == 'e01') {
        $ctgs_name = "PHP게시판";
    }

    if (preg_match('/d/', $ctg)) {
        $ctgs_name = "<br>";
    }
    if ($ctgs == 'd01') {
        $ctgs_name = "레시피";
    }
    if ($ctgs == 'd02') {
        $ctgs_name = "이벤트";
    }


    //////////////////게시판 b_ID 설정 ///////////////////////////
    $times = time();
    $times_1 = date("d-Hi", $times);
    $times_2 = date("s", $times);
    $b_ID = chr(rand(97, 122)) . "Y" . $times_1 . "-" . chr(rand(97, 122)) . $times_2;
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    $_SESSION['b_ID'] = $b_ID;
    ?>


    <title><? echo $top_title = $ctgs_name . ' Write'; ?></title>

    <style type="text/css">
        BODY, TD, SELECT, input, DIV, form, TEXTAREA, center, option, pre
        blockquote {
            font-size: 9pt;
            font-family: 굴림, 돋움, Arial;
            color: #2E2D2D;
            line-height: 120%
        }

        A:link {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }

        A:visited {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }

        A:active {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }

        A:hover {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #2E2D2D;
            text-decoration: none;
        }


        body {
            margin: 0 auto;
            background-color: #fff;
        }

        /* 화면 너비 960픽셀 이상 */
        #ex-wrap {
            width: 100%;
            margin: 0 auto;
        }

        .t_rsize {
            margin: 0 auto;
            width: 85%;
        }

        .pc_mode_1 {
            width: 100%;
            height: 100%;
            margin: 0;
            float: left;
            display: block;
        }

        /* PC MODE */
        .mobile_mode_1 {
            float: left;
            display: none;
        }

        /* MOBILE_MODE_1 */


        .subject {
            width: 400px;
            height: 25px;
            float: left;
        }

        /*제목 input */
        .checkboxs1 {
            width: 150px;
            height: 35px;
            text-align: left;
            float: left;
            border: 0px solid red;
        }

        /*체크박스 */
        .checkboxs1 input {
            width: 25px;
            height: 25px;
        }


        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .t_rsize {
                margin: 0 auto;
                width: 90%;
            }

            .pc_mode_1 {
                display: none;
            }

            /* PC MODE */
            .mobile_mode_1 {
                width: 100%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

            /* MOBILE_MODE_1 */
            .subject {
                width: 80%;
                height: 25px;
                float: left;
            }

            /*제목 input */
            .checkboxs1 {
                width: 15%;
                height: 35px;
                text-align: left;
                float: left;
                font-size: 10px
            }

            /*체크박스 */
            .checkboxs1 input {
                width: 20px;
                height: 25px;
            }
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {
            .t_rsize {
                margin: 0 auto;
                width: 98%;
            }

            .pc_mode_1 {
                display: none;
            }

            /* PC MODE */
            .mobile_mode_1 {
                width: 100%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

            /* MOBILE_MODE_1 */
            .subject {
                width: 68%;
                height: 20px
            }

            /*제목 input */
            .checkboxs1 {
                width: 30%;
                height: 35px;
                text-align: left;
                float: left;
                font-size: 10px
            }

            /*체크박스 */
            .checkboxs1 input {
                width: 20px;
                height: 20px;
            }
        }


        .tds1 {
            margin-top: 7px;
            width: 100 p%;
            height: 40px;
            float: left;
        }


        #_tds {
            position: relative;
            margin: 0
        }

        #img_lis_button {
            position: absolute;
            z-index: 1;
            margin-left: -100px;
            padding-top: 10px;
        }

        .uplode_box {
            position: relative;
            margin: 0;
            padding: 0;
        }

        #file_up {
            position: absolute;
            top: 0px;
            left: 700px;
        }


        /*****
        position:relative;  //relative:기준점, absolute ,outside
        *************/


        .fn_1_box {
            margin: 0 auto;
            position: relative;
        }

        .fn_1_box .font_11 {
            font-family: 굴림, 돋움, Arial;
            font-size: 8pt;
            color: #E96DFF;
            text-decoration: none;
            position: absolute;
            left: 10px;
            top: 25px;
        }

        .fn_1_box img {
            position: absolute;
            right: 50px;
            top: 25px;
            color: #A6A6A6;
        }

        .fn_1_box font {
            position: absolute;
            right: 23px;
            top: 25px;
            color: #A6A6A6;
        }

        /* 상세정보 이미지 리사이징 */
        .img_rsizes {
            display: inline-block;
            width: auto \9 !important; /*ie8*/
            width: auto !important;
            max-width: 95%;
            height: auto !important;
        }
    </style>


</head>


<?php
include '../../lib/connect.php';
$connect = dbconn();
$member = member_info();
$_co = co_info(); //회사정보


$query = "select * from member where user_id='$user_id' ";
mysqli_query($connect, "SET NAMES utf8");
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);


// 게시판 글 불러 오기
$query = "select * from bbs1 where b_ID='$b_ID'  ";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);


///// 일반 게시판은 이것을 아래를 실행;/////
if (preg_match('/a|c|e/', $ctg)) {
    //상단 라인선/ TD색상 색상;
    if ($ctgs == 'a01' or $ctgs == 'ra01') $tdcolor = "#DCC9C3";
    if ($ctgs == 'a02' or $ctgs == 'ra02') $tdcolor = "#81A4C8";
    if ($ctgs == 'a03' or $ctgs == 'ra03') $tdcolor = "#A1B99B";
    if ($ctgs == 'c01' or $ctgs == 'rc01') $tdcolor = "#C120DE";
    if ($ctgs == 'e01' or $ctgs == 're01') $tdcolor = "#BA90DB";
}

////// 웹진형 게시판 컬러;//////
if (preg_match('/d/', $ctg)) {
    if ($ctgs == 'd01' or $ctgs == 'rd01') $tdcolor = "#CAC4AB";
    if ($ctgs == 'd02' or $ctgs == 'rd02') $tdcolor = "#CAC4AB";
}


////// 영상게시판;///////
if ($ctg == "v") {
    if ($ctgs == 'v01') $tdcolor = "#7BB7AA"; //(1);
    if ($ctgs == 'v02') $tdcolor = "#7BB7AA"; //(2);
    if ($ctgs == 'v03') $tdcolor = "#7BB7AA"; //(2);
}
?>
<!---///바디 조절 // 오른쪽 마우스 금지///--->
<body LEFTMARGIN='0' TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">


<!---///////////////////////////////////[테이블 시작]//////////////////////////////////////////////////----->
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
    <TR>
        <!-------------[[상단 로고/카페고리1]]------------->
        <TD WIDTH='100%' HEIGHT='105' ALIGN='CENTER' VALIGN='TOP'>
            <? include("../../sub_page/top2.php"); ?>
            </iframe>
        </TD>


        <!------------ 상단 카테고리 2----------->
    <TR>
        <TD WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
            <? include("../../sub_page/top_category2.php"); ?>
        </TD>


    <TR>
        <!-------------[[중앙 내용]]------------->
        <TD WIDTH='100%' HEIGHT='98%' ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>


            <DIV ID="ex-wrap">
                <table border='0' height='57' align='center' valign='top' cellspacing='0' cellpadding='0'
                       bgcolor='FFFFFF' class="t_rsize">
                    <tr>
                        <td width='100%' height='10' colspan='2'>
                            &nbsp; &nbsp;
                        </td>

                    <tr>
                        <td width='80%' height='33' align='right'>
                            &nbsp;
                        </td>

                        <td width='20%' height='33' align='right'>
                            <!--///////게시판 이름 /////////////-->
                            <? if (preg_match('/a|d|e/', $ctg)) { //일반 //?>
                                <img src="./image/logo_<?= $ctgs ?>.gif" border='0'>
                            <? } else if (preg_match('/v|p/', $ctg)) { ///////영상 /////////////;?>
                                <img src="./image/logo_<?= $ctg ?>.gif" border='0'>
                            <? } ?>
                        </td>


                    <tr>
                        <td height='10' colspan='2' valign='middle'>
                            <hr size='0.1' width='98%' color='<?= $tdcolor ?>'/>
                        </td>
                    </tr>
                </table>


                <form name='write' action='write_post.php' method='post' enctype='multipart/form-data'>
                    <input type='hidden' name='groups' value='jm1'> <!-- 그룹-->
                    <input type='hidden' name='ctg' value='<?= $ctg ?>'>
                    <input type='hidden' name='ctgs' value='<?= $ctgs ?>'>
                    <input type='hidden' name='level' value='<?= $level ?>'> <!--- 답급시--->
                    <input type='hidden' name='b_ID' value='<?= $b_ID ?>'>

                    <table border='0' cellspacing='0' cellpadding='0' align='center' class="t_rsize">
                        <tr>
                            <td height='50' colspan='2' align='center'>
                                <span style='font-size:12pt; font-family:돋움,Tahoma; color:#8C8C8C'><b>[글쓰기]</b></span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan='2' style="width:80%; height:40px">
                                <? if ($data['subject']) { ?>
                                    <input type=text name='subject' value='(re☞) <?= $data['subject'] ?>'
                                           placeholder="글 제목" class="subject"/>
                                <? } else { ?>
                                    <input type='text' name='subject' class="subject" placeholder="글 제목"/>
                                <? } ?>
            </div>

            <div class="checkboxs1">
                &nbsp;
                <input type='checkbox' name='secret' value='OK'>비밀글
            </div>


            <? if (!$member['user_id']){ //아이디가 있으면 이름과 이메일 기제부분 생략 자동출력?>
    <tr>
        <td style="height:30px">이름</td>
        <td style="height:30px"><input type='text' name='name' style="width:400px; height:25px"/></td>

    <tr>
        <td style="height:30px">E-mail</td>
        <td style="height:30px"><input type=text name='email' size=30></td>
        <?php }else{ ?>

    <tr>
        <td style="height:30px">
            <? if ($member['nickname']) { ?> Nick name <? } else { ?>이름<? } ?>
        </td>

        <td style="height:30px">
            <? if ($member['nickname']) { //만일 닉네임이 있으면 닉네임을 출력 없으면 이름을 출력
                echo $member['nickname'];
            } else {
                echo $member['name'];
            } ?>
        </td>

    <tr>
        <td style="height:30px">E-mail</td>
        <td><?= $member['email'] ?></td>

        <? } ?>



        <? if (!$member['user_id']){ //회원일경우는 비밀번호 입력할필요없게 한다. ?>
    <tr>
        <td>password</td>
        <td><input type=password name=pw size=20></td>
        <? } else { ?>
            <input type=hidden name=pw value='<?= $member['pw'] ?>'>
        <? }  //회원일경우는 비밀번호 입력할필요없게 한다.(끝) ?>

    <tr>
        <td height='30' colspan='2'>&nbsp;</td>


    <tr>
        <td colspan='2'>
            <? if ($data['Tstory']) { ?>
                <textarea name="Tstory" id="editor"
                          style="width:100%; height:500px; overflow-y:hidden; overlow-x:scroll;"><?= $data['Tstory'] ?>
	 </textarea>
            <? } else { ?>
                <textarea name="Tstory" id="editor"
                          style="width:100%; height:500px; overflow-y:hidden; overlow-x:scroll;"></textarea><? } ?>
        </td>


        <script type="text/javascript">
            /*  /////////---------   -------///////////  */
            var oEditors = [];
            nhn.husky.EZCreator.createInIFrame({
                oAppRef: oEditors,
                elPlaceHolder: "editor",
                sSkinURI: "http://<?=$_SERVER['SERVER_NAME']?>/SmartEditor/SmartEditor2Skin.html",
                htParams: {
                    bUseToolbar: true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseVerticalResizer: true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                    bUseModeChanger: true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                    //aAdditionalFontList : aAdditionalFontSet,		// 추가 글꼴 목록
                    fOnBeforeUnload: function () {
                        //alert("완료!");
                    }
                }, //boolean

                fCreator: "createSEditorInIFrame"
            });


            function pasteHTML() {
                var sHTML = document.getElementById("mmm").value;
                oEditors.getById['editor'].exec("PASTE_HTML", [sHTML]);
            }


            function postSubmit() {
                var f = document.frm;
                oEditors.getById['editor'].exec("UPDATE_CONTENTS_FIELD", []);
                f.editor.value = document.getElementById("editor").value;
                f.editor.value = document.getElementById("mmm").value;
                f.submit();
                alert("작성완료");
            }
        </script>


    <tr>
        <td height='10' colspan='2'>&nbsp;</td>
    </tr>
</table>


<div class="pc_mode_1">
    <table border='0' cellspacing='0' cellpadding='0' align='center' class="t_rsize">
        <tr>
            <td height='40' colspan='2' class='fn_1_box'>
                <hr size='0.1' color='#DBDBDB'/>
                <font class='font_11'>...........</font>
                <? if ($member['level'] <= 2) { //파일업로드는 관리자 '레벨2'부터 가능;?>
                    <a href="#" title='파일'
                       onclick="window.open('./file2_list.php?b_ID=<?= $b_ID ?>','','width=520,height=450')">
                        <img src='./image/files.gif' width='20' height='20' border='0'><font>파일</font></a>
                <? } ?>
            </td>

        <tr>
            <td height='10' colspan='2'>&nbsp;</td>

        <tr>
            <td height='100' colspan='2' valign='top' align='left' bgcolor='FFFFFF' id='_tds'>
                <iframe id='image_list' src="./image_list.php?b_ID=<?= $b_ID ?>" width='100%' height='100'
                        scrolling="no" frameborder="0" marginwidth='0'>
                </iframe>
            </td>
        </tr>
    </table>
</div>


<table border='0' height='40' cellspacing='0' cellpadding='0' align='center' class="t_rsize">
    <tr>
        <td height='100%' height='30' colspan='2' valign='middle' align='center' bgcolor='#FFFFFF'>
            <input type='hidden' value='' id='mmm' title="실지 서버에 저장할것" onfocus='pasteHTML();'>
            <input type='button' value='선택 이미지 본문에 넣기' onclick='pasteHTML();'>
        </td>

    <tr>
        <td width='100%' height='30' colspan='2'>&nbsp;</td>
    </tr>


    <tr>
        <td height='30' colspan='2' align='right'>
            <div class="mobile_mode_1">
                <? if ($member['level'] <= 5) { ?>
                    <a href="#" title='파일'
                       onclick="window.open('./_image_list.php?b_ID=<?= $b_ID ?>','','width=90%,height=600')"
                       onfocus="this.blur()">
                        <img src='./image/up_load.gif' width='20' height='20' border='0'><font>이미지</font></a>
                <? } ?>
            </div>
        </td>
    </tr>
</table>

<table border='0' align='center' cellspacing='0' cellpadding='0' class="t_rsize">
    <tr>
        <td height='30' colspan='3'>&nbsp;</td>

    </tr>
    <td align=right>
        <? if ($member['user_id']) { ?>
            <input type=hidden name='name' size=20 value='<?= $member['name'] ?>'>
            <input type=hidden name='nickname' size=20 value='<?= $member['nickname'] ?>'>
            <input type=hidden name='email' size=30 value='<?= $member['email'] ?>'>
        <? } ?>
        <input type='image' src='./image/ok_s.gif' name='susin' onclick='postSubmit();'>
        </form>
    </td>

    <td width='100' align='center'>&nbsp;</td>
    <!--  취소 전달 폼------>
    <td align='left' border=0>
        <form action='./list.php'>
            <input type=hidden name=ctg size=10 value='<?= $ctg ?>'>
            <input type=hidden name=ctgs size=10 value='<?= $ctgs ?>'>
            <input type='image' src='./image/cancel_s.gif'>
    </td>
    </form>
    <tr>
        <td height='50' colspan='3'>&nbsp;</td>

    </tr>
</table>

</body>


</html>  <!-------------[[중앙 내용 (끝)]]------------->
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