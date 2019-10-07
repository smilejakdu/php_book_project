<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test홈페이지</title>
</head>
<body>
<?php
           include("./lib/db_connect.php");
           $connect = dbconn();
           $member = member();
           error_reporting(E_ALL);
           ini_set("display_errors", 1);
?>
    <table  width='100%' height='100%' align="center" cellspacing='0' cellpadding='0'>
        <tr>
            <td width='100%' height='100%' align="center">
                <table border="1" width='100%' height='100%' align="center" cellspacing='0' cellpadding='0'>
                    <tr>
                        <td width='100%' height='80' align="center" bgcolor="#764300">
                            <font color='#ffffff'><strong>홈페이지 상단</strong></font>
                        </td>

                        <tr>
                            <td width='100%' height='50' align="right">
                                    <?php
                                    if($member['user_id']){
                                        echo $member['user_id']."님 환영합니다.";
                                    }else{
                                    ?>
                                        <a href="./member/join.php"><strong>[회원가입]</strong></a>
                                        &nbsp; &nbsp; &nbsp;
                                        <a href="./member/login.php"><strong>[로그인]</strong></a>
                                        <?php
                                    }
                                    ?>
                                    &nbsp; &nbsp;
                                    <?php
                                    if($member['user_id']){
                                    ?>
                                    <a href="./member/logout.php"><strong>[로그아웃]</strong></a>
                                                    <?php }
                                 ?>
                            </td>
                        </tr>
                  
                            <tr>
                                <td width='100%' height='30' align="center" bgcolor="#ededed">mysql 데이터 생성</td>
                            </tr>
                            <td width='100%' height='200' align="left" valign='top' bgcolor="#ffffff"></td>
                    </tr>
                        <td>
                            <form action='./test2.php' name='test' method="POST">
                                <input type='hidden' name='id'>
                                <li>아이디: <input type="text" name="user_id" size="10"></li>
                                <li>이름: <input type="text" name="name" size="10"></li>
                                <li>비밀번호: <input type="password" name="pw" size="10"></li>
                                <br><br>
                                -메모-<br>
                                <textarea name="memo" cols="100" rows="5"></textarea>
                                 <br><br>
                                <input type="submit" value="전 송">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
                    <?php

                            //쿼리문으로 데이터를 불러오기
                            $query ="select * from bbs_1 where id='test'";
                            $result = mysqli_query($connect ,$query);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $date_Y =substr($row['regdate'] ,0 ,4); // 년도
                                    $date_m =substr($row['regdate'] ,4 ,2); // 월
                                    $date_d =substr($row['regdate'] ,6 ,2); // 일
                                    $date_h =substr($row['regdate'] ,8 ,2); // 시간
                                    $date_i =substr($row['regdate'] ,10 ,2); // 분 
                                    ?>
                                <div>
                                    <?php echo "이름 : ".$row['name']; ?>
                                    <?php echo "아이디 : ". $row['user_id']; ?></br>
                                    <?php echo "$date_Y 년,$date_m 월,$date_d 일, $date_h"?></br>
                                    <?php echo "메모 : " . $row['memo']; ?> 
                                    <hr size='0.1'/>
                                </div>
                                    <?php
                                }
                            }
                        ?>
    </body>
</html>