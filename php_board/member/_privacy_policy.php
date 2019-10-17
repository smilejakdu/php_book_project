<script type="text/javascript">
    function privercy_tap2(kk) {
        var tap = document.getElementById('new_privercy_tap2');
        var pcontent = document.getElementById('new_privercy_content2');
        for (var i = 0; i < tap.children.length; i++) {
            tap.children[i].className = '';
            pcontent.children[i].style.display = 'none';
            if (i == parseInt(kk)) {
                tap.children[i].className = 'sel';
                pcontent.children[i].style.display = '';
            }
            if (i == 2) tap.children[i].className += ' end';
        }
    }
</script>

<style type="text/css">
    .ft_bb1 {
        font-family: 굴림, 돋움;
        font-size: 11pt;
        color: #5B5959;
        font-weight: bold;
    }

    .ft_bb2 {
        font-family: 굴림, 돋움;
        font-size: 10pt;
        color: #5B5959;
    }

    .ft_bb3 {
        font-family: 굴림, 돋움;
        font-size: 9pt;
        color: #5B5959;
    }
</style>

<?
$terms = $_GET[terms];  //이용약간  & 개인정보취급 방침


if (!$terms and $ctg == "members") {  //회원가입페이지에서 보기!!
    ?>
    <table border='0' width='95%' height='100%' bgcolor='D2D2D2' align='center' cellspacing='0' cellpadding='0'>
        <tr>
            <td width='95%' height='30' align='center'><h3><strong>개인정보 취급방침</strong></h3></td>

        <tr>
            <td width='95%' height='50'>
                <div class="privercy-contract-tap">
                    <ul id="new_privercy_tap2">
                        <a href="#none" onClick="privercy_tap2(0);" class="sel"><font>- 수집하는 개인정보 항목</font></a>
                        &nbsp; &nbsp;
                        <a href="#none" onClick="privercy_tap2(1);">- 개인정보의 수집 이용목적</font></a>
                        <br>
                        <br>
                        <a href="#none" onClick="privercy_tap2(2);" class="end"><font>- 개인정보의 보유 및 이용기간</font></a>
                    </ul>
                </div>
            </td>

        <tr>
            <td width='95%' height='auto' align='center' valign='top'>
                <div class="tab-content" id="new_privercy_content2">
                    <div class="privercy-contract">
		<textarea style="width:95%; height:140px; overlow-x:scroll; background-color:#D2D2D2;" readonly>
              [수집하는 개인정보 항목]
수집하는 개인정보의 항목 및 수집방법
<?= $cinfo[site_name]; ?>은(는) 회원가입, 비회원 구매, 상담, 불량이용의 방지 등을 위해
아래와 같은 개인정보를 수집하고 있습니다.
- 필수항목 : 이름, ID, 비밀번호, 주민등록번호, 이메일, 전화번호, 주소, IP Address, 결제기록
- 선택항목 : 개인맞춤 서비스를 제공하기 위하여 회사가 필요로 하는 정보
</textarea></div>


                    <div class="privercy-contract" style="display: none;">
		<textarea style="width:95%; height:170px; overlow-x:scroll; background-color:#D2D2D2;" readonly>
              [개인정보의 수집 및 이용목적]
<?= $cinfo[site_name]; ?>은(는) 수집한 개인정보를 다음의 목적을 위해 활용합니다.

가. 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산, 콘텐츠 제공, 
구매 및 요금 결제, 물품배송 또는 청구지 등 발송, 금융거래 본인 인증 및 금융서비스
나. 회원 관리
회원제 서비스 이용에 따른 본인확인, 개인 식별, 불량회원의 부정 이용 방지와 
비인가 사용 방지, 가입 의사 확인, 연령확인, 불만처리 등 민원처리, 고지사항 전달
다. 마케팅 및 광고에 활용
이벤트 등 광고성 정보 전달, 접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계
</textarea></div>

                    <div class="privercy-contract" style="display: none;">
		<textarea style="width:95%; height:260px; overlow-x:scroll; background-color:#D2D2D2;" readonly>
           [개인정보의 보유 및 이용기간]
<?= $cinfo[site_name]; ?>은(는) 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당
정보를 지체 없이 파기합니다. 단, 상법 및 “전자상거래등에서의 소비자보호에
관한 법률” 등 관련 법령의 규정에 의하여 다음과 같이 거래 관련 관리 의무 관
계의 확인 등을 이유로 일정기간 보유하여야 할 필요가 있을 경우에는 일정기
간 보유합니다.

- 계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호
    에 관한 법률)

