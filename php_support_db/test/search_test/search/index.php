<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>search 테스트</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet" href="../../../index.css" type="text/css"> -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
 </head>
 <style>
      .search_button {
      border: 1px solid #405ea3;
      background-color: #ffffff;
      width: 200px;
      height: 30px;
      margin: 10px;
      font-size: 16px;
      color: #2471A3;
      font-weight: 500;
      font-size: 15px;
      padding: 3px 16px;
      border-radius: 10px;
      text-align: left;
  }
 </style>
 <body>
  <div class="container">
   <br />
   <h2 align="center">Ajax Live Data Search using Jquery PHP MySql</h2><br/>
   <div class="md-form mt-0">
         <input type="text" name="search_text" id="search_text" class="search_button" placeholder="검색" aria-label="Search" />
    </div>
   <br />
   <div id="result"></div>
  </div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>