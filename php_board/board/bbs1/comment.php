<!---/////////////////////////////[코 멘 트 PC용 버전]//////////////////////////////////--->
<table border='0' width='100%' cellspacing='0' cellpadding='0'>
    <tr>
        <td width='100%' align='center' class="comment">&nbsp;</td>


    <tr>
        <td width='100%' align='center'>

            <!--- 코맨트  출력 부분-------------->
            <table border='0' width='80%' cellspacing='0' cellpadding='0' id='lo_reply_1'>
                <?
                ////////////////////////  코멘트 NO 생성 /////////////////////////
                $times = time();
                $times_1 = date("d-Hi", $times);
                $times_2 = date("s", $times);
                $comment_no = 'C' . chr(rand(97, 122)) . $times_1 . "-" . chr(rand(97, 122)) . $times_2;
                ////////////////////////////////////////////////////////////////

                $q_count = "select count(*) from bbs1_comments where b_ID='$data[b_ID]' ";
                $r_count = mysqli_query($connect, $q_count);
                $count = mysqli_fetch_array($r_count);
                $total_count = $count[0]; // 현재 쿼리한 게시물의 총 개수를 구함
                ?>
                <tr>
                    <td colspan='4' align='right'>
                        <font color='9C9A9A'>TOTAL comment: <?= $total_count ?></font>&nbsp; &nbsp;
                    </td>
                    <?
                    $q = "select * from bbs1_comments where b_ID='$data[b_ID]' and !r_replys_no  order by regdate asc, no asc ";
                    $r = mysqli_query($connect, $q);
                    while ($d = mysqli_fetch_array($r)){

                    ?>


                <tr>
                    <td width='50' align='center' valign='top' rowspan='4' bgcolor='#EEEEEE'>
                        <?
                        $q_ss = "select * from member where user_id='$d[user_id]'  ";
                        $r_ss = mysqli_query($connect, $q_ss);
                        while ($d_ss = mysqli_fetch_array($r_ss)) {
                            ?>

                            <? if ($d_ss['file01']) { ?>
                                <img src="../../dataset/member/<?= $d_ss['file01'] ?>" width='50' height='50'>
                            <? } else { ?>
                                <img src="../../member/member_img/pv_x.gif" width='50' height='50'>
                            <? }
                        } ?>
                    </td>

                    <td width='10' valign='middle' rowspan='4' bgcolor='#EEEEEE'>&nbsp;</td>


                <tr>
                    <td width='674' height='25' valign='middle' bgcolor='#EEEEEE'>
<span style='font-size:9pt; font-family:Tahoma; color:#727371'>
<? if ($d['nickname']) {
    echo $d['nickname'];
} else {
    echo $d['name'];
} ?>
   &nbsp; &nbsp;  &nbsp; &nbsp;
  <?
  echo $d_Y = substr($d['regdate'], 0, 4) . "-";
  echo $d_m = substr($d['regdate'], 4, 2) . "-";
  echo $d_d = substr($d['regdate'], 6, 2) . "&nbsp;";
  echo $d_h = substr($d['regdate_time'], 0, 2) . ":";
  echo $d_i = substr($d['regdate_time'], 2, 2);
  ?>
  </span>
                    </td>


                <tr>
                    <td width='674' valign='top' bgcolor='#EEEEEE'>
                        <div class="comment_memo">
                            <? echo nl2br($d['memo']) . "</font>"; ?>
                        </div>
                    </td>

                <tr>
                    <td width='674' height='20' valign='middle' bgcolor='#EEEEEE'>
                        <? if ($member['user_id'] == $d['user_id']) { ?>
                            <div align='right'>
                                <a href="comment_del.php?d_no=<?= $d['no'] ?>&no_s=<?= $data['b_ID'] ?>&b_ID=<?= $d['b_ID'] ?>&replys_all=all">
                                    <font color='#FF0000' onfocus="this.blur()"
                                          onclick="return confirm('정말로 삭제 하겠습니까?');">[DEL]</font></a>
                                &nbsp; &nbsp; &nbsp;
                            </div>
                        <? } ?>
                    </td>


                <tr>
                    <td colspan='3' width='120' align='right' valign='middle' bgcolor='#EEEEEE'>
                        <? if ($member['user_id']) { ?>
                            <a href='view.php?r_replys_w=yes&b_ID=<?= $data['b_ID'] ?>&d_no=<?= $d['no'] ?>#lo_reply_2'
                               onfocus="this.blur()">
                                <span style='font-size:9pt; font-family:Tahoma; color:#727371'>[답글달기]</span></a> &nbsp;
                        <? } ?>
                    </td>


                    <?
                    //////////////  답 글 출력  /////////////
                    $q_2 = "select * from bbs1_comments where b_ID='$data[b_ID]' and r_replys_no  and r_replys_no='$d[no]' order by regdate asc , regdate_time asc ";
                    $r_2 = mysqli_query($connect, $q_2);
                    while ($d_2 = mysqli_fetch_array($r_2)){
                    ?>
                <tr>
                    <td width='100%' height='5' valign='top' colspan='4'>

                        <table border='0' width='100%' height='5' valign='middle' cellspacing='0' cellpadding='0'>
                            <tr>
                                <td width='10'>&nbsp;</td>
                                <td width='10' align='center'>
                                    <span style='font-size:11pt; color:#8A8A88'>└</span>
                                </td>

                                <td width='30' align='center'>
                                    <?
                                    $q_ss_2 = "select * from member where user_id='$d_2[user_id]'  ";
                                    $r_ss_2 = mysqli_query($connect, $q_ss_2);
                                    $d_ss_2 = mysqli_fetch_array($r_ss_2);

                                    if ($d_ss_2['file01']) {
                                        ?>
                                        <img src="../../dataset/member/<?= $d_ss_2['file01'] ?>" width='30' height='30'>
                                    <? } else {
                                        ?>
                                        <img src="../../member/member_img/pv_x.gif" width='30' height='30'>
                                    <? } ?>
                                </td>

                                <td width='75%' align='left'>
                                    <div class="r_replys_1">
                                        <? if ($d_2['nickname']) {
                                            ?>
                                            <?= $d_2['nickname'] ?>
                                        <? } else {
                                            ?>
                                            <?= $d_2['name'];
                                        } ?>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <?
                                        echo $d_2_Y = substr($d_2['regdate'], 0, 4) . "-";
                                        echo $d_2_m = substr($d_2['regdate'], 4, 2) . "-";
                                        echo $d_2_d = substr($d_2['regdate'], 6, 2) . "&nbsp;";
                                        echo $d_2_h = substr($d_2['regdate_time'], 0, 2) . ":";
                                        echo $d_2_i = substr($d_2['regdate_time'], 2, 2);
                                        ?>
                                    </div>

                                    <div class="r_replys_memo"><?= $d_2['memo'] ?></div>
                                    &nbsp; &nbsp;
                                    <? if ($member['user_id'] and $member['user_id'] == $d_2['user_id']) { ?>
                                        <div align='right'>
                                            <a href="comment_del.php?d_no=<?= $d_2['no'] ?>&no_s=<?= $data['b_ID'] ?>&b_ID=<?= $d_2['b_ID'] ?>&r_replys_no=<?= $d_2['r_replys_no'] ?>&reply_rr=rr"
                                               onfocus="this.blur()" onclick="return confirm('정말로 삭제 하겠습니까?');">
                                                <span style='font-size:8pt; color:#5A5B5A'>['del']</span></a>
                                            &nbsp; &nbsp; &nbsp;
                                        </div>
                                    <? } ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <? } ?>
                <tr>
                    <td height='10' colspan='4' align='center' class="r_replys">&nbsp;</td>
                    <? //////////////  답글 [끝]/////////////
                    ?>


                    <? /// 답글 쓰기 ///
                    ?>
                    <? if ($r_replys_w == "yes" and $d_no == $d['no']) {
                        $d_no = $_GET['d_no'];  //댓글번호
                        $q_cs = "select * from bbs1_comments where no='$d_no'  ";
                        $r_cs = mysqli_query($connect, $q_cs);
                        $d_cs = mysqli_fetch_array($r_cs);
                        ?>
                        <form name='r_replys' action='comment_post.php' method='post'>
                            <input type=hidden name='groups' value='jm1'> <!-- 그룹-->
                            <input type=hidden name='b_ID' value='<?= $data['b_ID'] ?>' title='게시판글 ID'>
                            <input type='hidden' name='comment_no' value='<?= $comment_no ?>' title='코멘트NO'>
                            <input type=hidden name='ctg' value='<?= $data['ctg'] ?>'>
                            <input type=hidden name='ctgs' value='<?= $data['ctgs'] ?>'>
                            <input type=hidden name='name' value='<?= $member['name'] ?>'>
                            <input type=hidden name='nickname' value='<?= $member['nickname'] ?>'>
                            <input type=hidden name='r_replys_w' value='yes'>
                            <input type='hidden' name='r_replys_no' value='<?= $d[no] ?>'>

                            <input type='hidden' name='to_mID' value='<?= $d_cs['mID'] ?>'>
                            <input type='hidden' name='to_user_id' value='<?= $d_cs['user_id'] ?>'>
                            <input type='hidden' name='to_name' value='<?= $d_cs['name'] ?>'>
                            <input type='hidden' name='to_nickname' value='<?= $d_cs['nickname'] ?>'>
                            <input type='hidden' name='body_content' value='<?= $d_cs['memo'] ?>'>

                            <td id='lo_reply_2' colspan='2' align='right'>
                                <span style='font-size:11pt; color:#8A8A88'>└</span>
                            </td>

                            <td align='center' valign='middle'>
                                <textarea name='memo' style="width:90%; height:30px;"></textarea>
                            </td>

                            <td align='center' valign='middle'>
                                <input type=submit value='submit' style="width:80px; height:20px;"/>
                            </td>
                        </form>
                    <? } ?>
                    <? /// 답글 쓰기 [끝] ///
                    ?>

                <tr>
                    <td width='100%' height='5' valign='top' colspan='4'>&nbsp;</td>
                    <? } ?>
                </tr>
            </table>


            <? if ($member['user_id']) { ?>
                <!---------------  달글 입력 부분------------->
                <table border='0' width='800' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td width='100%' height='30' colspan='5' align='center' valign='middle' bgcolor='#FFFFFF'>
                            <hr size='0.1' width='95%' color='#B2B2B2'/>
                        </td>

                    <tr>
                        <form name='reply' action='comment_post.php' method='post'>
                            <input type=hidden name='groups' value='jm1'>
                            <input type='hidden' name='b_ID' value='<?= $data['b_ID'] ?>' title='게시판글 ID'>
                            <input type='hidden' name='comment_no' value='<?= $comment_no ?>' title='코멘트NO'>
                            <input type='hidden' name='ctg' value='<?= $data['ctg'] ?>'>
                            <input type='hidden' name='ctgs' value='<?= $data['ctgs'] ?>'>
                            <input type='hidden' name='name' value='<?= $member['name'] ?>'>
                            <input type='hidden' name='nickname' value='<?= $member['nickname'] ?>'>
                            <input type='hidden' name='r_replys_w' value='yes'>


                            <td width='120' align='center' valign='middle' bgcolor='#E7CADE'>
                                <? if ($member['nickname']) {
                                    echo $member['nickname'];
                                } else {
                                    echo $member['name'];
                                } ?>
                            </td>
                            <td width='20' align='left' bgcolor='#FFD2F1'>&nbsp;</td>


                            <td width='100' align='right' bgcolor='#FFD2F1'>Comment &nbsp;</td>

                            <td align='left' bgcolor='#FFD2F1'>
                                <textarea name='memo' cols=80 rows=3 style='width=100%'></textarea>
                            </td>

                            <td width=30>
                                <input type=submit value='O K'>
                            </td>

                    </tr>
                    </form>
                </table>
            <?php } ?>

        </td>
    </tr>
</table>
<!---/////////////////////////////[코 멘 트 ((끝))]//////////////////////////////////--->