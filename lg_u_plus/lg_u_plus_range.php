<?php
// Range.php
if(isset($_POST["date"])){
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "phone_db";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$result = '';
		$result.='
		<br>
		<p class="flexbox wrapper btn btn-info">'.$_POST["date"].' 변경모델<p>';
		$query = "SELECT DISTINCT model_name FROM u_plus_shop WHERE support_date ='".$_POST["date"]."'";
		$sql = mysqli_query($conn, $query);
		$t=0;
		$total_record = mysqli_num_rows($sql);
		$result .='
		<p class="btn btn-outline-danger">공시지원금 변동 '.$total_record.'건</p>
		<br>';

		while($row = mysqli_fetch_array($sql)){
			$t ++; 
			if($t % 5 == 0){
				$result .='
				<button type="button" id="change_name" class="btn btn-outline-info">'.$row["model_name"].'</button>
				<br>';
			}else {
				$result .='
				<button type="button" id="change_name" class="btn btn-outline-info">'.$row["model_name"].'</button>
				';
			}
		}

        $result .='
        <div class="flexbox wrapper">
			<div class="button">단말기 명</div>
			<div class="button">모델 명</div>
			<div class="button">요금제</div>
			<div class="button">출고가</div>
			<div class="button">공시지원금</div>
			<div class="button">공시일자</div>
		</div>';

		$query = "SELECT * FROM u_plus_shop WHERE support_date ='".$_POST["date"]."' ORDER BY model_name";
        $sql = mysqli_query($conn, $query);
        if(mysqli_num_rows($sql) > 0){
		while($row = mysqli_fetch_array($sql)){
			$result .='
      <table>
			<tr class="flexbox wrapper">
  			<td>'.$row["machine_name"].'</td>
  			<td>'.$row["model_name"].'</td>
  			<td>'.$row["plan_money"].'</td>
  			<td>'.$row["shipment_money"].'</td>
            <td>'.$row["disclosure_money"].'</td>
  			<td>'.$row["support_date"].'</td>
			</tr>
      </br>
      <hr width="800" class="flexbox wrapper"/>
      ';
		}
	}
	else{
		$result .='
		<tr>
		<td colspan="5">아이템이 없습니다.</td>
		</tr>';
	}
	$result .='</table>';
	echo $result;
}
?>
