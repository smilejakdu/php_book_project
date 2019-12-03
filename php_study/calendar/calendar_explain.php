<?php 
	
	//DB 셋팅 부분
	$db = new mysqli('localhost', 'root', 'root', 'calendar');
	if ($db->connect_error) {
		die('데이터베이스 연결에 문제가 있습니다. 관리자에게 문의 바랍니다.');
		exit;
	}
	$db->set_charset('utf8');
	//디비 셋팅 종료

	$year =  date('Y'); // 먼저 년 데이터를 넣어준다.
	if(isset($_GET['year'])){ //이후 GET으로 year가 있다면
		$year = $_GET['year']; // 받아온 값 기준으로 year를 수정해준다.
	}
	
	$month = date('m'); //먼저 월 데이터를 넣어준다.
	if(isset($_GET['month'])){ //이후 GET으로 Month가 있다면
		$month = $_GET['month']; // 받아온 값 기준으로 month를 수정해준다.
		
		//받아온 데이터가 9 이하라면 0을 추가해준다.
		if($month <= 9){
			$month = "0" . $month;
		}
	} 

	///데이터 삽입하여 결과 가져오기
	// 년 / 월 필터링을 여기서 모두 해줘서 그에 맞는 년/월 이벤트 날짜 데이터만 가져오도록 구성한다.
	$sql = "SELECT * FROM t_holiday where h_year = '$year' and h_date like '$month%'"; // 쿼리문으로 데이터 가져오기
	$result = $db->query($sql);
	

	
	//받아온 이벤트 날짜 데이터를 while로 돌려서 배열에 각각 넣어준다. 
	$rowSet = 0;
	$specialDay = []; //배열 초기화
	while($row = $result->fetch_assoc()){
		$specialDay[++$rowSet] = $row['h_date'];
		$specialName[$rowSet] = $row['h_name'];
	};

	
	$timestamp = strtotime("$year-$month-01"); // 셋팅한 날짜의 타임스탬프를 가져온다.
	$totalDay = date('t', $timestamp); // 지금 달력 '월'의 총 날짜의 마지막 날을 가져온다.
	$startWeek = date('w', $timestamp); // 시작 요일
	$totalWeek = ceil(($totalDay + $startWeek) / 7);  // 지금 달의 총 주차를 가져온다. (1주차/2주차 등등. 몇주차 까지 있는지.)
?>

<!DOCTYPE html>
<html lang="kr">
<head>
	<meta charset="UTF-8">
	<title>calendar</title>
	<style type="text/css">

		/* 기본 테이블 설정 구조*/
		table {
			border-spacing: 0;
			border: 1px solid #444444;
   			border-collapse: collapse;
			
		}
		/* 테이블 사이즈 조정 / 왼쪽 상단 설정 (text-align) */
		table td {
			width: 100px;
            height: 80px;
            text-align: left;
			vertical-align : top;
			font-weight: 600;
		}

		/* 모든 a태그 밑줄 제거*/
		a{
        	text-decoration:none;
        }

		/* caption 태그 적용을 위한 css */
		caption{
			font-size: 25px; 
			padding-bottom: 15px;
		}
	</style>
</head>
<body>
	
	<!-- 이전 / 이후 년/월  날짜 바로가기 만들기 시작 (자바스크립트로 처리할 데이터를 먼저 가공해줌)-->
	<?php
		//지금이 1월이라면 작년 12월 링크를 만들어준다.
		if ($month == 1){
			$setYear = $year-1;
			$previousUrl = "calendar.php?year=" . $setYear . "&month=12"; //이전년도 12월
		}else{
			$setMonth = $month-1;
			$previousUrl = "calendar.php?year=" . $year . "&month=" . $setMonth; //이전 달
		}

		//현재가 12월이라면 다음년도 1월 링크를 만들어준다.
		if ($month == 12){
			$setYear = $year +1;
			$nextUrl = "calendar.php?year=" . $setYear . "&month=1"; //다음년도 1월
		}else{
			$setMonth = $month+1;
			$nextUrl = "calendar.php?year=" . $year . "&month=" . $setMonth; //다음 달
		}
	?>
	<!-- 이전 / 이후 년/월  날짜 바로가기 만들기 종료 -->

	<table border="1">
		<caption>
			<!-- 상단 날짜 바로가기 생성 자바스크립트 처리-->
			<a href="#" onclick="move_prev_month();"><</a>
			<?php echo "$year 년 $month 월" ?>
			<a href="#" onclick="move_next_month();" >></a>
			<!-- 상단 날짜 바로가기 완성 -->
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
			$today = 1; //실제 달력 날짜
		?>
		<!-- 처음 구한 모든 주차 반복 시작 -->
		<?php for ($i = 0; $i < $totalWeek; $i++){ ?> 
			<tr> 
				<!-- 한주 반복 시작 -->
				<?php for ($oneDay = 0; $oneDay < 7; $oneDay++){ ?> 
					
				<!-- 1. totalDay(총 날짜) 와 today (실제 달력 날짜) 를 비교하여 totalDay가 더 크다면 다음 조건을 확인 한다. (즉 전체 달력에서 나오는 부분을 확인) -->
				<!-- 2. oneDay(처음 셋팅한 시작 날짜 5(금요일)) 을 startWeek(지금날짜 - 숫자로 나옴.) 와 비교한다. ) << 이 조건이 없다면 처음 첫주가 어떤 요일부터 시작하는지 확인하지 못함. -->
				<!-- 2. 첫 주가 확인 된다면 이후는 today를 기준으로 트루값을 리턴한다. -->
				<?php if (($totalDay >= $today) && ($oneDay >= $startWeek || $today > 1)){ 
					$today++;
					if($oneDay % 7 == 0){ //일요일은 빨간색으로 처리
						echo "<td style='color: red;'>" . $today . "</td>";
					}else if($oneDay % 7 == 6){ //토요일은 파란색으로 처리
						echo "<td style='color: blue;'>" . $today . "</td>";
					}else if(count($specialDay) != 0){ //DB에 있는 데이터를 확인해서 가져온다.
						//조회하고 있는 today 데이터가 9이하라면 조회를 위해 0을 강제로 붙여준다.
						if($today <= 9){
							$today_tem = "0" . $today;
						}
						//형변환으로 인해 계산이 일어나지 않도록 String으로 처리해준다.
						$search = array_search((string)$month.(string)$today_tem, $specialDay); //배열 검색후 키값을 받아서 이후 SpecialName을 확인할때 처리
						if ($search){ // search결과 있다면 빨간색으로 처리해준다
							echo "<td style='color: red;'>" . $today . " $specialName[$search]</td>";
						}else{
							echo "<td>" . $today . "</td>";
						}
					}
					else{
						echo "<td>" . $today . "</td>";
					}

					//테스트 해볼때 열어서 사용해보세요.
					//echo "totalDay :: $totalDay //today :: $today  // oneDay :: $oneDay // startWeek :: $startWeek <br>";
				?>
				<?php } else { echo "<td></td>";} // 달력에 나오지 않는 날짜도 칸을 위해 td를 생성해준다. ?>
						
				<?php } ?> 

			</tr> 
		<?php } ?> 
	</table>

	<!-- 자바스크립트로 처리한 달력 페이징 -->
	<script>
		//결과값은 상단 php에서 모두 처리한뒤 url만 받아옵니다.
		function move_prev_month(){ //이전 달
			location.href="<?=$previousUrl?>"
		}

		function move_next_month(){ //이후 달
			location.href="<?=$nextUrl?>"
		}
	</script>
</body>
</html>