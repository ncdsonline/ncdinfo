<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeVisitlab */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel panel-danger">
    <div class="panel-heading">
            <h4>แก้ไขข้อมูลสิ่งส่งตรวจของผู้ป่วย</h4>
    </div>  
    <div class="panel-body">
        <div class="container">
            <div class="row col-md-11">
                <table class="table table-striped" id="someid">
                    <tr>
                        <td>ชื่อ-สกุล  :</td>
                        <td><?php echo $person->NAME.' - '.$person->LNAME;?></td>
                    </tr>
                    <tr>
                        <td>อายุ (ปี) :</td>
                        <td><?php echo $person->AGE;?></td>
                    </tr>
                    <tr>
                        <td>ที่อยู่ :</td>
                        <td><?php echo 'บ้านเลขที่   >   '.$person->HOUSE .'  หมู่ที่      >'.$person->VILLAGE_ID.'  บ้าน    >'.$person->MOOBAN;?></td>
                    </tr>
                    <tr>
                        <td>โรคเรื้อรัง :</td>
                        <td><?php echo $person->DM_DX.$person->HT_DX ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
  
</div>


<div class="panel panel-success">

    <div class="panel-body">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'BLOOD')->radioList(array(1=>'มี','0'=>'ไม่มี')); ?>
   
    <?= $form->field($model, 'URINE')->radioList(array(1=>'มี','0'=>'ไม่มี')); ?>
       
   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
       
</div>
