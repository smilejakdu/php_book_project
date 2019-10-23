<?php

//list에서 넘어올때 게시판 코드도 같이 포함해서 전송함
if ($_GET['list'] == 1) {
    $title = "notice";
} else {
    $title = "community";
}
include $_SERVER["DOCUMENT_ROOT"] . "/commons/head.php";

$No = $_GET['no'];

//조회수를 넣어줍니다.
if (!empty($No) && empty($_COOKIE['board_' . $No])) {
    $sql = 'update board set hit = hit + 1 where no = ' . $No;
    $result = $db->query($sql);
    if (empty($result)) {
        ?>
        <script>
            alert('오류가 발생했습니다.');
            history.back();
        </script>
        <?php
    } else {
        setcookie('board_' . $No, TRUE, time() + (60 * 60 * 24), '/');
    }
}

//게시글 조회 쿼리
$sql = 'select * from board where no = ' . $No;
$sql = $sql . " and del_yn = 'N'";
$textdata = mysqli_query($db, $sql);
$text = mysqli_fetch_assoc($textdata);
//결과없으면 방어코드 작동
if (empty($text)) {
    echo "<script>alert('삭제된 게시글입니다.'); history.back();</script>";
    exit;
}


//게시글 작성 유저 조회 쿼리문
$sql = "SELECT * FROM USER WHERE username = '" . $text['id'] . "'";
$board_user = mysqli_query($db, $sql);
$user = mysqli_fetch_assoc($board_user);

?>
<style>
    .button_hover:hover {
        background-color: #0c5460;
    }
</style>

