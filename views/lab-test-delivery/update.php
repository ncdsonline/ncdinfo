<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeLabdelivery */

$this->title = 'Update Me Labdelivery: ' . ' ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Me Labdeliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-labdelivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
