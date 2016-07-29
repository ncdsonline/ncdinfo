<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeLabdeliverySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-labdelivery-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'CID') ?>

    <?= $form->field($model, 'HOSPCODE') ?>

    <?= $form->field($model, 'PID') ?>

    <?= $form->field($model, 'SEQ') ?>

    <?php // echo $form->field($model, 'DATE_SERV') ?>

    <?php // echo $form->field($model, 'LABTEST') ?>

    <?php // echo $form->field($model, 'LABRESULT') ?>

    <?php // echo $form->field($model, 'D_UPDATE') ?>

    <?php // echo $form->field($model, 'UPDATED_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
