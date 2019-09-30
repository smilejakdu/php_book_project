<?php
if(isset($_POST["date"])){
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "phone_db";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
        $result = '';
        $result.='
        </br>
        <p class="flexbox wrapper btn btn-info">'.$_POST["date"].' 변경모델<p>';
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
        $data_list = array('skt_world' , 'kt_shop' , 'lg_db' , 'sk7_db' , 'u_plus_shop' , 'kt_m_mobile' ,'hello_mobile_kt' , 'hello_mobile_skt');

        for ($i=0; $i<count($data_list); $i++){
            $query = "SELECT DISTINCT machine_name FROM {$data_list[$i]} WHERE support_date ='".$_POST["date"]."'";
            $sql = mysqli_query($conn , $query);
            $today_data_list[$i] = mysqli_num_rows($sql);
            $total_today_data_sum +=$today_data_list[$i];
        }

        $result .='
            <div class="flexbox wrapper center">
            <p class="btn btn-outline-danger">공시지원금 변동 총'.$total_today_data_sum.'건</p>
            </div>
        <br>';

        $result .='
        <div class="flexbox wrapper center">
            <a href="./skt/skt_world.php" id="move_skt_world" class="btn btn-outline-info button_size">SKT </br>'.$today_data_list[0].' 건</a>
            <a href="./kt/kt_shop.php" class="btn btn-outline-info button_size">KT </br>'.$today_data_list[1].' 건</a>
            <a href="./lg_u_plus/lg_u_plus.php" class="btn btn-outline-info button_size">LG U+ </br>'.$today_data_list[2].'건</a>
        </div>
        ';

        $result.='
        <div class="flexbox wrapper">
            <a href="./lg_mobile/lg_mobile.php" class="btn btn-outline-info button_size">U+알뜰모바일 </br>'.$today_data_list[3].'건</a>
            <a href="./sk7/sk7.php" class="btn btn-outline-info button_size">SK 7모바일 </br>'.$today_data_list[4].'건</a>
            <a href="./kt_m_mobile/kt_m_mobile.php" class="btn btn-outline-info button_size">KT M모바일 </br>'.$today_data_list[5].'건</a>
            <a href="./hello_mobile_skt/hello_mobile_skt.php" class="btn btn-outline-info button_size">헬로모바일(SKT) </br>'.$today_data_list[6].'건</a>
            <a href="./hello_mobile_kt/hello_mobile_kt.php" class="btn btn-outline-info button_size">헬로모바일(KT) </br>'.$today_data_list[7].' 건</a>
        </div>
        ';
	echo $result;
}
?>
