<? session_start();
ob_start();

$b_ID = $_GET[b_ID];
$ctg = $_GET[ctg];
$ctgs = $_GET[ctgs];
///////////////////////////////////////////////////


///////////////////////////////////////////////////
$Search_text = $_GET[Search_text];
$page = $_GET[page];
//////////////////////////////////////////////////
?>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta http-equiv="imagetoolbar" CONTENT="no">

    <link rel='stylesheet' type='text/css' href='../lib/style.css'/>
    <?
    include '../lib/connect.php';
    $connect = dbconn();
    $member = member_info();
    $_co = co_info(); //회사정보

    $ctgs_name = "Searchs";
    ?>

    <title><? echo $_co[co_title] . "-" . $top_title = $ctgs_name; ?></title>

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


        .title {
            font-family: 굴림, 돋움, Arial;
            font-size: 12pt;
            color: #A8A8A8;
            font-weight: bold
        }

        /* 상품검색 */
        .search_td {
            margin: 0 auto;
            padding: 0px;
            position: relative;
        }

        .search_box {
            width: 70%;
            height: 50px;
            background: #bbdcb4;
            padding-top: 15px;
        }

        .search_input {
            width: 80%;
            height: 25px;
            border-bottom: 0.1px solid #757575;
            border-top: 0px;
            border-left: 0px;
            border-right: 0px;
        }

        .submit {
            background: #FFF;
            background-image: url("./img/search.png");
            border: 0;
            width: 20px;
            height: 20px;
            vertical-align: middle
        }


        .font_1 {
            font-family: 굴림, 돋움, Arial;
            font-size: 9pt;
            color: #6e7bcf;
        }

        .font_2 {
            font-family: 굴림, 돋움, Arial;
            font-size: 10pt;
            color: #f26b6b;
        }

        .font_4 a {
            font-family: 굴림, 돋움, Arial;
            font-size: 10pt;
            color: #464646;
        }
    </style>

</head>


<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0' TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">

<?
if (!$Search_text) Error('검색어를 입력하세요.');

$where = "no";


////검색할 조건///
$href = "&Search_text=$Search_text";

// 검색 단어를 입력했을때
$where = " (subject like '%$Search_text%' or Tstory like '%$Search_text%')";


$view_article = 15;  //총게시물수
if (!$page) $page = 1; // 현재 페이지 지정되지 않았을 경우 1로 지정  
$start = ($page - 1) * $view_article;

$query = "select count(*) from bbs1  where $where and secret='' ";
$result = mysqli_query($connect, $query);
$temp = mysqli_fetch_array($result);
$total_article = $temp[0]; // 현재 쿼리한 게시물의 총 개수를 구함
?>


<!---///////////////////////////////////[테이블 시작]//////////////////////////////////////////////////----->
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
    <TR>
        <!-------------[[상단 로고/카페고리1]]------------->
        <TD WIDTH='100%' HEIGHT='105' ALIGN='CENTER' VALIGN='TOP'>
            <iframe src="../../sub_page/top.php" name='top' width='100%' HEIGHT='105' frameborder='0' marginwidth='0'
                    marginheight='0' scrolling='no'>
            </iframe>
        </TD>


        <!------------ 상단 카테고리 2----------->
    <TR>
        <TD WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
            <iframe src="../../sub_page/top_category.php?ctg=<?= $ctg ?>" name='top_category' width='100%' HEIGHT='30'
                    frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
            </iframe>
        </TD>


    <TR>
        <!-------------[[중앙 내용]]------------->
        <TD WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>

            <DIV ID="auto_size">
                <div class="box1">&nbsp;</div>
                <div class="box2">
                    <table border='0' width='100%' height='100%' align='center' valign='top' cellspacing='0'
                           cellpadding='0' bgcolor='FFFFFF'>
                        <tr>
                            <td width='100%' height='10' colspan='2'>
                                &nbsp; &nbsp;
                            </td>

                        <tr>
                            <td width='100%' height='40' colspan='2' align='center' class='title'> 검색결과</td>

                        <tr>
                            <form action='<?= $PHP_SELF ?>' method='get'>
                                <td width='100%' height='20' colspan='2' align='center' class='search_td'>
                                    <div class='search_box'>
                                        <input type='text' name='Search_text' class='search_input'/>
                                        <input type='submit' value="" class='submit'/>
                                    </div>
                                </td>
                            </form>

                        <tr>
                            <td width='100%' height='20' colspan='2' align='center' class='font_1'>
                                - 비밀글은 검색이 되지 않습니다. -
                            </td>

                            <? if ($total_article <= 0){ ?>
                        <tr>
                            <td width='100%' height='200' colspan='2' align='center' valign='middle' class='font_2'>
                                *검색 결과가 없습니다.
                            </td>
                            <? } ?>

                            <?
                            $tempss = $total_article - ($view_article * ($page - 1)); //게시물 번호 카운트 하기    subject like '%$Search_text%'

                            $query = "select * from bbs1  where ctg not like 'r%'  and $where and secret=''   order by subject desc, top desc limit $start, $view_article ";
                            $result = mysqli_query($connect, $query);
                            while ($data = mysqli_fetch_array($result)) {
                            $ctg = $data[ctg];
                            $ctgs = $data[ctgs];


                            ?>

                        <tr>
                            <td width='5%'>
                                <?= $tempss; ?>
                            </td>
                            <td width='95%' height='30'>
                                <? if ($data[top] >= 100) {
                                    echo "<img src='./img/notics.gif' withd='15' height='15'>";
                                } //공지;

                                if ($data[secret] == 'OK') {
                                    echo "<img src='./img/secret.gif'>"; //비밀글;
                                }
                                ?>


                                <? if ($data[secret] == 'OK' and $data[user_id] != $member[user_id]){ //비밀 글이며 자신이 작성한 글이 아니면?>
                                    <font class='secret1'>비밀글입니다.</font>
                                <? }else{ ?>
                                <a href="./bbs1/view.php?b_ID=<?= $data[b_ID] ?>&ctg=<?= $ctg ?>&ctgs=<?= $ctgs ?>"
                                   onfocus="this.blur()">
                                    <font color=#6D6D6B>
                                        <?= mb_substr($data[subject], 0, 80, 'utf-8'); ////일반글  ?>
                                        <? } ?>
                            </td>
                            <?
                            $tempss--;
                            } ?>

                        <tr>
                            <td width='100%' height='25' colspan='2' align='center' bgcolor='#FFFFFF'>
                                <? include "page.php"; ?>
                            </td>

                        <tr>
                            <td width='100%' height='30' colspan='2' align='center' bgcolor='#EEEEEE' class='font_4'>
                                <a href="../main.php">[메 인] </a>&nbsp; &nbsp;
                            </td>


                        <tr>
                            <td width='100%' height='100%' colspan='2'> &nbsp;</td>
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
            <iframe src="../../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </TD>
    </TR>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->