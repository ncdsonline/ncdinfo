<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeLabdelivery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-labdelivery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEQ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_SERV')->textInput() ?>

    <?= $form->field($model, 'LABTEST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LABRESULT')->textInput() ?>

    <?= $form->field($model, 'D_UPDATE')->textInput() ?>

    <?= $form->field($model, 'UPDATED_AT')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
