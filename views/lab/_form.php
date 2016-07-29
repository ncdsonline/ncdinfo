<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEQ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE_SERV')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LABTEST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LABNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LABRESULT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
