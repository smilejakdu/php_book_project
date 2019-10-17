<? header("content-type:text/html; charset=UTF-8"); ob_start;



 $from_email = "aaa@gmail.com";  //보내는 사람 이메일
 $from_name = "테스";  //보내는 사람이름

 $to_email = "pjws0321@naver.com"; // 받는 사람 이메일
 $to_name = "$to_name"; //받는사람 이름

 $title = "회원가입을 축하드립니다"; //메일제목



 $content = "<table border='0'  width='80%' height='120' align='center' bgcolor='#EEEEEE'>";  
 $content .= "<tr><td width='100%'>";
 $content .= "'<strong>$to_name</strong>' 님 '쩡원홈피' 회원가입을 축하 드립니다.<br>
                    '<strong>$to_name</strong>'님의 <u>회원 아이디는'<strong>$user_id</strong></u>'입니다.  ";
 $content .= "</td></tr></table>"; 




 //메일러 로딩
require_once("./class.phpmailer.php");

$mail = new PHPMailer(true); 

//한글 깨짐 해결
$mail-> CharSet="utf-8";
$mail-> Encoding="base64";

$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true; // SMTP 인증을 사용함 true / false
$mail->SMTPSecure = "ssl"; // SSL을 사용함
$mail->Host = "smtp.gmail.com"; // email 보낼때 사용할 서버를 지정
$mail->Port = 465; // email 보낼때 사용할 포트를 지정
$mail->IsHTML(true); //HTML사용 여부
$mail->Username = "aaa@gmail.com"; // 계정
$mail->Password = "123456"; // 패스워드
$mail->SetFrom($from_email, $from_name); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
$mail->Subject = $title; // 메일 제목
$mail->Body = $content; // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
$mail->AddAddress($to_email, $to_name); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
//$mail->WordWrap = 0;  //WordWrap기능을 사용여부
 // @mail("$to_name <$to_email>",$title,$content,'From:'.$from_email); // 실제로 메일을 보냄
/////////////*PHP확장이 php_openssl.dll)설치가 안된경우 메일보내기가 안됨*////////////
if(!$mail->Send())
    {
       echo "Message could not be sent. <p>";
       echo "Mailer Error: " . $mail->ErrorInfo;
    }else{

    echo "메일을 전송했습니다.";
	}
?>

