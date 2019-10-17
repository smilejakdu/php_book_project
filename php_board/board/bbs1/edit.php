<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
ob_start();
include '../../lib/connect.php';
$connect = dbconn();
$member = member_info();

///////////////////////////////////////////
$user_id = $_SESSION['user_id'];


$b_ID = $_GET['b_ID'];

$_SESSION['b_ID'] = $b_ID;
///////////////////////////////////////////

$query = "select * from member where user_id='$user_id' ";
mysqli_query($connect, "SET NAMES utf8");
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="imagetoolbar" CONTENT="no"> <!--====이미지 저장하는 툴바 없애기==-->
    <title><? echo $top_title = $ctgs_name . '- Edit'; ?></title>
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

        .mode3 {
            margin: 0 auto;
            display: none;
        }

        .subject_box {
            width: 60%;
            height: 25px;
        }

        .subject {
            width: 70%;
            height: 25px;
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

            .mode3 {
                margin: 0 auto;
                display: block;
            }

            .subject_box {
                width: 90%;
                height: 25px;
            }

            .subject {
                width: 70%;
                height: 25px;
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

            .mode3 {
                margin: 0 auto;
                display: block;
            }

            .subject_box {
                width: 100%;
                height: 25px;
            }

            .subject {
                width: 70%;
                height: 25px;
            }
        }


        /************ 하단 이미지 파일  *************/
        #_tds {
            position: relative;
            z-index: 1;
            margin: 0
        }

        #img_lis_button {
            position: absolute;
            z-index: 1;
            margin-left: -95px;
            padding-top: 10px;
        }

        /*****
        position:relative;  //relative:기준점, absolute ,outside
        *************/

        .fn_1_td {
            margin: 0 auto;
            position: relative;
        }

        .images_up {
            margin: 0 auto;
            width: 140px;
            float: left;
            background-color: #00ff99;
        }

        .images_up img {
            margin: 0 80px 0 0;
            right: 125px;
            top: -8px;
            color: #A6A6A6;
            float: left;
        }

        .images_up font {
            margin: 1px 68px 0 0;
            right: 130px;
            top: -4px;
            color: #A6A6A6;
            float: left;
        }


        .fn_1_td img {
            position: absolute;
            right: 50px;
            top: -8px;
            color: #A6A6A6;
            float: left;
        }

        .fn_1_td font {
            position: absolute;
            right: 23px;
            top: -4px;
            color: #A6A6A6;
            float: left;
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

    <script type="text/javascript" src="../../SmartEditor/js/HuskyEZCreator.js" charset="utf-8"></script>


    <script>
        function image_up() {
            a = document.editor_form.b_ID.value;
            window.open('image_up.php?b_ID=' + a, 'idc', 'width=450, height=300');
        }
    </script>

</head>
<!---///바디 조절 // 오른쪽 마우스 금지///--->
<body LEFTMARGIN='0' TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">


<?


//로그인후 사용;
if (!$member['level']) Error('글쓰기 권한이 없습니다.\r\n 로그인후 이용하세요');

$query = "select * from bbs1 where b_ID='$b_ID' ";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

$ctg = $data['ctg'];
$ctgs = $data['ctgs'];

if ($member['mID'] != $data['mID']) Error('자신의 글만 수정 가능합니다.');


///// 일반 게시판은 이것을 아래를 실행;/////
if (preg_match('/a|c|e/', $ctg)) {
    //상단 라인선/ TD색상 색상;
    if ($ctgs == "a01") $tdcolor = "#DCC9C3";
    if ($ctgs == "a02") $tdcolor = "#81A4C8";
    if ($ctgs == "a03") $tdcolor = "#A1B99B";
    if ($ctgs == "c01") $tdcolor = "#dda3e7";
    if ($ctgs == "e01") $tdcolor = "#BA90DB";
}

////// 웹진형 게시판 컬러;//////
if (preg_match('/d/', $ctg)) {
    if ($ctgs == "d01" or $ctgs == "rd01") $tdcolor = "#CAC4AB";
    if ($ctgs == "d02" or $ctgs == "rd02") $tdcolor = "#CAC4AB";
}


////// 영상게시판;///////
if ($ctg == "v") {
    if ($ctgs == "v01") $tdcolor = "#7BB7AA"; //(1);
    if ($ctgs == "v02") $tdcolor = "#7BB7AA"; //(2);
    if ($ctgs == "v03") $tdcolor = "#7BB7AA"; //(2);
}
?>

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


            <!--------  상단 -------------->
            <table border='0' width='95%' height='57' align='center' valign='top' cellspacing='0' cellpadding='0'
                   bgcolor='FFFFFF'>
                <tr>
                    <td width='100%' height='10' colspan='3'>
                        &nbsp; &nbsp;
                    </td>

                <tr>
                    <td width='80%' height='33' align='right'>
                        &nbsp;
                    </td>

                    <td width='20%' height='33' align='right' valign='top'>
                        <!--///////게시판 이름 /////////////-->
                        <? if (preg_match('/a|d|e/', $ctg)) { //일반 //?>
                            <img src="./image/logo_<?= $ctgs ?>.gif" border='0'>
                        <? } else if (preg_match('/v|p/', $ctg)) { ///////영상 /////////////;?>
                            <img src="./image/logo_<?= $ctg ?>.gif" border='0'>
                        <? } ?>
                    </td>


                <tr>
                    <td colspan='2' height='10' valign='middle'>
                        <hr size='0.1' width='100%' color='<?= $tdcolor ?>'/>
                    </td>
                </tr>
            </table>


            <form name='editor_form' action='edit_post.php' method='post' enctype='multipart/form-data'>
                <input type='hidden' name='b_ID' value='<?= $data['b_ID'] ?>'>
                <input type='hidden' name='ctg' value='<?= $data['ctg'] ?>'>
                <table border='0' width='95%' height='100%' cellspacing='0' cellpadding='0' align='center'>
                    <tr>
                        <td height='50' colspan='2' align='center'>
                            <span style='font-size:12pt; font-family:돋움,Tahoma; color:#8C8C8C'><b>[글 수정하기]</b></span>
                        </td>
                    </tr>

                    <tr>
                        <td align='center' style="width:50pt; height:30px;"><b>제 목</b></td>

                        <td style="height:30px;">
                            <div class='subject_box'>
                                <input type='text' class='subject' name='subject' value='<?= $data['subject'] ?>'>
                                <? if ($data['secret'] == "OK") { ?>
                                    <input type='checkbox' name='secret' value='OK' checked
                                           style="width:15px; height:15px;">
                                    비밀글
                                <? } ?>
                            </div>
                        </td>

                        <? if (!$member['user_id']){ //아이디가 있으면 이름과 이메일 기제부분 생략 자동출력?>
                    <tr>
                        <td align='center' style="height:30px;">이름</td>
                        <td style="height:30px;"><input type='text' name='name' value='<?= $member['name'] ?>'></td>

                    <tr>
                        <td align='center' style="height:25px;">E-mail</td>
                        <td style="height:25px;"><input type=text name=email size=30 value='<?= $member['email'] ?>'>
                        </td>
                        <? }else{ ?>
                    <tr>
                        <? if ($member['nickname']) { //만일 닉네임이 있으면 닉네임을 출력 없으면 이름을 출력?>
                            <td align='center'><b>Nickname:</b></td>
                            <td><?= $member['nickname'] ?></td>
                        <? } else { ?>
                            <td align='center' style="height:30px;">이름</td>
                            <td style="height:30px;"><?= $member['name'] ?></td>
                        <? } ?>

                    <tr>
                        <td align='center' style="height:25px;"><b>E-mail:<b/></td>
                        <td style="height:25px;"><?= $member['email'] ?></td>

                        <? } ?>


                        <? if (!$member['user_id']){ //회원일경우는 비밀번호 입력할필요없게 한다. ?>
                    <tr>
                        <td align='center'>Password</td>
                        <td><input type=password name=pw size=20></td>
                        <? } else { ?>
                            <input type=hidden name=pw value='<?= $member['pw'] ?>'>
                        <? }  //회원일경우는 비밀번호 입력할필요없게 한다.(끝) ?>


                    <tr>
                        <td colspan='2' height='20'>&nbsp;</td>

                    <tr>
                        <td width='100%' colspan='2'>
       <textarea name='editor1' id="Editor" style="width:95%; height:500px; overflow-y:hidden; overlow-x:scroll;">
	 <?= $data['Tstory'] ?> </textarea>
                        </td>


                    <tr>
                        <td height='30' align='left' colspan='2' bgcolor='FFFFFF'>&nbsp;</td>


                    <tr>
                        <td height='10' colspan='2' align='right' class='fn_1_td'>
                            <div class="mode3 images_up">
                                <a href="#" title='파일'
                                   onclick="window.open('./_image_list.php?b_ID=<?= $b_ID ?>','','width=90%,height=600')"
                                   onfocus="this.blur()">
                                    <img src="./image/img_up2.gif"/><font>이미지</font></a>
                            </div>

                            <? if ($member['level'] <= 2) { //파일업로드는 관리자 '레벨2'부터 가능;?>
                                <a href="#" title='파일'
                                   onclick="window.open('./_image_list.php?b_ID=<?= $b_ID ?>','','width=90%,height=600')"
                                   onfocus="this.blur()">
                                    <img src='./image/files.gif' width='20' height='20' border='0'><font>파일</font></a>
                            <? } ?>

                        </td>

                    <tr>
                        <td height='10' colspan='2'>
                            <hr size='0.1' color='#DBDBDB'/>
                        </td>


                    <tr>
                        <td height='auto' colspan='2' valign='top' align='left' bgcolor='#ffffff' id='_tds'>
                            <div class="mode1">
                                <iframe id='image_list' src="./image_list.php?b_ID=<?= $b_ID ?>" width='100%'
                                        height='100' scrolling="no" frameborder="0" marginwidth='0'>
                                </iframe>
                            </div>
                        </td>

                        <input type='hidden' value='' id='mmm' title="실지 서버에 저장할것">


                    <tr>
                        <td height='100%' height='40' colspan='2' valign='middle' align='center' bgcolor='#FFFFFF'>
                            <input type='button' value='선택 이미지 본문에 넣기' onclick='pasteHTML();'>
                        </td>

                        <script type="text/javascript">
                            ///////  게시판 에디트 글 서버에..... //////////
                            var oEditors = [];
                            nhn.husky.EZCreator.createInIFrame({
                                oAppRef: oEditors,
                                elPlaceHolder: "Editor",
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
                                fOnAppLoad: function () {


                                },
                                fCreator: "createSEditor2"
                            });


                            function pasteHTML() {
                                var sHTML = document.getElementById("mmm").value;
                                oEditors.getById['Editor'].exec("PASTE_HTML", [sHTML]);
                            }


                            function postSubmit() {
                                var f = document.frm;
                                oEditors.getById['Editor'].exec("UPDATE_CONTENTS_FIELD", []);
                                f.Editor.value = document.getElementById("Editor").value;
                                f.Editor.value = document.getElementById("mmm").value;
                                f.submit();
                                alert("작성완료");
                            }
                        </script>


                    <tr>
                        <td height='100%' height='30' colspan='2' bgcolor='#ffffff'>&nbsp;</td>
                    </tr>
                </table>

                <table border='0' width='90%' cellspacing='0' cellpadding='0' align='center'>
                    <tr>
                        <td width='45%' align='right' border=0>
                            <input type='image' src='./image/ok_s.gif' onclick='postSubmit();'>
                            <input type=hidden name=name value='<?= $member['name'] ?>'>
                            <input type=hidden name=nickname value='<?= $member['nickname'] ?>'>
                            <input type=hidden name=email value='<?= $member['email'] ?>'>
                        </td>

                        <td width='5%' border=0>&nbsp;</td>

                        <!--  취소------>
                        <td width='45%' align='left' border=0>
                            <a href="./view.php?b_ID=<?= $data['b_ID'] ?>&ctg=<?= $data['ctg'] ?>&ctgs=<?= $data['ctgs'] ?>"><img
                                        src='./image/cancel_s.gif' border='0'></a>
                        </td>
                    </tr>

                    <tr>
                        <td height='100%' colspan='3'>&nbsp;</td>
            </form>
    </tr>
</table>


</body>  <!-------------[[중앙 내용 (끝)]]------------->
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