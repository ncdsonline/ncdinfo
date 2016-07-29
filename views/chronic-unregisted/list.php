<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\VerbFilter;
// use kartik\grid\GridView;
use kartik\grid\GridView;
$this->title = 'Unregisted';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<div class="box box-success box-solid">
    <div class=" box-header">
        <h4>ผู้ป่วยโรคเรื้อรังที่ยังไม่ได้ขึ้นทะเบียน</h4>
    </div>   

    <div class=" box-title">
               <?php

               // echo 'test';

               ?>
    </div>    
    <div class="box-body">

       
            <?php
            if (isset($dataProvider)){
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'] ,
                    'responsive' => TRUE,
                   // 'hover' => true,
                    //'containerOptions' => ['style' => 'overflow: auto'],
                    'panel' => [
                        //  'heading' => '<b>My View</b>',
                        'before' => '', //IMPORTANT AS KPI--XXX
                    ],
                    'beforeHeader' => [
                        [
                            'columns' => [
                                ['content' => 'บัญชีรายชื่อผู้ป่วยโรคเรื้อรังที่ยังไม่ขึ้นทะเบียน', 'options' => ['colspan' => 12
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
                            'attribute' => 'BIRTH',
                            'label' => 'วันเกิด'
                        ],
                        [
                            'attribute' => 'SEX',
                            'label' => 'เพศ'
                        ],
                        [
                            'attribute' => 'HOUSE',
                            'label' => 'บ้านเลขที่'
                        ],
                        [
                            'attribute' => 'VILLAGE',
                            'label' => 'หมู่ที่'
                        ],
                        [
                            'attribute' => 'HCODE',
                            'label' => 'หน่วยบริการ'
                        ],
                        [
                            'attribute' => 'LAST_VISITDATE',
                            'label' => 'วันที่พบผู้ป่วย'
                        ],
                        [
                            'attribute' => 'CHRONIC_DX',
                            'label' => 'ICD-10'
                        ],
                    ]
                ]);
            }
            ?>
       
    </div>
</div> 