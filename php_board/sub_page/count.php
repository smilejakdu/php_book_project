<?
/////////////////////////////////////  방문자 카운트 /////////////////////////////////////
$today=date("Ymd",time());
if($_COOKIE["set_today"] !== $today){  //쿠키가 없으면 쿠키에 저장
setcookie("set_today",$today,time()+60*60*24, "/");   // 하루동안 유효 
}


function  counts(){
	global $connect, $today;
$query="select * from date_counts where regdate=$today";
$resert = mysqli_query($connect, $query);
$aaa=mysqli_fetch_array($resert);
return $aaa['counts'];
}
$counts=counts();


if($_COOKIE["set_today"] !=$today){  //쿠키가  쿼리를 보낸다.
		if($counts){  //오늘 날짜가 있다면
         $_query = "update date_counts set counts=counts +1  where regdate='$today' " ;  
		 mysqli_query($connect, $_query);
            }else if(!$counts){  //오늘 날짜가 없다면;
        $_query="insert into date_counts (regdate, counts) values('$today','1')";
        mysqli_query($connect, $_query);
          }
        }
/////////////////////////////////////  방문자 카운트  (끝) /////////////////////////////////////



/////////////////////////////  방문자 카운트  데이터 지우기 ////////////////////////////
 /*데이터의 저장된 카운트 수는 현재 날짜로 부터  10일동안만 저장이 되고
 10일 이상인 데이터는 삭제가 됩니다.  */
 $_times=time(); //현재데이터
 $d_regdate=$_times+strtotime($_times)-60*60*24*10; // (초*분*시간*날짜)
 $reg_date=date("Ymd",$d_regdate); 

///////   카운터 지정시간이 지나면 DB자료는 지운다. ///////////////////
   $d_query = "delete  from date_counts where regdate<'$reg_date' ";  
   $d_result = mysqli_query($connect, $d_query); 
   if(!$d_result) die(mysqli_error());  
////////////////////////////  방문자 카운트  데이터 지우기 (끝) /////////////////////////////
?>