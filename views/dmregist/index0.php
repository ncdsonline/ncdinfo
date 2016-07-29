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

    <?= \yii\grid\GridView::widget([
                'id' => 'table',
                'dataProvider' => $dataProvider,
                'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
                'summary' => $count < 2 ? "" : "Showing {begin} - {end} of {totalCount} items",
                'tableOptions' => ['class' => 'table  table-bordered table-hover'],
                'rowOptions' => function ($model, $key, $index, $grid) {
                    return [
                        'style' => "cursor: pointer",
                        'onclick' => 'location.href="'
                            . Yii::$app->urlManager->createUrl('test/index')
                            . '?id="+(this.id);',
                    ];
                },
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['style' => 'width: 20px;', 'class' => 'text-center'],
                    ],
                    [
                        'class' => 'yii\grid\DataColumn',
                        'attribute' => 'date',
                        'headerOptions' => ['class' => 'text-center'],
                        'label' => 'Date',
                        'contentOptions' => ['style' => 'width: 130px;', 'class' => 'text-center'],
                    ],
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return \yii\helpers\Html::a('<div class="text-center"><em data-toggle="tooltip"
                                                            data-placement="top" title="more detail"
                                                            class="fa fa-external-link-square text-warning"></em></div>',
                                    (new yii\grid\ActionColumn())->createUrl('test/index', $model, $model['id'], 1), [
                                        'title' => Yii::t('yii', 'view'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]);
                            },
                        ]
                    ],
                
            ]); 
                            ?>



