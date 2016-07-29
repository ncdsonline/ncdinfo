<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DiabetesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diabetes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'HOSPCODE') ?>

    <?= $form->field($model, 'HOSPNAME') ?>

    <?= $form->field($model, 'PID') ?>

    <?= $form->field($model, 'CID') ?>

    <?php // echo $form->field($model, 'NAME') ?>

    <?php // echo $form->field($model, 'LNAME') ?>

    <?php // echo $form->field($model, 'BIRTH') ?>

    <?php // echo $form->field($model, 'SEX') ?>

    <?php // echo $form->field($model, 'TYPEAREA') ?>

    <?php // echo $form->field($model, 'DISCHARGE') ?>

    <?php // echo $form->field($model, 'DDISCHARGE') ?>

    <?php // echo $form->field($model, 'HOUSE') ?>

    <?php // echo $form->field($model, 'VILLAGE') ?>

    <?php // echo $form->field($model, 'VILLAGENAME') ?>

    <?php // echo $form->field($model, 'TAMBON') ?>

    <?php // echo $form->field($model, 'SUBDISTNAME') ?>

    <?php // echo $form->field($model, 'AMPUR') ?>

    <?php // echo $form->field($model, 'CHANGWAT') ?>

    <?php // echo $form->field($model, 'DATE_DX') ?>

    <?php // echo $form->field($model, 'DX') ?>

    <?php // echo $form->field($model, 'TYPEDISCH') ?>

    <?php // echo $form->field($model, 'DATE_COMORBI') ?>

    <?php // echo $form->field($model, 'COMORBI') ?>

    <?php // echo $form->field($model, 'HOSP_RX') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
