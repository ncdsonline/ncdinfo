
<?php

// use yii\grid\GridView;
use kartik\grid\GridView;

?>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'panel'=>[
        'before'=>'รายงาน',
        'after'=>'วันที่ออกรายงาน'
        
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'HOSPCODE',
//        [
//            'attribute' => 'hospnamenew',
//            'format' => 'raw',
//            'value' => Html::a($dataProvider->hospnamenew, ['update', 'id' => $dataProvider->id]),
//        ],
        'nPOP',
        // 'detail:ntext',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>