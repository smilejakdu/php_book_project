<?php
    header("content-type:text/html; charset=UTF-8");
    error_reporting(E_ALL);

    ini_set("display_errors", 1);
    
   $id=$_POST['id'];
   $user_id=$_POST['user_id'];
   $name=$_POST['name'];
   $pw=$_POST['pw'];
   $memo=$_POST['memo'];

   $regdate = date("YmdHis",time()); // 날짜 , 시간 
   $ip = getenv("REMOTE_ADDR"); //ip

    $connect = mysqli_connect("localhost","root","root" ,"board"); // mysql 연결

    if(!$connect){
        echo "연결에 실패 하였습니다.".mysqli_error();
    }else{
        echo"연결에 성공 하였습니다.";
    }

    //쿼리 전송
    $query = "insert into bbs_1(id , user_id , name , pw , memo , regdate , ip)
                         values('$id','$user_id','$name','$pw','$memo','$regdate','$ip')";
    mysqli_query($connect , $query);
    // mysqli_commit($connect);
    // mysqli_close($connect); // mysql 끝내기.
?>

<script>
    alert("쿼리가 정상적으로 전송 되었습니다.");
    location.href = 'index.php'; // 다시 index페이지로 돌아가게 한다.
</script>