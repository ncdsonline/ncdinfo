<?php
// yii\helpers\VarDumper::dump($result,10,true);
$data = $result;
use app\models\Chospital;


?>
<style>
/* p {
   width: 300px;
   border: 1px solid black;
 
   line-height: 300%;
 }*/
/*.tr {
    background-color: #333;
    float: left;
    font-size: 18px;
    height: 93px;
    line-height: 60px;
    padding-left: 20px;
    width: 190px;
}*/



</style>
<table border="0" width="100%">
    <?php
    $i=0;
    $max=count($result);
    foreach ($result as $item){
        if($item['SEX']==1){
              $gender='เด็กชาย';
        }else{
               $gender='เด็กหญิง';
        }
       if($i==0){
          echo '<tr>';
       }
       if($i<$max and $i>0 ){
          echo '</tr>';
          echo '<tr>'; 

          
       }
        ?>
    
        <td>
            <table width="100%" border="0" margin="0" style="border:1px solid black;padding:10px;">
                
                <tr>
                    <td > 
                        <p><?php // echo $i;?></p>
                         <p>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>
                      
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เรียน&nbsp;&nbsp;ผู้ปกครองของ'.$gender.'&nbsp;&nbsp;'.$item['NAME'].'&nbsp; &nbsp;'. $item['LNAME'].'&nbsp; &nbsp;อายุ &nbsp;&nbsp;'.$item['AGEMONTH'].'&nbsp; &nbsp;เดือน &nbsp;&nbsp;บ้านเลขที่&nbsp;'. $item['HOUSE'] .'&nbsp; &nbsp;หมู่ที่ &nbsp;'. $item['VILLAGE']
?></p>
                        <hr>     
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;ขณะนี้  บุตรหลานของท่านยังไม่ได้รับวัคซีนป้องกันโรคหัด และหัดเยอรมัน' ?></p>
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;เพื่อปกป้องคุ้มครองบุตรหลานของท่านไม่ให้ต้องป่วยด้วยโรคที่สามารถป้องกันได้ด้วยวัคซีน' ?></p>
                        <br>
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;'.Yii::$app->user->identity->profile->chospital->fullname.'จึงขอให้ท่านนำบุตรหลานไปขอรับวัคซีนได้ที่โรงพยาบาลส่งเสริมสุขภาพตำบล';?></p>
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;ในวันที่....................................'.' &nbsp;เวลา....................น. '?></p>
                     

                        <br>
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;ด้วยความปรารถนาดีจาก';?></p>
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;'.Yii::$app->user->identity->profile->chospital->fullname;?></p>
                        <p>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>
                       
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*** หากมีข้อสงสัย  สามารถติดต่อสอบถามได้ที่ โทร.'.Yii::$app->user->identity->profile->chospital->tel;?></p>
						
						
                       
                        <p><?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;***  หากบุตรหลานของท่านได้รับวัคซีนแล้ว  ขอความกรุณานำสมุดสีชมพูมาแสดงต่อหมอครอบครัว  หรือ อสม.'?></p>
						<p>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </td>
                </tr>

            </table>
        </td>
        <?php

        if($i==$max){
            echo '</tr>';
        }
        $i++;
    }
    ?>
</table>