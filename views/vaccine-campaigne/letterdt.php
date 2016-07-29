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
                      
                        <p><?php echo '&nbsp; &nbsp;เรียน'.'&nbsp; &nbsp;คุณ'. $item['NAME'].'&nbsp; &nbsp;'. $item['LNAME'] .'&nbsp; &nbsp;&nbsp; &nbsp;บ้านเลขที่&nbsp;'. $item['HOUSE'] .'&nbsp; &nbsp;หมู่ที่ &nbsp;'. $item['VILLAGE']?></p>
                        <hr>
                        <p><?php echo '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;เนื่องจาก  ขณะนี้จังหวัดเพชรบูรณ์ยังคงเป็นพื้นที่เสี่ยงต่อโรคที่ป้องกันได้' ?></p>
                        <p><?php echo '&nbsp; &nbsp;ด้วยวัคซีนหลายชนิด  โดยเฉพาะโรคคอตีบ&nbsp; &nbsp;ซึ่งภูมิต้านทานโรคในผู้ใหญ่มีน้อย จนไม่สามารถป้องกันโรคได้' ?></p>
                   
                        <p><?php echo '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;'.Yii::$app->user->identity->profile->chospital->fullname;?></p>
                        <p><?php echo '&nbsp; &nbsp;จึงขอเชิญท่านมารับการฉีดวัคซีนป้องกันโรคคอตีบและบาดทะยัก&nbsp; &nbsp;ในวันที่....................................'.' &nbsp;เวลา................น. '?></p>
                        <p><?php echo '&nbsp;&nbsp; ณ '.'&nbsp;'.Yii::$app->user->identity->profile->chospital->fullname;?></p>

                        <p><?php echo '&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;จึงขอเชิญท่านมารับการตรวจเอ็กเรย์ปอด  ในวันดังกล่าว' ;?></p>
                        <br>
                        <p><?php echo '&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;ด้วยความปรารถนาดีจาก';?></p>
                        <p><?php echo '&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;'.Yii::$app->user->identity->profile->chospital->fullname;?></p>
                        <p>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</p>
                        <p><?php echo '*** ถ้าตั้งครรภ์หรือสงสัยว่ากำลังตั้งครรภ์  กรุณาแจ้งเจ้าหน้าที่' ?></p>
                        <p><?php echo 'หากมีข้อสงสัย  สามารถติดต่อสอบถามได้ที่ โทร.'.Yii::$app->user->identity->profile->chospital->tel;?></p>
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