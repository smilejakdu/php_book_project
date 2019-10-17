<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_cache_limiter('nocache,must-revalidate'); //만료된 페이지 보이지 않음
ob_start();
include '../lib/connect.php';
$connect = dbconn();
$member = member_info();
$cinfo = co_info(); //회사정보
$device_mode = device_mode();  //기기 접속모드
$ctg = $_GET['ctg'] ?? null;

//////////// 회원 mID 생성 ////////////////  예) MP-181192-mv (10자리) / 문자열 길이:12자 
$dates = date("ds", time());  //날짜,초
$mID = "M" . chr(rand(65, 90)) . "-" . $dates . rand(1, 9) . rand(1, 9) . "-" . chr(rand(97, 122)) . chr(rand(97, 122));
//////  회원 mID 생성 끝 /////////////////
?>
<head>
    <title>회원가입페이지</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>


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

        .pc_mode_table1 {
            width: auto;
            height: auto;
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

        .p_terms {
            display: block;
        }

        /* PC 이용약간 */
        .m_terms {
            display: none;
        }

        /* 모바일 이용약간 */

        .p_privacy_policy {
            display: block;
        }

        /* PC 개인정보 수집방침 */
        .m_privacy_policy {
            margin: 0;
            display: none;
        }

        /* 모바일 개인정보 수집방침 */

        .input_text1 {
            width: 30%;
            height: auto;
            float: left;
        }

        .input_text2 {
            width: 20%;
            height: auto;
            float: left;
        }

        .input_text3 {
            width: 2%;
            height: auto;
            clear: both;
        }

        .input_email_1 {
            width: 50%;
            height: 28px;
            float: left;
        }

        .input_email_2 {
            width: 40%;
            height: 28px;
            float: left;
        }

        .input_email_3 {
            width: 2%;
            height: 28px;
            clear: both;
        }

        .ck_text_1 {
            width: 40%;
            height: 28px;
            float: left;
        }

        .ck_text_2 {
            width: 30%;
            height: 28px;
            float: left;
        }

        /* 화면 너비 0픽셀 ~ 600픽셀 */
        @media screen and (max-width: 768px) {
            .pc_mode_1 {
                display: none;
            }

            /* PC MODE */
            .mobile_mode_1 {
                display: block;
            }

            /* MOBILE_MODE_1 */
            .p_terms {
                display: none;
            }

            /* PC 이용약간 */
            .m_terms {
                display: block;
            }

            /* 모바일 이용약간 */
            .p_privacy_policy {
                display: none;
            }

            /* PC 개인정보 수집방침 */
            .m_privacy_policy {
                margin: 0;
                display: block;
            }

            /* 모바일 개인정보 수집방침 */
            .input_text1 {
                width: 50%;
                height: auto;
                float: left;
            }

            .input_text2 {
                width: 40%;
                height: auto;
                float: left;
            }

            .input_text3 {
                width: 2%;
                height: auto;
                clear: both;
            }

            .input_email_1 {
                width: 55%;
                height: 28px;
                float: left;
            }

            .input_email_2 {
                width: 30%;
                height: 28px;
                float: left;
            }

            .input_email_3 {
                width: 2%;
                height: 28px;
                clear: both;
            }

            .ck_text_1 {
                width: 50%;
                height: 28px;
                float: left;
            }

            .ck_text_2 {
                width: 40%;
                height: 28px;
                float: left;
            }
        }


        /* 화면 너비 0픽셀 ~ 400픽셀 */
        @media screen and (max-width: 480px) {
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
            .p_terms {
                display: none;
            }

            /* PC 이용약간 */
            .m_terms {
                width: 90%;
                height: 180px;
                overlow-x: scroll;
                background-color: #E2E4EE;
                display: block;
            }

            /* 모바일 이용약간 */
            .p_privacy_policy {
                display: none;
            }

            /* PC 개인정보 수집방침 */
            .m_privacy_policy {
                margin: 0;
                display: block;
            }

            /* 모바일 개인정보 수집방침 */
            .input_text1 {
                width: 85%;
                height: auto;
                float: left;
            }

            .input_text2 {
                width: 80%;
                height: auto;
                float: left;
            }

            .input_text3 {
                width: 2%;
                height: auto;
                clear: both;
            }

            .input_email_1 {
                width: 83%;
                height: auto;
                float: left;
            }

            .input_email_2 {
                width: 80%;
                height: auto;
                float: left;
            }

            .ck_text_1 {
                width: 90%;
                height: 28px;
                text-align: center;
                float: left;
            }

            .ck_text_2 {
                width: 90%;
                height: 28px;
                text-align: center;
                float: left;
            }
        }


        .esse {
            font-family: Tahoma;
            font-size: 10px;
            color: red;
            font-weight: bold;
        }

        .font_1 {
            font-family: 굴림, 돋움, Tahoma;
            font-size: 8pt;
            color: #838383
        }

        .zip {
            width: 15%;
            height: 26px;
        }

        .addr_1 {
            width: 95%;
            height: 26px;
        }

        .addr_2 {
            width: 60%;
            height: 26px;
        }
    </style>


    <script language=javascript>
        /////주소불러오기//////

        window.onload = function () {
            if (!document.form_1.terms.checked) {
                document.getElementById('terms_ms').innerHTML = '먼저 가입약간에 동의해 주세요.';
                document.getElementById('terms_ms').style.color = 'blue';
            }


            if (document.form_1.user_id_s.value == "") {
                document.getElementById('user_id_ms1').innerHTML = '아이디를 작성해 주세요..';
                document.getElementById('user_id_ms1').style.color = 'blue';
            }

            if (document.form_1.pw.value == "") {
                document.getElementById('pw_ms1').innerHTML = '비밀번호를 입력하세요.';
                document.getElementById('pw_ms1').style.color = 'blue';
            }

            if (document.form_1.name.value == "") {
                document.getElementById('name_ms').innerHTML = '이름을 입력하세요.';
                document.getElementById('name_ms').style.color = 'blue';
            }

            if (document.form_1.mphone_2.value == "" || document.form_1.mphone_3.value == "") {
                document.getElementById('mphone_ms').innerHTML = '휴대푠 번호를 입력하세요.';
                document.getElementById('mphone_ms').style.color = 'blue';
            }


            var input = form_1.elements;
            var sex = input.sex;
            for (var i = 0, c = sex.length; i < c; i++)
                if (sex[i].checked)
                    var jj = sex[i].value;
            if (!jj) {
                document.getElementById('sex_ms').innerHTML = '성별 채크하세요';
                document.getElementById('sex_ms').style.color = 'blue';
            }

            if (document.form_1.birth.value == "") {
                document.getElementById('birth_ms').innerHTML = '생년월일 입력하세요';
                document.getElementById('birth_ms').style.color = 'blue';
            }

            if (document.form_1.email.value == "") {
                document.getElementById('email_ms').innerHTML = '이메일을 입력하세요';
                document.getElementById('email_ms').style.color = 'blue';
            }

        }  //window.onload=function 닫기


        function terms_check() {
            if (document.form_1.terms.checked) {
                document.getElementById('terms_ms').innerHTML = '&nbsp;';
                document.getElementById('terms_ms').style.color = 'green';
                document.getElementById('sm1').value = "1";
            } else if (!document.form_1.terms.checked) {
                document.getElementById('terms_ms').innerHTML = '먼저 가입약간에 동의해 주세요.';
                document.getElementById('terms_ms').style.color = 'blue';
                document.getElementById('sm1').value = "0";
            }
        }


        function user_id_check() {
            if (!document.form_1.user_id.value) {
                window.alert('아이디를 입력하셔야 합니다.');
                document.form_1.user_id.focus();
                return false;
            }


            var a = document.form_1.user_id.value;

            window.open('id_check.php?user_id=' + a, 'idc', 'width=300, height=100');
        }


        function pw_check() {
            var pw_ch = document.form_1.pw.value;
            var confirmPW = document.form_1.pw_2.value;
            if (pw_ch.length < 6 || pw_ch.length > 16) {
                window.alert('비밀번호는 6글자 이상, 16글자 이하만 가능합니다.');
                document.getElementById('pw_ch').value = document.getElementById('pw2_ch').value = '';
                document.getElementById('pw_ms').innerHTML = '';
                document.getElementById('sm3').value = "0";
            }

            if (document.getElementById('pw_ch').value != '' && document.getElementById('pw2_ch').value != '') {
                if (document.getElementById('pw_ch').value == document.getElementById('pw2_ch').value) {
                    document.getElementById('pw_ms').innerHTML = '비밀번호가 일치합니다.';
                    document.getElementById('pw_ms1').innerHTML = '정상';
                    document.getElementById('pw_ms').style.color = 'green';
                    document.getElementById('pw_ms1').style.color = 'green';
                    document.getElementById('sm3').value = "1";
                } else {
                    document.getElementById('pw_ms').innerHTML = '비밀번호가 일치하지 않습니다.';
                    document.getElementById('pw_ms').style.color = 'red';
                    document.getElementById('pw_ms1').innerHTML = '&nbsp;';
                    document.getElementById('sm3').value = "0";
                }
            }
        }


        //////이름 유효성 검사///
        //허용길이

        function name_check() {
            if (document.form_1.name.value.length < 2 || document.form_1.name.value.length > 5) {
                document.getElementById('name_ms').innerHTML = '2~5자 까지만 허용합니다..';
                document.getElementById('name_ms').style.color = 'red';
                var error = 1;
                document.getElementById('sm4').value = "0";
            }


//한글만 허용
            for (i = 0; i < document.form_1.name.value.length; i++) {
                var _name = document.form_1.name.value;

                if (!((_name.charCodeAt(i) > 0x3130 && _name.charCodeAt(i) < 0x318F) || (_name.charCodeAt(i) >= 0xAC00 && _name.charCodeAt(i) <= 0xD7A3))) {
                    document.getElementById('name_ms').innerHTML = '한글만 입력하세요.';
                    document.getElementById('name_ms').style.color = 'red';
                    var error = 1;
                    document.getElementById('sm4').value = "0";

                } //  if
            } //for

//공백사용금지
            if (document.form_1.name.value.indexOf(" ") >= 0) {
                document.getElementById('name_ms').innerHTML = '공백을 사용할수 없습니다.';
                document.getElementById('name_ms').style.color = 'red';
                var error = 1;
                document.getElementById('sm4').value = "0";
            }

//에러가 없으면....
            if (!error == 1) {
                document.getElementById('name_ms').innerHTML = '양호.';
                document.getElementById('name_ms').style.color = 'green';
                document.getElementById('sm4').value = "1";
            }

        } //function


        //////휴대폰///
        //허용길이
        function mphone_check() {
            var _mphone_2 = /[_0-9-]{3,4}$/;
            var _mphone_3 = /[_0-9-]{4}$/;

            if (!document.form_1.mphone_2.value.match(_mphone_2) || !document.form_1.mphone_3.value.match(_mphone_3)) {
                document.getElementById('mphone_ms').innerHTML = '정확하게 입력해주세요.';
                document.getElementById('mphone_ms').style.color = 'red';
                document.getElementById('sm5').value = "0";
            } else {
                document.getElementById('mphone_ms').innerHTML = '양호';
                document.getElementById('mphone_ms').style.color = 'green';
                document.getElementById('sm5').value = "1";
            }
        }


        ////// 성별 /////////
        function display() {
            var input = form_1.elements;
            var sex = input.sex;
            for (var i = 0, c = sex.length; i < c; i++)
                if (sex[i].checked)
                    var jj = sex[i].value;
            if (jj) {
                document.getElementById('sex_ms').innerHTML = '&nbsp;';
                document.getElementById('sm6').value = "1";
            }
        }


        //////생년월일///
        //허용길이
        function birth_check() {
            var _birth = /[_0-9-]{8}$/;
            if (!document.form_1.birth.value.match(_birth)) {
                document.getElementById('birth_ms').innerHTML = '숫자8자리로 입력하세요..';
                document.getElementById('birth_ms').style.color = 'red';
                document.getElementById('sm7').value = "0";
                var error = 1;
            }
            //에러가 없으면....
            if (!error == 1) {
                document.getElementById('birth_ms').innerHTML = '양호.';
                document.getElementById('birth_ms').style.color = 'green';
                document.getElementById('sm7').value = "1";
            }
        }

        //////이메일 유효성 검사///
        //허용길이
        function email_check() {
            var reg_exp = /[0-9a-zA-Z][_0-9a-zA-Z-]*@[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+){1,2}$/;
            var _email = document.form_1.email.value;
            if (!_email.match(reg_exp)) {
                document.getElementById('email_ms').innerHTML = '이메일 형식이 아닙니다.';
                document.getElementById('email_ms').style.color = 'red';
                document.getElementById('sm8').value = "0";
            } else {
                document.getElementById('email_ms').innerHTML = '양호.';
                document.getElementById('email_ms').style.color = 'green';
                document.getElementById('sm8').value = "1";
            }
        }


        function addr_check() {
            if (!document.form_1.sc_addr_1.value == "") {
                document.getElementById('addr_ms').innerHTML = '확인완료';
                document.getElementById('addr_ms').style.color = 'green';
            }
        }


        /*
        필수항목은 '8개' 입니다.
        필수 항목을 입력하지 않는 경우 다음페이지로  진행이 되지 않습니다.
        필수항목: 약간동의, 아이디, 비밀번호, 이름, 휴대폰, 성별, 생년월일, 이메일
        */
        function join_submit() {
            var total = 0;
            var smm = document.getElementsByName('sm');
            for (var i = 0; i < smm.length; i++) {
                var s_mm = parseInt(smm[i].value);
                var total = total + s_mm;
            }
            document.form_1.hap.value = total;

            if (document.form_1.hap.value >= '8') {
                document.getElementById('join_submits').style.backgroundColor = '#85c4f9';
                document.form_1.submit();
            }
        }

    </script>
</head>


<!---///바디 조절 // 오른쪽 마우스 금지///--->
<BODY>

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

            <DIV ID="ex-wrap">


                <table border='0' width='98%' height='100%' bgcolor='FFFFFF' align='center' cellspacing='0'
                       cellpadding='0'>
                    <tr>
                        <td height='30' colspan='2' bgcolor='ffffff' align=center>
                            <b>[ 회 원 가 입 ]</b>
                        </td>

                    <tr>
                        <!--------이용약관---------->
                        <td width='100%' height='100%' colspan='2' align='center'>
                            <div class="p_terms">
	 <textarea style="width:1000px; height:300px; overlow-x:scroll;" readonly='readonly'>
	<? include './member_terms.php';  ///PC용 이용약간/// ?>
	 </textarea>
                            </div>

                            <div class="m_terms">
	 <textarea style="width:90%; height:180px; overlow-x:scroll; background-color:#E2E4EE;" readonly='readonly'>
	<? include './_member_terms.php'; ///모바일 이용약간///  ?>
	 </textarea>
                        </td>

                    <tr>
                        <td height='10' colspan='2' align='center'>&nbsp;</td>


                    <tr>
                        <!-----------개인정보 수집방침------------>
                        <td colspan='2' align='center'>
                            <div class="p_privacy_policy">
                                <? include './privacy_policy.php'; //PC 개인정보 수집방침 // ?>
                            </div>

                            <div class="m_privacy_policy">
                                <? include './_privacy_policy.php'; //모바일 개인정보 수집방침 // ?>
                            </div>

                        </td>


                    <tr>
                        <!----  폼테그 시작--------------------->

                        <form action='join_post.php' name='form_1' method='post'>
                            <input type='hidden' name='mID' value="<?= $mID ?>">
                            <input type='hidden' name='language' value='kor'>

                            <td align='center' colspan='2' bgcolor='#F7E0FA'>
                                <div class="ck_text_1">
                                    <font color='red'>[필수]</font> &nbsp; &nbsp;
                                    <b>위 약관을 동의합니다.</b>
                                    <input type='checkbox' name='terms' onclick="terms_check()"/>
                                </div>

                                <div class="ck_text_2">
                                    &nbsp; &nbsp; <span id="terms_ms"></span>
                                </div>
                                <input type='hidden' name='sm' id="sm1" value="0" onkeyup="cc_check()">
                            </td>

                    <tr>
                        <td height='40' colspan=2 align=right bgcolor=ffffff>
                            <!----------------------- 표기란 ----------------------->
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <font color=red>* (표기란은 모두 입력 하셔야 합니다.) </font><br>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <font color=red>형식에 맞게 입력 하셔야 회원가입이 가능 합니다. </font>
                        </td>

                    <tr>
                        <!----------------------- 아이디 ----------------------->
                        <td width='30%' height='40' bgcolor='ffffff' align='center'>
                            <font class='esse'>*</font> 아이디
                        </td>

                        <td width='70%' bgcolor='ffffff'>
                            <div class="input_text1">
                                <input type='text' size='15' name="user_id" onchange="user_id_check()"/>
                            </div>
                            <div class="input_text2">
                                &nbsp; &nbsp; <span id="user_id_ms1"></span>&nbsp; <span id="user_id_ms"></span>
                            </div>
                            <div class="input_text3"></div>
                            <font class="font_1"> 4자 이상 아이디는 영문(소문자),숫자, '_' 로 구성</font>
                        </td>

                        <input type='hidden' value='' name='user_id_s' id="user_id_s"/>
                        <input type='hidden' name="sm" id="sm2" value="0" onkeyup="cc_check()">


                    <tr>
                        <!----------------------- 비밀번호 ----------------------->
                        <td width='30%' height='40' bgcolor='E9EBED' align='center'><font class='esse'>*</font> 비밀번호:
                        </td>
                        <td width='70%' bgcolor='E9EBED'>
                            <div class="input_text1">
                                <input type='password' size='15' name='pw' id="pw_ch" onchange="pw_check()"/>
                            </div>
                            <div class="input_text2">
                                &nbsp; &nbsp; <span id="pw_ms1"></span>
                            </div>
                            <div class="input_text3"></div>
                            <font class="font_1">6~12자</font>
                        </td>

                        <input type='hidden' name="sm" id="sm3" value="0" onkeyup="cc_check()">


                    <tr>
                        <!----------------------- 비밀번호 확인 ----------------------->
                        <td height='40' bgcolor='E9EBED' align='center'>
                            <font class='esse'>*</font> 비밀번호 확인:
                        </td>

                        <td bgcolor=E9EBED>
                            <div class="input_text1">
                                <input type='password' size='15' name='pw_2' id="pw2_ch" onchange="pw_check()"/>
                            </div>
                            <div class="input_text2">
                                &nbsp; &nbsp; <span id="pw_ms"></span>
                            </div>
                            <div class="input_text3"></div>
                            <font class="font_1">(분실 방지를 막기위해 한번더 입력하세요.)</font>
                        </td>


                    <tr>
                        <!----------------------- 이름 ----------------------->
                        <td height='40' align='center'>
                            <font class='esse'>*</font> 이 름:
                        </td>
                        <td>
                            <div class="input_text1">
                                <input type='text' name='name' id='name_ch' maxlength='5' size='15' value=''
                                       onchange='name_check()'/>
                            </div>
                            <div class="input_text2">
                                &nbsp; &nbsp; <span id="name_ms"></span>
                            </div>
                            <div class="input_text3"></div>

                            &nbsp; <font class="font_1">(한글2자~5자 이내)</font>
                        </td>
                        <input type='hidden' name="sm" id="sm4" value="0" onkeyup="cc_check()">


                    <tr>
                        <!----------------------- 닉네임 한국어 ----------------------->
                        <td height='40' bgcolor='E9EBED' align='center'>닉네임:</td>
                        <td bgcolor=E9EBED>
                            <input type=text name='nickname' maxlength='5' size='12' onchange='name_check()'>
                            &nbsp; &nbsp; <span id="nickname_ms"></span>
                            <br><font class="font_1">(한글,영문5까지) </font>
                        </td>


                    <tr>
                        <!----------------------- 연락처 ----------------------->
                        <td height='40' align='center'></font>연락처:</td>
                        <td>
                            <input type=text name='tel' maxlength='13' size='25'>
                            <br>
                            <font class="font_1">총13자리 예) 02-1234-1234 </font>
                        </td>


                    <tr>
                        <!----------------------- 핸드폰 ----------------------->
                        <td height='40' bgcolor='E9EBED' align='center'>
                            <font class='esse'>*</font> 휴대폰:
                        </td>
                        <td bgcolor=E9EBED>
                            <div class="input_text1">
                                <select name='mphone_1'>
                                    <option value='010'> 010
                                    <option value='011'> 011
                                    <option value='017'> 017
                                    <option value='018'> 018
                                    <option value='019'> 019
                                </select>
                                - <input type=text name='mphone_2' size='5' maxlength='4' onchange="mphone_check()"/>
                                - <input type=text name='mphone_3' size='5' maxlength='4' onchange="mphone_check()"/>
                            </div>
                            <div class="input_text2">
                                <span id="mphone_ms"></span>
                            </div>
                            <div class="input_text3"></div>
                        </td>
                        <input type='hidden' name="sm" id="sm5" value="0" onkeyup="cc_check()">


                    <tr>
                        <!----------------------- 성별----------------------->
                        <td height='40' align='center'><font class='esse'>*</font> 성 별:</td>
                        <td>
                            <div class="input_text1">
                                <input type="radio" name='sex' value='male' onclick="display(this);">남 자 &nbsp; &nbsp;
                                <input type="radio" name='sex' value='female' onclick="display(this);">여 자
                            </div>
                            <div class="input_text2">
                                &nbsp; &nbsp; <span id="sex_ms"></span>
                            </div>
                            <div class="input_text3"></div>
                        </td>
                        <input type='hidden' name="sm" id="sm6" value="0" onkeyup="cc_check()">


                    <tr>
                        <!----------------------- 생년월일----------------------->
                        <td height='40' bgcolor='E9EBED' align='center'>
                            <font class='esse'>*</font> 생년월일:
                        </td>
                        <td bgcolor=E9EBED>
                            <div class="input_text1">
                                <input type='text' name='birth' id='birth_ch' size='8' maxlength='8'
                                       onchange="birth_check();" placeholder="12345678">
                            </div>
                            <div class="input_text2">
                                &nbsp; &nbsp; <span id='birth_ms'></span>
                            </div>
                            <div class="input_text3"></div>
                            <font class="font_1"> (예:) 20001010 (8섯자리로 입력하세요.)</font> <br>
                        </td>

                        <input type='hidden' name="sm" id="sm7" value="0" onkeyup="cc_check()">

                    <tr>
                        <!----------------------- 이메일  ----------------------->

                        <td height='40' align='center'><font class='esse'>*</font> email:</td>

                        <td>
                            <div class="input_text1">
                                <input type='text' name='email' size='25' onchange="email_check();">
                            </div>
                            <div class="input_text2">
                                &nbsp; &nbsp; <span id='email_ms'></span>
                            </div>
                            <div class="input_text3"></div>
                            &nbsp; <font class="font_1">이메일 형식에 맞게 작성해 주세요.</font>
                        </td>

                        <input type='hidden' name="sm" id="sm8" value="0" onkeyup="cc_check()">



                    <tr>
                        <td height='60' colspan='2' align='center'>
                            <input type='hidden' name='hap' size='5' value="0" OnChange="cc_check()"> </input>
                            <!----------------------- 가입하기----------------------->
                            <input type='button' id="join_submits" value='가입하기' onclick="join_submit();"
                                   style="border:none; height:25px">
                        </td>

                    </tr>
                </table>
                </form>


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