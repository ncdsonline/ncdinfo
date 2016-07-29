<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeVisitlabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Letter';
$this->params['breadcrumbs'][] = ['label' => 'LabBooking', 'url' => ['lab-test-booking/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="box box-success box-solid">
        <div class="box-header">
            <h4>บัญชีรายชื่อผู้ป่วยที่จองคิวตรวจทางห้องปฎิบัติการ</h4>
        </div>   
<!--        <div class="box box-title">
               testtest
        </div>-->

        <div class="box-body">
            <div class="row">
             <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>    
                <p>
                    <?php // echo Html::a('print', ['pdf', ['datestart' =>  $searchModel->datestart,'datestop' =>  $searchModel->datestop]], ['class' => 'btn btn-success']) ?>
                </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    
//                    [
//                        'attribute'=>'CREATED_AT',
//                        'label'=>'วันเวลาที่บันทึกขัอมูล'
//                    ],
                    ['attribute'=>'CREATED_AT','format'=>'html','value'=>function($model, $key, $index, $column){
                       // return Yii::$app->formatter->asDate($model->CREATED_AT,'long'); //short,medium,long,full
                        return Yii::$app->formatter->asDateTime($model->CREATED_AT,'long');
                    }
                    ],
                    //'ID',
                    //'HOSPCODE',
                    [
                        'attribute'=>'mechronicregist.HN_HMAIN',
                        'label'=>'HN'
                    ],
                    
                    'mechronicregist.CID',
                    'mechronicregist.NAME',
                    'mechronicregist.LNAME',
                    'mechronicregist.HOUSE',
                    'mechronicregist.VILLAGE_ID',
                    'mechronicregist.DM_DX',
                    'mechronicregist.HT_DX',
                    [ // แสดงข้อมูล string
                        'attribute' => 'เลือด',
                        'format'=>'raw',
                        'value'=>function($model, $key, $index, $column){
                          return $model->BLOOD==1 ?  "<span style=\"color:green;\">มี</span>":"<span style=\"color:red;\">ไม่มี</span>";
                        }
                    ],        
                    [ // แสดงข้อมูล string
                        'attribute' => 'ปัสสาวะ',
                        'format'=>'raw',
                        'value'=>function($model, $key, $index, $column){
                          return $model->URINE==1 ? "<span style=\"color:green;\">มี</span>":"<span style=\"color:red;\">ไม่มี</span>";
                        }
                    ],

                  //  'CREATED_AT',
                  //  'CREATED_BY',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options'=>['style'=>'width:120px;'],
                        'buttonOptions'=>['class'=>'btn btn-default'],
                        'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {update} {delete} </div>'
                    ],
                ],
            ]); ?>
        </div>
</div>
