<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeLabdelivery */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Me Labdeliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-labdelivery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'CID',
            'HOSPCODE',
            'PID',
            'SEQ',
            'DATE_SERV',
            'LABTEST',
            'LABRESULT',
            'D_UPDATE',
            'UPDATED_AT',
        ],
    ]) ?>

</div>
