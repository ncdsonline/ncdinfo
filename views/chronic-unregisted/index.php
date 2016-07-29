<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\VerbFilter;
// use kartik\grid\GridView;
use kartik\grid\GridView;
$this->title = 'Unregisted';
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

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
                                ['content' => 'จำนวนผู้ป่วยโรคเรื้อรังรายใหม่', 'options' => ['colspan' => 12
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
                            'value' => function ($data) {
                                return Html::a(Html::encode($data['HOSPCODE']), ['chronic-unregisted/list','HOSPCODE'=>$data['HOSPCODE']]);
                            },

                        ],
                        [
                            'attribute' => 'HOSPNAME',
                            'label' => 'หน่วยบริการ'
                        ],
                        [
                            'attribute' => 'N',
                            'label' => 'จำนวน'
                        ],


                    ]
                ]);
            }
            ?>
       
    </div>
</div> 