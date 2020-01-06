<?php
include "./commons/head.php";
?>
<style>
    body{
        background-image:url('../kakao.png');
    }
    .div {
        width: 50%;
        border: 1px solid #000;
        margin-left:auto;
        margin-right:auto;
    }
    .div_left {
        width: 30%;
        height:850px;
        float: left;
        box-sizing: border-box;
        background: #000;
    }
    .div_right {
        width: 70%;
        height:850px;
        float: right;
        box-sizing: border-box;
        background:white;
    }
    img {
        display:block;
        margin:0px auto;
    }
    .button_style{
        background:white;
        color:black;
        border:2px solid black;
        padding-right:200px;
        padding-left:200px;
        padding-top:5px;
        padding-bottom:5px;
        border-radius:50px;
        text-align:center;
        font-size:20px;
        margin-top:30px;
    }
    .hc { width:200px; left:0; right:0; margin-left:auto; margin-right:auto; } /* 가로 중앙 정렬 */ 
    .vc { height:40px; top: 0; bottom:0; margin-top:auto; margin-bottom:auto; } /* 세로 중앙 정렬 */

</style>

<body>
    <div class="div" style="margin-top:50px; margin-bottom:50px;">
        <div class="div_left">
            <img src="me.jpg" style="width:200px; height:200px; border-radius:50%; margin-top:30px; margin-bottom:30px;">
            <h3 style="font-weight:bold; text-align:center; color:white;">안승현</h3>
            <h3 style="text-align:center; margin-bottom:30px; color:white;">android php python</h3>

            <hr style="border:1px dashed white; width:200px; margin-left:auto; margin-right:auto;">

            <img src="location.jpg" style="width:70px; height:70px; border-radius:50%; margin-top:30px; margin-bottom:30px;">
            <p style="color:white; text-align:center;">서울시 동작구 사당동 에 살아요</p>
            <img src="phone.png" style="width:70px; height:70px; border-radius:50%; margin-top:30px; margin-bottom:30px;">
            <p style="color:white; text-align:center;"> 010-5671-3767</p>
            <img src="email.jpg" style="width:70px; height:70px; border-radius:50%; margin-top:30px; margin-bottom:30px;">
            <p style="color:white; text-align:center;"> ash982416@gmail.com</p>
        </div>

        <div class="div_right">
            <h1 style="text-align:center; margin-top:30px; font-size:50px;">an seung hyun</h1>
                <center>
                    <button class="button_style">프로필</button>
                </center>
                <center>
                <table style="margin-top:30px; width=40px;">
                    <tr>
                        <th style="font-size:20px;" width="40%">php</th>
                        <th style="font-size:20px;" width="45%">android</th>
                        <th style="font-size:20px;" width="40%">python</th>
                    </tr>
                </table>
                <p style="width:450px; margin-top:30px;">android 로 취업을 했지만, 회사에 업무를 맡으면서 
                php 를 접하게 됬고 , python 크롤링을 접하게 됬습니다.
                하나를 알게되면 , 다른것을 배울때 그래도 어렵겠지만 많은 도움이 된다는
                매력을 느꼈습니다.</p>
                </center>
                <br>
                <center>
                    <button class="button_style">일 경험</button>
                </center>
                <center>
                <table style="width:450px; margin-top:30px;">
                    <tr>
                        <td class="text-warning" style="font-size:13px;">2019.6.1 입사~2019.7</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:15px;">첫번째 업무</td>
                    </tr>
                    <tr>
                        <td>안드로이드로 입사해서 , xml 을 작성했습니다.</td>
                    </tr>
                </table>
                </center>

                <center>
                <table style="width:450px; margin-top:30px;">
                    <tr>
                        <td class="text-warning" style="font-size:13px;">2019.7 입사~2019.8</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:15px;">두번째 업무</td>
                    </tr>
                    <tr>
                        <td>크롤링 업무를 맡았습니다. 처음에는 php로 크롤링을 했는데,
                            제가 부족한 탓에 어려웠습니다. 그래서 python 으로 크롤링하게되었고,
                            python 에 매력을 느꼈습니다.
                        </td>
                    </tr>
                </table>
                </center>

                <center>
                <table style="width:450px; margin-top:30px; margin-bottom:30px;">
                    <tr>
                        <td class="text-warning" style="font-size:13px;">2019.8 입사~2019.11</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:15px;">세번째 업무</td>
                    </tr>
                    <tr>
                        <td>안드로이드 개발과 php 개발 같이했습니다. php 로는 크롤링 한것을 뿌려주기위한 
                            웹사이트를 만들었고 , 안드로이드는 상품에 대한 검색하는 안드로이드를 만들었습니다.
                        </td>
                    </tr>
                </table>
                </center>
        </div>
    </div>
    </body>
</html>