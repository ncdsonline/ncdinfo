
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
// \yii\helpers\VarDumper::dump($dataProvider);
$this->title = 'Pre-DM';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
// echo $sql;
$this->params['breadcrumbs'][] = ['label' => 'ผลการปรับเปลี่ยนพฤติกรรม Pre-DM'];
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
                    ['content' => 'ผลการปรับเปลี่ยนพฤติกรรมในกลุ่มเสี่ยงโรคเบาหวาน', 'options' => ['colspan' => 9
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
////                'label' => ' น้อยกว่า 100 มก./ดล'
//                 'label' => 'LEVEL1'
//            ],
            
            [
                'attribute' => 'LEVEL1',
               // 'label' => ' น้อยกว่า 100 มก./ดล'
                'header' => '<span class=class="badge" style="background-color:#00b730">เสี่ยงต่ำ</span>',
                'format' => 'raw',
                'value' => function ($data) { 
//                   if($data['LEVEL1']>0){
                        return "<span class=\"badge\" style=\"background-color:#00b730\">".$data['LEVEL1']."</span>";
//                   }else{
//                        return "<span class=\"badge\" style=\"background-color: white\">".$data['LEVEL1']."</span>";
//                   }
                       
                }
            ],
                    
                    
//            [
//                'attribute' => 'LEVEL2',
////                'label' => '100-125 มก./ดล.'
//                 'label' => 'LEVEL2'
//            ],
                    
            [
                'attribute' => 'LEVEL2',
//               'label' => '100-125 มก./ดล.'
                'headerOptions' => ['style'=>'background-color: #3fff00'],
                'header' => '100-125 มก./ดล.',
                'format' => 'raw',
                'value' => function ($data) { 
//                   if($data['LEVEL2']>0){
                        return "<span class=\"badge\" style=\"background-color: #3fff00\">".$data['LEVEL2']."</span>";
//                   }else{
//                        return "<span class=\"badge\" style=\"background-color: white\">".$data['LEVEL1']."</span>";
//                   }
                       
                }
            ],
                 
                    
//                    
//            [
//                'attribute' => 'LEVEL3',
//               // 'label' => 'มากกว่า 125 มก./ดล.'
//                'label' => 'LEVEL3'
//            ],
            [
                'attribute' => 'LEVEL3',
               // 'label' => 'มากกว่า 125 มก./ดล.'
               'headerOptions' => ['style'=>'background-color: red'],
                'header' => 'มากกว่า 125 มก./ดล.',
                'format' => 'raw',
                'value' => function ($data) { 
//                   if($data['LEVEL3']<50){
                        return "<span class=\"badge\" style=\"background-color:  #ff8509\">".$data['LEVEL3']."</span>";
//                   }elseif($data['LEVEL3'] >50 && $data['LEVEL3'] <70 ){
//                        return "<span class=\"badge\" style=\"background-color: orange\">".$data['LEVEL3']."</span>";
//                   }
                       
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






