<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\VarDumper;
use app\models\Coffice;
use yii\helpers\ArrayHelper;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary box-solid">
    <div class=" box-header">
       <h2>.: สมัครใช้งาน  :.</h2>
    </div>   

      <div class="box-body">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
            ]); ?>

            <?php
        //    VarDumper::dump($model->getErrors(),10,true);
        //    VarDumper::dump($profile->getErrors(),10,true);
            ?>
			
                        <h4>ขอเชิญสมัครฟรี ไม่เสียค่าใช้จ่ายใดๆ</h4>  

            <?= $form->field($model, 'username') ?>
			<?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'email') ?>

          
			<?php

            $listOffice=ArrayHelper::map(Coffice::find()->asArray()->all(),'hoscode','hosname');
            echo $form->field($profile, 'office_id')->dropDownList($listOffice,[
                'prompt'=>'==กรุณาเลือก=='
            ]);
			?>

            <?= $form->field($profile, 'firstname') ?>

            <?= $form->field($profile, 'lastname') ?>
                    
            <?= $form->field($profile, 'photo')->fileInput() ?>
            <div class="form-group">
                <?= Html::submitButton('ตกลง', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
