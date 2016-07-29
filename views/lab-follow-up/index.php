<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LabfuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Labfu All';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labfu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Labfu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'HOSPCODE',
            'chospital.hosname',
            'PID',
            'person.NAME',
            'person.LNAME',
            //'SEQ',
            'DATE_SERV',
            'LABTEST',
             'LABRESULT',
            // 'D_UPDATE',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
