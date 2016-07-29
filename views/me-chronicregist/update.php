<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronicregist */

//$this->title = 'Update Me Chronicregist: ' . ' ' . $model->NAME;
//$this->params['breadcrumbs'][] = ['label' => 'Me Chronicregists', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->NAME, 'url' => ['view', 'id' => $model->ID]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="me-chronicregist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
