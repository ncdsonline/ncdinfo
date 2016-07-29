
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
// \yii\helpers\VarDumper::dump($dataProvider);

?>

<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
// echo $sql;
$this->params['breadcrumbs'][] = ['label' => 'ผลการคัดกรองโรค DM & HT'];
?>

<!-------------------------------  passing params    ----------------------------------> 


<!-------------------------------  GridView    ----------------------------------> 

<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([
        
        'dataProvider' => $dataProvider,
        'responsive' => TRUE,
        'hover' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'panel' => [
            'before' => 'KPI--XXX', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'ผลการคัดกรองโรค DM & HT ปี 2558', 'options' => ['colspan' => 9
                            , 'class' => 'text-center success']],
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
            ],
            [
                'attribute' => 'HOSPNAME',
                'label' => 'หน่วยบริการ'
            ],
            [
                'attribute' => 'NUM_POP',
                'label' => 'เป้าหมาย (คน)'
            ],
            [
                'attribute' => 'NUM_DM',
                'label' => 'คัดกรอง DM (คน)'
            ],
            [
                'attribute' => 'NUM_HT',
                'label' => 'คัดกรอง HT (คน)'
            ],
            [
                'attribute' => 'RATE_DM',
                'label' => 'คัดกรอง DM (%)'
            ],
            [
                'attribute' => 'RATE_HT',
                'label' => 'คัดกรอง HT (%) '
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
                    return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
                            Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['screenncd/view', 'HOSPCODE' => $data['HOSPCODE']])) 
                            :'' ;
                },
                    ],
                ]
            ]);
        ?>






