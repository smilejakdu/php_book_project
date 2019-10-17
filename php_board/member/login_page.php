<?php
session_start();
ob_start(); ?>

<head>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>

    <!-- 링크시 테두리선 안보이게-->
    <style>
        a {
            selector-dummy: expression(this.hideFocus=true);
        }  </style>
    <!-- 링크시 ,,,,  End-->


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
    </script>

</head>

<?
$ctg = $_GET['ctg'] ?? null;

include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
?>


<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY LEFTMARGIN='0' TOPMARGIN='0' RIGHTMARGIN='0' BOTTOMMARGIN='0' onload="focus();" oncontextmenu="return false">


<!---///////////////////////////////////[테이블 시작]//////////////////////////////////////////////////----->
<TABLE BORDER='0' CELLSPACING='0' CELLPADDING='0' WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP'>
    <tr>
        <!-------------[[상단 로고/카페고리1]]------------->
        <td WIDTH='100%' HEIGHT='105' ALIGN='CENTER' VALIGN='TOP'>
            <iframe src="../sub_page/top.php" name='top' width='100%' HEIGHT='105' frameborder='0' marginwidth='0'
                    marginheight='0' scrolling='no'>
            </iframe>
        </td>
    </tr>
    <!------------ 상단 카테고리 2----------->

    <td WIDTH='100%' HEIGHT='30' ALIGN='CENTER' VALIGN='MIDDLE' BGCOLOR='#434343'>
        <iframe src="../sub_page/top_category.php?ctg=<?= $ctg ?>" name='top_category' width='100%' HEIGHT='30'
                frameborder='0' marginwidth='0' marginheight='0' scrolling='no'>
        </iframe>
    </td>


    <tr>
        <!-------------[[중앙 내용]]------------->
        <td WIDTH='100%' HEIGHT='100%' ALIGN='CENTER' VALIGN='TOP' BGCOLOR='#FFFFFF'>


            <!-------------((본문시작))------------->

            <table border='0' width='85%' height='430' cellspacing='0' cellpadding='0' align='center'>

                <tr>
                    <td colspan='3' width='100%' height='50' align='center' valign="middle">&nbsp;</td>
                </tr>
                <td colspan='3' width='100%' height='30' align='center' valign="middle">
                    <span style="font-size:20px; font-weight:bolder; color: #17A589">회원로그인</span>
                </td>

                <tr>
                    <td colspan='3' width='100%' height='50' align='center' valign="middle">
                        <hr size='3' width='95%' color='17A589'/>
                    </td>
                </tr>
                <td width='50%' height='150' align='center' valign="middle">
                    <!---   로그인 테이블 시작----------->
                    <table border='0' width='100%' height='150' cellspacing='0' cellpadding='0' align='center'
                           valign="middle">
                        <tr>
                            <td width='100%' height='30' align='center' valign="middle">&nbsp;</td>
                            <form action='./login_check.php' method='post'>
                                <input type='hidden' name='id' value='<?= $id ?>'>
                                <input type='hidden' name='login_locate' value='main'>
                        </tr>
                        <!--- 로그인 페이지위치 (메인:main / 일반:normal) -->

                        <td width='100%' height='50' align='right' valign="middle">
                            &nbsp; &nbsp; &nbsp;
                            <!--아이디-->
                            <input type='text' name='user_id'
                                   style="width:160px; height:40px; background-color:#E0E0E0"
                                   value=' user I D  (아이디) '
                                   onblur="if(this.value == '') this.value=' user I D (아이디) ';"
                                   onfocus="this.value=''">
                        </td>

                        <tr>
                            <td width='100%' height='50' align='right' valign="middle">
                                <!---비번--->
                                <input type='password' name='pw'
                                       style="width:160px; height:40px; background-color:#E0E0E0;" value='password'
                                       onblur="if(this.value == '') this.value='password';" onfocus="this.value=''">
                            </td>
                        </tr>
                    </table>
                </td>


                <td width='3%' align='center' valign="middle">&nbsp;</td>

                <td colspan='3' width='47%' height='150' align='left' valign="middle">
                    <!---로그인--->
                    <input TYPE="IMAGE" src="./member_img/logins.gif" width='93' height='93' onfocus="this.blur()"
                           name="Submit" value="Submit" align="absmiddle"/>
                </td>


                <tr>
                    <td colspan='3' width='100%' height='50' align='center' valign="bottom">
                        &nbsp; &nbsp; &nbsp;
                        <input type='checkbox' name='autologin' value='1'
                               onclick="window.alert('개인용 PC에서만 사용하시기 바랍니다.');"> &nbsp; 아이디 저장
                        <br>
                        <hr size='3' width='95%' color='17A589'/>
                    </td>
                    </form>

                </tr>
                <td colspan='3' width='100%' height='50' align='center' valign="middle">
                    * 아직 회원이 아니시면 <a href="./join.php?ctg=members" target='_top' OnFocus="this.blur()"><span
                                color='blue'>[회원가입]</span></a> 를 클릭 하세요. <br><br>

                    * ID및 비밀번호가 생각이 안나시면 <br>
                    &nbsp; &nbsp;
                    <a href="./search_myuser.php?ctg=members" target='_top' OnFocus="this.blur()"><span
                                color='#FF00A8'>[아이디/비밀번호 찾기!]</span></a> 를 클릭하세요. <br>
                </td>

                <tr>
                    <td colspan='3' width='100%' height='100%' align='left' valign="middle">&nbsp;</td>
                </tr>
            </table>
            <!-------------((본문끝))------------->


        </td>  <!-------------[[중앙 내용 (끝)]]------------->
    </tr>  <!---- 본문내용 테이블_1(/TR)----->


    <tr>
        <!------------  하단 마커 --------------------->
        <td WIDTH='100%' HEIGHT='150' ALIGN='CENTER' BGCOLOR='<?= $setup['marker_c'] ?>' VALIGN='BOTTOM'>
            <iframe src="../sub_page/maker.php" width='100%' height='150' scrolling="no" frameborder="0"
                    marginwidth='0'/>
        </td>
    </tr>
</TABLE> <!---- 본문내용 테이블_1(/TABLE)----->