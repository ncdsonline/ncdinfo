<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronics */

$this->title = 'Update Me Chronics: ' . ' ' . $model->NAME;
$this->params['breadcrumbs'][] = ['label' => 'Me Chronics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-chronics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
