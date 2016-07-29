
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use kartik\date\DatePicker;
//use kartik\widgets\DatePicker;
// use app\models\Coffice;
// use yii\helpers\ArrayHelper;
// use etsoft\widgets\YearSelectbox;
$this->params['breadcrumbs'][] = ['label' => 'this title of page'];

?>
<br>
<div class="box box-success box-solid">
    
    <div class="box-header">
                <h4>จำนวนผู้ป่วยโรคเรื้อรังรายใหม่</h4>
    </div> 
    <div class="container-fluid">
    <div class="box-body">
        <div class='row'>
            <H3 style="text-align: center">รายงาน.............</H3>
            <H4 style="text-align: center"><?php echo '  ปีงบประมาณ' ?></H4>
        </div>
        <hr>
        <div class="row">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'form-search',
                            'method' => 'get',
                ]);
                ?> 
                    <div class="row">
                        <div class="col-lg-3">
                     
                                <?php echo $form->field($model, 'year_dx')->dropDownList([
                                    '2558' => 'ปี พ.ศ. 2558',
                                    '2559' => 'ปี พ.ศ. 2559', 
                                    ],['prompt' => '--เลือกปี พ.ศ.--'])->label(false); 
                                ?>              
                        </div>
                       
                    </div>
                    <div class='row'>

                            <div class="col-lg-3"> 
                                <?php echo $form->field($model, 'maininscl')->dropDownList([
                                    '0' => 'TOTAL', 
                                    '1' => 'UC',
                                    '2' => 'NON-UC',
                                    '3' => 'NON-UC', 
                                  
                                    ],['prompt' => '--เลือกสิทธิการรักษา--'])->label(false); 
                                ?>
                            </div>
                            <div class="col-lg-3"> 
                                <?php echo $form->field($model, 'sex')->dropDownList([
                                    '0' => 'TOTAL', 
                                    '1' => 'ชาย',
                                    '2' => 'หญิง', 
                                    ],['prompt' => '--เลือกเพศ--'])->label(false); 
                                ?>
                            </div>
                            <div class="col-lg-3"> 
                                <?= $form->field($model, 'agestart')->textInput()->textInput(array('placeholder' => 'อายุตั้งแต่(ปี)'))->label(false) ?>
                            </div>
                            <div class="col-lg-3"> 
                                <?= $form->field($model, 'agestop')->textInput()->textInput(array('placeholder' => 'ถึงอายุ(ปี)'))->label(false) ?>
                            </div>
                    </div>

                    <br>
                    <div class='row'>
                        <div class="col-lg-2"> 
                            <div class="form-group">
                                <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                <?= Html::a('เริ่มใหม่',['index'],['class'=>'btn btn-danger'])?>
                            </div>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
        </div>
        <div class='row'>
            <h1>Gridview</h1>
        </div> <!-- // Gridview  -->
        </div> <!-- // body -->
    </div> <!-- // container -->
</div>
   
        <?php // echo $sql.'<br>';?>
