<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Registed Hypertension';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="box box-success box-solid">
    
    <div class="box-header">
                <h4>ทะเบียนโรคความดันโลหิตสูง</h4>
    </div> 
    <div class="container-fluid">
    <div class="box-body">
        <div class='row'>
            <H3 style="text-align: center"><?php echo'ทะเบียนโรคความดันโลหิตสูง'.'--ปี พ.ศ. '.($year_id+543)?></H3>
           <H4 style="text-align: center"><?php echo'อายุระหว่าง '.$agestart.'--ถึง--'.$agestop.' ปี'?></H4>
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
                                    '2016' => 'ปี พ.ศ. 2559',
                                    '2015' => 'ปี พ.ศ. 2558',
                                    '2014' => 'ปี พ.ศ. 2557',
                                    '2013' => 'ปี พ.ศ. 2556',
                                    '2012' => 'ปี พ.ศ. 2555',
                                    '2011' => 'ปี พ.ศ. 2554',
                                    '2010' => 'ปี พ.ศ. 2553',
                                    '2009' => 'ปี พ.ศ. 2552',
                                    '2008' => 'ปี พ.ศ. 2551',
                                    '2007' => 'ปี พ.ศ. 2550',
                                   // '2557' => 'ปี พ.ศ. 2557',
                                    ],['prompt' => '--เลือกปี พ.ศ.--'])->label(false); 
                                ?>              
                        </div>                        
                        
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
                                    ['content' => 'สรุปการขึ้นทะเบียนโรคความดันโลหิตสูง', 'options' => ['colspan' => 12
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
                                // use ($persontable,$year_id,$maininscl,$sex,$agestart,$agestop,$enddate) 
                                {
                                    return Html::a(Html::encode($data['HOSPCODE']), 
                                            ['hypertension-registed/all'                                    
                                                ,'hospcode'=>$data['HOSPCODE'],
//                                                'persontable'=> $persontable,
//                                                'year_id'=>$year_id,
//                                                'maininscl'=>$maininscl,
//                                                'sex'=>$sex,
//                                                'agestart'=> $agestart,
//                                                'agestop'=> $agestop,
//                                                'enddate'=>$enddate,
                                            ]);
                                },

                            ],
                            [
                                'attribute' => 'HOSPNAME',
                                'label' => 'หน่วยบริการ'
                            ],
                            [
                                'attribute' => 'TOTAL',
                                'label' => 'ขึ้นทะเบียน'
                            ],
                            [
                                'attribute' => 'ONTREATMENT',
                                'label' => 'ยังรักษาอยู่'
                            ],
                            [
                                'attribute' => 'DISCHARGED',
                                'label' => 'จำหน่าย'
                            ],


                        ]
                    ]);
                }
            ?>
        </div> <!-- // Gridview  -->
        </div> <!-- // body -->
    </div> <!-- // container -->
</div>
   <?php // echo $sql;?>
        <?php // echo $year_id.'<br>'.$enddate.'<br>'.$agestart.'<br>'.$agestop.'<br>';?>
