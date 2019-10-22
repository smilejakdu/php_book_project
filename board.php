<?php
$title = "community";
include "./commons/head.php";

//데이터 초기화
$searchText = "";
$subString = "";
$searchColumn = "";
$paging = "";


//서브게시판 및 메뉴 리스트 나오도록하는 변수
$side = "";
?>

<?php

/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

/* 검색 시작 */

if (isset($_GET['searchColumn'])) {
    $searchColumn = $_GET['searchColumn'];
    $subString .= '&amp;searchColumn=' . $searchColumn;
} else {
    $searchColumn = '';
    $subString = '';
}

if (isset($_GET['searchText'])) {
    $searchText = $_GET['searchText'];
    $subString .= '&amp;searchText=' . $searchText;
}

if (isset($searchColumn) && isset($searchText)) {
    if ($searchColumn == "1") {
        $searchSql = ' and title LIKE "%' . $searchText . '%"';
    } else if ($searchColumn == "2") {
        $searchSql = ' and content LIKE "%' . $searchText . '%"';
    } else {
        $searchSql = ' and id LIKE "%' . $searchText . '%"';
    }
} else {
    $searchSql = '';
}

/* 검색 끝 */

$sql = "select count(*) as cnt from board where category='자유게시판' and del_yn = 'N'" . $searchSql;

$result = $db->query($sql);
$row = $result->fetch_assoc();

$allPost = $row['cnt']; //전체 게시글의 수

if (empty($allPost)) {
    $emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
} else {

    $onePage = 15; // 한 페이지에 보여줄 게시글의 수.
    $allPage = ceil($allPost / $onePage); //전체 페이지의 수

    if ($page < 1 && $page > $allPage) {
        ?>
        <script>
            alert("존재하지 않는 페이지입니다.");
            history.back();
        </script>
        <?php
        exit;
    }

    $oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
    $currentSection = ceil($page / $oneSection); //현재 섹션
    $allSection = ceil($allPage / $oneSection); //전체 섹션의 수

    $firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

    if ($currentSection == $allSection) {
        $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
    } else {
        $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
    }

    $prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
    $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

    $paging = '<ul class="pagination" style="justify-content: center;">'; // 페이징을 저장할 변수

    //첫 페이지가 아니라면 처음 버튼을 생성
    if ($page != 1) {
        $paging .= '<li class="page-item"><a class="page-link" href="./board.php?page=1' . $subString . '">&laquo;</a></li>';
    }
    //첫 섹션이 아니라면 이전 버튼을 생성
    if ($currentSection != 1) {
        $paging .= '<li class="page-item"><a class="page-link" href="./board.php?page=' . $prevPage . $subString . '">이전</a></li>';
    }

    for ($i = $firstPage; $i <= $lastPage; $i++) {
        if ($i == $page) {
            $paging .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $paging .= '<li class="page-item"><a class="page-link" href="./board.php?page=' . $i . $subString . '">' . $i . '</a></li>';
        }
    }

    //마지막 섹션이 아니라면 다음 버튼을 생성
    if ($currentSection != $allSection) {
        $paging .= '<li class="page-item"><a class="page-link" href="./board.php?page=' . $nextPage . $subString . '">다음</a></li>';
    }

    //마지막 페이지가 아니라면 끝 버튼을 생성
    if ($page != $allPage) {
        $paging .= '<li class="page-item"><a class="page-link" href="./board.php?page=' . $allPage . $subString . '">&raquo;</a></li>';
    }
    $paging .= '</ul>';

    /* 페이징 끝 */
    $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
    $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

    $sql = "select * from board where category='자유게시판' and del_yn = 'N' " . $searchSql . " order by no desc" . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
    $result = $db->query($sql);

}
?>


<!-- 중간 콘텐츠 시작 -->
<div class="container" style="padding-top:1em;">
    <div class="row">
        <!-- 메인 콘텐츠 시작 -->
        <div class="col-md-12 mainset">
            <!--검색 기능 추가 작업 진행 -->
            <form id="search_from" action="">
                <div class="card" style="margin-bottom: 10px;">
                    <div class="card-body">

                        <div class="input-group" style="height: 43.5px;">
                            <div class="form-group mx-sm-3">
                                <select class="custom-select" id="searchColumn" name="searchColumn"
                                        style="height: 43.5px;">
                                    <option value="1" <?php if ($searchColumn == "1") {
                                        echo "selected";
                                    } ?>>제목
                                    </option>
                                    <option value="2" <?php if ($searchColumn == "2") {
                                        echo "selected";
                                    } ?>>내용
                                    </option>
                                    <option value="3" <?php if ($searchColumn == "3") {
                                        echo "selected";
                                    } ?>>작성자
                                    </option>
                                </select>
                            </div>

                            <input type="text" class="form-control" style="height: 43px;" id="searchText"
                                   name="searchText" placeholder="통합 검색" aria-label="Search" value="<?= $searchText ?>">
                            <span class="input-group-btn">
							<input type="submit" class="btn btn-warning"
                                   style="border-radius : 0.5em; height: 43px; width:85px; margin-left: 10px;"
                                   value="검색">

							</span>
                        </div>

                    </div>
                </div>
            </form>
            <!-- 검색 기능 종료 -->

            <div class="card" style="margin-bottom: 10px;">
                <div class="card-body">
                    <h4>자유게시판</h4>
                    <table class="table">
                        <colgroup>
                            <col width="10%">
                            <col width="10%">
                            <col width="40%">
                            <col width="15%">
                            <col width="15%">
                        </colgroup>

                        <thead class="thead-light">
                        <tr>
                            <th scope="col">번호</th>
                            <th scope="col">태그</th>
                            <th scope="col">제목</th>
                            <th scope="col">글쓴이</th>
                            <th scope="col">날짜</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if (isset($emptyData)) {
                            echo $emptyData;
                        } else {
                            while ($row = $result->fetch_assoc()) {
                                $datetime = explode(' ', $row['date']);
                                $date = $datetime[0];
                                $time = $datetime[1];
                                if ($date == Date('Y-m-d'))
                                    $row['date'] = $time;
                                else
                                    $row['date'] = $date;
                                ?>
                                <tr>
                                    <td class="no"><?php echo $row['no'] ?></td>
                                    <td class="no"><?php echo $row['teg'] ?></td>
                                    <td class="title">
                                        <a href="./view.php?list=2&no=<?php echo $row['no'] ?>"><?php echo $row['title'] ?></a>
                                    </td>
                                    <td class="author"><?php echo $row['id'] ?></td>
                                    <td class="date"><?php echo $row['date'] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        </tbody>
                    </table>
                    <hr>
                    <?php echo $paging ?>
                </div>
            </div>

            <div class="text-right" style="padding-bottom: 100px;">
                <a href="./write.php" class="btn btn-primary" style="border-radius : 0.5em;">작성</a>
            </div>
        </div>

    </div>
</div>
<!--중간 콘텐츠 끝-->

<?php
include "./commons/footer.php";
?>
