<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>로그인 페이지</title>
</head>
<body>
    <table border='0' width='600' height='100%' align='center' cellspacing='0' cellpadding='0' bgcolor='#eeeeee'>
        <tr>
            <td width='100%' height='80' align='center'>
                =로그인=
            </td>
        </tr>    

        <tr>
            <form action='./login_post.php' name='login' method='POST'>
                <td width='100%' height='200' align='left'> 
                <li>아이디 &nbsp; <input type='text' name='user_id' size='10'>
                <br>
                <li>비밀번호: <input type='password' name='pw' size='15'>
                </td>

                <tr>
                    <td width='100%' height='30' align='center'>
                    <input type='submit' value='전송'></td>
                </tr>
            </form>

                <tr>
                <td width='100%' height='100%' align='center'>&nbsp;</td>
        </tr>
    </table>
</body>
</html>