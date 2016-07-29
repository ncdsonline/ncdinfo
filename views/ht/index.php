<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Prevalence Hypertension';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="box box-success box-solid">
    
    <div class="box-header">
                <h4>อัตราความชุกโรคความดันโลหิตสูง</h4>
    </div> 
    <div class="container-fluid">
    <div class="box-body">
        <div class='row'>
            <H3 style="text-align: center">อัตราความชุกโรคความดันโลหิตสูง</H3>
           
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
                     
                                <?php echo $form->field($model, 'year_id')->dropDownList([
                                    '2559' => 'ปี พ.ศ. 2559',
                                    '2558' => 'ปี พ.ศ. 2558',
                                   // '2557' => 'ปี พ.ศ. 2557',
                                    ],['prompt' => '--เลือกปี พ.ศ.--'])->label(false); 
                                ?>              
                        </div>                        
                        <div class="col-lg-3"> 
                            <?php echo $form->field($model, 'maininscl')->dropDownList([
                                '0' => 'TOTAL', 
                                '1' => 'UC',
                                '2' => 'NON-UC',
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
                       
                    </div>
                    <div class='row'>

                            <div class="col-lg-3"> 
                                <?= $form->field($model, 'agestart')->textInput()->textInput(array('placeholder' => 'อายุตั้งแต่(ปี)'))->label(false) ?>
                            </div>
                            <div class="col-lg-3"> 
                                <?= $form->field($model, 'agestop')->textInput()->textInput(array('placeholder' => 'ถึงอายุ(ปี)'))->label(false) ?>
                            </div>
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
            <hr>
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
                                    ['content' => 'ความชุกโรคความดันโลหิตสูง', 'options' => ['colspan' => 12
                                            , 'class' => 'text-center default']],
                                ],
                            // 'options'=>['class'=>'skip-export'] // remove this row from export
                            ]
                        ],

                        //  'floatHeader' => true,
                        // 'layout'=>"\n{pager}",
                        'columns' => [
                            [

                                'attribute' => 'HOSPCODE',
                                'label' => 'รหัสหน่วยบริการ',
                                'format' => 'raw',
                                'value' => function ($data ) 
                                 use ($persontable,$year_id,$maininscl,$sex,$agestart,$agestop,$enddate) 
                                {
                                    return Html::a(Html::encode($data['HOSPCODE']), 
                                            ['ht/list'
                                                
                                                ,'hospcode'=>$data['HOSPCODE'],
                                                'persontable'=> $persontable,
                                                'year_id'=>$year_id,
                                                'maininscl'=>$maininscl,
                                                'sex'=>$sex,
                                                'agestart'=> $agestart,
                                                'agestop'=> $agestop,
                                                'enddate'=>$enddate,
                                            ]);
                                },

                            ],
                            [
                                'attribute' => 'HOSPNAME',
                                'label' => 'หน่วยบริการ'
                            ],
                            [
                                'attribute' => 'TARGET',
                                'label' => 'ประชากร'
                            ],
                            [
                                'attribute' => 'HT',
                                'label' => 'HT'
                            ],
                            [
                                'attribute' => 'HTDM',
                                'label' => 'HT&DM'
                            ],
                           [
                                'attribute' => 'HTRATE',
                                'label' => 'ร้อยละ'
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
