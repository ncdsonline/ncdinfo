<?php 
use kartik\grid\GridView; 
use yii\helpers\Html;
$this->title = 'Missed dTC List';
$this->params['breadcrumbs'][] = ['label' => 'ผลการรณรงค์ dTC', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'รายหน่วยบริการ', 'url' => ['viewdt']];
$this->params['breadcrumbs'][] = ['label' => 'รายหมู่บ้าน', 'url' => ['misseddtbyvillage','hospcode'=>Yii::$app->user->identity->profile->office_id]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box box-success box-solid">

    <div class="container-fluid">
        
        <div class="box-body">
        <div class="row">
            <div class="form-group">
                <?= Html::a('พิมพ์จดหมายเชิญ',['letterdt','village'=>$village],['class'=>'btn btn-success'])?>
            </div>
        </div>
        <div class='row'>
            
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
                                    ['content' => 'บัญชีรายชื่อผู้ที่ยังไม่ได้รับวัคซีน dTC', 'options' => ['colspan' => 12
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
                                'attribute' => 'AGE',
                                'label' => 'อายุ '
                            ],
                            [
                                'attribute' => 'HOUSE',
                                'label' => 'บ้านเลขที่ '
                            ],
                            [
                                'attribute' => 'VILLAGE',
                                'label' => 'หมู่ที่ '
                            ],
                            [
                                'attribute' => 'LAST_VACIINE',
                                'label' => 'เคยได้รับ dT '
                            ],
                            [
                                'attribute' => 'LAST_VACIINEPLACE',
                                'label' => 'หน่วยบริการ '
                            ],


                        ]
                    ]);
                }
            ?>
        </div> <!-- // Gridview  -->
        </div>
    </div>
</div>