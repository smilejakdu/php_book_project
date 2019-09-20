<!DOCTYPE html>
<html>
<head>
<style>
   .custom_ul {
   list-style: none;
   padding: 0px;
   }

   .custom_ul > li {
   margin-bottom: 3px;
   border: 1px solid black;
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script>
$(document).ready(function() {

// li 부분을 클릭했을 경우 
$("#testUl").on("click","li",function(){
   alert($(this).text());
   alert("안녕하세요.");
});


// 추가 버튼을 눌렀을 경우
$("#addbtn").on("click", function() {
  $("#testUl").append("<li>(추가된것)클릭해보세요!</li>")
});

});
</script>
</head>

<body>
  <div>
    <ul id="testUl" class="custom_ul">
      <li>클릭해보세요!</li>
      <li>클릭해보세요!</li>
    </ul>
  </div>

  <button id="addbtn"> 추가 </button>

</body>

</html>