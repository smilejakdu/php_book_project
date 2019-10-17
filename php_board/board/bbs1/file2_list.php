<? header("content-type:text/html; charset=UTF-8"); ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!--다국어 언어: UTF-8-->
    <meta http-equiv="imagetoolbar" CONTENT="no">
    <link type="text/css" href='../../lib/style.css' rel='stylesheet'/>

    <style type="text/css">
        .image_box {
            margin: 0;
            padding: 0;
            position: relative;
        }

        #imeg_del {
            position: absolute;
            top: 25px;
            left: 38px;
        }

        #imeg_del strong {
            font-family: 굴림, 돋움, Arial;
            font-size: 10pt;
            color: #ff0000;
            background: #FFFFFF;
            font-weight: bold;
        }

        #img_up_button {
            height: 50px;
            width: 50px;
            background-image: url('./image/img_up.gif');
            border: 0px;
        }

        .f_list_box {
            margin: 0 auto;
            padding: 0;
            font-family: 굴림, Arial;
            font-size: 10pt;
            font-weight: bold;
        }

        .delbox font {
            color: red;
            font-weight: bold;
        }
    </style>

    <script>
        function image_up() {
            a = document.img_up.b_ID.value;
            window.open('image_up.php?b_ID=' + a, 'idc', 'width=300, height=100');
        }
    </script>

    <?
    include '../../lib/connect.php';
    $connect = dbconn();
    $member = member_info();

    ?>

</head>


<?
$b_ID = $_GET[b_ID];
$query = "select * from bbs1 where b_ID='$b_ID' ";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);
?>


<table border='0' width='95%' height='100' cellspacing='0' cellpadding='0' align='center' bgcolor='#EAEAEA'>
    <tr>
        <td colspan='2' align='center' bgcolor='#FFFFFF' style="height:20px; width:100%;" class='f_list_box'>파 일 목 록
        </td>

    <tr>
        <td colspan='2' align='left' bgcolor='#FFFFFF' style="height:80px; width:100%;" class='delbox'>
            <?
            if ($data[file2]) {
                $_file2 = explode("#", $data['file2']);   # . 을 기준으로 분리
                $_file2_name = explode("#", $data['file2_name']);   # . 을 기준으로 분리
                for ($i = 1; $i < count($_file2); $i++) {

                    ?>
                    -
                    <a href="./file2_del.php?b_ID=<?= $data[b_ID] ?>&file2=<?= $_file2[$i] ?>&file2_name=<?= $_file2_name[$i] ?>"
                       title='삭제'>
                        <?= $_file2_name[$i] ?>&nbsp;<font>[X]</font></a>
                    <br>
                <? }
            }
            if (!$data[file2]) {
                echo "파일목록이 없습니다.";
            } ?>
        </td>

    <tr>
        <td colspan='2' align='center' bgcolor='#FFFFFF' style="height:40px; width:100%;">
            <form name='file2' action='file2_upload.php' method='post' enctype='multipart/form-data'>
                <input type='file' name='file2'/>
                <input type='hidden' name='b_ID' value='<?= $b_ID ?>'/>
        </td>

    <tr>
        <td align='center' bgcolor='#FFFFFF' style="height:20px; width:50%;">
            <input type='submit' value='업로드'/>
        </td>

        <td align='center' bgcolor='#FFFFFF' style="height:20px; width:50%;">
            <input type='button' value='닫기' onclick="window.close();"/>
        </td>
        </form>
    </tr>
</table>



