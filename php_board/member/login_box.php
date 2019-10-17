<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>
</head>
<!-------------((본문시작))------------->

<table border='0' width='85%' height='430' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td colspan='3' width='100%' height='50' align='center' valign="middle">&nbsp;</td>
    </tr>
    <td colspan='3' width='100%' height='30' align='center' valign="middle">
        <span style="font-size:20px;  font-weight:bolder;">회원로그인</span>
    </td>

    <tr>
        <td colspan='3' width='100%' height='50' align='center' valign="middle">
            <hr size='3' width='95%' color='E9A0E3'/>
        </td>
    </tr>
    <td width='50%' height='150' align='center' valign="middle">
        <!---   로그인 테이블 시작----------->
        <table border='0' width='100%' height='150' cellspacing='0' cellpadding='0' align='center' valign="middle">
            <tr>
                <td width='100%' height='30' align='center' valign="middle">&nbsp;</td>
                <form action='./login_check.php' method='post'>
                    <input type='hidden' name='id' value='<?= $id ?>'>
                    <input type='hidden' name='login_locate' value='normal'>
                    <!--- 로그인 페이지위치 (메인:main / 일반:normal) -->

            </tr>
            <td width='100%' height='50' align='right' valign="middle">
                &nbsp; &nbsp; &nbsp;
                <!--아이디-->
                <input type='text' name='user_id' style="width:160px; height:40px; background-color:#E0E0E0"
                       value=' user I D  (아이디) ' onblur="if(this.value == '') this.value=' user I D (아이디) ';"
                       onfocus="this.value=''">
            </td>

            <tr>
                <td width='100%' height='50' align='right' valign="middle">
                    &nbsp; &nbsp; &nbsp;
                    <!---비번--->
                    <input type='password' name='pw' style="width:160px; height:40px; background-color:#E0E0E0;"
                           value='password' onblur="if(this.value == '') this.value='password';"
                           onfocus="this.value=''">
                </td>
            </tr>
        </table>
    </td>


    <td width='3%' align='center' valign="middle">&nbsp;</td>

    <td colspan='3' width='47%' height='150' align='left' valign="middle">
        <!---로그인--->
        <input TYPE="IMAGE" src="./member_img/logins.gif" width='93' height='93' onfocus="this.blur()" name="Submit"
               value="Submit" align="absmiddle"/>
    </td>


    <tr>
        <td colspan='3' width='100%' height='50' align='center' valign="bottom">
            &nbsp; &nbsp; &nbsp;
            <input type='checkbox' name='autologin' value='1' onclick="window.alert('개인용 PC에서만 사용하시기 바랍니다.');"> &nbsp;
            아이디 저장
            <br>
            <hr size='3' width='100%' color='E9A0E3'/>
        </td>
        </form>

    </tr>
    <td colspan='3' width='100%' height='50' align='center' valign="middle">
        * 아직 회원이 아니시면 <a href="./join.php?ctg=members" target='_top' OnFocus="this.blur()"><font
                    color='blue'>[회원가입]</font></a> 를 클릭 하세요. <br><br>

        * ID및 비밀번호가 생각이 안나시면 <br>
        &nbsp; &nbsp;
        <a href="./search_myuser.php?ctg=members" target='_top' OnFocus="this.blur()"><font color='#FF00A8'>[아이디/비밀번호
                찾기!]</font></a> 를 클릭하세요. <br>
    </td>

    <tr>
        <td colspan='3' width='100%' height='100%' align='left' valign="middle">&nbsp;</td>
    </tr>
</table>
<!-------------((본문끝))------------->
