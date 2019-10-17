<link rel='stylesheet' type='text/css' href='../../lib/style.css'/>
<style type="text/css">
    .font1 {
        font-family: Tahoma, Arial;
        font-size: 12pt;
        color: #856F5C;
        background: #C3C2C1;
        font-weight: bold;
    }

    /*링크가 불 가능한것*/
    .font2 a {
        font-family: Tahoma;
        font-size: 12pt;
        color: #FFF;
        background: #856F5C;
        font-weight: bold;
    }

    /*링크가 가능한것*/
    .font3 a {
        font-family: Tahoma;
        font-size: 11pt;
        color: #856F5C;
        font-weight: bold;
    }

    /*이동표기*/
    .font4 a {
        font-family: Tahoma;
        font-size: 10pt;
        color: #856F5C;
        font-weight: bold;
    }

    /*First / Last (링크가능) */
    .font5 {
        font-family: Tahoma;
        font-size: 10pt;
        color: #7D7D7D;
        font-weight: bold;
    }

    /*First / Last (링크불가)*/
</style>


<table border='0' width='100%' cellspacing='0' cellpadding='0'>
    <tr>
        <td width='100%' align='center'>
            <?php

            // 전페 페이지 구함. ceil() 올림함수

            if (!$total_article == 0) {
                $total_page = ceil($total_article / $view_article);
            }

            // 이전 페이지값 구함 (1보다 작을 경우 1로 지정)
            $prev_page = $page - 1;
            if ($prev_page < 1) $prev_page = 1;

            // 다음 페이지값 구함 (전체페이지값 넘으면 전체페이지값으로 지정)
            $next_page = $page + 1;
            if ($next_page > $total_page) $next_page = $total_page;

            // 페이지 인덱스의 시작과 종료 범위 구함
            if ($page % 10) $start_page = $page - $page % 10 + 1;
            else          $start_page = $page - 9;
            $end_page = $start_page + 10;

            // 이전 페이지 그룹을 지정
            $prev_group = $start_page - 1;
            if ($prev_group < 1) $prev_group = 1;

            // 다음 페이지 그룹을 지정
            $next_group = $end_page;
            if ($next_group > $total_page) $next_group = $total_page;


            // 처음 페이지, 이전 페이지 그룹, 이전 페이지 출력
            // 만약 현재 페이지가 1이라면 링크 없이 출력
            if ($page != 1) echo "<font class='font4'><a href=$PHP_SELF?page=1$href>First</a></font>  &nbsp; &nbsp;";
            else                      echo "<font class='font5'>First</font>  &nbsp; &nbsp;";

            if ($page != 1) echo "<font class='font3'><a href=$PHP_SELF?page=$prev_group$href>◀</a></font> &nbsp; &nbsp; ";
            // else                      echo "<< ";  //한그룹 앞으로 이동

            //if ($page != 1)           echo "[<a href=$PHP_SELF?page=$prev_page$href><</a>]"; //한칸씩 앞으로 이동 (클릭가능)
            //else                      echo "[ < ] ";  //한칸씩 앞으로 이동 (클릭불가)


            // 페이지 인덱스의 일정 범위 출력
            for ($i = $start_page; $i < $end_page; $i++) {
                if ($i > $total_page) break;
                if ($i == $page) echo " <font class='font1'>$i</font> &nbsp; &nbsp; ";
                else           echo "<font class='font2'><a href=$PHP_SELF?page=$i$href>$i</a></font> &nbsp; &nbsp; ";
            }


            // 다음 페이지, 다음 페이지 그룹, 마지막 페이지 출력
            //if ($page != $total_page) echo "  [<a href=$PHP_SELF?page=$next_page$href>></a>]"; //한칸씩 뒤로 이동 (클릭가능)
            //else                      echo "  [>]   ";  //한칸씩 뒤로 이동 (클릭불가)

            if ($page != $total_page) echo "&nbsp; &nbsp; <font class='font3'><a href=$PHP_SELF?page=$next_group$href>▶</a></font>";
            //else                      echo ">>";  //한그룹 뒤로 이동

            if ($page != $total_page) echo " &nbsp; &nbsp; <font class='font4'><a href=$PHP_SELF?page=$total_page$href>Last</a></font>  ";
            else                      echo " &nbsp; &nbsp; <font class='font5'>Last</font>   ";

            ?>

        </td>
    </tr>
</table>