<?php
// 설정
define('__ROOT__', dirname(dirname(__FILE__)));

include(__ROOT__ . "/lib/dbconfig.php");
include(__ROOT__ . "/lib/utill.php");


session_start();
//error_reporting(0);

//필터작업 (XSS 방어)
$title = $db->real_escape_string($_POST['title']);
$title = scriptExclusion($title);
//$teg = $db->real_escape_string($_POST['teg']);
//$teg = scriptExclusion($teg);
$content = $db->real_escape_string($_POST['content']);
$content = scriptExclusion($content);


//////////////////////////////이미지 파일 업로드 설정 ///////////////////////////////////
// 위치
$uploads_dir = '../upload';     // ../ upload 경로를 변수 uploads_dir에 넣어준다.
$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');  // 이미지 확장자 명을 배열에 넣어준다

// 변수 정리
$error = $_FILES['myfile']['error']; //
$name = $_FILES['myfile']['name'];

$file_code = 0;

if ($name != null) {
    $ext = array_pop(explode('.', $name));
    // 오류 확인
    $file_code = 1;
    if ($error != UPLOAD_ERR_OK) {
        switch ($error) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "파일이 너무 큽니다. ($error)";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "파일이 없습니다. ($error)";
                break;
            default:
                echo "파일이 제대로 업로드되지 않았습니다. ($error)";
                exit;
        }
        exit;
    }
}

if ($file_code == 1) {
    // 확장자 확인
    if (!in_array($ext, $allowed_ext)) {
        echo "허용되지 않는 확장자입니다.";
        exit;
    }

    //동일파일명 이슈 동시 해결
    $name = md5(time() . $name);
    //확장자 통합
    $file_name = $name . "." . $ext;
    // 파일 이동
    move_uploaded_file($_FILES['myfile']['tmp_name'], "$uploads_dir/$file_name");
} else {
    $file_name = null;
}


////////////////////////////////////////////////////////////////////////////////////////

$teg = "자유";
$category = '자유게시판';

//ID가 비여있으면 날려버림
if (is_null($_SESSION['user_name'])) {
    echo("<script>location.replace('../board.php');</script>");
    exit;
}

$id = $_SESSION['user_name'];


$sql = 'insert into board (category, teg, id, title, content, DATE, file_name) values("' . $category . '", "' . $teg . '", "' . $id . '", "' . $title . '", "' . $content . '", SYSDATE() , "' . $file_name . '")';
$result = $db->query($sql);

echo("<script>location.replace('../board.php');</script>");


?>