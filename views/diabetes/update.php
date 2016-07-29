<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diabetes */

$this->title = 'Update Diabetes: ' . ' ' . $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Diabetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diabetes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
