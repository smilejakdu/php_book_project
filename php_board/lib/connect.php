<?
// db연결 함수  (1)
function dbconn()
{
    $host_name = "localhost";
    $db_user = "root";
    $db_pw = "root";
    $db_name = "board_query";

    $connect = mysqli_connect($host_name, $db_user, $db_pw, $db_name);
    mysqli_set_charset($connect, "utf8");

    if ($connect->connect_errno) {
        echo "<span color='red'>연결에 실패 하였습니다.</span>" . $connect->connect_error . '<br>';
    }
    return $connect;
}

////////////////--[[페이지 세팅 정보]]--////////////////
function setup()
{
    global $connect, $id;
    $query = "select * from page_setting ";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);

    return $data;
}


////////////////--[[페이지 세팅 정보 (끝)]]--////////////////


////////////로그인정보가 없으면 로그인페이지로.//////////////////
function logen_page($msg)
{
    echo " 
    <script>window.alert('$msg'); 
	location.href='http://" . $_SERVER['HTTP_HOST'] . "/member/login_page.php'; 
	</script> ";
    exit;
}


// 에러메세지 출력함수 (5)
function Error($msg)
{
    echo " 
    <script> 
       window.alert('$msg'); 
       history.back(1); 
    </script>";
    exit;
}

// 게시판 리스트 가기
function list_go($msg, $ctg, $ctgs)
{
    echo " 
    <script>window.alert('$msg'); 
	location.href='http://$_SERVER[HTTP_HOST]/board/bbs1/list.php?ctg=$ctg&ctgs=$ctgs'; 
	</script> ";
    exit;
}


function Hom_go($msg)
{
    echo " 
    <script> 
       window.alert('$msg'); 
        location.href='http://$_SERVER[HTTP_HOST]'; 
    </script> 
    ";
    exit;
}

function movepage($url)
{
    echo " 
     <script> 
        location.href='$url'; 
     </script>  
     ";
}

///아이디가 없으면 메인으로///
function mainGO($msg)
{
    echo " <script> window.alert('$msg'); 
            location.href='" . $_SERVER[HTTP_HOST] . "';
            </script> ";
    exit;
}


/////////언어 쿠키사용/////////(7)
function languages()
{
    global $HTTP_COOKIE_VARS;
    $languages = $HTTP_COOKIE_VARS["members_languages"];
    echo $languages;
}


////////[회사정보]////////////
function co_info()
{
    global $connect;
    $q_set = "select * from basic_setting where co_ID='jm1'";
    mysqli_query($connect, "set names utf8");
    $r_set = mysqli_query($connect, $q_set);
    $d_set = mysqli_fetch_array($r_set);

    return $d_set;
}


///////////////회원정보 쿠키///////////////(8)
function member_info()
{
    global $connect, $_COOKIE;


    $temp = $_COOKIE["members"] ?? null;  //쿠키
    $temps = $_SESSION['user_id'] ?? null; //세션


///////////////회원정보/////////////// (9)
    $query = "select * from member where user_id='$temp' or user_id='$temps' ";
    mysqli_query($connect, "SET NAMES utf8");
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_array($result);

    if ($temp == $data['user_id'] and !$temps) { //쿠키가 있고 세션이 없는경우
        $_SESSION['user_id'] = $data['user_id']; //세션등록
    }

    return $data;

}


function device_mode()
{ //기기 접속모드  값이 있으면 모바일 접속
    //모바일 접속시 모바일용 페이지로 이동 ;
    $arr_mobile = array("Android", "iPhone", "iPod", "IEMobile", "Mobile", "lgtelecom", "PPC", "Opera Mini", "SymblanOS", "Windows CE", "BlackBerry", "Nokia",
        "SonyEricsson", "web OS", "PalmOS", "LG", "MOT", "SAMSUNG", "MeeGo");
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    for ($iex = 0; $iex < count($arr_mobile); $iex++) {
        if (preg_match("/$arr_mobile[$iex]/i", $user_agent)) {
            $device_mobile = "mobile";
        } else {
            $device_mobile = "PC";
        }

        return $device_mobile;
    }
}

?> 