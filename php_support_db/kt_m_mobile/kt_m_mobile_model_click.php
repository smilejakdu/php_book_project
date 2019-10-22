<?php
// Range.php
if(isset( $_POST["changed_machine_name"] , $_POST["date"]  )){
		include '../connect.php';
		$conn = dbconn();
		$result = '';
		$result.='
		<br>
		<p class="flexbox wrapper btn btn-info">'.$_POST["date"].' 변경모델<p>';

		$query = "SELECT DISTINCT machine_name FROM kt_m_mobile WHERE support_date ='".$_POST["date"]."'";
		$sql = mysqli_query($conn, $query);
		$t=0;
		$total_record = mysqli_num_rows($sql);
		$result .='
		<p class="btn btn-outline-danger">공시지원금 변동 '.$total_record.'건</p>
		<br>
		';

		while($row = mysqli_fetch_array($sql)){
			$t ++; 
			if($t % 5 == 0){
				if($_POST["changed_machine_name"] == $row["machine_name"]){

					$result .='
					<button type="button" id="change_name" class="btn btn-info">'.$row["machine_name"].'</button>
					<br>';
				}else {
					$result .='
					<button type="button" id="change_name" class="btn btn-outline-info">'.$row["machine_name"].'</button>
					<br>';
				}

			}
			else {

				if($_POST["changed_machine_name"] == $row["machine_name"]){
					$result .='
					<button type="button" id="change_name" class="btn btn-info">'.$row["machine_name"].'</button>
					';
				}else {
					$result .='
					<button type="button" id="change_name" class="btn btn-outline-info">'.$row["machine_name"].'</button>
					';
				}

			}
		}

	$result .= '
       <div class="container">
        <div class="table-responsive">
            <table>
                <tr>
                    <th>
                        <button class="button_list">단말기 명</button>
                    </th>
                    <th>
                        <button class="button_list"> 모델 명</button>
                    </th>
                    <th>
                        <button class="button_list">요금제</button>
                    </th>
                    <th>
                        <button class="button_list"> 출고가</button>
                    </th>
                    <th>
                        <button class="button_list"> 공시지원금</button>
                    </th>
                    <th>
                        <button class="button_list"> 공시일자</button>
                    </th>
                </tr>';

		$query = "SELECT * FROM kt_m_mobile WHERE machine_name ='".$_POST["changed_machine_name"]."' AND support_date = '".$_POST["date"]."'  ORDER BY machine_name , plan_money";
        $sql = mysqli_query($conn, $query);
        if(mysqli_num_rows($sql) > 0){
		while($row = mysqli_fetch_array($sql)){
			$result .= '
			<tr class="table table bordered">
                <td>' . $row["machine_name"] . '</td>
                <td>' . $row["model_name"] . '</td>
                <td>' . $row["plan_money"] . '</td>
                <td>' . $row["shipment_money"] . '</td>
                <td>' . $row["disclosure_money"] . '</td>
                <td>' . $row["support_date"] . '</td>
			</tr>
      ';
		}
		} else {
			$result .= '
		<tr>
		    <td colspan="5">아이템이 없습니다.</td>
		</tr>';
		}
	$result .= '</table>';
	echo $result;
}
?>