<!-- 중간 콘텐츠 시작 -->
<div class="container" style="padding-top:1em;">
    <h4><?= $text['category'] ?></h4>
    <hr>
    <div class="card" style="margin-bottom: 10px;">
        <div class="card-body">
            <h4><b>제목 : </b><?php echo $text['title'] ?></h4>
            <div class="text-right">
                <b>작성자 : </b><?php echo $text['id'] ?><br>
                <b>조회수 : </b> <?php echo $text['hit'] ?><br>
                <b>작성일 : </b> <?php echo $text['date'] ?>
            </div>

            <hr>
            <b>첨부파일 :&nbsp;</b>
            <?php
            if ($text['file_name'] != null) {
                ?>
                <img src="./uploads/<?= $text['file_name'] ?>" alt="이미지">
            <?php } ?>

            <p style="white-space: pre-line;">
                <?php echo $text['content'] ?>
            </p>
        </div>
    </div>

    <div class="text-right" style="padding-bottom: 20px;">

        <?php
        if ($text['category'] == '공지사항') {
            $list_url = "./notice.php";
        } else if ($text['category'] == '자유게시판') {
            $list_url = "./board.php";
        }
        ?>
        <a href="<?= $list_url ?>" class="btn btn-primary" style="border-radius : 0.5em;">목록</a>

        <?php
        if ($text['id'] == $_SESSION['user_name'] || $_SESSION['gm'] == '2') { //관리자에서는 모두 삭제가 가능함.
            ?>
            <!-- 실제 글쓴이 & 관리자만 수정 삭제 표시 나오도록 구성 -->
            <button type="button" class="btn btn-warning" style="border-radius : 0.5em;" onclick="formset();">수정
            </button>
            <a class="btn btn-danger" style="border-radius : 0.5em;" href="#"
               onclick="delete_list('<?= $text['no'] ?>');">삭제</a>
            <?php
        }
        ?>
    </div>

    <hr>
    <!-- 댓글 영역 -->
    <?php

    $sql = "select count(*) as cnt from comment where del_yn = 'n'"; //정상적인 댓글 리스트를 전부 가져오는 쿼리문
    $sql = $sql . " and boardid = '" . $No . "'";
    $result = mysqli_query($db, $sql);
    $comment_cnt = mysqli_fetch_assoc($result);

    $allPost = $comment_cnt['cnt']; //전체 댓글수

    if (empty($allPost)) {
        $emptyData = '댓글이 아직 등록되지 않았습니다.';
    } else {
        $emptyData = '<b>댓글놀이~~~~~~~~~</b>';
        $sql = "select * from comment where del_yn = 'n' ";
        $sql = $sql . " and boardid = '" . $No . "' ORDER BY depthid ASC , NO ASC";
        $result = $db->query($sql);
    }

    ?>
    <h5>댓글</h5>

    <div class="card" style="margin-bottom: 30px; ">
        <div class="card-body">
            <textarea id="comment" style="height: 57px; width: 1000px; resize: none;"
                      onkeydown="if(event.keyCode==13) comment_insert();"></textarea>
            <button type="button" class="btn btn-primary"
                    style="margin-left: 5px; border-radius: 0.5em; margin-top: -50px; width: 100px; height: 60px;"
                    onclick="comment_insert();">등록하기
            </button>
        </div>

        <div class="card-body">
            <?php
            //if(isset($emptyData)) {
            ?>
            <div class="alert alert-light comment" style="margin-top: 5px;" role="alert">
                <b>[ 댓글돌이 ]</b>
            </div>
            <div>
                <?= $emptyData; ?>
            </div>

            <?php //} else {
            $count2 = 0;
            while ($row_comment = mysqli_fetch_assoc($result)) {
                $datetime = explode(' ', $row_comment['date']);
                $date = $datetime[0];
                $time = $datetime[1];
                $count2 = $count2 + 1;
                if ($date == Date('Y-m-d'))
                    $row_comment['date'] = $time;
                else
                    $row_comment['date'] = $date;
                ?>
                <!-- 뎁스와 no 값이 동일하면 대댓글이 아님에 따라 처리하지 않음 -->
                <?php if ($row_comment['depthid'] == $row_comment['no']) { ?>
                    <div class="alert alert-light comment" role="alert">
                        <b><?php echo $row_comment['id'] ?></b> <!-- 닉네임 부분 -->
                        <span style="float: right;"><?php echo $row_comment['date'] ?> <!-- 날짜 부분 -->
                            <?php if ($row_comment['id'] == $_SESSION['user_name'] || $_SESSION['gm'] == '2') { ?> <!--자신이 작성한 글이거나 권한 레벨이 2라면 삭제 권한을 준다 -->
                                / <a class="button_hover"
                                     onclick="comment_model('<?= $count2 ?>', '<?= $row_comment['no'] ?>');">수정f</a> / <a
                                        onclick="comment_delete('<?= $row_comment['no'] ?>');">삭제f</a> / <a
                                        onclick="comment_model2('<?= $row_comment['no'] ?>');"> 대댓글f</a>
                            <?php } else { ?>
                                <a onclick="comment_model2('<?= $row_comment['no'] ?>');"> / 대댓글</a>
                            <?php } ?>
						</span>
                    </div>

                    <div>
                        <?php echo $row_comment['comment'] ?>
                        <input type="hidden" id="comment_update<?= $count2 ?>" value="<?= $row_comment['comment'] ?>">
                    </div>


                <?php } else { ?>  <!-- 대댓글이면 -->
                    <div style="margin-left: 30px;">
                        <div class="alert alert-light comment" role="alert">
                            <b><?php echo $row_comment['id'] ?></b>
                            <span style="float: right;"><?php echo $row_comment['date'] ?>
                                <?php if ($row_comment['id'] == $_SESSION['user_name'] || $_SESSION['gm'] == '2') { ?>
                                    /
                                    <a onclick="comment_model('<?= $count2 ?>', '<?= $row_comment['no'] ?>');">수정s</a> /
                                    <a onclick="comment_delete('<?= $row_comment['no'] ?>');">삭제s</a>
                                <?php } ?> <!--두번째 댑스에서는 대댓글 사용 금지-->
						</span>
                        </div>

                        <div>
                            <?php echo $row_comment['comment'] ?>
                            <input type="hidden" id="comment_update<?= $count2 ?>"
                                   value="<?= $row_comment['comment'] ?>">
                        </div>
                    </div>

                <?php } ?>


            <?php } ?>
        </div>
    </div>
</div>
<!--중간 콘텐츠 끝-->

<!-- 댓글 수정용 모달 시작 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">댓글 수정하기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="comment_text">
                <input type="hidden" id="comment_no" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
                <button type="button" class="btn btn-primary" onclick="comment_update();">수정</button>
            </div>
        </div>
    </div>
