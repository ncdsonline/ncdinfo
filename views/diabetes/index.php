<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DiabetesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diabetes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diabetes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Diabetes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'HOSPCODE',
            'HOSPNAME',
            'PID',
            'CID',
            // 'NAME',
            // 'LNAME',
            // 'BIRTH',
            // 'SEX',
            // 'TYPEAREA',
            // 'DISCHARGE',
            // 'DDISCHARGE',
            // 'HOUSE',
            // 'VILLAGE',
            // 'VILLAGENAME',
            // 'TAMBON',
            // 'SUBDISTNAME',
            // 'AMPUR',
            // 'CHANGWAT',
            // 'DATE_DX',
            // 'DX',
            // 'TYPEDISCH',
            // 'DATE_COMORBI',
            // 'COMORBI',
            // 'HOSP_RX',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
