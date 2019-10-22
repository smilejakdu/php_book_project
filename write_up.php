<?php
	$title ="community";
	include "commons/head.php";

	//define('__ROOT__', dirname(dirname(__FILE__)));

	//include(__ROOT__."/lib/dbconfig.php");
	//include(__ROOT__."/lib/utill.php");

	//게시글 번호 받아오기
	//$no =$_GET['no'];

	$no = $db->real_escape_string($_POST['no']);
	//stripslashes 처리 추가
	$no = scriptExclusion($no);


	//게시글 조회 쿼리
	$sql = 'select * from board where no = ' . $no;
	$sql = $sql . " and del_yn = 'N'";
	$textdata = $db->query($sql);
	$text = $textdata->fetch_assoc();

	//결과없으면 방어코드 작동
	if(empty($text)) {
		echo "<script>alert('접근할 수 없습니다.'); history.back();</script>";
		exit;
	}

	
	//사용자가 맞는지 조건 검사 시작
	if ($text['id'] == $_SESSION['user_name'] || $_SESSION['gm'] == '2'){}
	else{
		echo("<script>location.replace('../board.php');</script>"); 
		exit;
	}


?>


	<!-- 중간 콘텐츠 시작 -->

	<form enctype='multipart/form-data' action='./board/write_upload.php' method='post' id="board_form">
	<input type="hidden" id="no" name="no" value="<?=$text['no']?>">
	<input type="hidden" id="listcode" name="listcode" value="2">

	<div class="container" style="padding-top:1em;">
		<div class="card" style="margin-bottom: 10px;">
			<div class="card-body">
				<!-- 게시글 작성 폼 시작 -->
				<h4>게시글 수정</h4>
				<hr>
				<p>게시글 제목</p>
				<div class="form-group">
					<input type="text" class="form-control" id="title" name="title" placeholder="제목을 입력해주세요." value="<?=$text['title']?>">
				</div>

				<div class="form-group">
					<small id="text" class="form-text text-muted">내용을 마음것 입력해주세요.</small>
					<textarea class="form-control" id="content" name="content" style="height: 530px;" rows="3"> <?=$text['content']?></textarea>
				</div>
				<!-- 게시글 작성 폼 끝 -->

				<div id="ajaxImageModal" style="display:none;">
					<div id="light" style="display: table;position: absolute;top:25%;left:25%;width:50%;height:50%; text-align:center; background-color:transparent; z-index:1002;overflow: auto;">
						<div style="display: table-cell; vertical-align: middle;">
							<img src="/ckeditor/plugins/ajaximage/loading.gif" style="user-select: none; -ms-user-select: none;">
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- 첨부파일 업로드 -->
		<div class="card" style="margin-bottom: 30px;">
			<div class="card-body">
				<h5 style="font-size: 15px;">첨부파일등록하기</h5>
				<div class="form-group">
					<input type="file" class="form-control-file" id="myfile" name="myfile" aria-describedby="fileHelp">
					<small id="fileHelp" class="form-text text-muted">첨부파일은 1개의 파일만 올릴 수 있습니다.</small>
				</div>
			</div>
		</div>
		<!-- 첨부파일 업로드 끝 -->
	
		<div class="text-right" style="padding-bottom: 100px;">
			<button type="button" class="btn btn-primary" style="border-radius : 0.5em;" onclick="formset();">등록</button>
		</div>

	</div>
	<!--중간 콘텐츠 끝-->
	</form>

	<form id="img_upload_form" action="/img_upload.php" enctype="multipart/form-data" method="post" style="display:none;">
		<input type='file' id="img_file" multiple="multiple" name='imgfile[]' accept="image/*">
	</form>

	<script type="text/javascript" src="./ckeditor/jquery.form.min.js"></script>
	<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="./ckeditor/adapters/jquery.js"></script>

	<script>

		
		$('#content').ckeditor();
		
		var ajaxImage = {};
		// ckeditor textarea id
		ajaxImage["id"] = "content";
		// 업로드 될 디렉토리
		ajaxImage["uploadDir"] = "upload";
		// 한 번에 업로드할 수 있는 이미지 최대 수
		ajaxImage["imgMaxN"] = 10;
		// 허용할 이미지 하나의 최대 크기(MB)
		ajaxImage["imgMaxSize"] = 20;

		window.onload = function () {
			
			//CKEDITOR.replace('content');
		}



		function formset(){
			
			CKEDITOR.instances.content.updateElement();

			if($('#title').val()==""){
				alert("제목을 입력해주세요.");
			}
			else if($('#content').val()==""){
				alert("내용을 입력해주세요.");
			}
			else{
				$("#board_form").submit();
			}
		}
	</script>





<?php
	include "commons/footer.php";
?>
