<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeVisitlabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Missed dTC by Village';
$this->params['breadcrumbs'][] = ['label' => 'dTC', 'url' => ['campaigne-td/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="box box-success box-solid">
        <div class="box-header">
            <h4>จำนวนผู้ที่ยังไม่ได้รับวัคซีน dTC จำแนก รายหมูบ้าน</h4>
        </div>   
<!--        <div class="box box-title">
               testtest
        </div>-->

        <div class="box-body">
         
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
                'columns' => [
                  //  ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute'=>'VILLAGE',
                        'label'=>'หมู่ที่'
                    ],
                    [
                        'attribute'=>'VNAME',
                        'label'=>'ชื่อหมู่บ้าน'
                    ],
                    [
                        'attribute'=>'TAMBONNAME',
                        'label'=>'ชื่อตำบล'
                    ],
                    [
                        'attribute'=>'MISSED',
                        'label'=>'ยังไม่ได้ฉีด'
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttonOptions'=>['class'=>'btn btn-default'],
                        'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {print}  </div>',
                        'options'=> ['style'=>'width:150px;'],
                        'buttons'=>[
                              'view' => function($url,$data,$key){
                                    return Html::a('<i class="glyphicon glyphicon-print"></i>',
                                    ['vaccine-campaigne/printmisseddt'
                                                ,'village'=>$data['VILLAGE'],
                                    ],
                                    ['class'=>'btn btn-default']);
                            },
                              'print' => function($url,$data,$key){
                                  return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                                    ['vaccine-campaigne/itemsmisseddt'
                                                ,'village'=>$data['VILLAGE'],
                                    ],
                                    ['class'=>'btn btn-default']);
                            }

                          ]
                      ],
                   
                ],
            ]); ?>
        </div>
</div>
