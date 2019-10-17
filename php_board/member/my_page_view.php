<? session_start(); //ob_start(); ?>
<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>

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


        /*링크시 테두리선 안보이게*/
        a {
            selector-dummy: expression(this.hideFocus=true);
        }

        /*링크시 테두리선 안보이게 [끝]*/

        /* 회원정보 / 쪽지 */
        .member_box {
            display: table;
        }

        .row {
            display: table-row;
            height: 30px;
        }

        .members {
            display: table-cell;
            width: 120pt;
            text-align: center;
            vertical-align: middle;
        }

        #addrs {
            margin-left: 10px;
            width: 80%;
            height: 50px;
            border: solid #B0A071;
            border-width: 1px 0 1px 0;
        }

        .message {
            display: table-cell;
            width: 80%;
            height: 30px;
            text-align: right;
            vertical-align: middle;
        }

        .message img {
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }

        .me_ct {
            width: 40px;
            height: 25px;
        }


        .profile_box1 {
            margin: 0;
            padding: 0;
            border: 2px dotted #0000ff;
        }

        .profile_1 {
            top: 130px;
            left: 5px;
            text-align: left;
            font-size: 9pt;
            font-family: 돋움, Tahoma;
            color: #A7A7A7;
        }

        .profile_2 {
            font-size: 9pt;
            font-family: 돋움, Tahoma;
            color: #B0A071;
        }

        .profile_box2 {
            border: 1px dotted #0000ff;
        }

        .pf_font1 {
            text-align: left;
            font-size: 9pt;
            font-family: 돋움, Tahoma;
            color: #A7A7A7;
        }

        .pf_font2 {
            font-size: 9pt;
            font-family: 돋움, Tahoma;
            color: #B0A071;
        }

        .profile_box3 {
            border: 2px dotted #EB0A79;
        }

    </style>


    <!----///////////[/프로필 이미지 크게보기]//////////------>
    <script language='javascript'>
        <!--
        function profile_img(url) {
            var img = new Image();
            img.src = url;
            var pop = window.open('', 'pop', 'width=300px, height=300px, toolbar=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no');
            pop.document.body.style.margin = '0px;';
            pop.document.body.innerHTML = '<img src="' + url + '" width="300" height="300"  title="창닫기" onclick="self.close();">';
        }

        //-->

        function shopping() {
            location.href = "../store/member/my_shopping.php";
        }
    </script>

</head>

<?
$ctg = $_GET['ctg'] ?? null;

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$device_mode = device_mode();  //기기 접속모드

