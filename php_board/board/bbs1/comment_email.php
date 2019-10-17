<? 

/////////////////[[[이메일 안내]]]/////////////////;
  //코맨트 답 글 이메일 안내,,,,,,,,,,,,,,,,,,,,,,,;
if($r_replys_no=='0'){ $s_text="코멘트"; }
if($r_replys_no>=1){ $s_text="코멘트 답"; }

  //[메일 제목]//
 $email_title = $name."님".$s_text."글을 확인하세요.";  //메일 제목

  //[보내는이 정보]//
 $from_name =$c_o["site_name"];  //보내는이 이름  
 $from_email=$c_o["server_mail"]; //발송 메일주소 (서버메일) 
 /*
 발송 메일주소는 이메일은 사용하는 서버메일을 기본으로 발송이 된다.
 보내는 메일을 서버메일이 아닌 다른 메일을 사용하는 경우 스팸으로 의심을 받을 수 있다.
 */


if(preg_match("/a02|a03/",$ctgs)){ 
	 $logo="image/xeronote.jpg";
}
if(preg_match("/ra02|ra03/",$ctgs)){ 
 $logo="store/image/xeronote.jpg";
}


$email_content ="<style type='text/css'>
                .box_1{border:1px solid #E3E0BB;}
				.box_2{border:1px solid #E3E0BB;}
                 </style>";

$email_content .= "<table border='0'  width='80%' height='120' align='center' bgcolor='#FFFFFF'>
                    <tr>
                    <td width='100%' height='10' align='center'>
                    <img src='http://$_SERVER[HTTP_HOST]/$logo'>
                    </td>";  

$email_content .= "<tr>
                   <td width='100%' height='10' align='center'>
				   <hr size='0.1' width='90%' color='#d5d6d7' />
				   </td>";


$email_content .= "<tr>
                   <td width='100%' align='center' class='box_1'>
                    '<strong>$name</strong>'님의 코맨트:$memo
                   </td>";

$email_content .= "<tr>
                   <td width='100%' height='10'>&nbsp;</td>";

$email_content .= "<tr>
                   <td width='100%' height='25' align='center' bgcolor='#EEEEEE' class='box_2'>
                     <a href='http://$_SERVER[HTTP_HOST]/board/bbs1/view.php?b_ID=$b_ID&ctg=$ctg&ctgs=$ctgs' target='_blank'><strong>[작성글 보기]</strong></a>
                   </td>";

$email_content .=  "</tr></table>";
//메일 내용 (끝)


$email_title = "=?UTF-8?B?".base64_encode($email_title)."?=";  //문자열을 base64_encode 처리
$from_name = "=?UTF-8?B?".base64_encode($from_name)."?="; //문자열을 base64_encode 처리
$to_name = "=?UTF-8?B?".base64_encode($to_name)."?=";  //문자열을 base64_encode 처리

 $headers = "Return-Path: <".$from_email.">\n";
 $headers .= "From: ".$from_name." <".$from_email.">\n";
 $headers .= "X-Sender: <".$from_email.">\n";
 $headers .= "X-Mailer: PHP\n";
 $headers .= "Reply-To: ".$from_name." <".$from_email.">\n";
 $headers .= "MIME-Version: 1.0\n";
 $headers .= "Content-Type: text/html;charset=utf-8\n";
$mails = @mail("$to_name <$to_email>",$email_title,$email_content,$headers);

////////////////// //서버메일이 없으면 외부 이메일사용  ////////////////////
if(!$mails){  /// mail서버가 없다면 외부 메일 보내기 코드로 이동
$from_email2="pjws0321@gmail.com";

require_once("../../Mailer/class.phpmailer.php"); //JM밴드와 스토어,비둘기TV 각각경로 다름(주의)
$mail = new PHPMailer(true); 
$mail->IsSMTP();
$mail-> CharSet="utf-8";     //언어셋 설정
$mail-> Encoding="base64"; //인코딩설정
$mail->Host = "smtp.gmail.com"; // (SMTP서버)email 보낼때 사용할 서버를 지정
$mail->SMTPAuth = true; // SMTP 인증을 사용함 true / false
$mail->SMTPDebug = 0;
$mail->Port = 465; // email 보낼때 사용할 포트를 지정//465(SSL)//   587(tls)
$mail->SMTPSecure = "ssl"; // SSL인 경우 465 /587인경우 tls 를 사용
$mail->Username = "pjws0321@gmail.com"; // 계정
$mail->Password = "dwqsrtqgjkadjlie"; // 패스워드 // 패스워드 (구글인경우 구글웹 비밀번호를 입력!) / dwqsrtqgjkadjlie
$mail->SetFrom($from_email2, $from_name); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
$mail->AddAddress($to_email, $to_name); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
$mail->Subject = $email_title; // 메일 제목
$mail->Body = $email_content; // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)
$mail->IsHTML(true); //HTML사용 여부
/////////////*PHP확장이 php_openssl.dll)설치가 안된경우 메일보내기가 안됨*////////////
 $mail->Send();
 
 if(!$mails and !$mail){
     echo "메일 전송에 실패 하였습니다.\n\n" ;    
	 }

  } //if(!$mails) 닫기!! //
 //////외부 이메일사용 (여기까지)  ////////
///////////////////////////////////  메일보내기 (끝)  //////////////////////////////////////////////

?>