</div>
<!-- 댓글 수정용 모달 끝 -->


<!-- 댓글 등록용 모달 시작 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">대댓글 달기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="comment_text2">
                <input type="hidden" id="comment_no2" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">취소</button>
                <button type="button" class="btn btn-primary" onclick="comment_insert2();">등록</button>
            </div>
        </div>
    </div>
</div>
<!-- 댓글 등록용 모달 끝 -->


<!-- 수정시 전송데이터 -->
<form enctype='multipart/form-data' action='./<?php if ($_GET['list'] == 1) {
    echo "notice_up.php";
} else {
    echo "write_up.php";
} ?>' method='post' id="board_form">
    <input type="hidden" id="no" name="no" value="<?php echo $text['no'] ?>">
</form>


<!-- 콘텐츠 수정시 시작-->
<script>

    function comment_model(data, no) {
        $('#exampleModal').modal('show');
        $('#comment_text').val($('#comment_update' + data).val());
        $('#comment_no').val(no);

    }

    function comment_model2(no) {
        $('#exampleModal2').modal('show');
        $('#comment_no2').val(no);

    }


    function formset() {
        $("#board_form").submit();
    }

    //게시글 삭제
    function delete_list(no) {
        $.ajax({
            url: './board/write_del.php',
            type: 'post',
            dataType: 'json',
            data: {'no': no}, //no 데이터만 태워서 del로 전달
            success: function (data) {
                if (data.code == '200') {
                    alert('정상적으로 삭제되었습니다.');
                    //location.reload();
                    location.replace('../board.php'); //삭제후 보드로 이동

                } else {
                    alert('정상적으로 처리되지 못했습니다.');
                }
            },
            error: function (err) {
                alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
            }
        });
    }

    //코멘트(댓글)삭제
    function comment_delete(no) {
        $.ajax({
            url: './board/comment_del.php',
            type: 'post',
            dataType: 'json',
            data: {'no': no},
            success: function (data) {
                if (data.code == '200') {
                    alert('정상적으로 처리되었습니다.');
                    location.reload();
                } else {
                    alert('정상적으로 처리되지 못했습니다.');
                }
            },
            error: function (err) {
                alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
            }
        });

    }

    //댓글 신규 등록
    function comment_insert() {
        $.ajax({
            url: './board/comment_insert.php',
            type: 'post',
            dataType: 'json',
            data: {'no': <?=$No?>, 'comment': $('#comment').val(), 'depth': "0"},
            success: function (data) {
                if (data.code == '200') {
                    alert('정상적으로 등록되었습니다.');
                    location.reload();
                } else {
                    alert('정상적으로 처리되지 못했습니다.');
                }
            },
            error: function (err) {
                alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
            }
        });

    }

    //대댓글 등록 하기
    function comment_insert2() {
        $.ajax({
            url: './board/comment_insert.php',
            type: 'post',
            dataType: 'json',
            data: {'no': <?=$No?>, 'comment': $('#comment_text2').val(), 'depth': $('#comment_no2').val()},
            success: function (data) {
                if (data.code == '200') {
                    alert('정상적으로 등록되었습니다.');
                    location.reload();
                } else {
                    alert('정상적으로 처리되지 못했습니다.');
                }
            },
            error: function (err) {
                alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
            }
        });

    }

    //댓글 업데이트는 공통으로 사용함 (no값만 있으면 됌.)
    function comment_update() {
        $.ajax({
            url: './board/comment_upload.php',
            type: 'post',
            dataType: 'json',
            data: {'no': $('#comment_no').val(), 'comment': $('#comment_text').val()},
            success: function (data) {
                if (data.code == '200') {
                    alert('정상적으로 수정되었습니다.');
                    location.reload();
                } else {
                    alert('정상적으로 처리되지 못했습니다.');
                }
            },
            error: function (err) {
                alert('정상적으로 처리되지 못했습니다. 관리자에게 문의해주세요.');
            }
        });

    }


</script>
<!-- 콘텐츠 수정시 끝-->

<?php
include "commons/footer.php";
?>
