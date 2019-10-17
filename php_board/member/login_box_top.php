<?php
session_start();
ob_start();
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
</head>
<body>
<!---   로그인 테이블 시작----------->
<table border='0' width='236' height='25' cellspacing='0' cellpadding='0'>
    <form action='./member/login_check.php' method='post'>
        <input type='hidden' name='id' value='<?= $id ?>'>
        <input type='hidden' name='login_locate' value='main'>  <!--- 로그인 페이지위치 (메인:main / 일반:normal) -->
        <tr>

            <td width='200' height='25' align='left' valign="middle">
                <!--아이디-->
                <input type='text' name='user_id' style="width:80px; height:20px;" value=' user I D '
                       onblur="if(this.value == '') this.value=' user I D ';" onfocus="this.value=''">
                <!---비번--->
                <input type='password' name='pw' style="width:100px; height:20px;" value='password'
                       onblur="if(this.value == '') this.value='password';" onfocus="this.value=''">
            </td>

            <!---로그인--->
            <td width='36' align='center' valign="middle">
                <input TYPE="IMAGE" src="./member/member_img/login.gif" width='35' height='14' onfocus="this.blur()"
                       name="Submit" value="Submit" align="absmiddle"/>
            </td>
        </tr>
    </form>
</table>
