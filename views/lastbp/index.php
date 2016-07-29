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
$this->params['breadcrumbs'][] = ['label' => 'อัตราผู้ป่วยความดันโลหิตควบคุมได้ดี', 'url' => ['#']];
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
                    ['content' => 'ผู้ป่วยความดันโลหิตควบคุมได้ดี', 'options' => ['colspan' => 9
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
//                'format' => 'raw',
//                'value' => function ($data) {
//                    return Html::a(Html::encode($data['HOSPCODE']), '#');
//                },
            ],
            [
                'attribute' => 'HOSPNAME',
                'label' => 'หน่วยบริการ'
            ],
            [
                'attribute' => 'N_HT',
                'label' => 'จำนวนผู้ป่วย HT'
            ],
            [
                'attribute' => 'HT_IN',
                'label' => 'ควบคุม BP ได้ดี'
            ],
            [
                'attribute' => 'PERCENT',
                'label' => 'ร้อยละ'
            ],
            [
                'attribute' => 'NO_FU',
                'label' => 'ไม่มีผล BP'
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




