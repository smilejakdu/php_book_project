<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .ellipsis-multi {
        width:50px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* 라인수 */
    -webkit-box-orient: vertical;
    word-wrap:break-word; 
    line-height: 1.2em;
    height: 3.6em; /* line-height 가 1.2em 이고 3라인을 자르기 때문에 height는 1.2em * 3 = 3.6em */
    }
</style>
<body>
      <?php
      $today_skt_world=0;
      $today_kt_shop=0;
      $today_lg_db=0;
      $today_sk7_db=0;
      $today_u_plus_shop=0;
      $today_kt_m_mobile=0;
      $today_today_hello_kt=0;
      $today_today_hello_skt=0;
      
        $data_list = array('skt_world' , 'kt_shop' , 'lg_db' , 'sk7_db' , 'u_plus_shop' , 'kt_m_mobile' ,'today_hello_kt' , 'today_hello_skt');
        for ($i=0; $i<count($data_list); $i++){
            echo "today_{$data_list[$i]}<br>" ;            
        }
      ?>
    
</body>
</html>