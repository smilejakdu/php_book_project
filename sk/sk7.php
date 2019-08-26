<?php
$conn = mysqli_connect( 'localhost', 'root', 'root', 'phone_db');
$sql = "SELECT * FROM sk_db ORDER BY num desc;";
$result = mysqli_query( $conn, $sql );
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <title>U and Soft and xeronote </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , user-scalable=no">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

</head>

<body>

  <div class="flexbox center wrapper">

  </div>

  <div class="flexbox center wrapper">
    <h3><span style="color:#01A9DB">공시지원금 변동현황</span></h3>
  </div>

<br>

<?php

$timestamp = strtotime("Now");
$timestamp="".date('Y-m-d', $timestamp);

?>

<center>
    <div class="flexbox2 wrapper">
        <button type="submit" class="item3">전일</button>
        <span> sk 7 Mobile / 공시지원금 변동현황</span>
        <input type="text" name="date" id="date" class="date_button" placeholder="날짜선택"/>
        <input type="button" name="range" id="range" value="확인" class="btn btn-primary"/>
        <br>
    </div>
</center>

<script>

$(document).ready(function(){
        $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
        });
        $(function(){
                $("#date").datepicker({
                    altField:"#alternate"
                });
        });
        $('#range').click(function(){
                var date = $('#date').val();
                if(date != ''){

                            alert(date);
                        $.ajax({
                                url:"sk7_range.php",
                                method:"POST",
                                data:{date:date},
                                success:function(data)
                                {
                                        $('#purchase_order').html(data);
                                }
                        });
                }
                else
                {
                        alert("날짜를 선택하세요");
                }
        });
});

</script>

<br>

<!-- <div class="flexbox wrapper center">
    <h3>
        <p style="color:#FF0040"> 공시지원금 변동 5건 있습니다</p>
    </h3>
</div> -->

<br>
<div class="flexbox wrapper center">

    <button type="submit" class="button2">SKT</button>

    <a href="http://localhost:8000/kt/">
        <button type="submit" class="button2">KT</button>
    </a>

    <a href="http://localhost:8000/lg/">
        <button type="submit" class="button2">LG U+</button>
    </a>

</div>
<div class="flexbox wrapper">
    <button type="submit" class="button2">U+알뜰모바일</button>
    <button type="submit" class="button">SK 7모바일</button>
    <button type="submit" class="button2">KT M모바일</button>
    <button type="submit" class="button2">헬로모바일(SKT)</button>
    <button type="submit" class="button2">헬로모바일(KT)</button>
</div>
<br>

<hr width="800" class="flexbox wrapper"/>
<div class="flexbox wrapper">
</div>

<center id="purchase_order">
    <div class="flexbox wrapper" >
        <div class="button">단말기 명</div>
        <div class="button">모델 명</div>
        <div class="button">요금제</div>
        <div class="button">출고가</div>
        <div class="button">공시지원금</div>
        <div class="button">공시일자</div>
    </div>

    <?php
      while( $row = mysqli_fetch_array( $result )){
    ?>
    <!-- here -->
    <table>
    <tr class="flexbox wrapper">
      <td><?php echo $row['machine_name'];?></td>
      <td><?php echo $row['model_name'];?></td>
      <td><?php echo $row['plan_money'];?></td>
      <td><?php echo $row['shipment_money'];?></td>
      <td><?php echo $row['disclosure_money'];?></td>
      <td><?php echo $row['support_date'];?></td>
    </tr>
    </br>
    <hr width="800" class="flexbox wrapper"/>

    <?php
  }
  ?>

  </table>
</center>
<br>
</body>

</html>
