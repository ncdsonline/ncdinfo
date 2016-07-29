<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;

$this->title = 'Diabetes Screening';
$this->params['breadcrumbs'][] = $this->title;

//yii\helpers\VarDumper::dump($dataProvider);
//exit();

?>
<br>
<div class="box box-success box-solid">
    
    <div class="box-header">
                <h4><?php echo 'ผลคัดกรองโรคเบาหวาน'.' &nbsp; &nbsp;'.'ปีงบประมาณ'.' &nbsp; &nbsp;'.$year_id.' &nbsp;อายุตั้งแต่ &nbsp;'.$agestart.' &nbsp;ถึง &nbsp;'.$agestop;?></h4>
    </div> 
    <div class="container-fluid">
<!--       <div class='row box-success'>
            <H3 style="text-align: center">อัตราความชุกโรคเบาหวาน</H3>
           
        </div>-->

    <div class="box-body">
        
        <div class="row">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'form-search',
                            'method' => 'get',
                ]);
                ?>       
                    <div class="col-lg-3">
                     
                                <?php echo $form->field($model, 'year_id')->dropDownList([
                                    '2559' => 'ปีงบประมาณ 2559',
                                    '2558' => 'ปีงบประมาณ 2558',
                                   // '2557' => 'ปี พ.ศ. 2557',
                                    ],['prompt' => '--เลือกปี งบประมาณ --'])->label(false); 
                                ?>              
                    </div>   
                    <div class="col-lg-3"> 
                                <?= $form->field($model, 'agestart')->textInput(array('placeholder' => 'อายุตั้งแต่(ปี)'))->label(false) ?>
                    </div>
                    <div class="col-lg-3"> 
                        <?= $form->field($model, 'agestop')->textInput(array('placeholder' => 'ถึงอายุ(ปี)'))->label(false) ?>
                    </div>
                    <div class="col-lg-3"> 
                       <div class="form-group">
                            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            <?= Html::a('เริ่มใหม่',['index'],['class'=>'btn btn-danger'])?>

                       </div>
                   </div>

                <?php ActiveForm::end(); ?>
        </div> 
        
        
        
        
        
        <div class='row'>
         
            <?php
                if (isset($dataProvider)){
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'] ,
                        'responsive' => TRUE,
                       // 'hover' => true,
                        //'containerOptions' => ['style' => 'overflow: auto'],
                        'panel' => [

                            'before' => '', //IMPORTANT
                        ],
                        'beforeHeader' => [
                            [
                                'columns' => [
                                    ['content' => 'ผลการคัดกรองโรคเบาหวาน', 'options' => ['colspan' => 12
                                            , 'class' => 'text-center default']],
                                ],
                            // 'options'=>['class'=>'skip-export'] // remove this row from export
                            ]
                        ],

                        //  'floatHeader' => true,
                        // 'layout'=>"\n{pager}",
                        'columns' => [
//                            [
//
//                                'attribute' => 'HOSPCODE',
//                                'label' => 'รหัสหน่วยบริการ',
////                                'format' => 'raw',
////                                'value' => function ($data ) 
////                                 use ($persontable,$year_id,$maininscl,$sex,$agestart,$agestop,$enddate) 
////                                {
////                                    return Html::a(Html::encode($data['HOSPCODE']), 
////                                            ['dm/list'
////                                                
////                                                ,'hospcode'=>$data['HOSPCODE'],
//////                                                'persontable'=> $persontable,
//////                                                'year_id'=>$year_id,
////                                                'maininscl'=>$maininscl,
////                                                'sex'=>$sex,
////                                                'agestart'=> $agestart,
////                                                'agestop'=> $agestop,
////                                                'enddate'=>$enddate,
////                                            ]);
////                                },
//
//                            ],
                            [
                                'attribute' => 'HOSPNAME',
                                'label' => 'หน่วยบริการ'
                            ],
                            [
                                'attribute' => 'TARGET',
                                'label' => 'เป้าหมาย'
                            ],
                            [
                                'attribute' => 'RESULT',
                                'label' => 'ผลงาน'
                            ],
                            [
                                'attribute' => 'RATE',
                                'label' => 'ร้อยละ'
                            ],
                            [
                                'attribute' => 'LEVEL1',
                               // 'label' => 'BP < 120/80 mmHg'
                                'label' => 'ปกติ',
                                'format' => 'raw',
                                'value' => function ($data) { 
                                        return "<span class=\"badge\" style=\"color:#000000 ; background-color:#FFFFFF\">".$data['LEVEL1']."</span>";
                                }
                            ],

                            [
                                'attribute' => 'LEVEL2',
                               //  'label' => 'BS 100-125'
                                'label' => 'เสี่ยง',
                                'format' => 'raw',
                                'value' => function ($data) { 
                                        return "<span class=\"badge\" style=\"color: #000000; background-color:#3fff00\">".$data['LEVEL2']."</span>";
                                }
                            ],
                            [
                                 'attribute' => 'LEVEL3',
                                //  'label' => ' BS >125'
                                 'label' => 'สงสัยป่วย',
                                 'format' => 'raw',
                                 'value' => function ($data) { 
                                         return "<span class=\"badge\" style=\"color: #000000;background-color:#00FFFF\">".$data['LEVEL3']."</span>";
                                 }
                             ],
                            [
                                'attribute' => 'MISSED',
                                'label' => 'MISSED'
                            ],


                        ]
                    ]);
                }
            ?>
            </div> <!-- // Gridview  -->
        </div> <!-- // body -->
    </div> <!-- // container -->
</div>
   
        <?php // echo $sql.'<br>';?>
