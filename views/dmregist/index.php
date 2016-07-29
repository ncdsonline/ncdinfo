<?php


use yii\helpers\Html;
use yii\helpers\Url;

// use kartik\grid\GridView;
use kartik\grid\GridView;

?>
<?php
//print_r($dataProvider);
// $office_id = Yii::$app->user->identity->profile->office_id;
?>
<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
$this->params['breadcrumbs'][] = ['label' => 'อัตราชุกโรคเบาหวาน', 'url' => ['dmregist/index']];
?>

<!-------------------------------  passing params    ----------------------------------> 

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
//        'toolbar' => [
//        ['content'=>
//            Html::a('Add', ['create'], ['data-pjax' => 'false', 'class' => 'btn btn-success']) .
//            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => false, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
//        ],
//        '{export}',
//        '{toggleData}'
//        ],
        
        /*
        // link grid
        'rowOptions' => function ($model, $key, $index, $grid) {
                    return [
                        'style' => "cursor: pointer",
                        'onclick' => 'location.href="'
                            . Yii::$app->urlManager->createUrl('dm/index')
                            . '?HOSPCODE="+(this.id);',
                    ];
                },
        
        */
        
        'hover' => true,
        'containerOptions' => ['style' => 'overflow: auto'],
        'panel' => [
            //  'heading' => '<b>My View</b>',
            'before' => 'KPI--65', //IMPORTANT
        ],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => 'อัตราชุกโรคเบาหวาน', 'options' => ['colspan' => 9
                            , 'class' => 'text-center warning']],
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
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a(Html::encode($data['HOSPCODE']), '#');
                },
//                'value' => function ($data) { 
//                    echo  Url::to(['site/index', 'src' => 'ref1', '#' => 'name']);
//                }  
                 // "Url: " . Url::to(['site/index', 'src' => 'ref1', '#' => 'name']);
               // 'content:html'=>'',
            ],
            [
                'attribute' => 'HNAME',
                'label' => 'หน่วยบริการ'
            ],
            [
                'attribute' => 'N',
                'label' => 'จำนวนผู้ป่วย DM'
            ],
            [
                'attribute' => 'POP',
                'label' => 'ประชากร'
            ],
            [
                'attribute' => 'RATE',
                'label' => 'ร้อยละ'
            ],
            // with authorized
            [
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'format' => 'raw',
                'value' => function ($data) { 
                    if (Yii::$app->user->isGuest) {
                         return false;
//                    return Yii::$app->user->identity->role !==10 ?
//                            Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['dmregist/dmlistview', 'HOSPCODE' => $data['HOSPCODE']])) 
//                            :'ล็อกอิน' ;
                    }
                    return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE'] ?
                            Html::a('ดูรายละเอียด!ที่นี่', Yii::$app->urlManager->createUrl(['dmregist/view', 'HOSPCODE' => $data['HOSPCODE']])) 
                            :'' ;
//                //Yii::$app->urlManager->createUrl([‘site/page’, ‘id’ => ‘about’])
//                // return $data['HOSPCODE']; // $data['name'] for array data, e.g. using SqlDataProvider.
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']?Html::url('site/index'):'';
//                // return Yii::$app->user->identity->profile->office_id == $data['HOSPCODE']? Html::a('<i class="glyphicon glyphicon-eye-open"></i>',Url::to(['viewdetail','HOSPCODE'=>$HOSPCODE])):'';
                },
                    ],
                ]
            ]);
        ?>




