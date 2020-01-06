<?php
include "../lib/dbconfig.php";
include "../commons/head.php";
?>
<style>
    body {
        padding-bottom: 40px;
        background-color: #eee;
        background-image:url('../kakao.png');
    }
    
    tr th{
        font-weight:bold;
        text-align:center;
        background:white;
        color:black;
        font-size:16px;
    }
    td{
        text-align:center;
        font-size:16px;
        vertical-align: middle;
        border: 1px solid black;
        color:orange;
    }
    img {
        max-width:130px;
        max-height:130px;
    }

    .a_style:hover{
        color:white;
    }
    
    .table_css {
      margin-top:30px;
      width:80%;
      text-align:center;
      margin-left:auto;
      margin-right:auto;
    }
</style>
<a href="http://www.kyobobook.co.kr/bestSellerNew/bestseller.laf?orderClick=d79" class="btn btn-danger" style="padding:10px; margin-top:20px; position:relative; margin-left:150px;">베스트셀러 보러가기</a>
<table class="table table-striped table-dark table_css">
    <tr>
        <th>순위</th>
        <th>제목</th>
        <th>저자</th>
        <th>이미지</th>
        <th>가격</th>
        <th>할인가격</th>
    </tr>
<?php
    $sql ="select * from book";
    $result = $db ->query($sql);
    while($row = $result->fetch_assoc()){
        $author=$row['author'];
        $author_url = "https://search.naver.com/search.naver?sm=top_hty&fbm=1&ie=utf8&query=".$author;
        ?>
    <tr>
        <td style="font-weight:bold; vertical-align:middle;"><?= $row['num'];?></td>
        <td style="vertical-align:middle;"><a href=<?= $row['url'];?> style="text-decoration:none;" class="a_style"><?= $row['title'];?></a></td>
        <td style="vertical-align:middle;"><a href=<?= $author_url; ?> style="text-decoration:none;" class="a_style"><?= $row['author'];?></a></td>
        <td><a href=<?= $row['url'];?>><img src=<?= $row['image'];?>></a></td>
        <td style="vertical-align:middle;"><?= number_format($row['original_price']);?></td>
        <td style="vertical-align:middle;"><?= number_format($row['sale_price']);?></td>
    </tr>
        <?php
        }
        ?>
</table>
</body>
</html>