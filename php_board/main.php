<?php
session_start();
ob_start();
include './lib/connect.php';
$connect = dbconn();
$member = member_info();
$_co = co_info(); //회사정보
$device_mode = device_mode();  //기기 접속모드
?>
<!DOCTYPE HTML>
<html lang="ko">
<HEAD>
    <title>unsoft</title>
    <LINK REL="SHORTCUT ICON" HREF="./image/us.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--한글로 구성:UTF-8-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <!-- <TITLE><?= $_co['site_name']; ?></TITLE> -->
    <link rel="stylesheet" href="./image/xeronote.jpg">

    <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <link rel="canonical" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>"><!--- 대표URL --->


    <link type='text/css' HREF='./lib/style.css' rel='stylesheet'/>
    <link rel="stylesheet" href="./lib/main_style.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- javascript 부분  -->
    <script type="text/javascript">
        function funcThisSize() {
            $("#innerWidth").html(window.innerWidth);
            $("#innerHeight").html(window.innerHeight);
            $("#outerWidth").html(window.outerWidth);
            $("#outerHeight").html(window.outerHeight);
        }

        $(function () {
            $(window).resize(funcThisSize);
            funcThisSize();
        });


        function search_sub() {
            document.searchs.submit();
        }
    </script>

</head>

<body id="funcThisSize">


<div class="login" style="background-color:#D8C494;">
    <a href='./main.php' class="btn btn-success main_logo" onfocus="this.blur()">야호 메인 로고입니다</a>
    <?php if (!$member['user_id']) { ?>
        <a href="./member/login_page.php" target='_top' OnFocus="this.blur()">로그인</a>
        &nbsp; &nbsp;
        <a href="./member/join.php?ctg=members" target='_top' OnFocus="this.blur()">회원가입</a>
    <?php } else {
        include "./member/profile_box_main.php";
    } ?>
    &nbsp; &nbsp;
</div>

<div class="my_page" style="background-color:#D8C494;">
    <a href="./member/my_page_view.php?ctg=members" target='_top' OnFocus="this.blur()">내정보</a>
    &nbsp; &nbsp;
    <a href="./board/bbs1/list.php?ctg=a&ctgs=a03" target='_top' OnFocus="this.blur()">게시판</a>
    &nbsp; &nbsp;
    <a href="./infor/infor.php?ctg=infor&ctgs=1" target='_top' OnFocus="this.blur()">회사</a>
    &nbsp;
</div>


<!-------------   1~ 600px까지  로그인 디자인 변경 --------->
<div class="box2_m" style="background-color:#D8C494; height:100px" name="css테이블 1번">
    <table border='0' style="width:100%; height:100px" cellspacing='0' cellpadding='0' align="center" valign='top'
           bgcolor='#D8C494'>
        <tr>
            <td style="width:2%; height:35px">&nbsp;</td>
            <td style="width:10%; height:35px" align='cneter' class='log_1'><img src='./image/us.png' height='25'></td>
            <td style="width:88%; height:35px" align='left' class='log_2'>
                <?php if ($member['user_id']){ ?>
                    <iframe src="../member/_profile_box.php" target="_top" name='top' width='100%' HEIGHT='35'
                            frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
                    </iframe>
                <?php }else{ ?>

                <font class='login_font'>
                    <a href="../member/login_page.php" target='_top' OnFocus="this.blur()">
                        <font class='login_font'>로그인</font>
                    </a>
                    &nbsp; &nbsp;
                    <a href="../member/join.php?ctg=members" target='_top' OnFocus="this.blur()">회원가입</a>
                    &nbsp; &nbsp;
                    <?php } ?>
            </td>
            <td style="width:6%; height:35px">&nbsp;</td>
        </tr>

        <tr>
            <td style="width:100%; height:5px" colspan="4">&nbsp;</td>
        </tr>
    </table>
</div>

<!-----------  //////////// 상단배너 ////////////  ----------->
<div class="box3">
    <img src='./image/xeronote.jpg' class='m_image'>
</div>

<div class="tables1">
    <div class="tables1_row">
        <div class="tables1_cell">
            <!-----------  //////////// 카테고리 ////////////  ----------->

            <td colspan='5' height='50' align="center" valign="middle">
                <a href="./board/bbs1/list.php?ctg=a&ctgs=a02">문의</a> &nbsp; | &nbsp;
                <a href="./board/bbs1/list.php?ctg=a&ctgs=a03">자유게시판</a> &nbsp; | &nbsp;
            </td>

        </div name="tables1 (닫기)">
    </div name="tables1_row (닫기)">
</div name="tables1_cell (닫기)">

</body>

<?
    include('./sub_page/count.php'); //방문자 카운터//
    include('./lib/data_dump.php'); //7일이 지난 탈퇴회원데이터 삭제//
?>
</html>