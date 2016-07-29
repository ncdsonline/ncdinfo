
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
// use app\models\Coffice;
// use yii\helpers\ArrayHelper;
// use etsoft\widgets\YearSelectbox;

$this->title = 'Target find by age ';
$this->params['breadcrumbs'][] = ['label' => 'ค้นหาจากอายุ'];
//echo $agestart.'<br>';
//echo $agestop.'<br>';
//echo $yearreport.'<br>';
//\yii\helpers\VarDumper::dump($dataProvider);

?>
<div class="box box-success box-solid">
        <div class=" box-header">
            <h4>สอบถามจำนวนประชากรจากการสำรวจ ตามช่วงอายุ</h4>
        </div>   

<div class="box-body">
<div class="well">
    <p><H3 style="text-align: center"></H3>
 <p><H4 style="text-align: center"><?php echo '  ปีงบประมาณ  '.$yearreport ;?></H4></p>
</div>
<div class="site-signup">
    <div class="row">

        <?php
        $form = ActiveForm::begin([
                    'id' => 'form-search',
                    'method' => 'get',
                    'action' => ['target-find-by-age/index']
        ]);
        ?> 
        <div class="col-lg-3"> 
            <?php 
                echo $form->field($model, 'yearreport')->dropDownList([
                 '2558' => 'ปีงบประมาณ 2558',
                 '2559' => 'ปีงบประมาณ 2559', 
                 ],['prompt' => '--เลือกปีงบประมาณ--'])->label(false); 
            ?>
            </div>
        <div class="col-lg-3"> 
<?= $form->field($model, 'agestart')->textInput()->label(false) ?>

        </div>
                <div class="col-lg-3"> 
<?= $form->field($model, 'agestop')->textInput()->label(false) ?>

        </div>

        <div class="col-lg-2"> 
            <div class="form-group">
                <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-success', 'name' => 'find-button']) ?>
                 <?= Html::a('เริ่มใหม่',['index'],['class'=>'btn btn-danger'])?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>


<?php           
 echo GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'] ,
    'columns' => [
        [
             'attribute'=>'HOSPCODE',
                'label'=>'รหัสหน่วยบริการ'
        ],
        [
             'attribute'=>'HOSPNAME',
                'label'=>'หน่วยบริการ'
        ],
        [
             'attribute'=>'MALE',
                'label'=>'ชาย'
        ],
        [
             'attribute'=>'FEMALE',
                'label'=>'หญิง'
        ],
        [
             'attribute'=>'TOTAL',
                'label'=>'รวม'
        ],

    ],
 ]) 
?>
<?php // echo $sql.'<br>';?>
</div>
</div>
    