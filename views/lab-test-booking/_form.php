<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronicregist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-chronicregist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HN_HMAIN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HOSPNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTH')->textInput() ?>

    <?= $form->field($model, 'AGE')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'MAININSCL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HT_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RENAL_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISCHEMIC_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STROKE_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COPD_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASTHMA_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_BREAST_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_BREAST_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_BREAST_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_BREAST_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_BREAST_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_CERVIX_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_CERVIX_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_CERVIX_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_CERVIX_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_CERVIX_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_COLON_DATE_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_COLON_DX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_COLON_DATE_DISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_COLON_TYPEDISCH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CA_COLON_HOSP_RX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
