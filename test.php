<?php
include "./lib/dbconfig.php";
include "./commons/head.php";
error_reporting(E_ALL);
ini_set("display_errors", 1);

// 페이지 값을  구함
$searchText = "";
$subString = "";
$searchColumn = "";
$paging = "";

//서브게시판 및 메뉴 리스트 나오도록하는 변수
$side = "";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
//    페이지값이 없으면 1로 초기화
    $page = 1;
}
$sql = "select count(*) as cnt from user";
$result = $db->query($sql);
$row = $result->fetch_assoc();

$allData = $row['cnt']; //전체 게시글의 수

if (empty($allData)) {
    $emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
} else {
    $onePage = 3; // 한 페이지에 보여줄 게시글 수
    $allPage = ceil($allData / $onePage); //전체 페이지의 수
    echo "전체 페이지의 수 : $allPage";

    if ($page < 1 && $page > $allPage) {
        ?>
        <script>
            alert("존재하지 않는 페이지입니다.");
            history.back();
        </script>
        <?php
        exit;
    }

    $oneSection = 3;// 한번에 보여줄 총 페이지의 개수
    $currentSection = ceil($page / $oneSection); //현재 섹션
    $allSection = ceil($allPage / $oneSection); // 전체 섹션의 수

    $firstPage = ($currentSection * $oneSection) - ($oneSection - 1);//현재 섹션의 처음 페이지

    if ($currentSection == $allSection) {
        $lastPage = $allPage; // 현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
    } else {
        $lastPage = $currentSection * $oneSection; // 현재 섹션의 마지막 페이지
    }

    $prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
    $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

    $paging = '<ul class="pagination" style="justify-content: center;">'; // 페이징을 저장할 변수


    //첫 페이지가 아니라면 처음 버튼을 생성
    if ($page != 1) {
//        &laquo; 로 해서 << 로 표시해도 되지만 , 알아보기 쉽게 처음 으로 설정
        $paging .= '<li class="page-item"><a class="page-link" href="./test.php?page=1' . $subString . '">처음</a></li>';
    } else if ($page == 1) {
        $paging .= '<li class="page-item" style="color:#3a5bd8;"><a class="page-link">처음</a></li>';
    }
    //첫 섹션이 아니라면 이전 버튼을 생성
    if ($currentSection != 1) {
        $paging .= '<li class="page-item"><a class="page-link" href="./test.php?page=' . $prevPage . $subString . '">이전</a></li>';
    } else if ($currentSection == 1) {
        $paging .= '<li class="page-item" style="color: #3a5bd8;"><a class="page-link">이전</a></li>';
    }

    for ($i = $firstPage; $i <= $lastPage; $i++) {
        if ($i == $page) {
            $paging .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $paging .= '<li class="page-item"><a class="page-link" href="./test.php?page=' . $i . $subString . '">' . $i . '</a></li>';
        }
    }

    //마지막 섹션이 아니라면 다음 버튼을 생성
    if ($currentSection != $allSection) {
        $paging .= '<li class="page-item"><a class="page-link" href="./test.php?page=' . $nextPage . $subString . '">다음</a></li>';
    } elseif ($currentSection == $allSection) {
        $paging .= '<li class="page-item" style="color: #3a5bd8;"><a class="page-link">다음</a></li>';
    }

    //마지막 페이지가 아니라면 끝 버튼을 생성
    if ($page != $allPage) {
//        &raquo;로 해도 되지만 끝이라고 알아볼수 있게 설정
        $paging .= '<li class="page-item"><a class="page-link" href="./test.php?page=' . $allPage . $subString . '">끝</a></li>';
    } else if ($page == $allPage) {
        $paging .= '<li class="page-item" style="color: #3a5bd8; "><a class="page-link">끝</a></li>';
    }
    $paging .= '</ul>';

    /* 페이징 끝 */
    $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
    $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

    $sql = "select * from user" . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
    $result = $db->query($sql);
}
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>list_page</title>
</head>
<style>
    table {
        font-size: 10px;
    }
</style>
<body>
<h3>리스트</h3>
<table class="table">
    <tr>
        <td>username</td>
        <td>name</td>
        <td>nickname</td>
    </tr>
    <tbody>
    <?php
    if (isset($emptyData)) {
        echo $emptyData;
    } else {
//        여기로는 들어온다.
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <?php
                if (isset($row['nickname'])) {
                    ?>
                    <td><?php echo $row['nickname'] ?></td>
                    <?php
                } else {
                    ?>
                    <td>별명이없어요</td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
<hr>
<?php echo $paging ?>
</body>
</html>
