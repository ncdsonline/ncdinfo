<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MeVisitlabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LabsQueue';
$this->params['breadcrumbs'][] = ['label' => 'bookqueue', 'url' => ['me-chronicregist/index']];
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
                    <?= Html::a('print', ['pdf', 'datestart' =>  $searchModel->datestart], ['class' => 'btn btn-success']) ?>
                </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'] ,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'CREATED_AT',
                    //'ID',
                    //'HOSPCODE',
                    'mechronicregist.HN_HMAIN',
                    'CID',
                    'mechronicregist.NAME',
                    'mechronicregist.LNAME',
                    'mechronicregist.HOUSE',
                    'mechronicregist.VILLAGE_ID',
                    'mechronicregist.DM_DX',
                    'mechronicregist.HT_DX',
                  //  'CREATED_AT',
                  //  'CREATED_BY',

                    ['class' => 'yii\grid\ActionColumn','template' => '{delete}',],
                ],
            ]); ?>
        </div>
</div>
