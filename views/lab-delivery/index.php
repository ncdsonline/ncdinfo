<?php


use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
$this->title = 'Lab Delivery';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<div class="box box-success box-solid">
        <div class=" box-header">
            <h4>ผลการตรวจแล็ปประจำปี</h4>
        </div>   

<div class="box-body">
     <div class=" box-title">
           <?php
           
           // echo 'test';
           
           ?>
        </div>      
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
            'before' => 'KPI--XXX', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'จำนวนผู้ป่วยโรคเบาหวาน/ความดันโลหิตสูงที่ได้รับการตรวจแล็ปประจำปี', 'options' => ['colspan' => 12
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
//                'format' => 'raw',
//                'value' => function ($data) {
//                    return Html::a(Html::encode($data['HOSPCODE'])
//                , ['diabetes-registed/all','hospcode'=>$data['HOSPCODE']]);
//                },

            ],
            [
                'attribute' => 'HOSPNAME',
                'label' => 'หน่วยบริการ'
            ],
            [
                'attribute' => 'NUM_TOTAL',
                'label' => 'ผู้ป่วย DM/HT'
            ],
            [
                'attribute' => 'NUM_ACCESS',
                'label' => 'ตรวจแล้ว'
            ],

            [
                'attribute' => 'NUM_MISSED',
                'label' => 'ไม่ได้ตรวจ',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data['NUM_MISSED'])
                , ['lab-delivery/missed','hospcode'=>$data['HOSPCODE']]);
                },

            ],
//            [
//                'attribute' => 'NUM_MISSED',
//                'label' => 'ไม่ได้ตรวจ',
//                'format' => 'raw',
//                'value' => function ($data) {
//                    //return Html::a(Html::encode($data['NUM_MISSED'])
//                    $url = urldecode(Url::toRoute(['steam/', 'steamid' => 'aa:bb:cc']));
//                    
//                    if($data['NUM_MISSED']>0){
//                         return Html::a(Html::encode($data['NUM_MISSED'],$url)
//                            //, ['diabetes-registed/all','hospcode'=>$data['HOSPCODE']]
//                                 );
//                    }
//                    //
//                    //
//                    //
//                    //
//                   // return $data['NUM_MISSED']>0 ? "<span style=\"color:red;\">YES</span>":"<span style=\"color:green;\">No</span>";
//                    
//                },
//
//            ],
          
        ]
    ]);
}
?>
</div>
</div> 