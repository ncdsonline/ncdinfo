<?php 
use kartik\grid\GridView; 
use yii\helpers\Html;
$this->title = 'MR รณรงค์';
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-warning box-solid">

    <div class="container-fluid">
        <div class="box-body">
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
                                    ['content' => 'ผลการรณรงค์ให้วัคซีน MR', 'options' => ['colspan' => 12
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
                            ],
                            [
                                'attribute' => 'HOSPNAME',
                                'label' => 'หน่วยบริการ'
                            ],
                            [
                                'attribute' => 'TARGET',
                                'label' => 'เป้าหมาย '
                            ],
                            [
                                'attribute' => 'RESULT1',
                                'label' => 'ได้รับในพื้นที่ '
                            ],
                            [
                                'attribute' => 'RESULT2',
                                'label' => 'ได้รับจากที่อื่น '
                            ],
                            [
                                'attribute' => 'RATE',
                                'label' => 'ร้อยละ'
                            ],
                            [
                                'attribute' => 'MISSED',
                                'label' => 'ไม่ได้รับ',
                                'format' => 'raw',
                                'value' => function ($data ) 
                                {
                                    return Html::a(Html::encode($data['MISSED']), 
                                            ['vaccine-campaigne/missedmr'
                                                ,'hospcode'=>$data['HOSPCODE'],
                                            ]);
                                },

                            ],


                        ]
                    ]);
                }
            ?>
        </div> <!-- // Gridview  -->
        </div>
    </div>
</div>