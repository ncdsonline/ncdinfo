<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeVisitlab */

$this->title = 'Update Me Visitlab: ' . ' ' . $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Me Visitlabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-visitlab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
