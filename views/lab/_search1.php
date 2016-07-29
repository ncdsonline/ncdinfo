<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'CID') ?>

    <?= $form->field($model, 'SEQ') ?>

    <?= $form->field($model, 'DATE_SERV') ?>

    <?= $form->field($model, 'LABTEST') ?>

    <?php // echo $form->field($model, 'LABNAME') ?>

    <?php // echo $form->field($model, 'LABRESULT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
