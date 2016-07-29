<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeVisitlab */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Me Visitlabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="me-visitlab-view">

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
            'HOSPCODE',
            'CID',
            'CREATED_AT',
            'CREATED_BY',
        ],
    ]) ?>

</div>
