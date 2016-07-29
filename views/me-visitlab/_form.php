<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeVisitlab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-visitlab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATED_AT')->textInput() ?>

    <?= $form->field($model, 'CREATED_BY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
