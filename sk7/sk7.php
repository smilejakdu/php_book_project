<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phone_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// $sql = "SELECT * FROM sk_db ORDER BY machine_name;";
// $result = mysqli_query( $conn, $sql );
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <title>U and Soft and xeronote </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
</head>

<body>

  <br>
  <div class="flexbox center wrapper">
    <h3><span style="color:#01A9DB">공시지원금 변동현황</span></h3>
  </div>

<br>

<?php
    date_default_timezone_set('Asia/Seoul');
    $date = strtotime("Now");
    $date="".date('Y-m-d', $date);
    // $date="2019-08-01";
?>

<center>
    <div class="flexbox2 wrapper">
        <button type="submit" class="item3">전일</button>
        <span> sk 7 Mobile / 공시지원금 변동현황</span>
        <input type="text" name="date" id="date" class="date_button" placeholder="<?php echo $date ?>"/>
        <input type="button" name="range" id="range" value="확인" class="item3"/>
        <br>
    </div>
</center>

<script>

$(document).ready(function(){

        $.datepicker.setDefaults({
                monthNames: ['1 월','2 월','3 월','4 월','5 월','6 월','7 월','8 월','9 월','10 월','11 월','12 월'], // 개월 텍스트 설정
                monthNamesShort: ['1 월','2 월','3 월','4 월','5 월','6 월','7 월','8 월','9 월','10 월','11 월','12 월'], // 개월 텍스트 설정
                dayNames: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
                dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
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
                // else
                // {
                //         alert("날짜를 선택하세요");
                // }
        });
});

$(document).on("click","#change_name",function() {
	// 이렇게하면 button element 를 클릭했을때 
	// 해당하는 model_name 이 보이게 된다 
	var changed_model_name =$(this).text();
    var date = $('#date').val();
    if(date !=''){
        $.ajax({
            url:"sk7_model_click.php",
            method:"POST",
            data:{changed_model_name:changed_model_name,date:date},
            success:function(data)
            {
                $('#purchase_order').html(data);
            }
        });
    }
});

</script>

<br>

<br>
<div class="flexbox wrapper center">

    <a href="../skt/skt_world.php"><button type="submit" class="button2">SKT</button></a>

    <a href="../kt/kt_shop.php">
        <button type="submit" class="button2">KT</button>
    </a>

    <a href="http://localhost:8000/lg/">
        <button type="submit" class="button2">LG U+</button>
    </a>

</div>
<div class="flexbox wrapper">
    <a href="../lg_mobile/lg_mobile.php"><button type="submit" class="button2">U+알뜰모바일</button></a>
    <button type="submit" class="button">SK 7모바일</button>
    <button type="submit" class="button2">KT M모바일</button>
    <button type="submit" class="button2">헬로모바일(SKT)</button>
    <button type="submit" class="button2">헬로모바일(KT)</button>
</div>
<br>

<hr width="800" class="flexbox wrapper"/>
<center id="purchase_order">
<br>
<p class="flexbox wrapper btn btn-info"><?php echo $date ?> 변경모델</p>

<?php
    $query = "SELECT DISTINCT model_name FROM sk_db WHERE support_date='$date'";
    $sql = mysqli_query($conn , $query);
    $t=0;
    $total_record = mysqli_num_rows($sql);
    // echo '$count : '.$total_record.'<br>';
?>

<br>
<br>
<p class="btn btn-outline-danger">공시지원금 변동 <?php echo $total_record ?>건</p>

<?php 
    while($row = mysqli_fetch_array($sql)){
        $t ++ ;
        if( $t % 5 ==0){
            ?>
            <button type="button" id="change_name" class="btn btn-outline-info"><?php echo $row['model_name'];?></button>
            <br>
            <?php
        }else {
            ?>
            <button type="button" id="change_name" class="btn btn-outline-info"><?php echo $row['model_name'];?></button>
            <?php
        }
    }
?>

    <div class="flexbox wrapper" >
        <div class="button">단말기 명</div>
        <div class="button">모델 명</div>
        <div class="button">요금제</div>
        <div class="button">출고가</div>
        <div class="button">공시지원금</div>
        <div class="button">공시일자</div>
    </div>

    <?php
      $query = "SELECT * FROM sk_db WHERE support_date='$date' ORDER BY model_name , plan_money";
      $sql = mysqli_query($conn, $query);
      if(mysqli_num_rows($sql) > 0){
      while( $row = mysqli_fetch_array($sql)){
    ?>
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
} else {
    ?>

    <tr>
    <td colspan="5">아이템이 없습니다.</td>
    </tr>
    <?php
}
?>
  </table>
</center>
<br>
</body>

</html>
