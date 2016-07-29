<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\VerbFilter;
// use kartik\grid\GridView;
use kartik\grid\GridView;

?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<div class="box box-success box-solid">
        <div class=" box-header">
            <h4>จำนวนผู้ป่วยเบาหวานรายใหม่</h4>
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
                    ['content' => 'จำนวนผู้ป่วยโรคเบาหวานรายใหม่', 'options' => ['colspan' => 12
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
                    return Html::a(Html::encode($data['HOSPCODE'])
                , ['diabetes-registed/all','hospcode'=>$data['HOSPCODE']]);
                },

            ],
            [
                'attribute' => 'HOSPNAME',
                'label' => 'หน่วยบริการ'
            ],
            [
                'attribute' => 'Y2016',
                'label' => 'ปี 2559'
            ],
            [
                'attribute' => 'Y2015',
                'label' => 'ปี 2558'
            ],
            [
                'attribute' => 'Y2014',
                'label' => 'ปี 2557'
            ],
            [
                'attribute' => 'Y2013',
                'label' => 'ปี 2556'
            ],
            [
                'attribute' => 'Y2012',
                'label' => 'ปี 2555'
            ],
//            [
//                'attribute' => 'DM_WITHOUT_HT',
//                'label' => 'โรคเบาหวานไม่มีความดัน'
//            ],
//            [
//                'attribute' => 'HT_WITHOUT_DM',
//                'label' => 'โรคความดันไม่มีเบาหวาน'
//            ],
//            [
//                'attribute' => 'DM_WITH_HT',
//                'label' => 'โรคเบาหวานและความดัน'
//            ],
//            [
//                'attribute' => 'OTHER',
//                'label' => 'โรคเรื้อรัง อื่นๆ ',
//                'hAlign'=>'middle',
//                'vAlign'=>'middle',
//            ],
                        /*
            // with authorized
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'format' => 'raw',
                'value' => function ($data) {
                    if (Yii::$app->user->isGuest) {
                         return false;
//                    return Yii::$app->user->identity->role !==10 ?
//                            Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['dmregist/dmlistview', 'HOSPCODE' => $data['HOSPCODE']]))
//                            :'ล็อกอิน' ;
                    }
//
//                        if(Yii::$app->user->can('Admin')){
//                            echo 'u r admin';
//                        }elseif(Yii::$app->user->can('Member') && 
//                            Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ){
//                             echo 'URL for data where owner is Member ';
//                        }else{
                         * returm redirect to login}
                      if( Yii::$app->user->identity->role <> 10){
                        return  Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
                          Html::a('รายละเอียด', Yii::$app->urlManager->createUrl(['chronicsprevalence/view', 'HOSPCODE' => $data['HOSPCODE']]))
                        :'' ;
                      }else {
                          return  Html::a('รายละเอียด', Yii::$app->urlManager->createUrl(['chronicsprevalence/view', 'HOSPCODE'=> $data['HOSPCODE']]));
                      }


//                //Yii::$app->urlManager->createUrl([‘site/page’, ‘id’ => ‘about’])
//                // return $data['HOSPCODE']; // $data['name'] for array data, e.g. using SqlDataProvider.
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']?Html::url('site/index'):'';
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']? Html::a('<i class="glyphicon glyphicon-eye-open"></i>',Url::to(['viewdetail','HOSPCODE'=>$HOSPCODE])):'';
                },
            ],
                         * 
                         */
        ]
    ]);
}
?>
</div>
</div> 