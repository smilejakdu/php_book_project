<?php
include_once("db_config.php");
$perPage = 5;
$sql = "SELECT * FROM developers";
$result = mysqli_query($conn, $sql);
$totalRecords = mysqli_num_rows($result);
echo "totalRecords : " . $totalRecords . "<br>";
echo "gettype(totalRecords) : " . gettype($totalRecords) . "<br>";
$totalPages = ceil($totalRecords / $perPage);
echo "totalPages : " . $totalPages;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="./js/pagination.js"></script>
    <title>mysql php pagination</title>
</head>
<script>
    $(document).ready(function(){
        var totalPage = parseInt($('#totalPages').val());
        alert(totalPage);
        var pag = $('#pagination').simplePaginator({
            totalPages: totalPage,
            maxButtonsVisible: 5,
            currentPage: 1,
            nextLabel: 'Next',
            prevLabel: 'Prev',
            firstLabel: 'First',
            lastLabel: 'Last',
            clickCurrentPage: true,
            pageChange: function(page) {
                $.ajax({
                    url:"load_data.php",
                    method:"POST",
                    dataType: "json",
                    data:{page:	page},
                    success:function(responseData){
                        $('#content').html(responseData.html);
                    }
                });
            }
        });
    });
</script>
<body>
<div class="container">
    <div class="row">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Skills</th>
                <th>Designation</th>
            </tr>
            </thead>
            <tbody id="content">
            </tbody>
        </table>
        <div id="pagination"></div>
        <input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">
    </div>
</div>

</body>
</html>