<?php 
	date_default_timezone_set('Asia/Seoul');
	include("./dbconfig.php"); //디비 셋팅 정보를 가져온다<div class=""></div>
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




	//휴가 기간 데이터도 가져오기 (+0929)
	$sql = "SELECT * FROM t_vacation where h_year = '$year' and h_date like '$month%' and del_yn = 'N'"; // 쿼리문으로 데이터 가져오기 , 삭제된 데이터는 가져오지 않도록 구성.
	$result2 = $db->query($sql);
	
	//받아온 휴가 기간 데이터를 배열에 다시 넣어준다.
	$rowSet = 0;
	$vacationDay = []; //배열 초기화
	while($row = $result2->fetch_assoc()){ //데이터를 다시 초기화 시키고 사용하는것이기 떄문에 변수명이 동일해도 상관 없음.
		$vacationDay[++$rowSet] = $row['h_date'];
		$vacationContents[$rowSet] = $row['h_contents'];
		$vacationName[$rowSet] = $row['h_name'];
	};
	
	$timestamp = strtotime("$year-$month-01"); // 셋팅한 날짜의 타임스탬프를 가져온다.
	$totalDay = date('t', $timestamp); // 지금 달력 '월'의 총 날짜의 마지막 날을 가져온다.
	$startWeek = date('w', $timestamp); // 시작 요일
	$totalWeek = ceil(($totalDay + $startWeek) / 7);  // 지금 달의 총 주차를 가져온다. (1주차/2주차 등등. 몇주차 까지 있는지.)

	$today_date = strtotime("Now"); // 오늘 날짜를 가져온다.
	$today_date="".date('Y-m-d', $today_date);
	$today_date_year =  date('Y');
	$today_date_month = date('m');
	$today_date_day = date('d');
	// echo "오늘은 $today_date_year 년, $today_date_month 월, $today_date_day 일";
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

      .modal {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 2;
      }
      .modal_content {
        position: absolute;
        left: 20%;
        top: 30%;
        transform: translate(-50%, -50%);
        width: 300px;
        height: 300px;
        border: 5px solid #FF9800;
        background-color: white;
        overflow: auto;
		padding: 10px;
      }


	</style>

	 <!-- jQuery -->
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>
<body>
	
	<!-- 이전 / 이후 년/월  날짜 바로가기 만들기 시작 (자바스크립트로 처리할 데이터를 먼저 가공해줌)-->
	<?php
		//지금이 1월이라면 작년 12월 링크를 만들어준다.
		if ($month == 1){
			$setYear = $year-1;
			$previousUrl = "index.php?year=" . $setYear . "&month=12"; //이전년도 12월
		}else{
			$setMonth = $month-1;
			$previousUrl = "index.php?year=" . $year . "&month=" . $setMonth; //이전 달
		}

		//현재가 12월이라면 다음년도 1월 링크를 만들어준다.
		if ($month == 12){
			$setYear = $year +1;
			$nextUrl = "index.php?year=" . $setYear . "&month=1"; //다음년도 1월
		}else{
			$setMonth = $month+1;
			$nextUrl = "index.php?year=" . $year . "&month=" . $setMonth; //다음 달
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
			<th>SUN</th> 
			<th>MON</th> 
			<th>TUE</th> 
			<th>WED</th> 
			<th>THU</th> 
			<th>FRI</th> 
			<th>SAT</th> 
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
					

					if($today <= 9){
						$today_tem = "0" . $today; // 9 이하는 0을 붙여주도록 처리
					}else{
						$today_tem  = $today;
					}
					// echo "$year"; // 해당 년도 를 출력
					// echo "$month"; // 해당 월을 출력 
					// echo "$today_tem"; // 해당 일 을 출력
					//공휴일 정보와 일정 관리 기능을 포함하기 위해 먼저 search 데이터를 만들어주는과정을 거친다.

					// echo "오늘은 $today_date_year 년, $today_date_month 월, $today_date_day 일";
					if(count($vacationDay) !=0){
						$search = array_search((string)$month.(string)$today_tem, $vacationDay); 
					}else{
						$search = 0;
					}

					if(count($specialDay) !=0){
						$search2 = array_search((string)$month.(string)$today_tem, $specialDay); 
					}else{
						$search2 = 0;
					}

					//이후 리서치 데이터를 가저오도록 변경 작업 진행
					if ($search){ // search결과 있다면 빨간색으로 처리해준다
						//data-는 데이터 속성으로 데이터에 필요한 값을 가지고 있는다.
						//여기서 사용하는 데이터는 달력날짜 / 년도 / 휴가명 / 휴가내용을 가지고 있는다.
						// echo "<td style='background-color: #FFC107' class='btn' data-today='$month$today_tem' data-year='$year' data-name='$vacationName[$search]' data-contents='$vacationContents[$search]'>" . $today . " $vacationName[$search]</td>";
						echo "<td style='border: inset; border-color: #FF9800  #FF9800  #FF9800  #FF9800 ; color: #FF9800;'  class='btn'  data-today='$month$today_tem' data-year='$year' data-name='$vacationName[$search]' data-contents='$vacationContents[$search]'>" . $today . " $vacationName[$search]</td>";
						##색상 변경 버전. 아무거나 사용하세요. 주석 풀어서 사용하시면 됩니다.
					}else if ($search2){ // search2결과 있다면 빨간색으로 처리해준다
						echo "<td style='color: red;'>" . $today . " $specialName[$search2]</td>";
					}else if($oneDay % 7 == 0){ //일요일은 빨간색으로 처리
						echo "<td style='color: red;' class='btn2' data-today='$month$today_tem' data-year='$year'>" . $today . "</td>";
					}else if($oneDay % 7 == 6){ //토요일은 파란색으로 처리
						echo "<td style='color: blue;' class='btn2' data-today='$month$today_tem' data-year='$year'>" . $today . "</td>";
					}else if(($year== $today_date_year) && ($month ==$today_date_month) && ($today_tem ==$today_date_day)){
						echo "<td style='color: #24A38B;' class='btn' data-today='$month$today_tem' data-year='$year'>" . $today . " today</td>";
					}
					else{
						echo "<td class='btn2' data-today='$month$today_tem' data-year='$year'>" . $today . "</td>";
					}

					$today++;
					//테스트 해볼때 열어서 사용해보세요.
					// echo "totalDay :: $totalDay //today :: $today  // oneDay :: $oneDay // startWeek :: $startWeek <br>";
				?>
				<?php } else { echo "<td></td>";} // 달력에 나오지 않는 날짜도 칸을 위해 td를 생성해준다. ?>
						
				<?php } ?> 

			</tr> 
		<?php } ?> 
	</table>
	<!--일정을 수정하는 모달을 만들어줍니다 -->
	<div class="modal" name="modal" id="modal">
		<div class="modal_content">
			<h3> 일정 정보 </h3>
			<div id="title">일정 명: <input type="text" id="h_name_modal"/></div>
			<div id="bodyset">
			내용 : <br><textarea style="width:230px; height: 110px;" id="h_contents_modal"></textarea>
			</div>
			<input type="hidden" id="today_modal" value=""> 
			<input type="hidden" id="year_modal" value="">
			<div style="text-align: right; padding-top: 25px;">
				<input class="btn_close" type="button" value="취소">
				<input type="button" value="삭제" onclick="calendar_del();">
				<input type="button" value="수정" onclick="calendar_update();">
			</div>
			
		</div>
    </div>
	<!--일정을 등록하는 모달을 만들어줍니다 -->
	<div class="modal" name="modal2" id="modal2">
		<div class="modal_content">
			<h3> 일정 정보 </h3>
			<div id="title">일정 명: <input type="text" id="h_name_modal2"/></div>
			<div id="bodyset">
			내용 : <br><textarea style="width:230px; height: 110px;" id="h_contents_modal2"></textarea>
			</div>
			<input type="hidden" id="today_modal2" value="">
			<input type="hidden" id="year_modal2" value="">
			<div style="text-align: right; padding-top: 25px;">
				<input class="btn_close2" type="button" value="취소">
				<input type="button" value="등록" onclick="calendar_insert();">
			</div>
			
		</div>
    </div>

	<!-- 자바스크립트로 처리한 달력 페이징 -->
	<script>
		//결과값은 상단 php에서 모두 처리한뒤 url만 받아옵니다.
		function move_prev_month(){ //이전 달
			location.href="<?=$previousUrl?>"
		}

		function move_next_month(){ //이후 달
			location.href="<?=$nextUrl?>"
		}

		function test(){
			alert("test");
		}

		//칼렌더 insert 처리 작업 진행
		function calendar_insert(){

			let today = $('#today_modal2').val();
			let year = $('#year_modal2').val();

			let name = $('#h_name_modal2').val();
			let contents = $('#h_contents_modal2').val();
			//ajax로 데이터 전송후 결과 받기.
			$.ajax({
				url:'./setting.php', //ajax 처리하는 부분
				type:'post', //post 로 전송
				dataType : 'json', //json로 데이터 전달 받기
				data:{'type': 'insert' , 'h_date' : today , 'h_year' : year , 'h_name' : name , 'h_contents' : contents }, //json 으로 data 생성후 전달
				success: function(data) {
					if(data.code == '200'){
						alert('정상적으로 처리되었습니다.');
						location.reload();
					}else{
						alert('정상적으로 처리되지 못했습니다.');
					}
				},
				error: function(err) {
					alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
				}
			});
		}

		//칼랜더 삭제 처리 진행
		function calendar_del(){

			let today = $('#today_modal').val();
			let year = $('#year_modal').val();
			//ajax로 데이터 전송후 결과 받기.

			$.ajax({
				url:'./setting.php', //ajax 처리하는 부분
				type:'post', //post 로 전송
				dataType : 'json', //json로 데이터 전달 받기
				data:{'type': 'del' , 'h_date' : today , 'h_year' : year }, //json 으로 data 생성후 전달
				success: function(data) {
					if(data.code == '200'){
						alert('정상적으로 처리되었습니다.');
						location.reload();
					}else{
						alert('정상적으로 처리되지 못했습니다.');
					}
				},
				error: function(err) {
					alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
				}
			});
		}

		//데이터 업데이트
		function calendar_update(){

			let today = $('#today_modal').val();
			let year = $('#year_modal').val();

			let name = $('#h_name_modal').val();
			let contents = $('#h_contents_modal').val();
			//ajax로 데이터 전송후 결과 받기.
			$.ajax({
				url:'./setting.php', //ajax 처리하는 부분
				type:'post', //post 로 전송
				dataType : 'json', //json로 데이터 전달 받기
				data:{'type': 'update' , 'h_date' : today , 'h_year' : year , 'h_name' : name , 'h_contents' : contents }, //json 으로 data 생성후 전달
				success: function(data) {
					if(data.code == '200'){
						alert('정상적으로 처리되었습니다.');
						location.reload();
					}else{
						alert('정상적으로 처리되지 못했습니다.');
					}
				},
				error: function(err) {
					alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
				}
			});
		}




		$(document).ready(function() {
			$(".btn").click(function() {
				//모달에 데이터 추가 작업을 진행합니다.
				$('#today_modal').val(this.dataset.today);
				$('#year_modal').val(this.dataset.year);
				$('#h_name_modal').val(this.dataset.name);
				$('#h_contents_modal').val(this.dataset.contents);
				$("#modal").fadeIn();
			});
			$(".btn_close").click(function() {
				$("#modal").fadeOut();
			});

			$(".btn2").click(function() {
				//데이터 속성으로 가져온 데이터를 모달 페이지에 넣어줍니다
				$('#today_modal2').val(this.dataset.today);
				$('#year_modal2').val(this.dataset.year);
				$("#modal2").fadeIn();
			});
			$(".btn_close2").click(function() {
				$("#modal2").fadeOut();
			});

		});

	</script>
</body>
</html>