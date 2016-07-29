<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\MeVisitlabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-visitlab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


        <div class="col-lg-3">
            <?php
            echo $form->field($model, 'datestart')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => 'วันที่'
                ],
                'readonly' => true,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label(false);
            ?>
        </div>
        <div class="col-lg-3">
            <?php
            echo $form->field($model, 'datestop')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder' => 'วันที่'
                ],
                'readonly' => true,
                'language' => 'th',
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label(false);
            ?>
        </div>

    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ส่งออก PDF', ['pdf', ['datestart' =>  $model->datestart,'datestop' =>  $model->datestop]], ['class' => 'btn btn-success']) ?>
        <?= Html::a('เริ่มใหม่',['index'],['class'=>'btn btn-warning'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
