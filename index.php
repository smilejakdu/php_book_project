<?php

	session_start();
	
	//파라미터에 ck 데이터가 같이 날라오면 표시해준다.
	$login_ck = $_GET['ck'];

	//세션에 값이 들어있는상태라면 자동으로 리프레쉬 진행

	//세션 체크
	if($_SESSION['id'] > 0){
		echo("<script>location.replace('./board.php');</script>"); 
		exit;
	}
?>

<!doctype html>
<html lang="kr">
<head>
<meta charset="UTF-8">
<title>로그인</title>


<style>
	body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #eee;
	}

	.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
	margin-bottom: 10px;
	}
	.form-signin .checkbox {
	font-weight: 400;
	}
	.form-signin .form-control {
	position: relative;
	box-sizing: border-box;
	height: auto;
	padding: 10px;
	font-size: 16px;
	}
	.form-signin .form-control:focus {
	z-index: 2;
	}
	.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
	}
	.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
	}
</style>

<link href="./css/bootstrap.css" rel="stylesheet">
</head>
<body>

<div class="container">

	<form class="form-signin" action="./login/login_ck.php" method="post" enctype="multipart/form-data">
		<h2 class="form-signin-heading">LOGIN</h2>
		<label for="inputId" class="sr-only">ID</label>
		ID<input type="text" name="inputId" id="inputId" class="form-control" required="required" placeholder="아이디" autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		PW<input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
		<div class="checkbox">
			<?php if ($login_ck == "1"){ ?> <a href="#" class="more" style="color: red; text-decoration: none;">없는계정이거나, 아이디나 패스워드가 틀렸습니다.</a><?php } ?>
			<?php if ($login_ck == "2"){ ?> <a href="#" class="more" style="color: red; text-decoration: none;">이미 사용된 계정입니다.</a><?php } ?>
			<?php if ($login_ck == "3"){ ?> <a href="#" class="more" style="color: #4caf50; text-decoration: none;">정상적으로 계정이 생성되었습니다!</a><?php } ?>
			<?php if ($login_ck == "4"){ ?> <a href="#" class="more" style="color: red; text-decoration: none;">계정인증 후 로그인이 가능합니다.</a><?php } ?>
			<?php if ($login_ck == "5"){ ?> <a href="#" class="more" style="color: red; text-decoration: none;">(가입) 성별을 선택해주세요.</a><?php } ?>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
		<a class="btn btn-lg btn-primary btn-block" href="./join.php" >가입</a>
	</form>

</div> <!-- /container -->

</body>
</html>