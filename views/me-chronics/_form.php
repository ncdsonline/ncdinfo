<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-chronics-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOSPNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTH')->textInput() ?>

    <?= $form->field($model, 'AGE')->textInput() ?>

    <?= $form->field($model, 'SEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPEAREA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DISCHARGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DDISCHARGE')->textInput() ?>

    <?= $form->field($model, 'HOUSE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VILLAGE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MOOBAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAMBON_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TAMBON')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AMPUR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CHANGWAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
