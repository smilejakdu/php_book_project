<? session_start();
ob_start(); ?>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"><!--다국어 언어: UTF-8-->

    <link type='text/css' href='../lib/style.css' rel='stylesheet'/>
</head>

<?
///////////////////////////////
$user_id = $_SESSION['user_id'];
///////////////////////////////
$ctg = $_GET['ctg'];


///////////////[POST 호출]////////////////////
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$mphone_1 = $_POST['mphone_1'];
$mphone_2 = $_POST['mphone_2'];
$mphone_3 = $_POST['mphone_3'];
$job = $_POST['job'];
$blood_type = $_POST['blood_type'];
$zip = $_POST['sc_zip'];
$addr_1 = $_POST['sc_addr_1'];
$addr_2 = $_POST['sc_addr_2'];
$pw = $_POST['pw'];


$file01 = $_FILES['file01']['name'];

include '../lib/connect.php';
$connect = dbconn();


//이메일 타당성 검사
if ($email && !preg_match("(^[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+)*@[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*$)", $email)) {
    error("이메일주소가 잘못되었습니다.");
}

if (!$pw) Error('개인정보 보호를 위해 비밀번호를 입력하세요.');


$query = "select * from member where user_id='$user_id' ";
mysqli_query($connect, "set names utf8");
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);


// 폼에서 작성했던 내용을 암호화로 변경
$result = mysqli_query($connect, "select password('$pw')");
$pws = mysqli_fetch_row($result);
$pw = $pws[0];


// DB에 비밀번호와 작성했던 비밀번호 대조
if ($data[pw]) {
    if ($data[pw] != $pw) Error('현재 비밀번호가 같지 않습니다.');
}


/////////////////////// (file01 아래를 실행)///////////////////
/////////////////[[[[이미지 업로드 실행]]]]/////////////////
/////////// 확장자 검사 //////////////////////////////////////
///////////////////////////////////////////////////////////////
if ($file01) {

    $file01 = $_FILES['file01'];//업로드된파일
    $img_ext = array('jpg', 'jpge', 'jpeg', 'gif', 'png');//파일확장자 종류
    $file01_name = strtolower($file01['name']);
    $file01_split = explode(".", $file01_name);
    $file01_type = $file01_split[count($file01_split) - 1];//맨마지막 .위치에 있는 것이 확장자명

//파일 확장자 체크
    if (array_search($file01_type, $img_ext) === false) {  //이미지파일이 아닙니다
        Error('이미지 파일이 아닙니다');
    }
//////////////////아래는 허용되는 확장자 일때  //////////////////


/////////////////////////////[이미지 용량 제한]////////////////////////////////
    $size_1 = $_FILES['file01']['size'];
    if ($size_1 > 524288) Error('파일용량: 512kb로 사이즈를 제한합니다. ');
////////////////////////////////////////////////////////////////////////////////  


////////////////////  1번 파일 삭제 루틴 //////////////////
    // 파일삭제루틴
    $del_file = "../dataset/member/" . $data[file01];
    if ($data[file01] && is_file($del_file)) unlink($del_file);


    // //// 파일 삭제 선택시  이미지 삭제//////////
    if ($file01_del) {
        $del_file = "../dataset/member/" . $data[file01];
        if ($data[file01] && is_file($del_file)) unlink($del_file);
    }


//////////////1번파일 업로드///////////////////
    $dir = "../dataset/member/";  // 업로드폴더 지정
    $times = time();
    $dates = date("mdh_i", $times);
    if ($_FILES['file01']['tmp_name']) {   // 임시파일이 있다면..

        $extvalue = explode(".", $_FILES['file01']['name']);   // . 을 기준으로 분리
        $extexplode = count($extvalue) - 1;  // 확장자배열값
        $ext_result = $extvalue[$extexplode];  // 확장자 변수로 지정
        $newnamefile = chr(rand(97, 122)) . chr(rand(97, 122)) . $dates . rand(1, 9) . rand(1, 9) . "." . $ext_result;  // 새 파일명 생성
        move_uploaded_file($_FILES['file01']['tmp_name'], $dir . $newnamefile);   // 업로드
        chmod($dir . $newnamefile, 0777);  // 업로드된 파일 퍼미션 변경
    }


//////////////////////////////////////////////////////////////
//echo "파일명 : " .$newnamefile ."<br><br><br>";
//echo "MIME : " .$_FILES['file01']['type'] ."<br>";
//echo "파일 크기 : " .$_FILES['file01']['size'] ."<br>";
//echo "임시 파일 : " .$_FILES['file01']['tmp_name'] ."<br>";
//echo "에러코드 : " .$_FILES['file01']['error'] ."<br>";
///////////////////////////////////////////////////////////////

    $file01_newnamefile = $newnamefile;

    if ($file01) {
        $query_1 = "update member set
               $temp
               file01='$file01_newnamefile'
               where user_id='$user_id' ";
        mysqli_query($connect, "SET NAMES utf8");
        mysqli_query($connect, $query_1);
    }


}   //////file01 있으면 실행 끝//////////

//////////////////////////////////////////////////////////////////	
////////////////[[이미지 업드로이드 끝]]//////////////////////
//////////////////////////////////////////////////////////////////

if (!$blood_type) {
    $blood_type = $data[blood_type];
}


$query_2 = "update member set
               $temp
			    nickname='$nickname',
                email='$email',
				tel='$tel',
				mphone_1='$mphone_1',
				mphone_2='$mphone_2',
				mphone_3='$mphone_3',
				mphone_for='$mphone_for',
				zip='$zip',
				addr_1='$addr_1',
				addr_2='$addr_2',
				addr_for='$addr_for',
				job='$job',
				blood_type='$blood_type'
				where user_id='$user_id' ";
mysqli_query($connect, "SET NAMES utf8");
mysqli_query($connect, $query_2);

?>


<script>
    window.alert(decodeURIComponent("<?=$data[name]?>회원정보가 수정 되었습니다."));

    location.href = './my_page_view.php?user_id=<?=$data[user_id]?>';
</script>
