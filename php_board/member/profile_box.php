<?
session_start(); //ob_start();?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
        <link type='text/css' href='../lib/style.css' rel='stylesheet'/>
    </head>

<?
if ($member['user_id']) { ?>

    <table border='0' cellspacing='0' cellpadding='0' width='270' height='25' align='left'>
        <tr>
            <? //성별출력,,,,,,,,,,;
            if ($member['sex'] == "male")
                $sex_img = "<img src=../member/member_img/member_boy.gif border=0 width='20' height=20 alt='male'>";

            if ($member['sex'] == "female")
                $sex_img = "<img src=../member/member_img/member_girl.gif border=0 width='20' height=20 alt='female'>";

            if ($member['sex'] == "-")
                $sex_img = "<img src=../member/member_img/member_x.gif border=0 width='20' height=20 alt='-'>";
            ?>
            <td width='20' height='25' align='center' valign='middle'>
                <?= $sex_img; ?>
            </td>

            <td width='190' height='25' align='left' valign='middle'>
                <font color='FFFFFF'>
                    &nbsp;
                    <? if ($member['nickname']) {
                        echo mb_strimwidth($member['nickname'], 0, 10, "..", "UTF-8");
                    } else if (!$member['nick_name']) {
                        echo mb_strimwidth($member['name'], 0, 10, "..", "UTF-8");
                    } ?>
                </font>
                <span style='font-size:8pt; font-family:돋움; color: #FFFFFF'>님 환영합니다!
   &nbsp;
                    <!-- 레벨-->
   L.<?= $member['level'] ?></span>
                &nbsp;

                <?
                $query = "select count(*) from message where to_user_id='$member[user_id]'  and  to_mID='$member[mID]' and checks!='OK'";
                $result = mysqli_query($connect, $query);
                $m_temp = mysqli_fetch_array($result);
                ?>
                <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/member/my_message.php" target="_top"
                   OnFocus="this.blur()">
                    <? if ($m_temp[0] >= 1) {
                        ?>
                        <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/member/member_img/_message2.gif" height='20'>
                    <? } else if ($m_temp[0] < 1) { ?>
                        <img src="http://<?= $_SERVER['SERVER_NAME'] ?>/member/member_img/_message.gif" height='20'>
                    <? } ?>
            </td>


            <td width='50' height='25' align='center' valign='middle'>
                <!-- 로그아웃-->
                <a href="../member/logout.php" OnFocus="this.blur()" title='logout'>
   <span style='font-size:9pt; font-family:돋움; color: #F86621'><b>LogOut</b>
   </span></a>
            </td>

            <td width='10' height='25' align='right'>&nbsp;</td>
        </tr>
    </table>
<? } ?>