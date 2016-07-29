<?php
use yii\helpers\Html;
use yii\helpers\Url;
//echo 'this regist ht';
//echo $HOSPCODE;
$office_id = Yii::$app->user->identity->profile->office_id;
?>
<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
$this->params['breadcrumbs'][] = ['label' => 'อัตราความชุกโรคความดันโลหิตสูง', 'url' => ['htprevalence/index']];
$this->params['breadcrumbs'][] = 'อัตราความชุกความดันโลหิตสูงรายหมู่บ้าน';
?>

<!-------------------------------  GridView    ----------------------------------> 

<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive' => TRUE,
        'hover' => true,
        'containerOptions' => ['style' => 'overflow: auto'],

        'panel' => [
            'before' => '', 
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'อัตราความชุกโรคเบาหวาน', 'options' => ['colspan' => 12
                            , 'class' => 'text-center success']],
                ],
            ]
        ],
        'floatHeader' => true,
        'columns' => [
            [
                'attribute' => 'VILLAGE_ID',
                'label' => 'หมู่ที่'
            ],
            [
                'attribute' => 'MOOBAN',
                'label' => 'ชื่อหมู่บ้าน'
            ],
            [
                'attribute' => 'NUM_HT',
                'label' => 'จำนวนผู้ป่วย HT'
            ],
            [
                'attribute' => 'NUM_POP',
                'label' => 'จำนวนประชากรกลุ่มเสี่ยง'
            ],
            
            [
                'attribute' => 'RATE',
                'label' => 'อัตรา(ร้อยละ)'
            ],

            
            [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'format'=>'raw',
            'value' => function ($data) {
    
                return !empty(Yii::$app->user->identity->profile->office_id)?
                    Html::a('<i class="glyphicon glyphicon-eye-open"></i>'
                        ,Yii::$app->urlManager->createUrl(['htprevalence/list','HOSPCODE'=>Yii::$app->user->identity->profile->office_id])
                    ):'';
            },
            ],
                    
        ]
    ]);
?>