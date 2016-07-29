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
$this->params['breadcrumbs'][] = ['label' => 'รายชื่อผู้ป่วยโรคเรื้อรังในหมู่บ้าน'];

?>

<!-------------------------------  passing params    ---------------------------------->


<!-------------------------------  GridView    ---------------------------------->

<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([

        'dataProvider' => $dataProvider,
        'responsive' => TRUE,
         'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
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
                    ['content' => 'รายชื่อผู้ป่วยโรคเรื้อรัง', 'options' => ['colspan' => 12
                            , 'class' => 'text-center warning']],
                ],
            // 'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],

      //  'floatHeader' => true,

        'layout'=>"\n{pager}",
        'columns' => [
            [

                'attribute' => 'CID',
                'label' => 'CID',
                'format' => 'raw',
                'value' => 'CID',
            ],

            [
                'attribute' => 'FULLNAME',
                'label' => 'ชื่อ-สกุล'
            ],
            [
                'attribute' => 'SEX',
                'label' => 'เพศ'
            ],
            [
                'attribute' => 'AGE',
                'label' => 'อายุ'
            ],
            [
                'attribute' => 'HOUSE',
                'label' => 'บ้านเลขที่'
            ],
            [
                'attribute' => 'HT_DX',
                'label' => 'HT'
            ],
            [
                'attribute' => 'STROKE_DX',
                'label' => 'STROKE'
            ],
            [
                'attribute' => 'ISCHEMIC_DX',
                'label' => 'ISCHEMIC'
            ],
            [
                'attribute' => 'DM_DX',
                'label' => 'DM'
            ],
            [
                'attribute' => 'COPD_DX',
                'label' => 'COPD'
            ],
            [
                'attribute' => 'ASTHMA_DX',
                'label' => 'ASTHMA'
            ],
            [
                'attribute' => 'CA_DX',
                'label' => 'CA'
            ],
            // with authorized

                ]
            ]);
        ?>
