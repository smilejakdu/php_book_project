<?

$ctg = $_GET['ctg'];
$ctgs = $_GET['ctgs'];

$ctg_first_text = substr($ctg, 0, 1);


$q_ctg = "select * from category_2 where mid='$ctg'";
mysqli_query($connect, "set names utf8");
$q_result = mysqli_query($connect, $q_ctg);
$q_da = mysqli_fetch_array($q_result);
?>
<head>
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

        .text_1 {
            font-family: Arial, 굴림, 돋움, Tahoma;
            font-size: 10pt;
            color: #FFFFFF;
        }
    </style>
</head>


<table BORDER='0' WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='TOP' CELLSPACING='0' CELLPADDING='0'>
    <tr>
        <td WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#4F4E4E' class='mu_categorys'>

            <?php
            /*****************************************************************************
             * 같은 게시판이지만 분야별로 ctgs 값이 틀려진다.
             * jmband =   a01: 공지사항   a02:Q&A     a03:자유게시판   d01:이벤트
             * jm store = ra01: 공지사항  ra02:Q&A    ra03:자유게시판  rd01:이벤트
             * //////  앞에 (r) 있는경우 store 게시판이 된다. ////
             ******************************************************************************/
            if ($ctg_first_text == 'r') { //// jm store  ////
                ?>
                <a href="../../board/bbs1/list.php?ctg=ra&ctgs=ra01" target="_top"><span
                            class='text_1'>공지사항</span></a> &nbsp; &nbsp;
                <a href="../../board/bbs1/list.php?ctg=ra&ctgs=ra02" target="_top"><span
                            class='text_1'>상품문의</span></a>  &nbsp; &nbsp;
                <a href="../../board/bbs1/list.php?ctg=ra&ctgs=ra03" target="_top"><span
                            class='text_1'>자유게시판</span></a>  &nbsp; &nbsp;
                <a href="../../board/bbs1/list.php?ctg=rd&ctgs=rd01" target="_top"><span
                            class='text_1'>이벤트</span></a>  &nbsp; &nbsp;
                <?php
            }
            ?>


        </td>
    </tr>
</table>
