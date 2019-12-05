<?php 
    $fr = fopen("../assets/config.ini", "r");
    $config = fread($fr, filesize("../assets/config.ini"));
    if($config == 1) {
        echo "<script>window.scrollTo(0,screen.height+9999);</script>";
    }
?>
<script src="//code.jquery.com/jquery.min.js"></script>
<script>
function runWrite() {
    $.ajax({
        url: "write.php",
        type: "post",
        data: "memo="+$('input[name=memo]').val()+"&source="+$('textarea[name=source]').val(),
    }).done(function(data) {
        document.getElementById('co').innerHTML = data;
		$('textarea[name=source]').val('');
        window.scrollTo(0,screen.height+9999);
    });
}
function Enter_Check() {
    if(event.keyCode == 13){
        runWrite();
        document.getElementById('default_focus').value = "";
    }
}
</script>