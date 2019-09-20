<?php  
 //filter.php  
 if(isset($_POST["from_date"], $_POST["to_date"]))  
 {  
      $connect = mysqli_connect("localhost", "root", "root", "phone_db");  
      $output = '';  
      $query = "  
           SELECT * FROM sk_db  
           WHERE support_date BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'  
      ";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
           <table class="table table-bordered">  
           <tr>  
                <th width="16%">단말기 명</th>  
                <th width="16%">모델 명</th>  
                <th width="16%">요금제</th>  
                <th width="16%">출고가</th>  
                <th width="16%">공시지원금</th>  
                <th width="16%">공시일자</th>  
            </tr>  
      ';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'. $row["machine_name"] .'</td>  
                          <td>'. $row["model_name"] .'</td>  
                          <td>'. $row["plan_money"] .'</td>  
                          <td>'. $row["shipment_money"] .'</td>  
                          <td>'. $row["disclosure_money"] .'</td>  
                          <td>'. $row["support_date"] .'</td>
                     </tr>  
                ';  
           }  
      }  
      else  
      {  
           $output .= '  
                <tr>  
                     <td colspan="5">찾을 수가 없습니다. </td>  
                </tr>  
           ';  
      }  
      $output .= '</table>';  
      echo $output;  
 }  
 ?>
