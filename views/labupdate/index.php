<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LabupdateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Labupdates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="labupdate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Labupdate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'CID',
            'person.NAME',
            'person.LNAME',
            'DATE_SERV',
            'n',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
