<? session_start();
ob_start(); ?>
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
            width: 18%;
            height: 100%;
            float: left;
        }

        .box2 {
            margin: 0;
            width: 58%;
            height: 100%;
            float: left;
        }

        .xtd1 {
            margin: 0;
            width: 40%;
            height: 230px;
            text-align: center;
            float: left;
            display: block;
        }

        .xtd2 {
            margin: 0;
            width: 60%;
            height: 230px;
            text-align: left;
            float: left;
            display: block;
        }

        .clears {
            clear: both;
        }


        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .box1 {
                margin: 0;
                width: 10%;
                height: 100%;
                float: left;
            }

            .box2 {
                margin: 0;
                width: 80%;
                height: 100%;
                float: left;
            }

            .xtd1 {
                margin: 0;
                width: 80%;
                height: 230px;
                text-align: center;
                float: left;
                display: block;
            }

            .xtd2 {
                margin: 0;
                width: 80%;
                height: 230px;
                text-align: left;
                float: left;
                display: block;
            }

            .clears {
                clear: both;
            }
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {
            .box1 {
                margin: 0;
                width: 3%;
                height: 100%;
                float: left;
            }

            .box2 {
                margin: 0;
                width: 94%;
                height: 100%;
                float: left;
            }


            .xtd1 {
                margin: 0;
                width: 95%;
                height: 230px;
                text-align: center;
                float: left;
                display: block;
            }

            .xtd2 {
                margin: 0;
                width: 95%;
                height: 230px;
                text-align: left;
                float: left;
                display: block;
            }

            .clears {
                clear: both;
            }
        }


        a {
            selector-dummy: expression(this.hideFocus=true); /*링크시 테두리선 안보이게*/
        }

        #profile_img {
            margin: 0;
            padding: 0;
            width: 120px;
        }

        .profile_1 {
            margin: 0;
            padding: 0px;
            background: #FFF
        }

        .profile_2 {
            margin: 0;
            padding: 0px;
            background: #FFF;
            border: 1px solid #CDCDCD;
        }

        .profile_3 {
            margin: 0;
            padding: 0px;
            width: 10%;
            background: #FFF;;
        }

        .profile_4 {
            margin: 0;
            padding: 5px;
            background: #FFF;
            border: 1px solid #CDCDCD;
            width: 70%
        }


        .b_bottom {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 40px;
            position: relative;
        }

        .edit_bottom {
            background: url('./member_img/edit_s.gif') no-repeat;
            width: 63px;
            height: 25px;
            border: 0;
            position: absolute;
            top: 1px;
            left: 50%;
        }

        .b_bottom a {
            position: absolute;
            top: 1px;
            left: 56%;
        }
    </style>
</head>

<?
///////////////////////////////
$user_id = $_SESSION['user_id'] ?? null;
///////////////////////////////
$ctg = $_GET['ctg'] ?? null;


include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$device_mode = device_mode();  //기기 접속모드


$query = "select * from member where user_id='$user_id'";
mysqli_query($connect, "set names utf8");
$result = mysqli_query($connect, $query);
$member = mysqli_fetch_array($result);

?>


<!-- 링크시 ,,,,  End-->

<!----- 주소불러오기------->
<script language=javascript>
    function address(option) {
        if (option == "c") { // 검색된 우편번호와 주소 가져오기
            theURL = "../infor/zip/search_addr_2.php?result_1=1&option=" + option;
            window.open(theURL, "zip", "left=100,top=100,width=520,height=350,scrollbars");
        } else {
            theURL = "../infor/zip/search_addr_2.php?result_1=1";
            window.open(theURL, "zip", "left=100,top=100,width=520,height=350,scrollbars");
        }
    }


    function address_2(option_2) {
        if (option_2 == "c") { // 검색된 우편번호와 주소 가져오기
            theURL = "../infor/zip/search_addr_3.php?result_1=1&option=" + option_2;
            window.open(theURL, "zip", "left=100,top=100,width=520,height=350,scrollbars");
        } else {
            theURL = "../infor/zip/search_addr_3.php?result_1=1";
            window.open(theURL, "zip", "left=100,top=100,width=520,height=350,scrollbars");
        }
    }
