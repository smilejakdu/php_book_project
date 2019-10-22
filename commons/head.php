<?php
	define('__ROOT__', dirname(dirname(__FILE__)));

	require_once(__ROOT__."/lib/dbconfig.php");
	require(__ROOT__."/lib/utill.php");

	session_start();
	error_reporting(); //오픈직전에 풀어줄것

	//사용자 URL 추출 작업 . http , https분기
	$base_URL = ($_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
	$base_URL .= ($_SERVER['SERVER_PORT'] != '80') ? $_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'] : $_SERVER['HTTP_HOST'];
	$web_path = $base_URL;


	//세션 체크
	if (empty($_SESSION['id'])){
		echo("<script>location.replace('".$web_path."/index.php');</script>"); 
		exit;
	}
	if (is_numeric($_SESSION['id']) == false){
		echo("<script>location.replace('".$web_path."/index.php');</script>"); 
		exit;
	}

	if($_SESSION['id'] == null || $_SESSION['id'] == ""){
		echo("<script>location.replace('".$web_path."/index.php');</script>"); 
		exit;
	}
	

	//유저 데이터 받아오기
	$sql = "SELECT * FROM user where no = ".$_SESSION['id'];
	$result = mysqli_query($db , $sql);
    $user_data = mysqli_fetch_assoc($result);


?>
<!doctype html>
<html lang="kr">
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="">
<title>게시판</title>
<!-- Bootstrap core CSS -->
<link href="<?=$web_path?>/css/bootstrap.css" rel="stylesheet">

<!-- 알림창 추가 -->

<!--파비콘 추가-->
<link rel="shortcut icon" href="<?=$web_path?>/img/shield.ico">
<!-- <link href="css/screen.css" rel="stylesheet"> -->
<!-- Custom styles for this template -->


<!-- Bootstrap core JavaScript ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



<style>
	@import url(http://fonts.googleapis.com/earlyaccess/jejugothic.css);
	@import url(https://fonts.googleapis.com/css?family=Lato:400,700);
	body {
		font-size: 14px;
		font-family: 'Lato', sans-serif !important;
	}
	@media (min-width: 992px) {
		.mainset{
			padding-left: 0px;
		}
	}
	.container {
		width: 1180px !important;
		max-width: none !important;
	}
	.jeju {
		font-family: 'Jeju Gothic', serif;
		font-size: 15px;
	}
	.comment{
		background-color :#e9ecef; 
		padding-bottom: 5px; 
		padding-top: 5px; 
		margin-bottom: 5px;
		margin-top: 25px;
	}
</style>
<!-- 모바일 고려 x -->
<!-- container / meta -->
</head>

<body style="background-color: #f4f4f4;">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
	<a class="navbar-brand" href="board.php" style="font-family: 'Jeju Gothic', serif;">블랙보드</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php if($title == "community"){ ?>active <?php } ?>">
			<a class="nav-link jeju" href="<?=$web_path?>/board.php">커뮤니티</a>
			</li>
		</ul>
		<div class="form-inline my-2 my-lg-0" style="color:white;">
			<?=$user_data['username']; ?>님
			<a class="nav-link jeju"  style="color:white;" href="<?=$web_path?>/logout.php">로그아웃</a>
		</div>
	</div>
</div>
</nav>
