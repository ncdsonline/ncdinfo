<?php 
use kartik\grid\GridView; 
use yii\helpers\Html;
$this->title = 'ผู้ที่ไม่ได้รับ MRC';
$this->params['breadcrumbs'][] = ['label' => 'MRC', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['viewmr']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary box-solid">

    <div class="container-fluid">
        <div class="box-body">
        <div class="row">
            <div class="form-group">
                <?= Html::a('พิมพ์จดหมายเชิญ',['lettermr'],['class'=>'btn btn-success'])?>
            </div>
        </div>            
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
                                    ['content' => 'บัญชีรายชื่อผู้ที่ยังไม่ได้รับวัคซีน MRC', 'options' => ['colspan' => 12
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
                                'label' => 'เลขประจำตัว ปชช.',
                            ],
                            [
                                'attribute' => 'NAME',
                                'label' => 'ชื่อ'
                            ],
                            [
                                'attribute' => 'LNAME',
                                'label' => 'สกุล '
                            ],
                            [
                                'attribute' => 'BIRTH',
                                'label' => 'วันเกิด '
                            ],
                            [
                                'attribute' => 'HOUSE',
                                'label' => 'บ้านเลขที่ '
                            ],
                            [
                                'attribute' => 'VILLAGE',
                                'label' => 'หมู่ที่ '
                            ],

                        ]
                    ]);
                }
            ?>
        </div> <!-- // Gridview  -->
        </div>
    </div>
</div>