- 대금결제 및 재화 등의 공급에 관한 기록 : 5년 (전자상거래등에서의 소비자보
    호에 관한 법률)

- 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보
    호에 관한 법률)

- 설문조사, 이벤트 등 일시적 목적을 위하여 수집한 경우 : 당해 설문조사, 
   이벤트 등의 종료 시점

- 본인확인에 관한 기록 : 6개월(정보통신망 이용촉진 및 정보보호 등에 관한 법률)

- 방문(로그)에 관한 기록 : 3개월(통신비밀보호법)
</textarea></div>
                </div>

            </td>
        </tr>
    </table>

<? } else if ($terms == "privacy_policy") {   //개인정보취급방침 페이지에서 보기!!?>
    <font class='ft_bb1'>개인정보 취급방침</font>
    <p>&nbsp;</p><br>
    <font class='ft_bb2'> [수집하는 개인정보 항목] </font>
    <br><br>
    <font class='ft_bb3'>
        수집하는 개인정보의 항목 및 수집방법<br>
        <?= $cinfo[site_name]; ?>은(는) 회원가입, 비회원 구매, 상담, 불량이용의 방지 등을 위해 <br>
        아래와 같은 개인정보를 수집하고 있습니다.<br>
        - 필수항목 : 이름, ID, 비밀번호, 주민등록번호, 이메일, 전화번호, 주소, IP Address, 결제기록<br>
        - 선택항목 : 개인맞춤 서비스를 제공하기 위하여 회사가 필요로 하는 정보<br>
    </font>
    <br><br><br>
    <font class='ft_bb2'>[개인정보의 수집 및 이용목적]</font>
    <br><br>
    <font class='ft_bb3'>
        <?= $cinfo[site_name]; ?>은(는) 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br>

        가. 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산, 콘텐츠 제공, <br>
        구매 및 요금 결제, 물품배송 또는 청구지 등 발송, 금융거래 본인 인증 및 금융서비스<br>
        나. 회원 관리<br>
        회원제 서비스 이용에 따른 본인확인, 개인 식별, 불량회원의 부정 이용 방지와 <br>
        비인가 사용 방지, 가입 의사 확인, 연령확인, 불만처리 등 민원처리, 고지사항 전달<br>
        다. 마케팅 및 광고에 활용<br>
        이벤트 등 광고성 정보 전달, 접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계<br>
    </font>
    <br><br><br>
    <font class='ft_bb2'>[개인정보의 보유 및 이용기간]</font>
    <br><br>
    <font class='ft_bb3'>
        <?= $cinfo[site_name]; ?>은(는) 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 <br>
        파기합니다. 단, 상법 및 “전자상거래등에서의 소비자보호에 관한 법률” 등 관련 <br>
        법령의 규정에 의하여 다음과 같이 거래 관련 관리 의무 관계의 확인 등을 이유로 <br>
        일정기간 보유하여야 할 필요가 있을 경우에는 일정기간 보유합니다.<br>
        - 계약 또는 청약철회 등에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)<br>
        - 대금결제 및 재화 등의 공급에 관한 기록 : 5년 (전자상거래등에서의 소비자보호에 관한 법률)<br>
        - 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 (전자상거래등에서의 소비자보호에 관한 법률)<br>
        - 설문조사, 이벤트 등 일시적 목적을 위하여 수집한 경우 : 당해 설문조사, 이벤트 등의 종료 시점<br>
        - 본인확인에 관한 기록 : 6개월(정보통신망 이용촉진 및 정보보호 등에 관한 법률)<br>
        - 방문(로그)에 관한 기록 : 3개월(통신비밀보호법)<br>
    </font>
<? } ?>