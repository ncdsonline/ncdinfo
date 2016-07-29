<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Labfu */

$this->title = 'Update Labfu: ' . ' ' . $model->HOSPCODE;
$this->params['breadcrumbs'][] = ['label' => 'Labfus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->HOSPCODE, 'url' => ['view', 'HOSPCODE' => $model->HOSPCODE, 'PID' => $model->PID, 'SEQ' => $model->SEQ, 'LABTEST' => $model->LABTEST]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="labfu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
