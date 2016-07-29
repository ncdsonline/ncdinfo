<?php 
use kartik\grid\GridView; 
use yii\helpers\Html;
$this->title = 'HT with DM';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success box-solid">

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
                                    ['content' => 'ผู้ป่วยโรคความดันโลหิตสูง(มีเบาหวานร่วมด้วย) ควบคุมความดันได้ดี', 'options' => ['colspan' => 12
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
                                'attribute' => 'TOTAL',
                                'label' => 'เป้าหมาย '
                            ],
                            [
                                'attribute' => 'RESULT1',
                                'label' => 'ผลงาน'
                            ],
                           
                            [
                                'attribute' => 'RATE',
                                'label' => 'ร้อยละ'
                            ],

                            [
                                'attribute' => 'RESULT0',
                                'label' => 'ควบคุมไม่ได้',
                                'format' => 'raw',
                                'value' => function ($data ) 
                                {
                                    return Html::a(Html::encode($data['RESULT0']), 
                                            ['ht-dm-outcomes/missed'
                                                ,'hospcode'=>$data['HOSPCODE'],
                                            ]);
                                },

                            ],
                            [
                                'attribute' => 'MISSED',
                                'label' => 'ไม่ทราบ',
                                'format' => 'raw',
                                'value' => function ($data ) 
                                {
                                    return Html::a(Html::encode($data['MISSED']), 
                                            ['ht-dm-outcomes/lostfollowup'
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