<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeChronicregistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-chronicregist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'HN_HMAIN') ?>

    <?= $form->field($model, 'HOSPCODE') ?>

    <?= $form->field($model, 'HOSPNAME') ?>

    <?= $form->field($model, 'PID') ?>

    <?php // echo $form->field($model, 'CID') ?>

    <?php // echo $form->field($model, 'NAME') ?>

    <?php // echo $form->field($model, 'LNAME') ?>

    <?php // echo $form->field($model, 'BIRTH') ?>

    <?php // echo $form->field($model, 'AGE') ?>

    <?php // echo $form->field($model, 'SEX') ?>

    <?php // echo $form->field($model, 'TYPEAREA') ?>

    <?php // echo $form->field($model, 'DISCHARGE') ?>

    <?php // echo $form->field($model, 'DDISCHARGE') ?>

    <?php // echo $form->field($model, 'HOUSE') ?>

    <?php // echo $form->field($model, 'VILLAGE_ID') ?>

    <?php // echo $form->field($model, 'MOOBAN') ?>

    <?php // echo $form->field($model, 'TAMBON_ID') ?>

    <?php // echo $form->field($model, 'TAMBON') ?>

    <?php // echo $form->field($model, 'AMPUR') ?>

    <?php // echo $form->field($model, 'CHANGWAT') ?>

    <?php // echo $form->field($model, 'MAININSCL') ?>

    <?php // echo $form->field($model, 'DM_DATE_DX') ?>

    <?php // echo $form->field($model, 'DM_DX') ?>

    <?php // echo $form->field($model, 'DM_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'HT_DATE_DX') ?>

    <?php // echo $form->field($model, 'HT_DX') ?>

    <?php // echo $form->field($model, 'HT_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'RENAL_DATE_DX') ?>

    <?php // echo $form->field($model, 'RENAL_DX') ?>

    <?php // echo $form->field($model, 'RENAL_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'ISCHEMIC_DATE_DX') ?>

    <?php // echo $form->field($model, 'ISCHEMIC_DX') ?>

    <?php // echo $form->field($model, 'ISCHEMIC_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'STROKE_DATE_DX') ?>

    <?php // echo $form->field($model, 'STROKE_DX') ?>

    <?php // echo $form->field($model, 'STROKE_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'COPD_DATE_DX') ?>

    <?php // echo $form->field($model, 'COPD_DX') ?>

    <?php // echo $form->field($model, 'COPD_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'ASTHMA_DATE_DX') ?>

    <?php // echo $form->field($model, 'ASTHMA_DX') ?>

    <?php // echo $form->field($model, 'ASTHMA_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'CA_BREAST_DATE_DX') ?>

    <?php // echo $form->field($model, 'CA_BREAST_DX') ?>

    <?php // echo $form->field($model, 'CA_BREAST_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'CA_CERVIX_DATE_DX') ?>

    <?php // echo $form->field($model, 'CA_CERVIX_DX') ?>

    <?php // echo $form->field($model, 'CA_CERVIX_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'CA_COLON_DATE_DX') ?>

    <?php // echo $form->field($model, 'CA_COLON_DX') ?>

    <?php // echo $form->field($model, 'CA_COLON_TYPEDISCH') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
