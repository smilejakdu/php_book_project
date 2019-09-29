<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phone_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);

error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <title>U and Soft and xeronote</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./index.css" type="text/css">
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
        <button type="submit" class="item3" id="yesterday">◀</button>
        <button type="submit" class="item3" id="tomorrow">▶</button>
        <span> total_data / 공시지원금 변동현황</span>
        <input type="text" name="date" id="date" class="date_button" value="<?php echo $today ?>"/>
        <br>
    </div>
</center>

<script>

$(function(){

        $.datepicker.setDefaults({
                monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
                            '7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'], // 개월 텍스트 설정
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
                                url:"total_range.php",
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
                                url:"index_range.php",
                                method:"POST",
                                data:{date:date},
                                success:function(data)
                                {   
                                    $('#purchase_order').html(data);
                                    $('#date').val(date);
                                    
                                }
                        });
                }
                
            }else{ // 만약 2019-09-01 이 아니라면 

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
                    alert(date); // 여기까지는 정상적으로 작동 어제 날짜가 출력됨 
                        $.ajax({
                                url:"total_range.php",
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
                                    url:"index_range.php",
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
                                    url:"index_range.php",
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
                                url:"index_range.php",
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
                                url:"index_range.php",
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

</script>
<?php
    $today_skt_world=0;
    $today_kt_shop =0;
    $today_lg_db=0;
    $today_sk7_db=0;
    $today_u_plus_shop=0;
    $today_kt_m_mobile=0;
    $today_today_hello_kt=0;
    $today_today_hello_skt=0;

    $total_today_data_sum=0;
    
    $today_data_list = array($today_skt_world , $today_kt_shop , $today_lg_db , $today_sk7_db , $today_u_plus_shop , $today_kt_m_mobile ,$today_today_hello_kt ,$today_today_hello_skt);
    $data_list = array('skt_world' , 'kt_shop' , 'lg_db' , 'sk7_db' , 'u_plus_shop' , 'kt_m_mobile' ,'today_hello_kt' , 'today_hello_skt');

    for ($i=0; $i<count($data_list); $i++){
        $query = "SELECT DISTINCT machine_name FROM {$data_list[$i]} WHERE support_date='$today'";
        $sql = mysqli_query($conn , $query);
        $today_data_list[$i] = mysqli_num_rows($sql);
        $total_today_data_sum +=$today_data_list[$i];

    }

?>
<center id="purchase_order">
</br>
<p class="flexbox wrapper btn btn-info"><?php echo $today ?> 변경모델</p>
</br>
</br>
<div class="flexbox wrapper center">
    <p class="btn btn-outline-danger">공시지원금 변동 총 <?php echo $total_today_data_sum ?>건</p>
</div>

<div class="flexbox wrapper center">
    <a href="./skt/skt_world.php" class="btn btn-outline-info button_size">SKT<?php echo "</br> $today_data_list[0]" ?>건</a>
    <a href="./kt/kt_shop.php" class="btn btn-outline-info button_size">KT<?php echo "</br>$today_data_list[1]" ?>건</a>
    <a href="./lg_u_plus/lg_u_plus.php" class="btn btn-outline-info button_size">LG U+<?php echo "</br>$today_data_list[2]" ?>건</a>
</div>

<div class="flexbox wrapper">
    <a href="./lg_mobile/lg_mobile.php" class="btn btn-outline-info button_size">U+알뜰모바일<?php echo "</br>$today_data_list[3]" ?>건</a>
    <a href="./sk7/sk7.php" class="btn btn-outline-info button_size">SK 7모바일<?php echo "</br>$today_data_list[4]" ?>건</a>
    <a href="./kt_m_mobile/kt_m_mobile.php" class="btn btn-outline-info button_size">KT M모바일<?php echo "</br>$today_data_list[5]" ?>건</a>
    <a href="./hello_mobile_skt/hello_mobile_skt.php" class="btn btn-outline-info button_size">헬로모바일(SKT)<?php echo "</br>$today_data_list[6]"?>건</a>
    <a href="./hello_mobile_kt/hello_mobile_kt.php" class="btn btn-outline-info button_size">헬로모바일(KT)<?php echo "</br>$today_data_list[7]"?>건</a>
</div>
</center>
<br>
</body>
</html>
