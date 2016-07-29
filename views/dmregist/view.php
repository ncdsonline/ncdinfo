<?php
use yii\helpers\Html;
$office_id = Yii::$app->user->identity->profile->office_id;
?>
<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
$this->params['breadcrumbs'][] = ['label' => 'อัตราชุกโรคเบาหวาน', 'url' => ['dmregist/index']];
$this->params['breadcrumbs'][] = 'ทะเบียนผู้ป่วยโรคเบาหวาน';
?>

<!-------------------------------  GridView    ----------------------------------> 

<?php
if (isset($dataProvider))
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive' => TRUE,
        'hover' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'rowOptions'=>function($data){
                if($data['AGE']<35){
                    return ['class'=>'danger'];
                }
        },
        'panel' => [
            'before' => '', 
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'ทะเบียนผู้ป่วยโรคเบาหวาน', 'options' => ['colspan' => 16
                            , 'class' => 'text-center success']],
                ],
            ]
        ],
        'floatHeader' => true,
        'columns' => [
            [
                'attribute' => 'CID',
                'label' => 'เลขประจำตัว ปชช.'
            ],
            [
                'attribute' => 'NAME',
                'label' => 'ชื่อ'
            ],
            [
                'attribute' => 'LNAME',
                'label' => 'ชื่อสกุล'
            ],
            [
                'attribute' => 'SEX',
                'label' => 'เพศ',
                'value' => function ($data) {
                    return $data['SEX']=='1'?'ชาย':'หญิง';
                }
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
            'attribute' => 'VILLAGE',
                'label' => 'หมู่ที่'
            ],
//            [
//                'attribute' => 'VILLAGENAME',
//                'label' => 'ชื่อหมู่บ้าน'
//            ],
            [
                'attribute' => 'DM_DX',
                'label' => 'ICD-10'
            ],
            [
                'attribute' => 'DM_DATE_DX',
                'label' => 'วันที่วินิจฉัย'
            ],
                    
                    
                    
            [
                'attribute' => 'LAST_HBA1C',
                 'format'=>'html',
                'label' => 'HbA1C ล่าสุด',
                'value'=>function($model, $key, $index, $column){
                    return $model['LAST_HBA1C']< 7 ?
                            "<span style=\"color:green;\">".$model['LAST_HBA1C']."</span>"
                            :"<span style=\"color:red;\">". $model['LAST_HBA1C'] ."</span>";
                }
                
            ],
                    
            [
                'attribute' => 'BS_LAST1',
                'label' => 'BS ล่าสุด',
                'format'=>'html',
                'value'=>function($model, $key, $index, $column){
                    return $model['BS_LAST1']< 100 ?
                            "<span style=\"color:green;\">".$model['BS_LAST1']."</span>"
                            :"<span style=\"color:red;\">". $model['BS_LAST1'] ."</span>";
                }
            ],
            [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'format'=>'raw',
            'value' => function ($data) {
    
                return !empty(Yii::$app->user->identity->profile->office_id)?
                    Html::a('<i class="glyphicon glyphicon-eye-open"></i>'
                        ,Yii::$app->urlManager->createUrl(['ht/lab','CID'=>$data['CID']])
                    ):'';
            },
            ],
                    
        ]
    ]);
?>