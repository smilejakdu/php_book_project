<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phone_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <title>U and Soft and xeronote </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , user-scalable=no">
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
    $today = strtotime("Now");
    $today="".date('Y-m-d', $today);

?>

<center>
    <div class="flexbox2 wrapper">
        <button type="submit" class="item3">전일</button>
        <span> U+ 알뜰 Mobile / 공시지원금 변동현황</span>
        <input type="text" name="date" id="date" class="date_button" placeholder="<?php echo $today ?>"/>
        <input type="button" name="range" id="range" value="확인" class="item3"/>
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
                        $.ajax({
                                url:"lg_mobile_range.php",
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
            url:"lg_mobile_model_click.php",
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

    <button type="submit" class="button2">SKT</button>

    <a href="http://localhost:8000/kt/">
        <button type="submit" class="button2">KT</button>
    </a>

    <a href="http://localhost:8000/lg/">
        <button type="submit" class="button2">LG U+</button>
    </a>

</div>
<div class="flexbox wrapper">
    <button type="submit" class="button">U+알뜰모바일</button>
    <a href ="../sk/sk7.php"><button type="submit" class="button2">SK 7모바일</button></a>
    <button type="submit" class="button2">KT M모바일</button>
    <button type="submit" class="button2">헬로모바일(SKT)</button>
    <button type="submit" class="button2">헬로모바일(KT)</button>
</div>
<br>

<hr width="800" class="flexbox wrapper"/>
<center id="purchase_order">
<br>
<p class="flexbox wrapper btn btn-info"><?php echo $today ?> 변경모델</p>

<?php
    $query = "SELECT DISTINCT model_name FROM lg_db WHERE support_date=$today";
    $sql = mysqli_query($conn , $query);
    $t=0;
    $total_record = mysqli_num_rows($sql);
?>

<br>
<br>
<p class="btn btn-outline-danger">공시지원금 변동 <?php echo $total_record ?>건</p>

<?php 
    while($row = mysqli_fetch_array($sql)){
        $t ++ ;
        if($t % 5 ==0 ){
            ?>
            <button type="button" id="change_name" class="btn btn-outline-info"><?php echo $row['machine_name'];?></button>
            <br>
            <?php
        }else {
            ?>
            <button type="button" id="change_name" class="btn btn-outline-info"><?php echo $row['machine_name'];?></button>
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
      $query = "SELECT * FROM lg_db WHERE support_date=$today ORDER BY model_name";
      $sql = mysqli_query($conn, $query);
      if(mysqli_num_rows($sql) > 0){
      while( $row = mysqli_fetch_array($result)){
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
}
else {
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
