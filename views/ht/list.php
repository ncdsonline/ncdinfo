<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\grid\GridView;
use kartik\date\DatePicker;
$this->title = 'Prevalence HT';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="box box-success box-solid">
    
    <div class="box-header">
                <h4><?php echo 'ความชุกโรคความดันโลหิตสูง'. '__หน่วยบริการ  :'.Yii::$app->user->identity->profile->office_id; ?></h4>
    </div> 
    <div class="container-fluid">
    <div class="box-body">
        <div class='row'>
            <H4 style="text-align: center">
                <?php echo 'ความชุกโรคความดันโลหิตสูง'?>
            </H4>
             <H4 style="text-align: center">
                 <?php echo 'ปี พ.ศ.   '.$year_id;?>  
                <?php if($sex==0){ echo 'ทุกเพศ';}elseif($sex==1){echo 'เพศ :ชาย';}else{echo 'เพศ :หญิง';}?>
                 <?php if($maininscl==0){ echo 'ทุกกลุ่มสิทธิ';}elseif($maininscl==1){echo 'สิทธิ : UC';}else{echo 'สิทธิ : NON-UC';}?>
                <?php echo 'อายุระหว่าง   :'.$agestart.'-'.$agestop.'  ปี';?>  
                 
            </H4>
           
        </div>
        <hr>
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
                                    ['content' => 'บัญชีรายชื่อผู้ป่วยโรคความดันโลหิตสูง', 'options' => ['colspan' => 12
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
                            [
                                'attribute' => 'NAME',
                                'label' => 'ชื่อ'
                            ],
                            [
                                'attribute' => 'LNAME',
                                'label' => 'สกุล'
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
                                'attribute' => 'HOUSE',
                                'label' => 'บ้านเลขที่'
                            ],
                            [
                                'attribute' => 'VILLAGE_ID',
                                'label' => 'หมู่บ้าน'
                            ],
                            [
                                'attribute' => 'HT_DATE_DX',
                                'label' => 'วันที่ Dx.HT'
                            ],
                            [
                                'attribute' => 'DM_DATE_DX',
                                'label' => 'วันที่ Dx.DM'
                            ],                            
                            
                            
                        ]
                    ]);
                }
            ?>     
        </div> <!-- // Gridview  -->
        </div> <!-- // body -->
    </div> <!-- // container -->
</div>
   
     
