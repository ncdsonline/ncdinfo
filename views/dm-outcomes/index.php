<?php 
use kartik\grid\GridView; 
use yii\helpers\Html;
$this->title = 'ผู้ป่วยโรคเบาหวานควบคุมน้ำตาลได้ดี';
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
                                    ['content' => 'ผู้ป่วยโรคเบาหวานควบคุมน้ำตาลได้ดี', 'options' => ['colspan' => 12
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
                                'attribute' => 'UNDERLINE',
                                'label' => 'ผลงาน'
                            ],
                           
                            [
                                'attribute' => 'RATE',
                                'label' => 'ร้อยละ'
                            ],
                            [
                                'attribute' => 'MISSED',
                                'label' => 'ควบคุมไม่ได้',
                                'format' => 'raw',
                                'value' => function ($data ) 
                                {
                                    return Html::a(Html::encode($data['MISSED']), 
                                            ['dm-outcomes/missed'
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