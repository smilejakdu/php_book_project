<?php
    header("content-type:text/html; charset=UTF-8"); ob_start;
    include('../lib/db_connect.php');
    $connect = dbconn();

    $user_id = $_POST['user_id'];
    $pw = $_POST['pw'];

    $pw =md5($pw); //  암호화 6자리로 됨.

    //나의 정보 데이터 가지고 오기 ! 

    $query = "select * from member where user_id='$user_id'";
    $result=mysqli_query($connect , $query);
    $member = mysqli_fetch_array($result);

    if(!$user_id){
        Error("아이디를 입력하세요.");
    }else if(!$member['user_id']){
        Error("존재하지 않는 회원아이디 입니다.");
    }

    if(!$pw){
        Error("비밀번호를 입력하세요.");
    }else if($member['pw']!=$pw){
        Error("비밀번호가 같지 않습니다.");
    }

    // 쿠키는 자신의 pc에 저장이 된다.
    
    if($member['user_id'] and $member['pw'] == $pw]){
            $tmps = $memeber['user_id']."//".$member['pw'];
            setcookie('COOKIES',$tmps,time()+60*60*24,"/"); //24 시간동안 유효
    }
?>

<script>
alert("로그인 되었습니다.");
location.href='../index.php';
</script>

