<?php
    session_start();
    if(!isset($_SESSION['auth'])) {
	    echo "<script type='text/javascript'>alert('로그인이 필요합니다.');</script>";
    }
    else {
        $fr = fopen("assets/config.ini", "r");
        $config = fread($fr, filesize("assets/config.ini"));

        $fw = fopen("assets/config.ini", "w");
        if($config == 1) {
            fwrite($fw, "0");
			echo "<script>alert('메모가 위에서 삽입됩니다.');</script>";
        }
        else {
            fwrite($fw, "1");
			echo "<script>alert('메모가 아래에 삽입됩니다.');</script>";
        }
        fclose($fw);
    }
    echo "<script>document.location.href='./';</script>"; 
?>
