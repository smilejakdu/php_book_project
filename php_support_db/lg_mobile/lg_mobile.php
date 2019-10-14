<?php
$servername = "localhost";
$username = "jakdu";
$password = "##tkakrnl12";
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

<style>
    .home_wrapper {
        width: 330px;
        margin: 0 auto;
    }

    .home_right {
        position:relative;
        left: 250px;
    }
</style>
<body>

<br>
          <div class="flexbox center">
          <h3 style="color:#01A9DB;">공시지원금 변동현황</h3>
          <a class="btn btn-outline-success home_right" href="../total.php">home</a>
          </div>
<br>

<?php
     date_default_timezone_set('Asia/Seoul');

     if (isset($_POST["date"])){
         $today = $_POST["date"];
     }else {
         $today = strtotime("Now");
         $today="".date('Y-m-d', $today);
     }
?>

<center>
    <div class="flexbox2 wrapper">
        <button type="submit" class="item3" id="yesterday">◀</button>
        <button type="submit" class="item3" id="tomorrow">▶</button>
        <span> U+ 알뜰 Mobile / 공시지원금 변동현황</span>
        <input type="text" name="date" id="date" class="date_button" value="<?php echo $today ?>"/>
        <br>
    </div>
</center>

<script>

$(function(){

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
                    onSelect: function(dateText, inst) {
                    $("input[name='date']").val(dateText);
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
                        }
                });
        });

        function yester_dataload(){
            var date = $('#date').val();
            var date_arr = date.split('-');
            var year = Number(date_arr[0]);
            var month = Number(date_arr[1]);
            var day = Number(date_arr[2]);

            if(day == 1){ // 만약 2019-09-01 이라면 
                var create_date = new Date(year , month-1 , day);
                create_date.setDate(0);
                var yesterYear = create_date.getFullYear();
                var yesterMonth = create_date.getMonth()+1;
                var yesterDay = create_date.getDate();

                if(yesterMonth < 10){ yesterMonth = "0" + yesterMonth; }
                if(yesterDay < 10) { yesterDay = "0" + yesterDay; }

                var date = yesterYear + "-" + yesterMonth + "-" + yesterDay;

                if(date != ''){
                        $.ajax({
                                url:"lg_mobile_range.php",
                                method:"POST",
                                data:{date:date},
                                success:function(data)
                                {   
                                    $('#purchase_order').html(data);
                                    $('#date').val(date);
                                    
                                }
                        });
                }
                
            }else { // 만약 2019-09-01 이 아니라면 

                // 어제 날짜
                var nowDate = new Date(year , month , day);
                var yesterDate = nowDate.getTime() - (1 * 24 * 60 * 60 * 1000);
                nowDate.setTime(yesterDate);
                
                var yesterYear = nowDate.getFullYear();
                var yesterMonth = nowDate.getMonth();
                var yesterDay = nowDate.getDate();
                        
                if(yesterMonth < 10){ yesterMonth = "0" + yesterMonth; }
                if(yesterDay < 10) { yesterDay = "0" + yesterDay; }
                        
                var date = yesterYear + "-" + yesterMonth + "-" + yesterDay;


                if(date != ''){
                        $.ajax({
                                url:"lg_mobile_range.php",
                                method:"POST",
                                data:{date:date},
                                success:function(data)
                                {   
                                    $('#purchase_order').html(data);
                                    $('#date').val(date);
                                    
                                }
                        });
                }
            }
        }

        function tomorrow_dataload(){
            var date = $('#date').val();
            var today = '<?=$today?>'
            if(date == today){
                alert(today+" 이 마지막 데이터 입니다 . ! ");
            }
            var date_arr = date.split('-');
            var year = Number(date_arr[0]);
            var month = Number(date_arr[1]);
            var day = Number(date_arr[2]);
           
        
            var lastDate = new Date(year , month ,"").getDate(); // 이번달 마지막 날짜 구해온다.
            // alert(lastDate); // 해당 월에 마지막 날짜가 찍힌다. 

            if(day == lastDate){
                // 다음년도 1월을 구해야한다.
                if(month == 11){
                    alert("11월 입니다. ");
                    var nowDate = new Date(year , 11 , 1);

                    var tomorrowYear = nowDate.getFullYear();
                    var tomorrowMonth = nowDate.getMonth();
                    var tomorrowDay = nowDate.getDate();

                    if(tomorrowMonth < 10){ tomorrowMonth = "0" + tomorrowMonth; }
                    if(tomorrowDay < 10) { tomorrowDay = "0" + tomorrowDay; }

                    var date = tomorrowYear + "-" + tomorrowMonth + "-" + tomorrowDay;

                    if(date != ''){
                            $.ajax({
                                    url:"lg_mobile_range.php",
                                    method:"POST",
                                    data:{date:date},
                                    success:function(data)
                                    {   
                                        $('#purchase_order').html(data);
                                        $('#date').val(date);
                                    }
                            });
                    }

                }else {
                    var nowDate = new Date(year , month+1 , 1);

                    var tomorrowYear = nowDate.getFullYear();
                    var tomorrowMonth = nowDate.getMonth();
                    var tomorrowDay = nowDate.getDate();

                    if(tomorrowMonth < 10){ tomorrowMonth = "0" + tomorrowMonth; }
                    if(tomorrowDay < 10) { tomorrowDay = "0" + tomorrowDay; }

                    var date = tomorrowYear + "-" + tomorrowMonth + "-" + tomorrowDay;

                    if(date != ''){
                            $.ajax({
                                    url:"lg_mobile_range.php",
                                    method:"POST",
                                    data:{date:date},
                                    success:function(data)
                                    {   
                                        $('#purchase_order').html(data);
                                        $('#date').val(date);
                                    }
                            });
                    }
                }
                
                var nowDate = new Date(year , month+1 , 1);

                var tomorrowYear = nowDate.getFullYear();
                var tomorrowMonth = nowDate.getMonth();
                var tomorrowDay = nowDate.getDate();

                if(tomorrowMonth < 10){ tomorrowMonth = "0" + tomorrowMonth; }
                if(tomorrowDay < 10) { tomorrowDay = "0" + tomorrowDay; }

                var date = tomorrowYear + "-" + tomorrowMonth + "-" + tomorrowDay;

                if(date != ''){
                        $.ajax({
                                url:"lg_mobile_range.php",
                                method:"POST",
                                data:{date:date},
                                success:function(data)
                                {   
                                    $('#purchase_order').html(data);
                                    $('#date').val(date);
                                }
                        });
                }
            }else {

                // 내일 날짜 
                var nowDate = new Date(year , month , day);
                var tomorrowYear = nowDate.getFullYear();
                var tomorrowMonth = nowDate.getMonth();
                var tomorrowDay = nowDate.getDate()+1;

                if(tomorrowMonth < 10){ tomorrowMonth = "0" + tomorrowMonth; }
                if(tomorrowDay < 10) { tomorrowDay = "0" + tomorrowDay; }

                var date = tomorrowYear + "-" + tomorrowMonth + "-" + tomorrowDay;

                if(date != ''){
                        $.ajax({
                                url:"lg_mobile_range.php",
                                method:"POST",
                                data:{date:date},
                                success:function(data)
                                {   
                                    $('#purchase_order').html(data);
                                    $('#date').val(date);
                                }
                        });
                }
            }
        }

        $('#yesterday').click(function(){
            yester_dataload();
        });

        $('#tomorrow').click(function(){
            tomorrow_dataload();
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

    <button type="submit" id="skt_world" class="button2">SKT</button>
    <button type="submit" id="kt_shop" class="button2">KT</button>
    <button type="submit" id="lg_u_plus" class="button2">LG U+</button>

</div>
<div class="flexbox wrapper">
    <button type="submit" id="lg_mobile" class="button">U+알뜰모바일</button>
    <button type="submit" id="sk7" class="button2">SK 7모바일</button>
    <button type="submit" id="kt_m_mobile" class="button2">KT M모바일</button>
    <button type="submit" id="hello_mobile_skt" class="button2">헬로모바일(SKT)</button>
    <button type="submit" id="hello_mobile_kt" class="button2">헬로모바일(KT)</button>
</div>
<script>

     function formCreate(nm,mt,at,tg) {
                    var f = document.createElement("form");
                    f.name = nm;
                    f.method = mt;
                    f.action = at;
                    f.target = tg ? tg : "_self";
                    return f;
                    } 
                    
                    /* 폼: 인풋 생성 */
                    function formInput(f,n,v) {
                    var i = document.createElement("input");
                    i.type = "hidden";
                    i.name = n;
                    i.value = v;
                    //f.appendChild(i);
                    f.insertBefore(i, null);
                    //f.insertBefore(i);
                    return f;
                    }
                    
                    /* 폼: 전송 */
                    function formSubmit(f) {
                    document.body.appendChild(f);
                    f.submit();
                    } 

                    $(document).on("click","#skt_world",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../skt/skt_world.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });

                    $(document).on("click","#kt_shop",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../kt/kt_shop.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });


                    $(document).on("click","#lg_u_plus",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../lg_u_plus/lg_u_plus.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });

                    $(document).on("click","#lg_mobile",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../lg_mobile/lg_mobile.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });

                     $(document).on("click","#sk7",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../sk7/sk7.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });

                     $(document).on("click","#kt_m_mobile",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../kt_m_mobile/kt_m_mobile.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });

                     $(document).on("click","#hello_mobile_skt",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../hello_mobile_skt/hello_mobile_skt.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });

                     $(document).on("click","#hello_mobile_kt",function() {

                        var date = $('#date').val();
                        go_skt_world(date);

                        function go_skt_world(date) {
                        var frm = formCreate('date_form','post','../hello_mobile_kt/hello_mobile_kt.php','');
                        // form 이름 , 포스트방식과 겟방식 , 이동하고자 하는 페이지
                        frm = formInput(frm, 'date', date);
                        // category_name 이란 이름으로 받아온 값을 date 에 담아줘야한다.
                        formSubmit(frm);	
                        }
                    });
    </script>

<br>

<hr width="800" class="flexbox wrapper"/>
<center id="purchase_order">
<br>
<p class="flexbox wrapper btn btn-info"><?php echo $today ?> 변경모델</p>

<?php
    $query = "SELECT DISTINCT model_name FROM lg_db WHERE support_date='$today'";
    $sql = mysqli_query($conn , $query);
    $t=0;
    $total_record = mysqli_num_rows($sql);
    // echo '$count : '.$total_record.'<br>';
?>

<br>
<br>
<p class="btn btn-outline-danger">공시지원금 변동 <?php echo $total_record ?>건</p>
<br>

<?php 
    while($row = mysqli_fetch_array($sql)){
        $t ++ ;
        if( $t % 5 == 0){
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
      $query = "SELECT * FROM lg_db WHERE support_date='$today' ORDER BY machine_name , model_name , plan_money";
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
