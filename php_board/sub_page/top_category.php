<? session_start();
ob_start();

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$cinfo = co_info(); //회사정보

$ctg = $_GET['ctg'];
$ctgs = $_GET['ctgs'];

$q_ctg = "select * from category_2 where mid='$ctg'";
mysqli_query($connect, "set names utf8");
$q_result = mysqli_query($connect, $q_ctg);
$q_da = mysqli_fetch_array($q_result);
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <LINK REL="StyleSheet" HREF="../lib/style.css" type="text/css">  <!---(글자스타일 변경)--->

    <style type="text/css">
        /* = 카테고리 2 = */
        .mu_categorys {
            margin: 0 auto;
            width: 100%;
        }

        .mu_categorys a {
            font-family: Arial, 굴림, 돋움, Tahoma;
            font-size: 10pt;
            color: #FFFFFF;
        }

    </style>
</head>

<TABLE BORDER='0' WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='TOP' CELLSPACING='0' CELLPADDING='0'>
    <TR>
        <TD WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#4F4E4E' class='mu_categorys'>
            <?

            if ($ctg == 'members') {  //마이페이지
                ?>
                <a href="../member/my_page_view.php?ctg=members&ctgs=1" target="_top">My page</a> &nbsp; &nbsp;
                <a href="../member/my_page_edit.php?ctg=members&ctgs=2" target="_top">회원정보수정</a> &nbsp; &nbsp;
                <?
            } else if ($ctg == 'infor') {  //infor(회사소개)?>
                <a href="../infor/infor.php?ctg=infor&ctgs=1" target="_top">회사소개</a> &nbsp; &nbsp;
            <? } else if (preg_match('/a|c|d/', $ctg)) { //커뮤니케이션?>
                <a href="../board/bbs1/list.php?ctg=a&ctgs=a01" target="_top">공지사항</a> &nbsp; &nbsp;
                <a href="../board/bbs1/list.php?ctg=a&ctgs=a02" target="_top">문의</a>  &nbsp; &nbsp;
                <a href="../board/bbs1/list.php?ctg=a&ctgs=a03" target="_top">자유게시판</a>  &nbsp; &nbsp;
                <a href="../board/bbs1/list.php?ctg=d&ctgs=d01" target="_top">이벤트</a>  &nbsp; &nbsp;


            <?php } ?>

            <?php if (!$ctg) { //ctg값을 없을때?>
                <a href="../main.php" target="_top">메인</a> &nbsp; &nbsp;
                <a href="../member/my_page_view.php?ctg=members&ctgs=1" target="_top">내정보</a> &nbsp; &nbsp;
                <a href="../board/bbs1/list.php?ctg=a&ctgs=a02" target="_top">게시판</a> &nbsp; &nbsp;
            <?php } ?>
        </TD>
    </TR>
</TABLE>
