<?php


use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
/// use kartik\datetime\DateTimePicker;

?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
$this->params['breadcrumbs'][] = ['label' => 'อัตราความชุกโรคเบาหวาน', 'url' => ['ht/index']];
?>

<!-------------------------------  passing params    ----------------------------------> 
<?php 
//echo DatePicker::widget([
//    'name'  => 'from_date',
//   // 'value'  => $value,
//    //'language' => 'ru',
//    //'dateFormat' => 'yyyy-MM-dd',
//]);
?>
<div class="row">
    <form  method="post" align="center">
        อายุระหว่าง :    <input type="number" name="agestart">
        ถึง :     <input type="number" name="agestop">
        <input type="submit"  value="ประมวลผล">
    </form>
</div>
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
            'before' => 'KPI--65', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'อัตราความชุกโรคเบาหวาน', 'options' => ['colspan' => 9
                            , 'class' => 'text-center warning']],
                ],
            // 'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        'floatHeader' => true,
        'columns' => [
            [
                'attribute' => 'HOSPCODE',
                'label' => 'รหัสหน่วยบริการ'
            ],
            [
                'attribute' => 'HOSPNAME',
                'label' => 'หน่วยบริการ'
            ],
            [
                'attribute' => 'NUM_DM',
                'label' => 'จำนวนผู้ป่วย DM (คน)'
            ],
            [
                'attribute' => 'NUM_POP',
                'label' => 'จำนวนประชากรกลุ่มเสี่ยง (คน)'
            ],
            [
                'attribute' => 'RATE',
                'label' => 'อัตราร้อยละ'
            ],
            // with authorized
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'format' => 'raw',
                 'label' => 'รายละเอียด',
                'value' => function ($data) {
//    // ตั้งแต่บ่ายยันสี่ทุ่ม  
                    if (Yii::$app->user->isGuest) {
                        return false;
                    }
                    return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
                            Html::a('คลิ๊ก!ที่นี่', Yii::$app->urlManager->createUrl(['dmprevalence/view', 'HOSPCODE' => $data['HOSPCODE']])) : 'ไม่อนุญาต';
//                //Yii::$app->urlManager->createUrl([‘site/page’, ‘id’ => ‘about’])
//                // return $data['HOSPCODE']; // $data['name'] for array data, e.g. using SqlDataProvider.
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']?Html::url('site/index'):'';
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']? Html::a('<i class="glyphicon glyphicon-eye-open"></i>',Url::to(['viewdetail','HOSPCODE'=>$HOSPCODE])):'';
                },
                    ],
                ]
            ]);
        ?>