</script>
<!----- 주소불러오기 (끝)------->


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


            <? if (isset($member['user_id'])) {  //회원아이디가 없다면 로그인 (끝) /////?>
                <iframe name='top' src="./login_box.php" name='top' width='100%' HEIGHT='430' frameborder='0'
                        marginwidth='0' marginheight='0' scrolling='no'>
                </iframe>
                <? exit;
            } ?>

            <DIV ID="auto_size">
                <div class="box1">&nbsp;</div>
                <div class="box2">
                    <!-------------  마이페이지--------------->
                    <table border='0' cellspacing='0' cellpadding='0' width='100%' height='50' align='center'
                           valign='top'>
                        <form action='my_page_edit_post.php' method='post' name='form_1' enctype='multipart/form-data'>
                            <input type='hidden' name='no' value='<?= $member[no] ?>'>

                            <tr>
                                <td width='100%' height='50' align='right' colspan='3' bgcolor='#FFFFFF'>
                                    <a href="my_page_view.php?user_id=<?= $member[user_id] ?>&ctg=members">[마이페이지
                                        가기!]</a>
                                    &nbsp; &nbsp;
                                    <a href="pw_edit.php"
                                       onClick="window.open('../member/pw_edit.php?<?= $member[user_id] ?>&no=<?= $member[no] ?>','','resizable=no width=600 height=450');return false">
                                        <font color='#FF0000'>[비밀번호 수정]</font></a>
                                    &nbsp; &nbsp;
                                    <a href="./userIDdel.php?user_id=<?= $member[user_id] ?>&no=<?= $member[no] ?>&ctg=members"><font
                                                color='#676767'>[회원탈퇴]</font></a>
                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                </td>


                            <tr>
                                <td width='100%' height='30' align='center' colspan='3' bgcolor='#FFFFFF'>
                                    <span style='font-size:12pt; font-family:돋움,Tahoma; color:#005DFF; font-weight:bold;'>회 원 정 보  수 정</span>
                                    <hr size='0.1' color='#D1E5F7' width='100%'/>
                                </td>
                            </tr>
                    </table>


                    <div class="xtd1">
                        <table border='0' cellspacing='0' cellpadding='0' width="100%" height='230' align='center'
                               valign='top'>
                            <tr>
                                <td width='45%' align='center' bgcolor='FFFFFF' id='profile_img'>
                                    프로필 사진
                                    <br><br>
                                    <? if (!$member[file01]) { // 자신의 프로필이 없으면 ....; ?>
                                        <img src='./member_img/pv_x.gif' width='120px' height='auto'>
                                    <? } else { ?>
                                        <!-------프로필이미지가 있는경우는 아래를 출력---->
                                        <img src='../dataset/member/<?= $member[file01] ?>' width='120px' height='auto'>
                                    <? } ?>
                                </td>


                                <td width='55%' bgcolor='#D1E5F7' class='profile_1'>
                                    이름: &nbsp;
                                    <b><?= $member[name] ?></b>
                                    <br><br>
                                    user ID: &nbsp; <b><?= $member[user_id] ?><br><br>

                                        <? // //// 생년월일 년,달,일 로 구분 ////////////
                                        $birth_y = substr($member[birth], 0, 4);
                                        $birth_m = substr($member[birth], 4, 2);
                                        $birth_d = substr($member[birth], 6, 2);
                                        ?>
                                        <!---(생년월일)--->생년월일:
                                        &nbsp; <b><? echo $birth_y . "-", $birth_m . "-", $birth_d ?></b> <br>

                                        <!---(닉네임)--->닉네임:
                                        &nbsp;
                                        <input type='text' name='nickname' style="width:90px" maxlength='5'
                                               value='<?= $member[nickname] ?>'/>
                                        <br>


                                        <!---(성별)--->성별:
                                        &nbsp;
                                        <?
                                        if ($member[sex] == "male")
                                            $sex_img = "<img src=./member_img/member_boy.gif border=0 alt='male'>";

                                        if ($member[sex] == "female")
                                            $sex_img = "<img src=./member_img/member_girl.gif border=0 alt='female'>";

                                        if ($member[sex] == "-")
                                            $sex_img = "<img src=./member_img/member_x.gif border=0 alt='-'>";
                                        echo $sex_img;
                                        ?>
                                        &nbsp; &nbsp; &nbsp;

                                        Level:
                                        <img src='./member_img/level/<?= $member[level] ?>.gif'/>

                                </td>
                            </tr>
                        </table>
                    </div>


                    <div class="xtd2">
                        <table border='0' cellspacing='0' cellpadding='0' width="100%" height='220' align='center'
                               valign='top'>
                            <tr>
                                <td width='100%' class='profile_1'>
                                    E-mail:
                                    <input type=text name='email' size=25 value='<?= $member[email] ?>'/>
                                    <br><font color=blue><!---(이메일 형식)--->*형식에 맞게 작성해주세요. </font>


                                    <br><br>
                                    <!---(전화번호)--->전화번호:
                                    <input type=text name=tel size=15 value='<?= $member[tel] ?>'/>


                                    <br><br>

                                    <!---(휴대폰)--->
                                    핸드폰: &nbsp;
                                    <b> <input type=text name='mphone_1' size=3 value='<?= $member[mphone_1] ?>'
                                               maxlength='3'/> -
                                        <input type=text name='mphone_2' size=4 value='<?= $member[mphone_2] ?>'
                                               maxlength='4'/> -
                                        <input type=text name='mphone_3' size=4 value='<?= $member[mphone_3] ?>'
                                               maxlength='4'/> </b>
                                    <br>
                                    <font color=blue>
                                        <!---(휴대폰)--->
                                        *형식에 맞게 입력해주세요.
                                    </font>

                                    <br><br>

                                    <!---(프로필사진 변경)--->
                                    프로필 사진 변경: <input type='file' name='file01' size=20 value='<?= $member[file01] ?>'/>
                                    <br>
                                    <font color=blue>이미지는 가로:300px 세로300px 크기로 보입니다. <br> <u>용량은350kb로 제한</u>합니다.</font>
                                </td>

                            </tr>
                        </table>
                    </div>


                    <table border='0' cellspacing='0' cellpadding='0' width='100%' height='145' align='center'
                           valign='top'>
                        <tr>
                            <td width='100%' height="25" colspan="2" class='profile_1'>
                                <!---(직업)--->
                                <br><br>

                                <!---(혈액형)--->
                                <?
                                if ($member['blood_type'] == $my_blood_type1 = "A") {
                                    $b_type1 = "<font color='E601AD'><b>";
                                    $La01 = "<!--";
                                    $La02 = "-->";
                                }
                                if ($member['blood_type'] == $my_blood_type1 = "B") {
                                    $b_type2 = "<font color='E601AD'><b>";
                                    $Lb01 = "<!--";
                                    $Lb02 = "-->";
                                }
                                if ($member['blood_type'] == $my_blood_type1 = "O") {
                                    $b_type3 = "<font color='E601AD'><b>";
                                    $Lc01 = "<!--";
                                    $Lc02 = "-->";
                                }
                                if ($member['blood_type'] == $my_blood_type1 = "AB") {
                                    $b_type4 = "<font color='E601AD'><b>";
                                    $Ld01 = "<!--";
                                    $Ld02 = "-->";
                                }

                                ?>
                                <li>혈액형: &nbsp; &nbsp;

                                    [<?= $b_type1 ?>A형</b></font><?= $La01 ?><input type="radio" name="blood_type"
                                                                                    value="A"><?= $La02 ?>] &nbsp;
                                    &nbsp; &nbsp;

                                    [<?= $b_type2 ?>B형</b></font><?= $Lb01 ?><input type="radio" name="blood_type"
                                                                                    value="B"><?= $Lb02 ?>] &nbsp;
                                    &nbsp; &nbsp;

                                    [<?= $b_type3 ?>O형</b></font><?= $Lc01 ?><input type="radio" name="blood_type"
                                                                                    value="O"><?= $Lc02 ?>] &nbsp;
                                    &nbsp; &nbsp;

                                    [<?= $b_type4 ?>AB형</b></font><?= $Ld01 ?><input type="radio" name="blood_type"
                                </li>
                                value="AB"><?= $Ld02 ?>]
                                <div style="height:15px;">&nbsp;</div>
                            </td>


                        <tr>
                            <td align=center class='profile_3'>
                                주 소
                            </td>

                            <td colspan='2' height='60' class='profile_4'>
                                <!-- //(우편번호)//-->
                                우편번호<input type=text name='sc_zip' value='<?= $member[zip] ?>' style="width:50px"
                                           maxlength=7 readonly>
                                <a href="javascript:address()"><img src='./member_img/look_.gif' border=0
                                                                    align=absmiddle></a>
                                <br>

                                <!--//(주소)//-->
                                <input type='text' name='sc_addr_1' value='<?= $member[addr_1] ?>' style="width:90%"
                                       maxlength=60 readonly>
                                <input type='text' name='sc_addr_2' value='<?= $member[addr_2] ?>' style="width:90%"
                                       maxlength=60>
                            </td>


                        <tr>
                            <td colspan='3' height='60' align='center' bgcolor='#FFFFFF'>
                                <!---(비밀번호)--->
                                <font color=#FF0000>* 현재비밀번호</font>
                                &nbsp; &nbsp;
                                <input type='password' name='pw' size=15>
                            </td>


                        </tr>
                    </table>


                    <table border='0' width='100%' height='120' align='center' valign='top' cellspacing='0'
                           cellpadding='0'>
                        <tr>
                            <td width='40%' height='70' align='right'>
                                <input type='submit' value=''
                                       style="background-image:url('member_img/edit_s.gif'); width:63px; height:25px; border:0;">
                            </td>
                            </form>

                            <td width='10%' height='70' align=center>&nbsp;</td>


                            <td width='40%' height='70' align='left'>
                                <a href="javascript:history.back()" onfocus="this.blur()"><img
                                            src='./member_img/cancel_s.gif' width='63' height='25' title='Cancel'
                                            border='0'></a>
                            </td>
                        </tr>
                        <td colspan='3' align=center height='100%' bgcolor=#D1E5F7> &nbsp; &nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="box1">&nbsp;</div>
                <div class="clears">&nbsp;</div>


            </DIV>


        </TD>  <!-------------[[중앙 내용 (끝)]]------------->
    </TR>  <!---- 본문내용 테이블_1(/TR)----->


    <TR>
        <!------------  하단 마커 --------------------->
        <TD WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?= $setup[marker_c] ?>' VALIGN='BOTTOM'>
            <iframe src="../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </TD>
    </TR>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->