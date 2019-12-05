<div class="content" id="co">
    <?php
        session_start();
        if(!isset($_SESSION['auth'])) {
            echo "<script>document.location.href='../';</script>";
        }
        else {
            readfile("memo.txt");
            echo "
            <script type='text/javascript'>
            document.getElementById('default_focus').placeholder = '메모 입력 후 엔터!';
            </script>";

            $fr = fopen("../assets/config.ini", "r");
            $config = fread($fr, filesize("../assets/config.ini"));
            if($config == 1) {
                echo "<script>window.scrollTo(0,screen.height+9999);</script>";
            }
        }
    ?>
</div>