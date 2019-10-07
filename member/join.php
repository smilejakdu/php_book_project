<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>회원가입</title>
</head>
<body>
    <table border='0' cellspacing='0' cellpadding='0' width='100%' height='100%' align='center' valign='top'>
        <tr>
            <td width='100%' height='100' align='center' valign='top'>
             &nbsp; &nbsp; <a href='../index.php'><strong>[홈]</strong></a>
            </td>

            <td width='100%' height='100%' align='center' valign='top'>
            <table border='0' width='750' height='100%' bgcolor='#ffffff' align='center' cellspacing='0' cellpadding='0'>
                <tr>
                <form action='./join_post.php' name='member' method='post'>
                    <td height='30' bgcolor='eeeeee' align=center>
                    <strong>[회 원 가 입]</strong>
                        <input type='hidden' name='id' value='test'>
                        <li>회원아이디: <input type='text' name='user_id' size='10'>
                        <li>이름:<input type='text' name='name' size='10'>&nbsp; &nbsp; &nbsp;닉네임: <input type='text' name='nick_name' size='10'>
                        <li>생년월일: <input type='text' name='birth' size='10'>&nbsp; &nbsp; &nbsp;
                            성별: <input type='radio' name='sex' value='male'>남자&nbsp; &nbsp; <input type='radio' name='sex' value='female'>여자
                        <li>연락처 : <input type='text' name='tel' size='10'>&nbsp; &nbsp; 이메일 <input type='text' name='email' size='10'>
                        <li>비밀번호 :<input type='password' name='pw' size='10'>
                        <li>주소 :<input type='text' name='addr_1' size='15'>&nbsp; &nbsp; 상세주소<input type='text' name='addr_2' size='15'>
                        <br>
                        <input type='submit' value='가입하기'>
                    </form>
                    </td>

                    <td height='100%' colspan=2 bgcolor='#eeeeee' align=center>&nbsp;</td>
                </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>