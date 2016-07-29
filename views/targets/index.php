<?php
// echo $sql;
//  \yii\helpers\VarDumper::dump($dataProvider,10,true);

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
/// use kartik\datetime\DateTimePicker;
// $office_id = Yii::$app->user->identity->profile->office_id;
?>

<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
//$this->title = 'ประชากรสำรวจรายหน่วยบริการ';
//// $this->params['breadcrumbs'][] = ['label' => '#', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;



$this->title = 'ประชากรสำรวจรายหน่วยบริการ';
// $this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-------------------------------  passing params    ----------------------------------> 

<div class="row">
    <form  method="post" align="center">
        อายุระหว่าง :    <input type="number" name="agestart">
        ถึง :     <input type="number" name="agestop">
       
        <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?php //Html::resetButton('Reset', ['class' => 'btn btn-danger']) ?>
                <?= Html::a('Reset',['index'],['class'=>'btn btn-danger'])?>
        </div>
        
        
    </form>
</div>
<br>
<h4><?php  echo "ประชากรจากการสำรวจ  ปีงบประมาณ  ".($toyear+543) .'    อายุระหว่าง  '.$agestart.  '     ปี  ถึง   '.$agestop.'  ปี'  ;?></h4>

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
            'before' => 'KPI--??', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => '', 'options' => ['colspan' => 9
                            , 'class' => 'text-center ']],
                ],
            // 'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        //'floatHeader' => true,
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
                'attribute' => 'MALE',
                'label' => 'ชาย'
            ],
            [
                'attribute' => 'FEMALE',
                'label' => 'หญิง'
            ],
            [
                'attribute' => 'TOTAL',
                'label' => 'รวม'
            ],
            // with authorized
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'format' => 'raw',
                'label' => 'รายละเอียด',
                'value' => function ($data) {
                    if (Yii::$app->user->isGuest) {
                        return false;
                    }
                    return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
                            Html::a('คลิ๊ก!ที่นี่', Yii::$app->urlManager->createUrl(
                                ['targets/view'
                                    , 'HOSPCODE' => $data['HOSPCODE']
                                  //  , 'agestart' => $agestart
                                ]
                            )) : '';
                },
                    ],
                ]
            ]);
        ?>




