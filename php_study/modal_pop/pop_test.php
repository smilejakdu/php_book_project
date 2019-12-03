<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script>
    function image_click() {
        document.getElementById('까꿍').style.display='block';
    }
    function image_display() {
        document.getElementById('까꿍').style.display='none';
    }
</script>
<body>

<div class="w3-container">
    <br>

    <img src="./background_img.png" style="width:10%;cursor:zoom-in"
         onclick="image_click()">

    <div id="까꿍" class="w3-modal" onclick="image_display()">
        <div class="w3-modal-content w3-animate-zoom">
            <img src="./background_img.png" style="width:100%">
        </div>
    </div>
</div>

</body>
</html>
