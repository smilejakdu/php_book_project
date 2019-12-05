<div class="content">
    <?php
        session_start();
        if(!isset($_SESSION['auth'])) {
            readfile("basic.txt");
            echo "
            <script type='text/javascript'>
            document.getElementById('default_focus').placeholder = '권한이 없습니다. 로그인해 주세요.';
            </script>";
        }
        else {
            show_memo_list();
            echo "
            <script type='text/javascript'>
            document.getElementById('default_focus').placeholder = '로그인 되었습니다.';
            </script>";
        }
    ?>
</div>

<?php
function show_memo_list() {
    $dir = "./";
    echo '<li><h5>작성된 메모 리스트</h5></li>';
    if(file_exists($dir)) {
        if($dh = opendir($dir)) {
            while(($file = readdir($dh)) !== false) {
                if(( $file !== '.well-known' && strpos($file,'-'))) {
                    $files[] = $file;
                }
            }
            closedir($dh);
            natsort($files);
            foreach($files as $file) {
                $fr = fopen("$file/memo.txt", "r");
                $text = fread($fr, filesize("$file/memo.txt"));
                $text = strip_tags($text);
                $descript = mb_substr($text, 0, 20);
                echo "<li><p><a href='".$dir.$file."/'>".$file."</a> : $descript...</p></li>";
            }
        }
    } else {
        echo "<p>ERROR / 제작자에게 <a href=\"mailto:im@baejino.com\">문의</a>하세요.</p>";
    }
}
?>