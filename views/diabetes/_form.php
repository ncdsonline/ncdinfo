<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Diabetes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diabetes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOSPNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTH')->textInput() ?>

    <?= $form->field($model, 'SEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPEAREA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DISCHARGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DDISCHARGE')->textInput() ?>

    <?= $form->field($model, 'HOUSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VILLAGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VILLAGENAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAMBON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SUBDISTNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AMPUR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CHANGWAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_COMORBI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COMORBI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOSP_RX')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
