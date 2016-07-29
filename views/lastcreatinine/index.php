<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;

use yii\helpers\Html;
// use yii\helpers\Url;
// use kartik\grid\GridView;
// use kartik\grid\GridView;

?>

<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
$this->params['breadcrumbs'][] = ['label' => 'การตรวจ Creatinine ในผู้ป่วยความดันโลหิตสูง', 'url' => ['#']];
?>

<!-------------------------------  passing params    ----------------------------------> 
<!--
<div class="row">
    <form  method="post" align="center">
        อายุระหว่าง :    <input type="number" name="agestart">
        ถึง :     <input type="number" name="agestop">
        <input type="submit"  value="ประมวลผล">
    </form>
</div>-->
<br>
<!-------------------------------  GridView    ----------------------------------> 

<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive' => TRUE,
        'hover' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'panel' => [
            //  'heading' => '<b>My View</b>',
            'before' => 'KPI--9999', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'Creatinine', 'options' => ['colspan' => 9
                            , 'class' => 'text-center warning']],
                ],
            // 'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        'floatHeader' => true,
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
                'label' => 'จำนวนผู้ป่วย HT'
            ],
            [
                'attribute' => 'LEVEL1',
                'label' => 'HT ที่มี Cr <= 2'
            ],
            [
                'attribute' => 'PERCENT',
                'label' => 'ร้อยละ'
            ],
            [
                'attribute' => 'LEVEL2',
                'label' => 'Cr > 1.5'
            ],
            [
                'attribute' => 'LEVEL3',
                'label' => 'Cr > 2'
            ],
            [
                'attribute' => 'NO_FU',
                'label' => 'ไม่มีผลตรวจ'
            ],
            // with authorized
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'format' => 'raw',
                'value' => function ($data) { 
                    if (Yii::$app->user->isGuest) {
                         return false;
                    }
                    return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
                            Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['dmregist/view', 'HOSPCODE' => $data['HOSPCODE']])) 
                            :'' ;
                    },
                    ],
                ]
            ]);
        ?>




