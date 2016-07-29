<?php



use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\grid\GridView;

//echo 'this regist ht';

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
//        'rowOptions'=>function($data){
//                if($data['LDL'] > 100 || ($data['HDL'] < 35 ) || ($data['BUN'] > 18 )){
//                    return ['class'=>'danger'];
//                }
//            
//        },
        'panel' => [
            'before' => '', 
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'ผลแล็ปครั้งล่าสุดของผู้ป่วยโรคความดันโลหิตสูง', 'options' => ['colspan' => 12
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
                'attribute' => 'TG',
                'label' => 'Triglyceride'
            ],
            [
                'attribute' => 'TC',
                'label' => 'Total Chol.'
            ],
            [
            'attribute' => 'HDL',
            'label' => 'HDL Chol.',    
            'value'=>function($data)
                {
                if ($data['HDL'] < 35) {                   
                    return HTML('<font color="red">'.$data['HDL'].'</font>');
                }else {
                       return $data['HDL'];
                }
                
    
    // return Html::cssStyleFromArray(['width' => '100px', 'height' => '200px']);

     
      
            },],
            [
                'attribute' => 'LDL',
                'label' => 'LDL Chol.'
            ],
            [
                'attribute' => 'BUN',
                'label' => 'BUN ในเลือด'
            ],
            [
                'attribute' => 'CR',
                'label' => 'Creatinine'
            ],
            [
                'attribute' => 'K',
                'label' => 'Protasium'
            ],

        ]
    ]);
?>