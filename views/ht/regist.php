<?php
use yii\helpers\Html;
use yii\helpers\Url;
//echo 'this regist ht';
//echo $HOSPCODE;
$office_id = Yii::$app->user->identity->profile->office_id;
?>
<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
$this->params['breadcrumbs'][] = ['label' => 'อัตราโรคความดันโลหิตสูง', 'url' => ['ht/index']];
$this->params['breadcrumbs'][] = 'ทะเบียนผู้ป่วยโรคความดันโลหิตสูง';
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
                    ['content' => 'ทะเบียนผู้ป่วยโรคความดันโลหิตสูง', 'options' => ['colspan' => 12
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
                'attribute' => 'FULLNAME',
                'label' => 'ชื่อ-สกุล'
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
            [
                'attribute' => 'VILLAGENAME',
                'label' => 'ชื่อหมู่บ้าน'
            ],
            [
                'attribute' => 'HT_DX',
                'label' => 'ICD-10'
            ],
            [
                'attribute' => 'DATE_DIAG',
                'label' => 'วันที่วินิจฉัย'
            ],
            [
                'attribute' => 'LAST_VISIT',
                'label' => 'ติดตามครั้งล่าสุด'
            ],
                    
            [
                'attribute' => 'LAST_BP',
                'label' => 'BP ครั้งล่าสุด'
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