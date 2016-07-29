<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use kartik\widgets\DatePicker;
use kartik\grid\GridView;
use kartik\date\DatePicker;

// echo 'find by birth';
//echo $datestart.'<br>';
//echo $datestop.'<br>';
//echo $yearreport.'<br>';
$this->title = 'Target find by birth ';
$this->params['breadcrumbs'][] = ['label' => 'ค้นหาจากวันเดือนปีเกิด'];
?>
<div class="box box-success box-solid">
        <div class=" box-header">
            <h4>สอบถามจำนวนประชากรจากวันเดือนปีเกิด</h4>
        </div>   

<div class="box-body">
<div class="well">
    <p><H3 style="text-align: center"></H3>
 <p><H4 style="text-align: center"><?php echo '  ปีงบประมาณ  '.$yearreport ;?></H4></p>
</div>
<div class="site-signup">
 

<div class="vaccinefully-search well-sm">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>


    <div class="row">
        <div class="col-lg-3">
            <?php echo $form->field($model, 'yearreport')->dropDownList([
                '2558' => 'ปีงบประมาณ 2558',
                '2559' => 'ปีงบประมาณ 2559', 
                ],['prompt' => '--เลือกปีงบประมาณ--'])->label(false); 
            ?>
        </div>
        <div class="col-lg-3">
            <?php
          
            echo $form->field($model, 'datestart')->widget(DatePicker::classname(), [
                'options' => [
                                'placeholder' => 'วันเดือนปีเกิด'
                ],
                'readonly' => true,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label(false);
            ?>
        </div>

        <div class="col-lg-3">
            <?php
            echo $form->field($model, 'datestop')->widget(DatePicker::classname(), [
                'options' => [
                                'placeholder' => 'วันเดือนปีเกิด'
                ],
                'readonly' => true,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label(false);
            ?>
        </div>
  
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-success']) ?>
                <?php //Html::resetButton('Reset', ['class' => 'btn btn-danger']) ?>
                <?= Html::a('Reset',['index'],['class'=>'btn btn-danger'])?>
               
            </div>
        </div>
    
    </div>


       <?php ActiveForm::end(); ?>
</div>
</div>
<div class="content" >
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
</div>
<?php // echo $sql;?> 
</div>
</div>
    
