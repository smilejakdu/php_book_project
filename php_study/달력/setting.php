<?php

include("./dbconfig.php"); //데이터베이스 정보를 가져온다.
header('Content-Type: application/json');

if($_POST['type'] == null){
	$member = array("code" => "400", "retrun" => "false"); //아무 데이터가 없을 경우 처리
	$output =  json_encode($member);
	
	echo  urldecode($output);
	exit;
}

//post로 가져온 데이터들 포함시켜두기.
$h_date = $_POST['h_date'];
$h_year = $_POST['h_year'];

//INSERT
if($_POST['type'] == "insert"){ //ajax로 받아온 값이 인서트라면
	$h_name = $_POST['h_name']; //name 정보와
	$h_contents = $_POST['h_contents']; //contents 정보를 가져온뒤
	$sql = "insert into t_vacation (h_date , h_year , h_name, h_contents)"; //데이터를 인서트 시켜주는 작업을 진행한다.
	$sql = $sql . " values ('$h_date' , '$h_year' , '$h_name' , '$h_contents')";

}else if($_POST['type'] == "update"){
	$h_name = $_POST['h_name']; //name 정보와
	$h_contents = $_POST['h_contents']; //contents 정보를 가져온뒤
	$sql = "update t_vacation set h_name='$h_name' , h_contents='$h_contents'";
	$sql = $sql . " where h_date = '$h_date'";
	$sql = $sql . " and h_year = '$h_year' ";
	$sql = $sql . " and del_yn = 'N' ";

}else if($_POST['type'] == "del"){
	$sql = "update t_vacation set del_yn='Y'"; //업데이트 쿼리문
	$sql = $sql . " where h_date = '". $h_date . "'";
	$sql = $sql . " and h_year = '". $h_year . "' ";

}else{
	$member = array("code" => "300", "retrun" => "false");
	$output =  json_encode($member);
	echo  urldecode($output);
	exit;
}

$result = $db->query($sql);
$member = array("code" => "200", "retrun" => "true" , "type" => $_POST['type'] , "sql" => $sql); //배열로 데이터를 만들어준다. sql부분은 테스트니 결과만 보시고 삭제하세요.


$output =  json_encode($member); //배열 데이터를 json으로 만들어준다.
echo  urldecode($output); //json 데이터를 보여준다.




?>