?>


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
            <hr size='0.1' width='90%' color='#E4E4E4'/>
            <br>


            <? if (!$member['user_id']) {  //회원아이디가 없다면 로그인/////?>
                <iframe name='top' src="./login_box.php" name='top' width='100%' HEIGHT='430' frameborder='0'
                        marginwidth='0' marginheight='0' scrolling='no'>
                </iframe>
                <? exit;
            } ?>


            <DIV ID="auto_size">
                <div class="box1">&nbsp;</div>
                <div class="box2">
                    <!------ ///////상단바 ////////-------->
                    <table border='0' width='100%' height='25' align='center' valign='top' cellspacing='0'
                           cellpadding='0'>
                        <tr>
                            <?
                            $query = "select count(*) from message where to_user_id='$member[user_id]' and to_mID='$member[mID]' and checks!='OK'  ";
                            $result = mysqli_query($connect, $query);
                            $m_temp = mysqli_fetch_array($result);
                            ?>
                            <td width="100%" height='25' align='right' valign='middle' bgcolor='#FFFFFF' colspan='5'>
                                <div class="member_box">
                                    <div class='members'>
                                        <a href="./my_page_edit.php?ctg=members" onfocus="this.blur()"><font
                                                    color='#0024FF'><b>회원정보수정</b></font></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>


                    <?
                    //생년월일
                    $birth_y = substr($member['birth'], 0, 4);
                    $birth_m = substr($member['birth'], 4, 2);
                    $birth_d = substr($member['birth'], 6, 2);

                    //성별: 남자
                    if ($member['sex'] == "male")
                        $sex_img = "<img src=./member_img/member_boy.gif border=0 alt='male'>";

                    //성별: 여자
                    if ($member['sex'] == "female")
                        $sex_img = "<img src=./member_img/member_girl.gif border=0 alt='female'>";

                    //성별: 모름
                    if ($member['sex'] == "-")
                        $sex_img = "<img src=./member_img/member_x.gif border=0 alt='-'>";
                    ?>


                    <table border='0' width='100%' height='40' align='center' valign='top' cellspacing='0'
                           cellpadding='0'>
                        <tr>
                            <td height='50' align='center' valign='middle' bgcolor='#FFFFFF'>
                                <span style='font-size:12pt; font-family:돋움,Tahoma; color:#769096'>「마 이 페 이 지」</font></span>
                            </td>

                        <tr>
                            <!----프로필 이미지--->
                            <td width='100%' height='120' align='center' valign='top' bgcolor='#FFFFFF'>
                                <table border='0' width='100%' height='120'>


                                    <tr>
                                        <td width='40%' height='120' align='center' valign='top' bgcolor='#FFFFFF'
                                            class='profile_box1'>
                                            <br>
                                            <? if (!$member['file01']) { // 자신의 프로필이 없으면 ....; ?>
                                                <img src='./member_img/pv_x.gif' width=80 height=80>
                                            <? } else { ?>
                                                <!-------프로필이미지가 있는경우는 아래를 출력---->
                                                <img src='../dataset/member/<?= $member[file01] ?>' width='80'
                                                     height='80' title='zoom +' onclick='profile_img(this.src);'
                                                     style='cursor:hand;'>
                                                <br>
                                                (zoom +)
                                            <? } ?>
                                        </td>


                                        <td width='60%' height='120' align='center' valign='top' bgcolor='#FFFFFF'>
                                            <div class='profile_1'>
                                                <li><font class='profile_2'><?= $member['name'] ?></font>
                                                <li><font class='profile_2'><?= $member['user_id'] ?></font>
                                                <li>
                                                    <font class='profile_2'><? echo $birth_y . "-", $birth_m . "-", $birth_d; ?></font>
                                                    <? if ($member['nickname']){ ?>
                                                <li><font class='profile_2'>(<?= $member['nickname'] ?>)</font><? } ?>
                                                    <br> <br>
                                                    &nbsp; &nbsp;
                                                    <?= $sex_img; ?> &nbsp; &nbsp; <img
                                                            src='./member_img/level/<?= $member['level'] ?>.gif'>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </td>


                        <tr>
                            <td width='50%' height='200' align='left' valign='top' bgcolor='#FFFFFF'
                                class='profile_box2'>
                                <p>&nbsp;</p>

                                <div align='right'>
                                    가입일:
                                    <?
                                    echo $data_Y = substr($member['regdate'], 0, 4) . "-";
                                    echo $data_m = substr($member['regdate'], 4, 2) . "-";
                                    echo $data_d = substr($member['regdate'], 6, 2) . "&nbsp;";
                                    echo $data_h = substr($member['times'], 0, 2) . ":";
                                    echo $data_i = substr($member['times'], 2, 2);
                                    ?>
                                    &nbsp; &nbsp; &nbsp;
                                </div>

                                <br>
                                <div class='pf_font1'>
                                    <li>혈액형 : <span class='pf_font2'><?= $member['blood_type'] ?></span>형
                                    <li>E-mail : <span class='pf_font2'><?= $member['email'] ?></span>
                                    <li>전화번호 : <span class='pf_font2'><?= $member['tel'] ?></span>
                                    <li>핸드폰 : <span
                                                class='pf_font2'><?= $member['mphone_1'] ?>-<?= $member['mphone_2'] ?>
                                            -<?= $member['mphone_3'] ?></span>
                                </div>
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td height='100' align='center' valign='middle' bgcolor='#FFFFFF'>
                                <a href="../main.php" onfocus="this.blur()"><img src='./member_img/ok_s.gif' border='0'
                                                                                 title="OK"></a>
                            </td>
                            <td width='100%' height='100%' bgcolor='#ffffff'> &nbsp;</td>
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
        <TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?= $setup['marker_c'] ?>' VALIGN='BOTTOM'>
            <iframe src="../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </TD>
    </TR>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->