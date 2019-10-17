<? header("content-type:text/html; charset=UTF-8");
session_start();
ob_start();

///////////////////////////////////////////
$user_id = $_SESSION['user_id'];
//////////////////////////////////////
$groups = $_POST['groups'];
$ctg = $_POST['ctg'];
$ctgs = $_POST['ctgs'];
$comment_no = $_POST['comment_no'];  //코멘트 NO
$memo = addslashes($_POST['memo']); // 홑/쌍따옴표,역슬래시를 허용
$name = $_POST['name'];
$nickname = $_POST['nickname'];
$b_ID = $_POST['b_ID'];  // 게시판글 ID
$r_replys_no = $_POST['r_replys_no']; //답글 번호
$r_replys_w = $_POST['r_replys_w']; //답글 사용여부
//////////////////////////////////////////////////////////////
$body_content = $_POST['body_content'];   //코맨트 본문
$to_mID = $_POST['to_mID'];           //메세지 받는 회원번호
$to_user_id = $_POST['to_user_id'];  //메세지 받는 사람 아이디
$to_name = $_POST['to_name'];        //메세지 받는 사람 이름
$to_nickname = $_POST['to_nickname']; //메세지 받는 사람 닉네임
/////////////////////////////////////////////////////////////////


include '../../lib/connect.php';
$connect = dbconn();
$member = member_info();
$c_o = co_info(); //회사정보 


//로그인후 사용;
if (!$member['user_id']) Error(' 로그인후 이용하세요');
if (!$memo) Error('내용을 입력하세요');
if (!$b_ID) Error('접근이 잘못되었습니다.');

$regdate = date("Ymd", time()); //날짜
$regdate_time = date("His", time());  //시간


if (!$r_replys_w == "yes") {
    $r_replys_no = '0';  /*답글이 아닌경우*/
}


// 버퍼/ 딜레이 되면서 글이 두번 등록된것을 방지 하기 위해 코맨트 no를 비교한다. //
$query7 = "select comment_no from bbs1_comments where comment_no='$comment_no' ";
mysqli_query($connect, "SET NAMES utf8");
$result7 = mysqli_query($connect, $query7);
$com_no = mysqli_fetch_array($result7);

IF ($comment_no != $com_no['comment_no']) {  // 같은글 중북 방지 ( 앞에서 보낸 글이 서버에 존재 하지 않다면....)


////////////답글이 달린경우 메세지 보내기////////////
    if ($r_replys_w == "yes" and $r_replys_no >= '1') {
// 메세지 보내기//
        $from_user_id = $member['user_id'];
        $from_user_id = $member['user_id'];
        $from_name = $member['name'];
        $content = $memo;
        $bbs = "1";  //bbs '1'이면 일반/웹진형 게시판, '2'면 상품판매형 게시판


        $query_2 = "insert into message(bbs, to_mID, to_user_id, to_name, to_nickname, 
                                                       content, from_user_id, from_name, from_nickname, regdate, regdate_time)
                       values('$bbs','$member[to_mID]','$to_user_id','$to_name','$to_nickname',
					               '$content','$user_id','$name','$nickname','$regdate','$regdate_time')";
        mysqli_query($connect, "SET NAMES utf8");
        mysqli_query($connect, $query_2);
    }
/////////답글이 달린경우 메세지 보내기 여기까지///////// 


    $query = "insert into bbs1_comments(groups, ctg, ctgs, name, mID, user_id, nickname, memo, b_ID, r_replys_no, regdate, regdate_time, comment_no)
                  values('$groups','$ctg','$ctgs','$name','$member[mID]','$user_id','$nickname','$memo','$b_ID','$r_replys_no','$regdate','$regdate_time','$comment_no'
				  ) ";
    mysqli_query($connect, $query);

    $query = "update bbs1 set comments=comments+1 where b_ID='$b_ID' ";
    mysqli_query($connect, $query);


    /********************************************************************************************
     * ///////////////////////////////// //코맨트/답글 이메일 보내기 ///////////////////////////////
     * ////////////////////////////////////////////////////////////////////////////////
     * -쿼리문 조건 설명 (코맨트 이메일 보내기)-
     * 1. 코맨트 를 올린 사람의 내용이 게시글 올린 사람에게 이메일을 가도록 한다.
     * 2. 코맨트나 답글을 작성한 사람은 현재작성자 외 이미 작성을 한 사람에게 이메일이 가도록 한다.
     * &&& 풀이가 조금 어렵다 & 그래서 겨우 힘들게 구성했다.
     *********************************************************************************************/

///////////  게시판 해당 글 //////////////
    $query1 = "select * from bbs1 where b_ID='$b_ID' ";
    mysqli_query($connect, "SET NAMES utf8");
    $result1 = mysqli_query($connect, $query1);
    $u_id = mysqli_fetch_array($result1);


////////////////////////////////////////////////////////////
// $u_id['user_id']  :  게시글을 올린사람
// $to_user_id  댓글을 쓴사람
// $user_id  // 답글이나 댓글을 쓸사람

    if ($u_id['user_id'] != $user_id) {  //내 게시글에 내가 코멘트를 작성할 경우가 아닌것

////  댓글또는 답글을 달았을때 게시글 게시자는 댓글 게시자에게 메일이 간다.///
        if ($user_id = $to_user_id and $to_user_id != $u_id['user_id']) { // 댓글쓴 사람과 내가 서로 같지 않으면
            $ff01 = $u_id['user_id'] . "|" . $to_user_id;
            $exp = explode("|", $ff01);
            for ($i = 0; $i < count($exp); $i++) {
                $query6 = "select * from member where user_id='$exp[$i]' ";
                mysqli_query($connect, "SET NAMES utf8");
                $result6 = mysqli_query($connect, $query6);
                $ffs = mysqli_fetch_array($result6);
                $to_name = $ffs['name'];  //받을 이메일 받을 사용자
                $to_email = $ffs['email'];  //받을 이메일
                include('./comment_email.php');  ////// 이메일 보내기

            }  //for문 닫기!!

        } else {  //      댓글 쓴 사람 또는 내 댓글에 답글을 남겼을시  게시글자에게만 메일을 보낸다.
            $to_name = $u_id['name'];  //받을 이메일 받을 사용자
            $to_email = $u_id['email'];  //받을 이메일
            include('./comment_email.php');  ////// 이메일 보내기
        }
    }
///////////////////////////////////////////////////////////////////


    /*********************************************************************************************************
     * //////////////////////////////////// 코맨트/답글 이메일 보내기 (여기까지) ////////////////////////////////
     **********************************************************************************************************/

}  //같은글 중북 방지 if문 닫기 
?>

<script>
    window.alert(decodeURIComponent("댓글이 등록되었습니다."));
    location.href = 'view.php?b_ID=<?=$b_ID?>&ctg=<?=$ctg?>&ctgs=<?=$ctgs?>&lo_reply_1=#lo_reply_1';
</script>
