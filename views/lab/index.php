<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Labs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'ID',
            'DATE_SERV',
            // 'SEQ',
            'CID',         
            'person.FNAME',
            'person.CID',
//            'LABTEST',
            // 'LABNAME',
            // 'LABRESULT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
