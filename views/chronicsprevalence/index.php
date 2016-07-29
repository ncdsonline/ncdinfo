<?php


use yii\helpers\Html;
use yii\helpers\Url;

// use kartik\grid\GridView;
use kartik\grid\GridView;

?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<!-------------------------------  breadcrumbs    ---------------------------------->

<?php

$this->title = 'Chronics Registed All';
//$this->params['breadcrumbs'][] = ['label' => 'กลับ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success box-solid">
    <div class=" box-header">
        <h4>ผู้ป่วยโรคเรื้อรัง</h4>
    </div>   
 
    <div class="box-body">
<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([

        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '0'] ,
        'responsive' => TRUE,
//        'toolbar' => [
//        ['content'=>
//            Html::a('Add', ['create'], ['data-pjax' => 'false', 'class' => 'btn btn-success']) .
//            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => false, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
//        ],
//        '{export}',
//        '{toggleData}'
//        ],

        /*
        // link grid
        'rowOptions' => function ($model, $key, $index, $grid) {
                    return [
                        'style' => "cursor: pointer",
                        'onclick' => 'location.href="'
                            . Yii::$app->urlManager->createUrl('dm/index')
                            . '?HOSPCODE="+(this.id);',
                    ];
                },

        */

       // 'hover' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'panel' => [
            //  'heading' => '<b>My View</b>',
            'before' => '', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'จำนวนรายป่วยโรคเรื้อรัง', 'options' => ['colspan' => 9
                            , 'class' => 'text-center warning']],
                ],
            // 'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],

      //  'floatHeader' => true,

        'layout'=>"\n{pager}",
        'columns' => [
            [

                'attribute' => 'HOSPCODE',
                'label' => 'รหัสหน่วยบริการ',
//                'format' => 'raw',
//                'value' => function ($data) {
//                    return Html::a(Html::encode($data['HOSPCODE']), ['chronicsprevalence/view','HOSPCODE'=>$data['HOSPCODE']]);
//                },

            ],
            [
                'attribute' => 'HOSPNAME',
                'label' => 'หน่วยบริการ'
            ],
            [
                'attribute' => 'DM_WITHOUT_HT',
                'label' => 'โรคเบาหวานไม่มีความดัน'
            ],
            [
                'attribute' => 'HT_WITHOUT_DM',
                'label' => 'โรคความดันไม่มีเบาหวาน'
            ],
            [
                'attribute' => 'DM_WITH_HT',
                'label' => 'โรคเบาหวานและความดัน'
            ],
            [
                'attribute' => 'OTHER',
                'label' => 'โรคเรื้อรัง อื่นๆ ',
                'hAlign'=>'middle',
                'vAlign'=>'middle',
            ],
            // with authorized
//            [
//                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//                'format' => 'raw',
//                'value' => function ($data) {
//                    if (Yii::$app->user->isGuest) {
//                         return false;
////                    return Yii::$app->user->identity->role !==10 ?
////                            Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['dmregist/dmlistview', 'HOSPCODE' => $data['HOSPCODE']]))
////                            :'ล็อกอิน' ;
//                    }
////
////                        if(Yii::$app->user->can('Admin')){
////                            echo 'u r admin';
////                        }elseif(Yii::$app->user->can('Member')){
////                             echo 'u r Member';
////                        }
//                      if( Yii::$app->user->identity->role <> 10){
//                        return  Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
//                          Html::a('รายละเอียด', Yii::$app->urlManager->createUrl(['chronicsprevalence/view', 'HOSPCODE' => $data['HOSPCODE']]))
//                        :'' ;
//                      }else {
//                          return  Html::a('รายละเอียด', Yii::$app->urlManager->createUrl(['chronicsprevalence/view', 'HOSPCODE'=> $data['HOSPCODE']]));
//                      }
//
//
////                //Yii::$app->urlManager->createUrl([‘site/page’, ‘id’ => ‘about’])
////                // return $data['HOSPCODE']; // $data['name'] for array data, e.g. using SqlDataProvider.
////                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']?Html::url('site/index'):'';
////                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']? Html::a('<i class="glyphicon glyphicon-eye-open"></i>',Url::to(['viewdetail','HOSPCODE'=>$HOSPCODE])):'';
//                },
//                    ], // end column Action
                ]
            ]);
        ?>
</div>
    </div>