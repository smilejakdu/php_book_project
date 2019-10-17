<?php
header("content-type:text/html; charset=UTF-8");

//쩡원의 PHP' *Eamil: pjws0321@gmail.com / pjws0321@naver.com *
$dir = "../../dataset/bbs1/";    // 'home/board/data' 저장된 파일 위치
$tmp_dir = "./temp/";  // 'home/board/temp' 다운로드 할 임시폴더 (필수필요 / 없으면 폴더를 생성하세요)

$filename = $_GET['file2'];  // 넘겨받은 파일명
$file_name = $_GET['file2_name'];  // 넘겨받은 본래 파일명
copy($dir . $filename, $tmp_dir . $filename) or die("복사실패");
Header("Content-Type: text.plain");
Header("Content-Disposition: attachment; filename=" . iconv('utf-8', 'euc-kr', $filename)); //서버있는 파일명
Header("Content-Disposition: attachment; filename= " . iconv('utf-8', 'euc-kr', $file_name));    //다운로 할 파일명

Header("Content-Transfer-Encoding: binary");
Header("Content-Length: " . (string)(filesize($tmp_dir . $filename)));
Header("Cache-Control: cache, must-revalidate");
Header("Pragma: no-cache");
Header("Expires: 0");

$fp = fopen($tmp_dir . $filename, "rb");  //rb 읽기전용 바이러니 타입

while (!feof($fp)) {
    echo fread($fp, 1048576 * 2);   //전송
}

fclose($fp);
unlink($tmp_dir . $filename) or die("삭제실패");
flush();  //출력 버퍼비우기 
?>
