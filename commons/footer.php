<style>
    .footer {
        position: relative;
        bottom: 10px;
        height: 200px;
    }

    .nav li {
        display: inline-block;
        font-size: 20px;
        padding: 20px;
    }

</style>
<script>
    function move_naver() {
        window.location.href = "https://www.naver.com";
    }

    function move_google() {
        window.location.href = "https://www.google.com";
    }
</script>
<div style="text-align: center; border-radius:20px;" class="footer bg-warning">
    <button style="margin-top: 20px;" type="button" class="btn btn-dark" onclick="move_naver()">한국인은 네이버!!</button>&nbsp;
    <button style="margin-top: 20px;" type="button" class="btn btn-dark" onclick="move_google()">개발은 구글!!</button>
    <dt style="margin-top: 10px">안승현 토이프로젝트</dt>
</div>

</body>
</html>