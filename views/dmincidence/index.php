
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
// \yii\helpers\VarDumper::dump($dataProvider);

?>

<!-------------------------------  breadcrumbs    ----------------------------------> 

<?php
// echo $sql;
$this->params['breadcrumbs'][] = ['label' => 'ผู้ป่วย DM รายใหม่'];
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
                    ['content' => 'ผู้ป่วยเบาหวานรายใหม่', 'options' => ['colspan' => 9
                            , 'class' => 'text-center danger']],
                ],
            // 'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        //  'floatHeader' => true,
        'layout' => "\n{pager}",
        'columns' => [
            [

                'attribute' => 'BYEAR',
                'label' => 'ปี พ.ศ.',
            ],
            [
                'attribute' => 'NUM_DM_TOTAL',
                'label' => 'รวมทั้งหมด'
            ],
            [
                'attribute' => 'NUM_DM_GRP1',
                'label' => 'อายุต่ำกว่า 35 ปี'
            ],
            [
                'attribute' => 'NUM_DM_GRP2',
                'label' => 'อายุ 35 ปีขึ้นไป'
            ],

        ]
    ]);
?>






