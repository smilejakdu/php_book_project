<?php 
	
	//DB 셋팅 부분
	$db = new mysqli('localhost', 'root', 'root', 'calendar');
	if ($db->connect_error) {
		die('데이터베이스 연결에 문제가 있습니다. 관리자에게 문의 바랍니다.');
		exit;
	}
	$db->set_charset('utf8');
	//디비 셋팅 종료

	$year =  date('Y'); 
	if(isset($_GET['year'])){ 
		$year = $_GET['year']; 
	}
	
	$month = date('m'); 
	if(isset($_GET['month'])){ 
		$month = $_GET['month']; 
		
		if($month <= 9){
			$month = "0" . $month;
		}
	} 

	$sql = "SELECT * FROM t_holiday where h_year = '$year' and h_date like '$month%'"; 
	$result = $db->query($sql);
	
	$rowSet = 0;
	$specialDay = []; 
	while($row = $result->fetch_assoc()){
		$specialDay[++$rowSet] = $row['h_date'];
		$specialName[$rowSet] = $row['h_name'];
	};
	
	$timestamp = strtotime("$year-$month-01"); 
	$totalDay = date('t', $timestamp); 
	$startWeek = date('w', $timestamp); 
	$totalWeek = ceil(($totalDay + $startWeek) / 7); 
?>

<!DOCTYPE html>
<html lang="kr">
<head>
	<meta charset="UTF-8">
	<title>calendar</title>
	<style type="text/css">

		table {
			border-spacing: 0;
			border: 1px solid #444444;
   			border-collapse: collapse;
			
		}
		
		table td {
			width: 100px;
            height: 80px;
            text-align: left;
			vertical-align : top;
			font-weight: 600;
		}

		
		a{
        	text-decoration:none;
        }

		
		caption{
			font-size: 25px; 
			padding-bottom: 15px;
		}


	</style>
</head>
<body>
	
	
	<?php
		
		if ($month == 1){
			$setYear = $year-1;
			$previousUrl = "calendar.php?year=" . $setYear . "&month=12"; 
		}else{
			$setMonth = $month-1;
			$previousUrl = "calendar.php?year=" . $year . "&month=" . $setMonth; 
		}

		
		if ($month == 12){
			$setYear = $year +1;
			$nextUrl = "calendar.php?year=" . $setYear . "&month=1"; 
		}else{
			$setMonth = $month+1;
			$nextUrl = "calendar.php?year=" . $year . "&month=" . $setMonth; 
		}
	?>

	<img src="./image.jpg"  width="200" height="200" alt="My Image">

	<table border="1">
		<caption>
			
			<a href="#" onclick="move_prev_month();"><</a>
				<?php echo "$year 년 $month 월" ?>
			<a href="#" onclick="move_next_month();" >></a>
			
		</caption>
		<tr> 
			<th>일요일</th> 
			<th>월요일</th> 
			<th>화요일</th> 
			<th>수요일</th> 
			<th>목요일</th> 
			<th>금요일</th> 
			<th>토요일</th> 
		</tr>
		 
		<?php 
			$today = 1; 
		?>
		
		<?php for ($i = 0; $i < $totalWeek; $i++){ ?> 
			<tr> 
				
				<?php for ($oneDay = 0; $oneDay < 7; $oneDay++){ ?> 
					
				<?php if (($totalDay >= $today) && ($oneDay >= $startWeek || $today > 1)){ 
					$today++;
					if($oneDay % 7 == 0){ 
						echo "<td style='color: red;'>" . $today . "</td>";
					}else if($oneDay % 7 == 6){ 
						echo "<td style='color: blue;'>" . $today . "</td>";
					}else if(count($specialDay) != 0){ 
						
						if($today <= 9){
							$today_tem = "0" . $today;
						}
						
						$search = array_search((string)$month.(string)$today_tem, $specialDay); 
						if ($search){ 
							echo "<td style='color: red;'>" . $today . " $specialName[$search]</td>";
						}else{
							echo "<td>" . $today . "</td>";
						}
					}
					else{
						echo "<td>" . $today . "</td>";
					}

				?>
				<?php } else { echo "<td></td>";}  ?>
						
				<?php } ?> 

			</tr> 
		<?php } ?> 
	</table>

	<script>
		function move_prev_month(){ 
			location.href="<?=$previousUrl?>"
		}

		function move_next_month(){ 
			location.href="<?=$nextUrl?>"
		}
	</script>
</body>
</html>