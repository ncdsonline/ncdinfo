<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MeVisitlabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="me-visitlab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
    ]); ?>

    <div class="row">
        <div class="col-lg-3 ">
            <div id="datepicker">
            <?php
                echo $form->field($model, 'dateexam')->widget(DatePicker::classname(), [
                    'id'=>'datepicker',
                    'options' => [
                        'placeholder' => 'วันที่นัดตรวจแล็ป'
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
        </div>
            <div class="form-group">
                    <?= Html::submitButton( 'ส่งตรวจแล็ป', ['id'=>'btn-send','class' => 'btn btn-success' ]) ?>
                
                <?php 
                    if ((Yii::$app->request->post('ids')!==null)) {
                         // This button will be displayed, but is disabled 
                        Html::a('Create a Project', ['create'], ['class' => 'btn btn-primary btn-xs', 'disabled' => 'disabled']);
                    }
                ?>
                
                    <?= Html::a('พิมพ์ใบจองคิว', ['/lab-test-booking-letter/index'], ['class'=>'btn btn-primary']) ?>
                 <!--<a href="<?//= Url::to('index.php?r=lab-test-booking-letter')?>"> <i class="fa fa-file-text"></i> เรียกดูการจองคิว</a>-->
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
