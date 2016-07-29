<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Diabetes Outcomes';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="box box-success box-solid">
    
    <div class="box-header">
                <h4><?php echo 'ผู้ป่วยโรคเบาหวานที่ควบคุมน้ำตาลไม่ได้'. '&nbsp;&nbsp;หน่วยบริการ  :'.'&nbsp;&nbsp;'.Yii::$app->user->identity->profile->office_id; ?></h4>
    </div> 
    <div class="container-fluid">
    <div class="box-body">
        <div class='row'>

             <H4 style="text-align: center">
                 <?php // echo 'ปี พ.ศ.   '.$year_id;?>  
              
                <?php //echo 'อายุระหว่าง   :'.$agestart.'-'.$agestop.'  ปี';?>  
                 
            </H4>
           
        </div>
        
        <div class="row">
           <?php
                if (isset($dataProvider)){
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
                        'responsive' => TRUE,
                       // 'hover' => true,
                        //'containerOptions' => ['style' => 'overflow: auto'],
                        'panel' => [

                            'before' => '', //IMPORTANT
                        ],
                        'beforeHeader' => [
                            [
                                'columns' => [
                                    ['content' => 'ผู้ป่วยโรคเบาหวานที่ควบคุมน้ำตาลไม่ได้ หรือไม่ได้ตรวจติดตาม', 'options' => ['colspan' => 12
                                            , 'class' => 'text-center default']],
                                ],
                            // 'options'=>['class'=>'skip-export'] // remove this row from export
                            ]
                        ],

                        //  'floatHeader' => true,
                        // 'layout'=>"\n{pager}",
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'HN_HMAIN',
                                'label' => 'HN (รพ.พช.)'
                            ],
                            [
                                'attribute' => 'CID',
                                'label' => 'เลขประจำตัว ปชช.'
                            ],
//                            [
//                                'attribute' => 'NAME',
//                                'label' => 'ชื่อ'
//                            ],
//                            [
//                                'attribute' => 'LNAME',
//                                'label' => 'สกุล'
//                            ],
                            
                            [ // รวมคอลัมน์
                              'label'=>'ชื่อ-นามสกุล',
                              'format'=>'html',
                              'value'=>function($model, $key, $index, $column){
                                return $model['NAME'].'&nbsp;&nbsp;&nbsp;'.$model['LNAME'];
                              }
                            ],
                            [
                                'attribute' => 'SEX',
                                'label' => 'เพศ'
                            ],
                            [
                                'attribute' => 'BIRTH',
                                'label' => 'วันเกิด'
                            ],
                                                        
                            [
                                'attribute' => 'AGE',
                                'label' => 'อายุ (ปี)'
                            ],
                            [ // รวมคอลัมน์
                              'label'=>'ที่อยู่',
                              'format'=>'raw',
                              'value'=>function($data){
                                return $data['HOUSE'].' '.'หมู่ '.$data['VILLAGE_ID'];
                              }
                            ],
//                            [
//                                'attribute' => 'HOUSE',
//                                'label' => 'บ้านเลขที่'
//                            ],
//                            [
//                                'attribute' => 'VILLAGE_ID',
//                                'label' => 'หมู่บ้าน'
//                            ],
                            [
                                'attribute' => 'A1C_LAST',
                                'label' => 'HbA1C'
                            ],
                            [ // รวมคอลัมน์
                              'label'=>'FPG ล่าสุด 2 ครั้ง',
                              'format'=>'raw',
                              'value'=>function($data){
                                return $data['FPG_LAST'].'-'.$data['FPG_BEFORELAST'];
                              }
                            ],                          
                            [ // รวมคอลัมน์
                              'label'=>'DTX ล่าสุด 2 ครั้ง',
                              'format'=>'raw',
                              'value'=>function($data){
                                return $data['DTX_LAST'].'-'.$data['DTX_BEFORELAST'];
                              }
                            ],   
                            
                        ]
                    ]);
                }
            ?>     
        </div> <!-- // Gridview  -->
        </div> <!-- // body -->
</div><!-- // container -->
</div>
   
     
