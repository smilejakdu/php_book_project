<?php

session_start();
ob_start();
/////////////[받기]///////////////////////////////////
$user_id = $_SESSION['user_id'] ?? null;
$b_ID = $_GET['b_ID'] ?? null;
$ctg = $_GET['ctg'] ?? null;
$ctgs = $_GET['ctgs'] ?? null;
$Search_text = $_GET['Search_text'] ?? null;
$Search_mode = $_GET['Search_mode'] ?? null;
$page = $_GET['page'] ?? null;

?>

<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta http-equiv="imagetoolbar" CONTENT="no">

    <link rel='stylesheet' type='text/css' href='../../lib/style.css'/>

    <title><? echo $top_title = $ctgs_name; ?></title>

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

        .table1_1 {
            width: 100%;
            height: 100%;
            margin: 0;
            float: left;
            display: block;
        }

        .table1_2 {
            float: left;
            display: none;
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

        .subjects1 {
            margin: 0;
            float: left;
            display: block;
        }

        .subjects2 {
            margin: 0;
            float: left;
            display: none;
        }

        .border_size1 {
            margin: 0 auto;
            width: 80%;
            text-align: center;
            display: block
        }


        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {

            .table1_1 {
                display: none;
            }

            .table1_2 {
                width: 100%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

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

            .subjects1 {
                margin: 0;
                float: left;
                display: none;
            }

            .subjects2 {
                margin: 0;
                float: left;
                display: block;
            }

            .border_size1 {
                width: 90%;
                text-align: center;
                display: block;
            }
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {

            .table1_1 {
                display: none;
            }

            .table1_2 {
                width: 100%;
                height: 100%;
                margin: 0;
                float: left;
                display: block;
            }

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

            .subjects1 {
                margin: 0;
                float: left;
                display: none;
            }

            .subjects2 {
                margin: 0;
                float: left;
                display: block;
            }

            .border_size1 {
                width: 98%;
                text-align: center;
                display: block;
            }

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

        .category2_box {
            border-top: 1px solid #E4E3E1;
            border-bottom: 1px solid #E4E3E1;
        }

        .category2_box a {
            font-family: 굴림, 돋움, Arial, Tahoma, serif;
            font-size: 9pt;
            color: #B4B4B4
        }

        .categorys {
            border-bottom: 1px solid #EEEEEE;
        }

        .page_title1 {
            padding-top: 8px;
            padding-right: 8px;
            padding-left: 8px;
            padding-bottom: 8px;
            width: 50%;
            border: 1px solid #79b693;
            -webkit-border-radius: 10px 10px 10px 10px; /* for Firefox */
            -moz-border-radius: 10px 10px 10px 10px; /* for Safari and chrome */
            border-radius: 10px 10px 10px 10px; /* CSS3 */
            font-family: 굴림, 돋움, Arial, Tahoma;
            font-size: 9pt;
            color: #79b693;
        }

        .page_title2 {
            font-family: 굴림, 돋움, Arial, Tahoma;
            font-size: 11pt;
            color: #AB96DD;
            font-weight: bold;
        }

        .secret1 {
            font-family: 굴림, Arial;
            font-size: 9pt;
            color: #C5B793
        }
    </style>

    <script>
        object.style.wordWrap = "break-word";
    </script>
</head>

<?php
    include '../../lib/connect.php';
    $connect = dbconn();
    $member = member_info();
    $_co = co_info(); //회사정보
    $device_mode = device_mode();  //기기 접속모드
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
        <td WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
            <? include("../../sub_page/top_category2.php"); ?>
        </td>


    <TR>
        <!-------------[[중앙 내용]]------------->
        <TD WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>


            <?
            $where = "no";

            // 검색 단어를 입력했을때
            if ($Search_text) {
                if ($Search_mode == 1) $tmp = "subject";
                if ($Search_mode == 2) $tmp = "Tstory";


                if ($Search_mode == 3) {
                    $where = " (name like '%$Search_text%' or subject like '%$Search_text%' or Tstory like '%$Search_text%')";
                } else {
                    $where = " $tmp like '%$Search_text%'";
                }

            }


            ///// 일반 게시판은 이것을 아래를 실행;/////
            if (preg_match('/a|ra|c|rc|e|re/', $ctg)) {
                //상단 라인선/ TD색상 색상;
                if ($ctgs == 'a01') $tdcolor = "#DCC9C3";
                if ($ctgs == 'a02') $tdcolor = "#81A4C8";
                if ($ctgs == 'a03') $tdcolor = "#A1B99B";
                if ($ctgs == 'c01') $tdcolor = "#dda3e7";
                if ($ctgs == 'e01') $tdcolor = "#BA90DB";
                if ($ctgs == 'e02') $tdcolor = "#BA90DB";
                if ($ctgs == 'e04') $tdcolor = "#ccb9f8";
            }


            ////// 웹진형 게시판 컬러;//////
            if (preg_match("/d|rd/", $ctg)) {
                if ($ctgs == 'd01' or $ctgs == 'rd01') $tdcolor = "#CAC4AB";
            }


            ////// 영상게시판1;///////
            if ($ctg == "v") {
                if ($ctgs == 'v01') $tdcolor = "#7BB7AA"; //(1);
                if ($ctgs == 'v02') $tdcolor = "#7BB7AA"; //(2);
                if ($ctgs == 'v03') $tdcolor = "#7BB7AA"; //(2);
            }

            ////// 영상게시판2;///////
            if ($ctg == "p") {
                if ($ctgs == 'p01') $tdcolor = "#ccb9f8"; //(1);
                if ($ctgs == 'p02') $tdcolor = "#ccb9f8"; //(2);
                if ($ctgs == 'p03') $tdcolor = "#ccb9f8"; //(2);
            }


            // 일반 게시판은 이것을 아래를 실행;
            if (preg_match('/a|c|e/', $ctg)) {
                if ($ctg == 'a' and $ctgs == "a01") ($tdcolor_1 = "#DB552F");  // TDcolor(1);
                if ($ctg == 'a' and $ctgs == "a01") ($page_title1 = "공지사항"); // page_title
                if ($ctg == 'a' and $ctgs == "a02") ($page_title1 = "Q&A"); // page_title
                if ($ctg == 'a' and $ctgs == "a03") ($page_title1 = "자유게시판"); // page_title

                if ($ctg == 'e' and $ctgs == "e01") ($page_title1 = "PHP일반 강좌"); // page_title
                if ($ctg == 'e' and $ctgs == "e02") ($page_title1 = "PHP중급강좌"); // page_title
                if ($ctg == 'e' and $ctgs == "e04") ($page_title1 = "Python"); // page_title
                if ($ctg == 'c' and $ctgs == "c01") ($page_title1 = "비지니스"); // page_title
            }


            // 웹진형 게시판;
            if (preg_match('/d/', $ctg)) {
                if ($ctg == 'd' and $ctgs == "d01" or $ctg == 'rd' and $ctgs == "rd01") ($page_title1 = "이벤트"); // page_title
            }


            // 영상 게시판;
            if ($ctg == "v") {
                if ($ctg == 'v') ($page_title1 = "PHP 영상강좌 "); // page_title
                if ($ctg == 'v' and $ctgs == "v01") ($page_title2 = "기초"); // page_title
                if ($ctg == 'v' and $ctgs == "v02") ($page_title2 = "중급"); // page_title
                if ($ctg == 'v' and $ctgs == "v04") ($page_title2 = "일반"); // page_title
            }

            // 영상 게시판;
            if ($ctg == "p") {
                if ($ctg == 'p') ($page_title1 = "기타영상강좌"); //카테고리1
                if ($ctg == 'p' and $ctgs == "p01") ($page_title2 = "PHP"); // page_title
                if ($ctg == 'p' and $ctgs == "p02") ($page_title2 = "코딩"); // page_title
                if ($ctg == 'p' and $ctgs == "p03") ($page_title2 = "Python"); // page_title
            }

            // 일반강좌 게시판;
            if ($ctg == "e") {
                if ($ctg == 'e') ($page_title1 = "PHP 강좌 "); // page_title
                if ($ctg == 'e' and $ctgs == "e01") ($page_title2 = "PHP 기초과정"); // page_title
                if ($ctg == 'e' and $ctgs == "e02") ($page_title2 = "PHP 중급과정"); // page_title
            }
            ?>


            <!-----------------  상단 소분류 카테고리 ------------>
            <table border='0' width='80%' height='30' align='center' valign='top' cellspacing='0' cellpadding='0'
                   bgcolor='#FFFFFF'>
                <tr>
                    <td width='100%' height="30" colspan="3" align='right' valign="middle" class='category2_box'>
                        <?php
                        if (preg_match('/e01|e02/', $ctgs)) {
                            ?>
                            &nbsp; &nbsp; &nbsp;
                        <?php }
                        if (preg_match('/a01|a02/', $ctgs)) {
                            /*****************************************************************************
                             * 같은 게시판이지만 분야별로 ctgs 값이 틀려진다.
                             * jmband =   a01: 공지사항   a02:Q&A     a03:자유게시판   d01:이벤트
                             ******************************************************************************/
                            ?>
                            <a href='./list.php?ctg=a&ctgs=a01' onfocus="this.blur()">공지사항</a>
                            &nbsp; &nbsp;
                            <a href='./list.php?ctg=a&ctgs=a02' onfocus="this.blur()">Q&A</a>
                            &nbsp; &nbsp;
                            <a href='./list.php?ctg=a&ctgs=a03' onfocus="this.blur()">자유게시판</a>
                            &nbsp; &nbsp;

                        <?php } ?>
                    </td>
                </tr>
            </table>


            <DIV ID="ex-wrap">
                <? ///////////////////  게시판 이름 [일반모드] ////////////////// ?>
                <div class="table1_1" name="일반모드">
                    <table border='0' width='85%' height='48' align='center' valign='top' cellspacing='0'
                           cellpadding='0' bgcolor='FFFFFF'>
                        <tr>
                            <td colspan='2' style="width:100%; height:5px">&nbsp;</td>
                        </tr>

                        <td width='70%' height='33' align='right'>&nbsp;</td>
                        <td width='30%' height='33' align='right'>
                            <?php if (preg_match('/a|ra|d|rd|e|re/', $ctg)) { //일반 //?>
                                <img src="./image/logo_<?= $ctgs ?>.gif" border='0'>
                            <?php } else if (preg_match('/v|p/', $ctg)) { ///////영상 /////////////;?>
                                <img src="./image/logo_<?= $ctg ?>.gif" border='0'>
                            <?php } ?>
                        </td>

                        <tr>
                            <td colspan='2' height='10' valign='top'>
                                <hr size='0.1' width='100%' color='<?= $tdcolor ?>'/>
                            </td>
                        </tr>
                    </table>
                </div>


                <? ///////////////////  게시판 이름 [모바일 모드] ////////////////// ?>
                <div class="table1_2" name="모바일 모드">
                    <table border="0" width="100%" height="40" align="center" valign="top" cellspacing="0"
                           cellpadding="0" bgcolor="FFFFFF">
                        <tr>
                            <td width="auto" height="30" align="center">&nbsp;</td>

                            <td width="30%" height="30" align="right">
                                <div class="page_title1" align="center">
                                    <? if ($ctgs) { ///////게시판 이름1 /////////////;
                                        echo $page_title1;
                                    } ?>
                                </div>
                            </td>
                            <td width="5%" bgcolor="#FFFFFF">&nbsp;</td>

                    </table>
                </div>


                <? ///////////////////  게시판 이름-소분류 [전체 모드] //////////////////
                if (preg_match('/e|v|p/', $ctg)) { //카테고리 소분류 있을때..../ ?>
                    <table border='0' width='80%' height='25' align='center' valign='top' cellspacing='0'
                           cellpadding='0' bgcolor='FFFFFF' class='categorys'>
                        <tr>
                            <td width='95%' height="25" align='center' valign="middle" class='page_title2'>
                                <?= $page_title2 ?>
                            </td>
                        </tr>
                    </table>
                <? } ?>


                <div class="border_size1">
                    <? if (preg_match('/a|c|e/', $ctg)) { //일반형게시판일때// ?>
                    <table border='0' align='center' width="100%" height="200" cellspacing='0' cellpadding='0'>
                        <tr bgcolor='<?= $tdcolor ?>'>
                            <td width='65%' height="25" align='center' valign='middle'>
                                <span color='#FFFFFF'><b>Subject</b></span>
                            </td>

                            <td width='10%' align='center' valign='middle'>
                                <span color='#FFFFFF'><b>Name</b></span>
                            </td>

                            <td width='10%' align='center' valign='middle'>
                                <span color='#FFFFFF'><b>Hit</b></span>
                            </td>

                            <td width='15%' align='center' valign='middle'>
                                <span color='#FFFFFF'><b>Date</b></span>
                            </td>

                        <tr>
                            <td width="100%" height="10" colspan="4" bgcolor="#FFFFFF">
                                <hr size="0.1" width="98%" color="#888888"/>
                            </td>

                            <?php
                            $view_article = 15;  //총게시물수
                            if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정
                            $start = ($page - 1) * $view_article;

                            ////검색할 조건///
                            $href = "&Search_mode=$Search_mode&Search_text=$Search_text&ctg=$ctg&ctgs=$ctgs";


                            if ($ctgs) {
                                $query = "select count(*) from bbs1 where $where and   ctg='$ctg' and ctgs='$ctgs' ";
                            }
                            if (!$ctgs) {
                                $query = "select count(*) from bbs1 where $where and ctg='$ctg' ";
                            }
                            mysqli_query($connect, "set names utf8"); //mysqli 언어팩:utf8 ;
                            $result = mysqli_query($connect, $query);
                            $temp = mysqli_fetch_array($result);
                            $total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함

                            if ($ctgs) {
                                $query = "select * from bbs1 where $where and  ctg='$ctg' and ctgs='$ctgs'  order by no+top desc limit $start, $view_article";
                            }
                            if (!$ctgs) {
                                $query = "select * from bbs1 where $where and ctg='$ctg' order by no+top desc limit $start, $view_article";
                            }
                            $result = mysqli_query($connect, $query);

                            $cnt = 1;
                            $cnts = 1;

                            while ($data1 = mysqli_fetch_array($result)) {
                            ?>

                        <tr>
                            <td height='30'> <!-- 제목 나타나는 부분-->
                                <? echo "&nbsp; &nbsp;";
                                if ($data1['top'] >= 100) echo("<img src='./image/_notics.gif' withd='15' height='15'>"); //공지;

                                if ($data1["secret"] == "OK") print("<img src='./image/secret.gif'> &nbsp;");

                                if ($data1['secret'] == 'OK' and $data1['mID'] != $member['mID']) { //비밀 글이며 자신이 작성한 글이 아니면
                                    echo "<font class='secret1'>비밀글입니다.</font>";
                                } else {
                                    ?>
                                    <a href="view.php?b_ID=<?= $data1['b_ID'] ?>&page=<?= $page ?>&Search_mode=<?= $Search_mode ?>&Search_text=<?= $Search_text ?>&ctg=<?= $ctg ?>&ctgs=<?= $ctgs ?>"
                                       onfocus="this.blur()">

                                        <span class="subjects1" name="일반모드">
                                            <span color=#6D6D6B><?= $subject1 = mb_substr($data1['subject'], 0, 55, 'utf-8'); ////일반글             ?> </span>
                                        </span>

                                        <span class="subjects2" name="모바일 모드">
                                            <span color=#6D6D6B><?= $subject2 = mb_substr($data1['subject'], 0, 18, 'utf-8'); ////일반글             ?> </span>
                                        </span>

                                        <!---코맨드글 숫자 수보기---->
                                        <span style='font-size:8pt;' class='comments'>
  <? if ($data1['comments']) {
      echo "[" . $data1['comments'] . "]";
  } ?>
  </span>
                                    </a>
                                    <!--  코맨트 클 수자 수보기 끝-->

                                <? }//비밀글이 아니면 (여기까지)
                                echo "&nbsp; &nbsp; &nbsp;";
                                $data1_regdate = $data1['regdate'] . $data1['regdate_time'];
                                $data1_regdate_s = strtotime($data1_regdate);  //날짜를 'time'로 변경
                                if (time() - $data1_regdate_s < 60 * 60 * 48) echo("<span style='font-size:8pt; font-family:Tahoma; color:#ff0000'> new</span>&nbsp;");
                                ?>
                            </td>


                            <td align='center' height="30">
                                <?
                                if ($data1['secret'] == 'OK' and $data1['mID'] != $member['mID']){ //비밀 글이며 자신이 작성한 글이 아니면
                                    echo " <span class='secret1'>!</span>";
                                }else{
                                ?>
                                <span class="mode1" style='color:#391E01;'>
<? if ($data1['nickname']) {
    echo mb_substr($data1['nickname'], 0, 5, 'utf-8'); //닉네임
} else {
    echo mb_substr($data1['name'], 0, 5, 'utf-8'); //이름
}
?>
						  </span>

                                <span class="mode2" style='color:#391E01;'>
<? if ($data1['nickname']) {
    echo mb_substr($data1['nickname'], 0, 3, 'utf-8'); //닉네임
} else {
    echo mb_substr($data1['name'], 0, 3, 'utf-8'); //이름
}

} ?>
						  </span>
                            </td>


                            <td align=center><span
                                        style='font-size:8pt; color:#5F3601;'><?= $data1['hit']; //히트;             ?></span>
                            </td>


                            <td align=center>
<span style='font-size:8pt; color:#585757;'>
 <div class="mode1" name="일반모드">
<?
echo $data1_m = substr($data1['regdate'], 4, 2) . ".";
echo $data1_d = substr($data1['regdate'], 6, 2) . "&nbsp;";
echo $data1_h = substr($data1['regdate_time'], 0, 2) . ":";
echo $data1_i = substr($data1['regdate_time'], 2, 2);
?>
</div>

 <div class="mode2" name="모바일 모드">
<?
echo $data1_m = substr($data1['regdate'], 4, 2) . ".";
echo $data1_d = substr($data1['regdate'], 6, 2);
?>
  </div>
</span>
                            </td>
                        </tr>
                        <?
                        $cnt++;
                        $cnts--;
                        } ?>
                        <tr>
                            <td height='100%' colspan='4'>&nbsp;</td>


                        </tr>
                    </table>
                </div>


            <?

            } //일반형게시판일때 여기까지//


            //웹진형 게시판 //
            if (preg_match('/d/', $ctg)) {
                include './list_webzine.php';
            } //웹진형 게시판 여기까지


            //영상 게시판 //
            if (preg_match('/v|p/', $ctg)) {
                include './list_video.php';
            } //영상 게시판 여기까지
            ?>

                <!--------------  게시판 리스트 글보기 전체 And------------------------------->

                <table border="0" width="90%" height="90" align="center" cellspacing="0" cellpadding="0">
                    <?
                    if ($user_id = $member['user_id']) {    //회원아이디가 있으면서 글쓰기 가능!!//

                        if ($member['level'] <= '2') { //전체글쓰기는 레벨2부터 가능 (최고레벨'1');
                            ?>

                            <!---[글쓰기]--->
                            <? if (preg_match('/a01|c01|d01/', $ctgs)) {  //관리자 허용게시판 ?>
                                <a href="./write.php?ctg=<?= $ctg ?>&ctgs=<?= $ctgs ?>" onfocus="this.blur()"
                                   class="btn btn-success">글쓰기</a>
                            <? } //관리자 허용게시판
                        } //관리자 허용게시판 (여기까지)

                        ///////////////////  일반회원 게시판 /////////////////////
                        if (preg_match('/a02|a03|c01|c02|c03/', $ctgs)) {  //일반회원 게시판 허용범위
                            ?>
                            <a href="./write.php?ctg=<?= $ctg ?>&ctgs=<?= $ctgs ?>" onfocus="this.blur()"
                               class="btn btn-success">글쓰기</a>
                            <?
                        }
                    }
                    ?>
                    </td>

                    <tr>
                        <td width="100%" height="50" align="left" border="1px solid #2f9462">
                            <? include "page.php"; ?>
                        </td>
                    </tr>
                </table>


                <div class="mode1">
                    <!------------  PC 모드 --------------->
                    <table border="0" width="90%" align="center" cellspacing="0" cellpadding="0">
                        <form action=<?= $PHP_SELF ?>>
                            <input type=hidden name=id value="<?= $id ?>">
                            <input type=hidden name=ctg value="<?= $ctg ?>">
                            <input type=hidden name=ctgs value="<?= $ctgs ?>">


                            <tr>
                                <td width="85%" height="50" align="center" bgcolor="#B3B3B3">
                                    <select name="Search_mode" style="width:120px; height:25px;">
                                        <option value='3'> 전체에서
                                        <option value='1'> 제목에서
                                        <option value='2'> 내용에서
                                    </select>


                                    <input type='text' name='Search_text' style="width:300px; height:25px;">
                                    <input type='submit' value='OK' style="width:80px; height:25px;">
                                </td>

                                <td width="15%" align="left" bgcolor="#B3B3B3"> &nbsp;
                                </td>
                            </tr>
                        </form>

                        <tr>
                            <td align="right" colspan="2" bgcolor="#FFFFFF">
                                &nbsp;
                            </td>

                        </tr>
                        <td height="10" align="right" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                    </table>
                </div>


                <div class="mode2">
                    <!------------  모바일 / 테블릿PC --------------->
                    <table border="0" width="90%" align="center" cellspacing="0" cellpadding="0">
                        <form action=<?= $PHP_SELF ?>>
                            <input type=hidden name=id value="<?= $id ?>">
                            <input type=hidden name='ctg' value="<?= $ctg ?>">
                            <input type=hidden name='ctgs' value="<?= $ctgs ?>">


                            <tr>
                                <td width="100%" height="50" align="center" bgcolor="#B3B3B3">
                                    <select name="Search_mode" style="width:25%; height:25px;">
                                        <option value='3'> 전체에서
                                        <option value='1'> 제목에서
                                        <option value='2'> 내용에서
                                    </select>


                                    <input type='text' name='Search_text' style="width:50%; height:25px;">
                                    <input type='submit' value='OK' style="width:15%; height:25px;">
                                </td>

                                <td width="15%" align="left" bgcolor="#B3B3B3"> &nbsp;
                                </td>
                            </tr>

                        </form>

                        <tr>
                            <td align="right" colspan="2" bgcolor="#FFFFFF">
                            </td>
                        </tr>

                        <tr>
                            <td height="10" align="right" colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                    </table>
                </div>

            </DIV>


        </TD>  <!-------------[[중앙 내용 (끝)]]------------->
    </TR>  <!---- 본문내용 테이블_1(/TR)----->


    <?
    /******************************[ 게시판 글 // 파일/이미지 쓰레기 지우기 ]*********************************
     * /// 적용필드명: file1, file2 //
     *****************************  작성시작후 1시간이 지난 글 ***********************************************/
    $now_time = time(); //현재시간

    /* /////  정상으로 등록되지 않은 게시글은 ip가 입력이 되지 않습니다. 그래서 ip기준으로 사용자가 원하는 시간이
    지나면 DB테이터와 파일이 함께 삭제 됩니다. */

    $q_fdel = "select * from bbs1 where ip='NULL' ";
    $r_fdel = mysqli_query($connect, $q_fdel);
    while ($d_fdel = mysqli_fetch_array($r_fdel)) {


        $db_time = strtotime($d_fdel['regdate'] . $d_fdel['regdate_time']);
        $over_time = $db_time + 60 * 60;    //한시간이 지나면 삭제 60*60
        if ($now_time >= $over_time) {
            $_image = explode("#", $d_fdel['file1'] . $d_fdel['file2']); // '*'기준으로 문자 배열
////// 반복문 /////// $ips=1 이유는 파일 앞에 #기준으로 배열을 하기 때문
            for ($ips = 1; $ips < count($_image); $ips++) {
                if ($d_fdel['ip'] == 'NULL') {
// 본문글 삭제루틴 
                    $b_ID = $d_fdel['b_ID'];
                    $query = "delete  from bbs1 where ip='NULL' and b_ID='$b_ID' ";
                    $result = mysqli_query($connect, $query);
                    if (!$result) die(mysqli_error());

                    // 파일삭제루틴  //// 파일위치 경로 잘 확인 !!!
                    $del_image = "./data/" . $_image[$ips];
                    if ($_image[$ips] && is_file($del_image)) unlink($del_image);
                }  //if문 닫기
            } //for 문닫기
        } //if문 닫기
    } //while문 닫기
    /**********************************************************************************************************
     * /////////////////////////////[ 게시판 글 // 파일/이미지 쓰레기 지우기 (여기까지) ]/////////////////////////////////////
     *********************************************************************************************************/
    ?>


    <TR>
        <!------------  하단 마커 --------------------->
        <TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?= $setup['marker_c'] ?>' VALIGN='BOTTOM'>
            <iframe src="../../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </TD>
    </TR>
</TABLE>
<!---- 본문내용 테이블_1(/TABLE)----->