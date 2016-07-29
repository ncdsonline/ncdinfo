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
// echo $sql;
$this->params['breadcrumbs'][] = ['label' => 'จำนวนรายป่วยโรคเรื้อรัง', 'url' => ['chronicsprevalence/index']];
$this->params['breadcrumbs'][] = ['label' => 'จำนวนรายป่วยโรคเรื้อรังรายหมู่บ้าน'];

?>

<!-------------------------------  passing params    ---------------------------------->


<!-------------------------------  GridView    ---------------------------------->

<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([

        'dataProvider' => $dataProvider,
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

        'hover' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'panel' => [
            //  'heading' => '<b>My View</b>',
            'before' => 'KPI--XXX', //IMPORTANT
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

                'attribute' => 'VILLAGE_ID',
                'label' => 'หมู่ที่',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data['VILLAGE_ID']), ['chronicsprevalence/item',['HOSPCODE' => $data['HOSPCODE'],'VILLAGE_ID'=>$data['VILLAGE_ID']]]);
                },

            ],
            [
                'attribute' => 'MOOBAN',
                'label' => 'ชื่อหมู่บ้าน'
            ],
            [
                'attribute' => 'CARDIOVARCULAR',

                'label' => 'โรคระบบหัวใจและหลอดเลือด'
            ],
            [
                'attribute' => 'DIABETES',
                'label' => 'โรคเบาหวาน'
            ],
            [
                'attribute' => 'RESPIRATORY',
                'label' => 'โรคระบบทางเดินหายใจส่วนล่าง'
            ],
            [
                'attribute' => 'CANCER',
                'label' => 'โรคมะเร็ง'
            ],
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

                            if( Yii::$app->user->identity->role <> 10){
                              return  Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
                                Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['chronicsprevalence/list', 'HOSPCODE' => $data['HOSPCODE'],'VILLAGE_ID'=>$data['VILLAGE_ID']]))
                              :'' ;
                            }else {
                                return  Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['chronicsprevalence/list', 'HOSPCODE'=> $data['HOSPCODE'],'VILLAGE_ID'=>$data['VILLAGE_ID']]));
                            }

//                //Yii::$app->urlManager->createUrl([‘site/page’, ‘id’ => ‘about’])
//                // return $data['HOSPCODE']; // $data['name'] for array data, e.g. using SqlDataProvider.
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']?Html::url('site/index'):'';
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']? Html::a('<i class="glyphicon glyphicon-eye-open"></i>',Url::to(['viewdetail','HOSPCODE'=>$HOSPCODE])):'';
                },
                    ],
                ]
            ]);
        ?>
