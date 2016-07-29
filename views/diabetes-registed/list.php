<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\VerbFilter;
// use kartik\grid\GridView;
use kartik\grid\GridView;
$this->title = 'DM Registed All';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<div class="box box-success box-solid">
    <div class=" box-header">
        <h4>ทะเบียนโรคเบาหวาน</h4>
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
                    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
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
                                ['content' => 'บัญชีรายชื่อผู้ป่วยโรคเบาหวาน', 'options' => ['colspan' => 12
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
                            'label' => 'HN(รพ.พช.)'
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
                            'attribute' => 'BIRTH',
                            'label' => 'วันเกิด'
                        ],
//                        [
//                            'attribute' => 'SEX',
//                            'label' => 'เพศ'
//                        ],
                        [
                            'attribute' => 'HOUSE',
                            'label' => 'บ้านเลขที่'
                        ],
                        [
                            'attribute' => 'VILLAGE_ID',
                            'label' => 'หมู่ที่'
                        ],

                        [
                            'attribute' => 'DM_DATE_DX',
                            'label' => 'วินิจฉัย DM ครั้งแรก'
                        ],
                        [
                            'attribute' => 'HT_DATE_DX',
                            'label' => 'วินิจฉัย HT ครั้งแรก'
                        ],
                        
                        [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
                            'attribute' => 'DM_TYPEDISCH',
                             'label' => 'สถานะ',
                            'format'=>'html',
                            'value'=>function($data){
                              return $data['DM_TYPEDISCH']=='03' ? "<span style=\"color:green;\">ยังรักษาอยู่</span>":"<span style=\"color:red;\">จำหน่าย</span>";
                            }
                        ],
                    ]
                ]);
            }
            ?>
       
    </div>
</div> 