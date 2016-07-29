
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
// \yii\helpers\VarDumper::dump($dataProvider);
$this->title = 'Pre-HT';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
// echo $sql;
$this->params['breadcrumbs'][] = ['label' => 'ผลการปรับเปลี่ยนพฤติกรรม Pre-HT'];
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
                    ['content' => 'ผลการปรับเปลี่ยนพฤติกรรมกลุ่มเสี่ยงโรคความดันโลหิตสูง ', 'options' => ['colspan' => 12
                            , 'class' => 'text-center info']],
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
                'attribute' => 'NUM_RISK',
                'label' => 'กลุ่มเสี่ยง (คน)'
            ],
            [
                'attribute' => 'NUM_PP',
                'label' => 'ปรับพฤติกรรม(คน)'
            ],
//            [
//                'attribute' => 'LEVEL1',
////                'label' => 'BP < 120/80 mmHg'
//                 'label' => 'LEVEL1'
//            ],
            
            [
                'attribute' => 'LEVEL1',
               // 'label' => 'BP < 120/80 mmHg'
                'label' => 'LEVEL1',
                'format' => 'raw',
                'value' => function ($data) { 
                        return "<span class=\"badge\" style=\"color:#ffffff; background-color:#00b730\">".$data['LEVEL1']."</span>";
                }
            ],
            
            
//            [
//                'attribute' => 'LEVEL2',
////                'label' => 'BP 120-139/80-89 mmHg'
//                 'label' => 'LEVEL2'
//            ],
                    
            [
                'attribute' => 'LEVEL2',
               //  'label' => 'BP 120-139/80-89 mmHg'
                'label' => 'LEVEL2',
                'format' => 'raw',
                'value' => function ($data) { 
                        return "<span class=\"badge\" style=\"color: #000000; background-color:#3fff00\">".$data['LEVEL2']."</span>";
                }
            ],
                    
                    
//            [
//                'attribute' => 'LEVEL3',
//               // 'label' => ' BP 140-159/90-99 mmHg'
//                'label' => 'LEVEL3'
//            ],
                    
           [
                'attribute' => 'LEVEL3',
               //  'label' => ' BP 140-159/90-99 mmHg'
                'label' => 'LEVEL3',
                'format' => 'raw',
                'value' => function ($data) { 
                        return "<span class=\"badge\" style=\"color: #000000;background-color:#ffff42\">".$data['LEVEL3']."</span>";
                }
            ],
                 
                  
//                    
//                    
//            [
//                'attribute' => 'LEVEL4',
//               // 'label' => 'BP ≥ 160/100 mmHg  '
//                'label' => 'LEVEL4'
//            ],
//                    
            [
                'attribute' => 'LEVEL4',
               //  'label' => 'BP 120-139/80-89 mmHg'
                'label' => 'LEVEL4',
                'format' => 'raw',
                'value' => function ($data) { 
                        return "<span class=\"badge\" style=\"color: #000000;background-color:#ff4709\">".$data['LEVEL4']."</span>";
                }
            ],                    
                    
                    
                    
            [
                'attribute' => 'NO_PP',
                'label' => 'ไม่ได้ปรับ'
            ],
            // with authorized
//            [
//                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//                'format' => 'raw',
//                'value' => function ($data) { 
//                    if (Yii::$app->user->isGuest) {
//                         return false;
////                    return Yii::$app->user->identity->role !==10 ?
////                            Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['dmregist/dmlistview', 'HOSPCODE' => $data['HOSPCODE']])) 
////                            :'ล็อกอิน' ;
//                    }
//                    return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
//                            Html::a('รายละเอียด', Yii::$app->urlManager->createUrl(['prediabetes/view', 'HOSPCODE' => $data['HOSPCODE']])) 
//                            :'' ;
//                },
//            ],
        ]
    ]);
?>






