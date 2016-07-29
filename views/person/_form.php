<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'HOSPCODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRENAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SEX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTH')->textInput() ?>

    <?= $form->field($model, 'MSTATUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OCCUPATION_OLD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OCCUPATION_NEW')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RACE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NATION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RELIGION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EDUCATION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FSTATUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FATHER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MOTHER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'COUPLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VSTATUS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MOVEIN')->textInput() ?>

    <?= $form->field($model, 'DISCHARGE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DDISCHARGE')->textInput() ?>

    <?= $form->field($model, 'ABOGROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RHGROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LABOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASSPORT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TYPEAREA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'D_UPDATE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
