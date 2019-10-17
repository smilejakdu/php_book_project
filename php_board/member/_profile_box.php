<? session_start();
ob_start(); ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
        <link rel='stylesheet' type='text/css' href='../lib/style.css'/>

        <style type="text/css">
            .f_1 {
                font-family: 굴림, Tahoma;
                color: #7D7B7B;
                font-size: 9pt;
            }

            .f_2 {
                font-family: 굴림, Tahoma;
                color: #7D7B7B;
                font-size: 8pt;
            }

            .f_3 {
                font-family: 굴림, Tahoma;
                color: #6B5BBE;
                font-size: 10pt;
                font-weight: bold;
            }
        </style>
    </head>

<?
include "../lib/connect.php";
$connect = dbconn();
$member = member_info();


$query = "select count(*) from message where to_user_id='$member[user_id]' and checks!='OK'  ";
$result = mysqli_query($connect, $query);
$m_temp = mysqli_fetch_array($result);


if ($member['user_id']) {
    ?>


    <table border='0' cellspacing='0' cellpadding='0' width='100%' height='40' align='right'> <!-- 360-->
        <tr>
            <td width='64%' height='30' align='right' valign='middle'>
                <font class='f_1'>
                    <strong>
                        <a href="./my_page_view.php?ctg=members" onfocus="this.blur()" target="_top">
                            <?php
                            if ($member['nickname']) {
                                echo mb_strimwidth($member['nickname'], 0, 10, "..", "UTF-8");
                            } else if (!$member['nick_name']) {
                                echo mb_strimwidth($member['name'], 0, 10, "..", "UTF-8");
                            }
                            ?>
                    </strong>
                </font>
                </a>
                <font class='f_1'>님</font>

                &nbsp;
                <!-- 레벨-->
                <font class='f_2'>L.<?= $member['level'] ?></font>
                &nbsp;
            </td>


            <td width='25%' height='30' align='center' valign='middle'>
                <!-- 로그아웃-->
                <a href="./logout.php" OnFocus="this.blur()" title='logout' target="_top">
                    <font class='f_3'><b>Logout</font></a>
            </td>

            <td width='5%' height='30' align='right'>&nbsp;</td>
        </tr>
    </table>
<? } ?>