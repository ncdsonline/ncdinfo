<?php
use yii\helpers\Html;
use yii\helpers\Url;
//echo 'this regist ht';
//echo $HOSPCODE;
$office_id = Yii::$app->user->identity->profile->office_id;
?>
<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
$this->params['breadcrumbs'][] = ['label' => 'อัตราความชุกโรคเบาหวาน', 'url' => ['dmprevalence/index']];
$this->params['breadcrumbs'][] = ['label' => 'อัตราความชุกโรคเบาหวานรายหมู่บ้าน', 'url' =>['dmprevalence/view','HOSPCODE'=>Yii::$app->user->identity->profile->office_id]];
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
                    ['content' => 'ทะเบียนผู้ป่วยโรคเบาหวาน', 'options' => ['colspan' => 12
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
            'attribute' => 'VILLAGE_ID',
                'label' => 'หมู่ที่'
            ],
            [
                'attribute' => 'MOOBAN',
                'label' => 'ชื่อหมู่บ้าน'
            ],
            [
                'attribute' => 'DM_DX',
                'label' => 'ICD-10'
            ],
            [
                'attribute' => 'DATE_DIAG',
                'label' => 'วันที่วินิจฉัย'
            ],
            
            [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'format'=>'raw',
            'value' => function ($data) {
    
                return !empty(Yii::$app->user->identity->profile->office_id)?
                    Html::a('<i class="glyphicon glyphicon-eye-open"></i>'
                        ,Yii::$app->urlManager->createUrl(['labhistory/list','CID'=>$data['CID']])
                    ):'';
            },
            ],
                    
        ]
    ]);
?>